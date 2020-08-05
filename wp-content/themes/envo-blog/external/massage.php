<?php

    /* Gets massage passes */
    function massage_get_status()
    {
        $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
        $id_service = [5, 6]; // ! prone to modifications

        // getting details from the awesome db
        $query = "SELECT service_name, id_service  FROM services WHERE id_service = ? OR id_service = ?;";
        $result = db_query($query, [$id_service[0], $id_service[1]]);

        $return = [];
        while($row = $result->fetch())
        {
            $return[] = [$row['service_name'], $row['id_service']];
        }

        $query = "SELECT pass_amount, id_service  FROM passes WHERE passes.id_user = ? AND (passes.id_service = ? OR passes.id_service = ?);";
        $result = db_query($query, [$awesome_user, $id_service[0], $id_service[1]]);

        // Fetching passes table results
        $passes = [];
        while($row = $result->fetch())
        {
            $passes[] = [$row['id_service'], $row['pass_amount']];
        }

        // appending pass amount to return array
        foreach ($return as $key => $row)
        {
            $return[$key][2] = '-';
            for($i=0; $i < count($passes); $i++)
            {
                if($row[1] == $passes[$i][0])
                {
                    $return[$key][2] = $passes[$i][1];
                }
            }
        }

        return $return;
    }

    /* Gets bookings to fill table */
    function massage_get_table_booking()
    {
        $return = null;
        $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
        $id_service = [5,6]; // massage service ids

        $query = "SELECT bookings.id_booking, bookings.booking_date, bookings.booking_time_start, bookings.booking_time_end, bookings.cancelled, services.service_name 
              FROM awesome_external.bookings INNER JOIN services on bookings.id_service = services.id_service
              WHERE id_user = ? AND (bookings.id_service=? OR bookings.id_service=?);";
        $result = db_query($query, [$awesome_user, $id_service[0], $id_service[1]]);

        while($row = $result->fetch())
        {
            $return[] = [$row['service_name'], $row['id_booking'], $row['booking_date'],$row['booking_time_start'],$row['booking_time_end'], $row['cancelled']];
        }

        return $return;
    }