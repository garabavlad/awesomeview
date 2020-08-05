<?php

function swimming_get_status()
{
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
    $id_service = 2;

    // getting details from the avesome db
    $query = "SELECT pass_amount FROM passes WHERE id_user = ? and id_service = ?;";
    $result = db_query($query, [$awesome_user, $id_service]);

    $row = $result->fetch();

    if(!$row)
        return [-1];

    $pass_amount = $row['pass_amount'];
    if(isset($pass_amount))
        return [1,$pass_amount];
}

function swimming_get_table_bookings()
{
    $return = null;
    $awesome_user = get_user_meta(get_current_user_id(), 'awesome_user_id', true);
    $id_service = 2; // swimming service id

    $query = "SELECT bookings.id_booking, bookings.booking_date, bookings.booking_time_start, bookings.booking_time_end, bookings.cancelled, services.service_name 
              FROM awesome_external.bookings INNER JOIN services on bookings.id_service = services.id_service
              WHERE id_user = ? and bookings.id_service=?;";
    $result = db_query($query, [$awesome_user, $id_service]);

    while($row = $result->fetch())
    {
        $return[] = [$row['service_name'], $row['id_booking'], $row['booking_date'],$row['booking_time_start'],$row['booking_time_end'], $row['cancelled']];
    }

    return $return;
}

