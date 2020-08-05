<?php

/**
 * function returns the status of the customer's fitness subscription
 * @return array|int|null
 *
 * returns:
 * null if no subscription is found
 * -1 if subscription is cancelled
 * array of [0,expiration day] if subscription is expired
 * array of [1,expiration day] if subscription is actual
 */
function fitness_get_status()
{
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
    $id_service = 7;

    // getting details from the avesome db
    $query = "SELECT booking_date, cancelled FROM bookings WHERE id_user = ? and id_service = ?;";
    $result = db_query($query, [$awesome_user, $id_service]);

    $row = $result->fetch();
    if(!$row)
        return null;
    $time_end = $row['booking_date'];
    $cancelled = $row['cancelled'];

    if($cancelled)
        return -1;

    $time_now = date("Y-m-d H:i:m");
    $to_show_time = date("F j, Y",strtotime($time_end,0));

    if($time_now > $time_end)
        return [0,$to_show_time];
    else
        return [1,$to_show_time];
}

/**
 * function returns all subscriptions from external database for subscriptions table
 * @return array|null
 *
 * returns:
 * null if no subscription
 * array of the found subscriptions
 */
function fitness_get_table_subscriptions()
{
    $return = null;
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);

    $query = "SELECT subscriptions.id_subscription, subscriptions.id_check, subscriptions.duration, subscriptions.cancelled, services.service_name 
              FROM awesome_external.subscriptions INNER JOIN services on subscriptions.id_service = services.id_service
              WHERE id_user = ?;";
    $result = db_query($query, [$awesome_user]);

    while($row = $result->fetch())
    {
        $return[] = [$row['id_check'],$row['service_name'],$row['duration'], $row['cancelled'], $row['id_subscription']];
    }

    return $return;
}

