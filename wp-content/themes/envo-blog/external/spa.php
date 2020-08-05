<?php
//
//// Function used to displaying Reservation Table
//function Reservation_spa_get_slots($date, $type)
//{
//    $is_rent = false;
//    switch($type)
//    {
//        case "sf_1_lv":
//        case "sf_1_sd":
//            break;
//        case "is_15":
//        case "is_20":
//        case "is_25":
//            $is_rent = true;
//            break;
//        default:
//            awesome_goto_fail_page("CRITICAL SPA Res_Get_Slots ##1");
//    }
//
//    if($is_rent)
//    {
//        $availableSlots = Reservation_spa_get_available_slots_rent($date);
//    }
//    else
//    {
//        $availableSlots = Reservation_spa_get_available_slots_1x($date);
//    }
//
//    if(!$availableSlots)
//    {
//        // Return empty table if there are no available slots
//        return NULL;
//    }
//
//    return $availableSlots;
//}
//
//// Gets the list of available slots for renting spa servide
//function Reservation_spa_get_available_slots_rent($date)
//{
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//
//    $query = "SELECT closed,allow_night FROM wonderland.zile_speciale_spa WHERE data=?";
//    $result = db_query($query,[$date]);
//    $row = $result->fetch();
//    if(isset($row['closed']) && $row['closed'] != 0 || isset($row['allow_night']) && $row['allow_night'] == 0)
//        return null;
//
//    $query = "SELECT id_programare_spa FROM wonderland.programare_spa
//                WHERE id_client=? AND ziua=? AND start_time='22:00:00.000000' AND anulat=0";
//    $result = db_query($query,[$Wonder_user_id, $date]);
//
//    if($result->fetchAll())
//    {
//        $return = null;
//    }
//    else
//    {
//        return array("22:00");
//    }
//
//    return $return;
//}
//
//// Gets the list of available slots 1 time reservation spa servide
//function Reservation_spa_get_available_slots_1x($date)
//{
//    $return = [];
//
//    $query = "SELECT closed,start_time,end_time,nr_max_persoane FROM wonderland.zile_speciale_spa WHERE data=?";
//    $result = db_query($query,[$date]);
//    if($row = $result->fetchAll())
//    {
//        $row = $row[0];
//        if (isset($row['closed']) && $row['closed'] != 0)
//            return null;
//        $start_time = strtotime($row['start_time'], 0);
//        $end_time = strtotime($row['end_time'], 0);
//        $step = strtotime('+60 minute', 0);
//        $checkedHour = $start_time;
//        $people_amount = $row['nr_max_persoane'];
//    }
//    // No special day so getting info from orar
//    else
//    {
//        $dayOfTheWeek = date("l", strtotime($date));
//
//        $query = "SELECT closed,start_time,end_time,nr_max_persoane FROM wonderland.orar_spa WHERE ziua = ?;";
//        $res = db_query($query,[$dayOfTheWeek]);
//
//        $row = $res->fetch();
//        if ($row['closed'])
//        {
//            return null;
//        }
//        $start_time = strtotime($row['start_time'], 0);
//        $end_time = strtotime($row['end_time'], 0);
//        $step = strtotime('+60 minute', 0);
//        $checkedHour = $start_time;
//        $people_amount = $row['nr_max_persoane'];
//    }
//
//    // Generating available slots
//    while($checkedHour < $end_time)
//    {
//        $slot = date('H:i', ($checkedHour));
//        if($slot == "22:00")
//        {
//            $checkedHour += $step;
//            continue;
//        }
//            if($date === date("Y-m-d"))
//        {
//            if ($slot > date("H:i"))
//                $return[] = $slot ;
//        }
//        else
//        {
//            $return[] = $slot;
//        }
//
//        $checkedHour += $step;
//    }
//
//    // Getting booking times form WDL DB
//    $query = "SELECT start_time FROM wonderland.programare_spa WHERE ziua = ? AND anulat=0";
//    $res = db_query($query,[$date]);
//    $bookings = array();
//    while($row = $res->fetch())
//    {
//        $bookings[] = date("H:i", strtotime($row['start_time']));
//    }
//
//    // * Filtram sloturile disponibile dupa numarul de people_amount:
//    $logs = $return;
//    $return = array();
//
//    if(isset($logs))
//    foreach ($logs as $log)
//    {
//        $superior_limit = strtotime($log ." + 3 hour");
//        $inferior_limit = strtotime( $log ." - 3 hour");
//        $logs_whithin_range = 0;
//        foreach ($bookings as $booking)
//        {
//            $checked_time = strtotime($booking);
//            if($checked_time <= $superior_limit && $checked_time >= $inferior_limit)
//            {
//                $logs_whithin_range++;
//            }
//        }
//
//        if($people_amount > $logs_whithin_range)
//        {
//            $return[] = $log;
//        }
//    }
//
//    return $return;
//}
//
//// Reserving spa into Wonderland database
//function Reservation_spa_reserve()
//{
//    /** @var  $wonder_id */
//    $wonder_id = $_SESSION['reservation']['wonder_id'];
//    if(!$wonder_id)
//        awesome_goto_fail_page("Unsigned wonder_id",
//            "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//
//    /** @var  $reservationTime */
//    $reservationTime = date('H:i:s.u',strtotime($_SESSION['reservation']['time'],0));
//    if(!$reservationTime)
//        awesome_goto_fail_page("Unsigned time",
//            "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//
//    /** @var  $reservationDate */
//    $reservationDate = $_SESSION['reservation']['date'];
//    if(!$reservationDate)
//        awesome_goto_fail_page("Unsigned date",
//            "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//
//    // Checking service @var & creating query for new reservation
//    $service = $_SESSION['reservation']['service'];
//    switch ($service)
//    {
//        case "sf_1_lv":
//            $is_wknd = false;
//            break;
//        case "sf_1_sd":
//            $is_wknd = true;
//            break;
//        case "is_15":
//        case "is_25":
//        case "is_20":
//            break;
//
//        default:
//            awesome_goto_fail_page("Unsigned service",
//                "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//    }
//
//    // Check if reservation is not in the past:
//    if($reservationDate === date("Y-m-d"))
//    {
//        if ($reservationTime < date("H:i"))
//            awesome_goto_fail_page("Reservation in the past req",
//                "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//    }
//    elseif($reservationDate < date("Y-m-d"))
//        awesome_goto_fail_page("Reservation in the past req",
//            "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//
////    // Recheck if requested time is still available:
////    $query = "SELECT id_programare_spa from wonderland.programare_spa WHERE start_time='$reservationTime' AND ziua='$reservationDate' AND anulat=0";
////    $result = Repeat_DB_connection($query,$wonderland_DB_connection,8);
////    if(!$result)
////    {
////        if (isset($_SESSION['reservation']))
////        {
////            unset($_SESSION['reservation']);
////        }
////        $_SESSION['FAILS'] = 'Conexiunea cu baza de date a expirat #426.<br>Încercați mai târziu!';
////        die();
////    }
////    if(mysqli_num_rows($result) > 0)
////    {
////        $_SESSION['FAILS'] = 'Rezervarea la ora cerută a fost deja ocupată.';
////        die();
////    }
//
//    // Recheck if requested reservation is for suitable day: sd for weekend and lv for weekdays
//    if
//    (
//        isset($is_wknd) &&
//        ($is_wknd && (!(date('N', strtotime($reservationDate)) >= 6)) ||
//        !$is_wknd && (!(date('N', strtotime($reservationDate)) <= 5)))
//    )
//        awesome_goto_fail_page("Wrong resservation type",
//            "<h1 class=\"\" style=\"margin-bottom: 3%\">Rezervarea făcută a eșuat!</h1>
//                        <h2>Încercați din nou sau <a href='contact' style='color:#d4d1c2;''>contactați-ne</a> în caz ca se repetă</h2>");
//
//    Reservation_spa_decrease_sessions(1, $service);
//
//    $query_ = "INSERT INTO wonderland.programare_spa VALUES
//                        (NULL,?,?,?,'Web', 0, ?); ";
//    db_query($query_,[$wonder_id,$reservationDate,$reservationTime,$service]);
//
//    header("Location: reservation-result/");
//    die();
//}
//
//// Increases spa session number in WDL DB
//function Reservation_spa_increase_sessions($amount, $type)
//{
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//
//    $query = "SELECT id_client_spa FROM wonderland.client_spa WHERE id_client = ? AND tip_abonament = ?";
//    $result = db_query($query,[$Wonder_user_id,$type]);
//
//    $row_num = $result->rowCount();
//    if($row_num === 1)
//    {
//        $log = $result->fetch();
//        $query = "UPDATE wonderland.client_spa SET nr_sedinte_ramase = nr_sedinte_ramase + ? WHERE id_client = ? AND id_client_spa = ?;";
//        db_query($query,[$amount, $Wonder_user_id, $log['id_client_spa']]);
//    }
//    elseif($row_num === 0)
//    {
//        $query = "INSERT INTO wonderland.client_spa VALUE (NULL,?,?,?);";
//        db_query($query, [$Wonder_user_id, $amount, $type]);
//    }
//    else
//        awesome_goto_fail_page("CRITICAL SPA Res_Increase ##1",
//            "O eroare internă a avut loc.<br> Vă rugam insistent să păstrați datele din această pagină și să ne contactați imediat!");
//}
//
//// Decreases spa session number in WDL DB
//function Reservation_spa_decrease_sessions($amount, $type)
//{
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//
//    $query = "SELECT id_client_spa,nr_sedinte_ramase FROM wonderland.client_spa WHERE id_client = ? AND tip_abonament = ?";
//    $result = db_query($query,[$Wonder_user_id,$type]);
//
//    $row_num = $result->rowCount();
//    if($row_num == 1)
//    {
//        $row = $result->fetch();
//        if($row['nr_sedinte_ramase'] < $amount)
//            awesome_goto_fail_page(null,"Nu aveți suficiente sesiuni pentru serviciul ales!");
//
//        $query = "UPDATE wonderland.client_spa SET nr_sedinte_ramase = nr_sedinte_ramase - ? WHERE id_client = ? AND id_client_spa = ?;";
//        db_query($query,[$amount, $Wonder_user_id, $row['id_client_spa']]);
//    }
//    else
//        awesome_goto_fail_page("CRITICAL SPA Res_Decrease ##1",
//            "O eroare internă a avut loc.<br> Vă rugam insistent să păstrați datele din această pagină și să ne contactați imediat!");
//}
//
//// Extends spa subscriptions in WDL DB
//function Reservation_spa_extend_subscribe($days, $type)
//{
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//
//    $query = "SELECT id_abonament_activ_spa,valabilitate FROM wonderland.abonament_activ_spa WHERE id_client = ? AND tip_abonament = ?";
//    $result = db_query($query,[$Wonder_user_id,$type]);
//
//    $row_num = $result->rowCount();
//    if($row_num == 1)
//    {
//        $log = $result->fetch();
//        $DB_validity = $log['valabilitate'];
//
//        // Setting validity value by extending actual one or creating new
//        if(date("Y-m-d") > $DB_validity)
//            $validity = date("Y-m-d",strtotime("today + $days day"));
//        else
//            $validity = date("Y-m-d",strtotime("$DB_validity + $days day"));;
//
//        $query = "UPDATE wonderland.abonament_activ_spa SET valabilitate = ? ".
//            "WHERE id_client = ? AND id_abonament_activ_spa = ?;";
//        db_query($query,[$validity,$Wonder_user_id, $log['id_abonament_activ_spa']]);
//    }
//    elseif(mysqli_num_rows($result) == 0)
//    {
//        $validity = date("Y-m-d",strtotime("today + $days days"));
//        $query = "INSERT INTO wonderland.abonament_activ_spa VALUE (NULL,?,?,?);";
//        db_query($query,[$Wonder_user_id,$type,$validity]);
//    }
//    else
//    {
//        awesome_goto_fail_page("CRITICAL SPA Res_Increase_A ##1",
//            "O eroare internă a avut loc.<br> Vă rugam insistent să păstrați datele din această pagină și să ne contactați imediat!");
//    }
//}
//
//// Getting spa session amount from DB and storing them into array
//function Reservation_spa_get_all_sessions()
//{
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//
//    $return_arr = array();
//
//    $query = "SELECT tip_abonament,nr_sedinte_ramase FROM wonderland.client_spa WHERE id_client = ?";
//    $result = db_query($query,[$Wonder_user_id]);
//
//    while($row = $result->fetch())
//    {
//        switch($row['tip_abonament'])
//        {
//            case "sf_1_lv":
//                if($row['nr_sedinte_ramase'] == 0)
//                    $return_arr['sf_1_lv'] = '-';
//                else
//                    $return_arr['sf_1_lv'] = $row['nr_sedinte_ramase'];
//                break;
//            case "sf_1_sd":
//                if($row['nr_sedinte_ramase'] == 0)
//                    $return_arr['sf_1_sd'] = '-';
//                else
//                    $return_arr['sf_1_sd'] = $row['nr_sedinte_ramase'];
//                break;
//            case "is_15":
//                if($row['nr_sedinte_ramase'] == 0)
//                    $return_arr['is_15'] = '-';
//                else
//                    $return_arr['is_15'] = $row['nr_sedinte_ramase'];
//                break;
//            case "is_20":
//                if($row['nr_sedinte_ramase'] == 0)
//                    $return_arr['is_20'] = '-';
//                else
//                    $return_arr['is_20'] = $row['nr_sedinte_ramase'];
//                break;
//            case "is_25":
//                if($row['nr_sedinte_ramase'] == 0)
//                    $return_arr['is_25'] = '-';
//                else
//                    $return_arr['is_25'] = $row['nr_sedinte_ramase'];
//                break;
//            default:
//                awesome_goto_fail_page("SPA Res_Get_All_Session ##1");
//        }
//    }
//
//    $query = "SELECT tip_abonament,valabilitate FROM wonderland.abonament_activ_spa WHERE id_client = ?";
//    $result = db_query($query,[$Wonder_user_id]);
//    while($row = $result->fetch())
//    {
//            switch ($row['tip_abonament'])
//            {
//
//                case "as_30_lv":
//                    if($row['valabilitate'] < date("Y-m-d"))
//                        $return_arr['as_30_lv'] = '-';
//                    else
//                        $return_arr['as_30_lv'] = date("d F Y",strtotime($row['valabilitate'],0));
//                    break;
//                case "af_30_ld":
//                    if($row['valabilitate'] < date("Y-m-d"))
//                        $return_arr['af_30_ld'] = '-';
//                    else
//                        $return_arr['af_30_ld'] = date("d F Y",strtotime($row['valabilitate'],0));
//                    break;
//                case "asf_30_lv":
//                    if($row['valabilitate'] < date("Y-m-d"))
//                        $return_arr['asf_30_lv'] = '-';
//                    else
//                        $return_arr['asf_30_lv'] = date("d F Y",strtotime($row['valabilitate'],0));
//                    break;
//                case "asf_365_ld":
//                    if($row['valabilitate'] < date("Y-m-d"))
//                        $return_arr['asf_365_ld'] = '-';
//                    else
//                        $return_arr['asf_365_ld'] = date("d F Y",strtotime($row['valabilitate'],0));
//                    break;
//                default:
//                    awesome_goto_fail_page("SPA Res_Get_All_Session ##2");
//            }
//    }
//
//    if(!isset($return_arr['sf_1_lv']))
//    {
//        $return_arr['sf_1_lv'] = '-';
//    }
//    if(!isset($return_arr['sf_1_sd']))
//    {
//        $return_arr['sf_1_sd'] = '-';
//    }
//    if(!isset($return_arr['is_15']))
//    {
//        $return_arr['is_15'] = '-';
//    }
//    if(!isset($return_arr['is_20']))
//    {
//        $return_arr['is_20'] = '-';
//    }
//    if(!isset($return_arr['is_25']))
//    {
//        $return_arr['is_25'] = '-';
//    }
//    if(!isset($return_arr['as_30_lv']))
//    {
//        $return_arr['as_30_lv'] = '-';
//    }
//    if(!isset($return_arr['af_30_ld']))
//    {
//        $return_arr['af_30_ld'] = '-';
//    }
//    if(!isset($return_arr['asf_30_lv']))
//    {
//        $return_arr['asf_30_lv'] = '-';
//    }
//    if(!isset($return_arr['asf_365_ld']))
//    {
//        $return_arr['asf_365_ld'] = '-';
//    }
//
//    return $return_arr;
//}
//
//// Check the amount of a specific type of spa
//function Reservation_spa_get_specific_sessions_amount($type)
//{
//    switch($type)
//    {
//        case "sf_1_lv":
//        case "sf_1_sd":
//        case "is_15":
//        case "is_20":
//        case "is_25":
//        case "as_30_lv":
//        case "af_30_ld":
//        case "asf_30_lv":
//        case "asf_365_ld":
//            break;
//        default:
//            awesome_goto_fail_page("SPA Res_Get_Specific_Session ##1");
//    }
//
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//
//    $query = "SELECT nr_sedinte_ramase FROM wonderland.client_spa WHERE id_client = ? AND tip_abonament = ?";
//    $result = db_query($query,[$Wonder_user_id,$type]);
//
//    if( $row = $result->fetchAll() )
//    {
//        $credit_amount = $row[0]['nr_sedinte_ramase'];
//    }
//    else
//    {
//        $credit_amount = 0;
//    }
//
//    return $credit_amount;
//}
//
//// Cancels a specific reservation
//function History_spa_cancel_reservation($id_programare)
//{
//    $query = "SELECT tip_programare,anulat FROM wonderland.programare_spa WHERE id_programare_spa = ?;";
//    $result = db_query($query,[$id_programare]);
//
//    $log = $result->fetch();
//    if($log['anulat'] != 0)
//        awesome_goto_fail_page("SPA History_cancel_reservation ##1", "Rezervarea selectată a fost deja anulată!");
//
//    $query = "UPDATE wonderland.programare_spa SET anulat=1 WHERE id_programare_spa=?;";
//    db_query($query,[$id_programare]);
//
//    // Returning session back to customer
//    Reservation_spa_increase_sessions(1, $log['tip_programare']);
//
//    echo "<script>alert('Rezervarea a fost anulată cu succes!');</script>";
//}
//
//// Fills the history table with bookings
//function History_spa_get_slots()
//{
//    $Wonder_user_id = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//    $logs = [];
//
//    $query = "  SELECT id_programare_spa,tip_programare,start_time,ziua,anulat
//                FROM wonderland.programare_spa
//                WHERE
//                id_client = ? AND
//                TIMESTAMPDIFF(month, CURDATE(), ziua ) >=0;";
//
//    $result = db_query($query,[$Wonder_user_id]);
//    while($row = $result->fetch())
//    {
//        switch($row['tip_programare'])
//        {
//            case "sf_1_lv":
//                $row['tip_programare_show'] = "SPA&Fitness : Luni-Vineri – 1x";
//                break;
//            case "sf_1_sd":
//                $row['tip_programare_show'] = "SPA&Fitness : Sâmbătă-Duminică – 1x";
//                break;
//            case "is_15":
//                $row['tip_programare_show'] = "Închiriere SPA: 15 persoane";
//                break;
//            case "is_20":
//                $row['tip_programare_show'] = "Închiriere SPA: 20 persoane";
//                break;
//            case "is_25":
//                $row['tip_programare_show'] = "Închiriere SPA: 25 persoane";
//                break;
//            default:
//                awesome_goto_fail_page("SPA History_get_slots ##1");
//        }
//
//        array_push($logs,$row);
//    }
//
//    usort($logs, function($a, $b)
//    {
//    $retval = $b['ziua'] <=> $a['ziua'];
//    if ($retval == 0)
//        $retval = $a['start_time'] <=> $b['start_time'];
//    return $retval;
//    });
//
//    return $logs;
//}