<?php
// DEBUGING !!!
ini_set('display_errors', 1);
error_reporting(E_ALL);


/**
 * Check if a slot can be canceled
 * @param $date
 * @return bool
 * returns true when the input date is the day after today's date or later
 * returns false when the input date is in the past or today
 */
function awesome_check_cancel_date($date)
{
    $today = date("Y-m-d");
    $limit = date("Y-m-d", strtotime($date, 0));

    if ($today >= $limit) {
        return false;
    } else {
        return true;
    }
}


//usage: Increasing user sessions in awesome DB after payment:
function awesome_after_payment_increase($order_id)
{
    $return = false;
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);

    //getting the latest order
    $order = new WC_Order($order_id);
    //getting the items from the order
    $items = $order->get_items();

    // iterating through all items from the order
    foreach ($items as $item) {
        $return = false;
        //getting product object
        $product = wc_get_product($item['product_id']);
        //getting product sku code
        $product_sku = $product->get_sku();
        $amount = $item['quantity'];

        //looking up the sku code into awesome db
        $query = "SELECT id_service,is_pass FROM awesome_external.services WHERE wp_sku_code = ?;";
        $result = db_query($query,[$product_sku]);

        // if found
        if($result->rowCount())
        {
            $row = $result->fetch();
            //checking if its a pass or a subscription
            if($row['is_pass'])
            {
                // increasing passes
                awesome_increase_pass($amount, $row['id_service']);

                //adding a record in sales table
                awesome_record_sale($awesome_user,$amount, $row['id_service'], $order_id);
                $return = true;
            }
            else
            {
                // very specific service id to duration attribution
                switch($row['id_service'])
                {
                    case 7:
                        $duration = 30;
                        break;
                    case 8:
                        $duration = 90;
                        break;
                    case 9:
                        $duration = 180;
                        break;
                    case 10:
                        $duration = 360;
                        break;

                    default:
                        return -2;
                }

                for($i=0;$i<$amount;$i++)
                {
                    awesome_add_subscription($duration, $row['id_service'], $order_id);

                    //adding a record in sales table
                    awesome_record_sale($awesome_user, $amount, $row['id_service'], $order_id);
                }
                $return = true;
            }
        }
        // when not found
        else
        {
            return -1;
        }
    }

    //Marking order
    if ($return === true) {
        $order->update_status('completed', 'order_note');
    } else {
        $order->update_status('processing', 'order_note');
    }
}
add_action('woocommerce_thankyou', 'awesome_after_payment_increase');


/**
 * Redirection function
 * @param null $exception
 * @param string $message
 */
function awesome_goto_fail_page($exception = null, $message = "Something didn't go smoothly!")
{
    $_SESSION['FAILS']['message'] = $message;
    $_SESSION['FAILS']['exception'] = $exception;
    wp_redirect(get_site_url() . '/fail/');
    die;
}


/**
 * Usage: Defining SMTP action for mailing
 */
function send_smtp_email($phpmailer)
{
//    $phpmailer->isSMTP();
//    $phpmailer->Host = SMTP_HOST;
//    $phpmailer->SMTPAuth = SMTP_AUTH;
//    $phpmailer->Port = SMTP_PORT;
//    $phpmailer->SMTPSecure = SMTP_SECURE;
//    $phpmailer->Username = SMTP_USERNAME;
//    $phpmailer->Password = SMTP_PASSWORD;
//    $phpmailer->From = SMTP_FROM;
//    $phpmailer->FromName = SMTP_FROMNAME;
}
add_action('phpmailer_init', 'send_smtp_email');


/**
 * @param $phpmailer
 * Setting up mailtrap plugin
 */
function mailtrap($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '6e3180e55323e5';
    $phpmailer->Password = '4a1a83a5ec50d3';
}
add_action('phpmailer_init', 'mailtrap');


/**
 * @param $id_subscription
 * @return bool|int
 * returns -3 when given id is invalid
 * returns -2 when more than one booking found on the same user
 * returns -1 when given subscription already activated or cancelled
 * returns 1 when all good
 */
function awesome_activate_subscribtion($id_subscription)
{
    $return = 1;
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
    $duration = -1;

    // checking if subscription id is not cancelled or already used
    $query = "SELECT duration,cancelled FROM awesome_external.subscriptions WHERE id_subscription = ?;";
    $result = db_query($query, [$id_subscription]);

    $row = $result->fetch();
    if(!$row)
    {
        $return = -3;
        $action = "Subscription Activation Failure: Invalid Subscription ID";
    }
     elseif($row['cancelled'])
    {
        $return = -1;
        $action = "Subscription Activation Failure: Subscription Already Activated or Cancelled.";
    }
    else
    {
        $duration = $row['duration'];
        $id_service = 7; //standard


        //checking for an existing booking in external db of the same user
        $query = "SELECT id_booking,booking_date  FROM awesome_external.bookings WHERE id_user = ? and id_service = ?;";
        $result = db_query($query, [$awesome_user, $id_service]);

        $row_num = $result->rowCount();
        //checking if there is already an active subscription in awesome db
        if ($row_num === 1)
        {
            $log = $result->fetch();

            //checking if subscription is expired
            if (date('Y-m-d') > $log['booking_date'])
                //expired
            {
                $end_date = date("Y-m-d", strtotime("today + $duration day"));
            } // not expired
            else
            {
                $end_date = date("Y-m-d", strtotime($log['booking_date'] . " + $duration day"));
            }

            $query = "UPDATE awesome_external.bookings SET booking_date = ? WHERE id_booking = ?;";
            db_query($query, [$end_date, $log['id_booking']]);
            $action = "Subscription Activation: Updated Existing Booking";

        } elseif ($row_num === 0)
        {
            $end_date = date("Y-m-d", strtotime("today + $duration day"));

            $query = "INSERT INTO awesome_external.bookings VALUE (NULL,?,?,?,NULL,NULL,?);";
            db_query($query, [$id_service, $awesome_user, $end_date, 0]);

            $action = "Subscription Activation: Created New Booking";
        } else
        {
            $action = "Subscription Activation Fatal Error: More than One Booking Found";
            $return = -2;
        }

        // cancelling the activated subscription
        $query = "UPDATE awesome_external.subscriptions SET cancelled = 1 WHERE id_subscription = ?;";
        db_query($query, [$id_subscription]);
    }

    // adding new change in passes actions table
    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUE (NULL, NULL, ?, ?, ?, ?);";
    $argz = [$id_subscription,$timestamp, $action, $duration];
    db_query($query,$argz);

    return $return;
}

/**
 * function responsable for increasing passes
 * @param $amount of increasing pass
 * @param $id_service of the service to be increased
 */
function awesome_increase_pass($amount, $id_service)
{
    $return = true;
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);

    $query = "SELECT id_pass FROM awesome_external.passes WHERE id_user = ? AND id_service = ?";
    $result = db_query($query, [$awesome_user, $id_service]);

    $row_num = $result->rowCount();
    if ($row_num === 1) {
        $log = $result->fetch();
        $query = "UPDATE awesome_external.passes SET pass_amount = pass_amount + ? WHERE id_pass = ?;";
        db_query($query, [$amount, $log['id_pass']]);

        $action = "Passes Increased";
    } elseif ($row_num === 0) {
        $query = "INSERT INTO awesome_external.passes VALUE (NULL,?,?,?);";
        db_query($query, [$id_service, $awesome_user, $amount]);

        $action = "New Pass";
    } else
    {
        $action = "Fatal Error: More than One Pass Found";
        $return = -1;
    }

    // getting the updated pass id
    $query = "SELECT id_pass FROM awesome_external.passes WHERE id_user = ? AND id_service = ?";
    $result = db_query($query, [$awesome_user, $id_service]);
    $row = $result->fetch();

    // adding new change in passes actions table
    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUE (NULL, ?, NULL, ?, ?, ?);";
    $argz = [$row['id_pass'],$timestamp, $action, $amount];
    db_query($query,$argz);

    return $return;
}


/**
 * Decreases sessions in awesome DB
 * @param $amount
 * @param $id_service
 * @return bool|int
 * returns -2 when not enough sessions
 * returns -1 when wrong passes logs found in db
 * returns true when all good
 */
function awesome_decrease_pass($amount, $id_service)
{
    $return = true;
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);

    $query = "SELECT id_pass,pass_amount FROM awesome_external.passes WHERE id_user = ? AND id_service = ?";
    $result = db_query($query, [$awesome_user, $id_service]);

    // checking if there are enough passes to subtract
    $row_num = $result->rowCount();
    if ($row_num == 1) {
        $row = $result->fetch();
        if ($row['pass_amount'] < $amount)
        {
            $return = -2;
            $action = "Pass Decreasing Failure: Not Enough Passes";
        }
//            awesome_goto_fail_page(null, "Nu aveți suficiente sesiuni pentru serviciul ales!");
        if($return === true)
        {
            $query = "UPDATE awesome_external.passes SET pass_amount = pass_amount - ? WHERE id_pass = ?;";
            db_query($query, [$amount, $row['id_pass']]);
            $action = "Passes Decreased";
        }
    } else
        $return = -1;
//        awesome_goto_fail_page("CRITICAL SPA Res_Decrease ##1",
//            "O eroare internă a avut loc.<br> Vă rugam insistent să păstrați datele din această pagină și să ne contactați imediat!");


    // adding new change in passes actions table
    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUE (NULL, ?, NULL, ?, ?, ?);";
    $argz = [$row['id_pass'],$timestamp, $action, $amount];
    db_query($query,$argz);

    return $return;
}


/**
 * function responsable for increasing passes
 * @param $amount of increasing pass
 * @param $id_service of the service to be increased
 */
function awesome_add_subscription($duration, $id_service, $id_check=-1)
{
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);

    $query = "INSERT INTO awesome_external.subscriptions VALUE (NULL,?,?,?,?,?);";
    $argz = [$id_service, $awesome_user, $id_check, $duration, 0];
    db_query($query, $argz);

    // getting the id of the new added subscription
    $query = "SELECT id_subscription FROM awesome_external.subscriptions WHERE id_service = ? and id_user = ?
     and id_check = ? ORDER BY id_subscription DESC;";
    $argz = [$id_service, $awesome_user, $id_check];
    $result = db_query($query, $argz);

    // adding new change in passes actions table
    $log = $result->fetch();
    $action = "New Subscription";
    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUE (NULL, NULL, ?, ?, ?, ?);";
    $argz = [$log['id_subscription'],$timestamp, $action, $duration];
    db_query($query,$argz);

    return true;
}


/**
 * functions used for cancelling or activating subscriptions
 * @param $id_subscription
 */
function awesome_cancel_subscribtion($id_subscription)
{
    $return = true;
    // checking if the selected subscription is not already used
    $query = "SELECT cancelled FROM awesome_external.subscriptions WHERE id_subscription = ?";
    $result = db_query($query, [$id_subscription]);

    $row_num = $result->rowCount();
    if ($row_num == 1) {
        $row = $result->fetch();
        if ($row['cancelled'] != 0)
        {
            $return = -2;
            $action = "Cancellation Request Failure: Subscription Already Cancelled or Activated";
        }
    }

    //cancelling subscr
    if($return === true)
    {
        $query = "UPDATE awesome_external.subscriptions SET cancelled = 1 WHERE id_subscription = ?;";
        db_query($query, [$id_subscription]);
        $action = "Subscription Cancelled or Activated";
    }

    // adding new change in passes actions table
    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUE (NULL, NULL,?, ?, ?, ?);";
    $argz = [$id_subscription,$timestamp, $action, -1];
    db_query($query,$argz);

    return $return;
}


/**
 *  User insertion in external awesome database after wp registration
 * @param $WP_user_id
 * @return bool
 */
function awesome_user_insert($WP_user_id)
{
//collecting general data: id & email
    $user = get_user_by("ID", $WP_user_id);
    $user_email = $user->user_email;

    if (!$user_email) // no user email found : invalid case
        awesome_goto_fail_page("Registration WP no user id or email found");

//looking for user email in external db
    $found_in_wonder_DB = false;
    $query = "SELECT * FROM awesome_external.users WHERE email = ?;";

    $res = db_query($query, [$user_email]);
    $rows_found = $res->rowCount();
    if ($rows_found > 0)
        $found_in_wonder_DB = true;

// Getting first & last name
    if (um_user('first_name') && um_user('last_name')) {
        $user_firstname = um_user('first_name');
        $user_lastname = um_user('last_name');
    } else {
        $user_firstname = um_user('display_name');
        $user_lastname = "";
    }

// Gender
    $meta = get_user_meta($WP_user_id, 'gender');
    if ($meta[0][0]{0} == 'M') {
        $sex = 'M';
    } else {
        $sex = 'F';
    }

// Birth date
    $meta = get_user_meta($WP_user_id, 'birth_date');
    $def = $meta[0];
    $birth_date = str_replace('/', '-', $def);

    $mobile_number = get_user_meta($WP_user_id, 'mobile_number')[0];

// Insert new wp user into external db:
    if (!$found_in_wonder_DB) {
        $query = "INSERT INTO awesome_external.users VALUE (NULL, ?, ?, ?, ?, ?, ?);";
        $argz = [$user_firstname, $user_lastname, $sex, $birth_date, $user_email, $mobile_number];
// or update info if its email was found
    } else {
        $query = "UPDATE awesome_external.users SET last_name=?, first_name=?, call_number=? WHERE email=?;";
        $argz = [$user_lastname, $user_firstname, $mobile_number, $user_email];
    }
    db_query($query, $argz);

// Getting user id from awesome external db and adding it in wp user meta
    $query = "SELECT id_user FROM awesome_external.users WHERE email= ?;";
    $res = db_query($query, [$user_email]);

    $awesome_user_id = ($res->fetch())['id_user'];
    if (!$awesome_user_id) {
//        wp_delete_user($WP_user_id); !!!
        awesome_goto_fail_page("Registration WDL no user id returned");
    }

    update_user_meta($WP_user_id, 'awesome_user_id', $awesome_user_id);

    return true;
}
add_action( 'um_after_email_confirmation', 'awesome_user_insert', 90, 1 );
add_action( 'um_after_user_is_approved', 'awesome_user_insert', 11, 1 );

/**
 * function used to store payment information
 * @param $id_user
 * @param $amount
 * @param $id_service
 * @param $id_check
 */
function awesome_record_sale($id_user, $amount, $id_service, $id_check)
{
    $return = true;

    $query = "INSERT INTO awesome_external.sales VALUE (NULL,?,?,?,?);";
    db_query($query, [$id_service,$id_user,$id_check,$amount]);

    return $return;
}

/**
 * @param $booking_date
 * @param $booking_time_start
 * @param $booking_time_end
 * @param $id_service
 * @return int
 * returns -3 when pass decreasing failed
 * returns -2 when argument failed
 * returns -1 when booking requested in the past
 * returns 0 when there is another booking at that time
 * returns 1 when it is successfully
 */
function awesome_make_new_booking($booking_date, $booking_time_start, $booking_time_end, $id_service)
{
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
    $return = 1;

    if(is_null($booking_date) || is_null($booking_time_start) || is_null($booking_time_end) || is_null($id_service))
    {
        $act = "Booking: Passed arguments failed:d-$booking_date,ts-$booking_time_start,te-$booking_time_end,s-$id_service";
        $return = -2;
    }

    //transforming time formats
    $booking_time_start = date("H:i",strtotime("$booking_time_start"));
    $booking_time_end = date("H:i",strtotime("$booking_time_end"));

    if($return === 1)
    {
        // Check if reservation is not in the past:
        $check = false;
        if ($booking_date === date("Y-m-d"))
        {
            if ($booking_time_start < date("H:i"))
                $check = true;
        } elseif ($booking_date < date("Y-m-d"))
            $check = true;

        if ($check)
        {
            $act = "Booking: Requested date in the past:$booking_date & current date is ".date("Y-m-d");
            $return = -1;
        }
    }

    // Recheck if requested time is still available:
    if($return === 1)
    {
        $query = "SELECT id_booking from awesome_external.bookings WHERE id_user= ? and id_service=? AND booking_date=? AND
              booking_time_start=? and booking_time_end=? and cancelled = ?";
        $result = db_query($query, [$awesome_user, $id_service, $booking_date, $booking_time_start, $booking_time_end, 0]);
        if ($result->rowCount() > 0)
        {
            $act = "Booking: Requested time is already booked by another booking: $booking_date at $booking_time_start";
            $return = 0;
        }
    }

    // decreasing pass
    if($return === 1)
    {
        $status = awesome_decrease_pass(1, $id_service);
        if ($status !== true)
        {
            $act = "Booking: Decreasing pass failed";
            $return = -3;
        }
    }

    // Insert new booking into external db
    if($return === 1)
    {
        $query = "INSERT INTO awesome_external.bookings VALUES (NULL,?,?,?,?,?,?);";
        db_query($query, [$id_service, $awesome_user, $booking_date, $booking_time_start, $booking_time_end, 0]);
        $act = "Booking: New Booking Made Successfully";
    }

    // Insert info log into passes_actions table
    $query = "SELECT id_pass FROM awesome_external.passes WHERE id_service = ? and id_user = ?;";
    $res = db_query($query, [$id_service, $awesome_user]);
    $id_pass = $res->fetch()['id_pass'];

    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUES (NULL,?,NULL,?,?,?);";
    db_query($query,[$id_pass,$timestamp,$act,0]);

    return $return;
}

/**
 * @param $id_booking
 * @param $id_service
 * @return int
 * returns -2 when booking was not found in database
 * returns -1 when pass increment failed
 * returns 0 when booking is already cancelled
 * returns 1 when all good
 */
function awesome_cancel_booking($id_booking, $id_service=null)
{
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
    $return = 1;

    //checking booking information
    $query = "SELECT cancelled, id_service FROM awesome_external.bookings WHERE id_booking = ?;";
    $res = db_query($query,[$id_booking]);
    $row = $res->fetch();

    //if booking wasn't found in db
    if(!isset($row['cancelled']))
    {
        $act = "Booking Cancellation: Invalid booking id given: $id_booking";
        $return = -2;
    }
    //if booking is already cancelled
    if($return === 1 && $row['cancelled'] !== 0)
    {
        $act = "Booking Cancellation: Spotted cancellation request on a cancelled booking: $id_booking";
        $return = 0;
    }

    // cancelling booking into external db
    if($return === 1)
    {
        $query = "UPDATE awesome_external.bookings SET cancelled = 1 WHERE id_booking = ?;";
        db_query($query,[$id_booking]);

        $act = "Booking Cancellation: Cancellation Successfully: $id_booking";
        $return = 1;
    }

        // increasing pass
    if($return === 1)
    {
        $status = awesome_increase_pass(1, $row['id_service']);
        if ($status !== true)
        {
            $act = "Booking Cancellation: Increasing pass failed: $id_booking";
            $return = -1;
        }
    }


    // Insert info log into passes_actions table
    $query = "SELECT id_pass FROM awesome_external.passes WHERE id_service = ? and id_user = ?;";
    $res = db_query($query, [$row['id_service'], $awesome_user]);
    $id_pass = $res->fetch()['id_pass'];

    $timestamp = date("Y-m-d H:i:s");
    $query = "INSERT INTO awesome_external.passes_actions VALUES (NULL,?,NULL,?,?,?);";
    db_query($query,[$id_pass,$timestamp,$act,0]);

    return $return;
}

