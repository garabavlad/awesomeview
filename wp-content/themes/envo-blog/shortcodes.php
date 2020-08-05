<?php

// History Table shcode
//function table_history_shortcode($atts = [], $content = null)
//{
//    // Pentru mecanism proceeding -> completed order
//    /*$args = array(
////            'id' => '3384',
//        'status' => 'processing',
//        'return' => 'ids'
//    );
//    $orders = wc_get_orders( $args );
//    echo "<pre style='color: white;'>";
////    var_dump($orders);
//
//    $order = new WC_Order( 3384 );
//
//    $items = $order->get_items();
//    foreach ($items as $item)
//    {
//        $product = wc_get_product( $item['product_id'] );
//        var_dump($product->get_sku());
//    }
//    die;*/
//
//
//    ////////////////////////////////////////////////////
//    //Testing inc decr func
////    $type= 'agr4';
////    $date = '2019-03-26';
//
////    Reservation_balloon_decrease_sessions(5,$type);
//
////    var_dump(Reservation_balloon_get_specific_sessions_amount($type));
//
////    var_dump(Reservation_balloon_get_slots($date,$type));
////    die;
//
//    if(isset($_POST['manegeCancelRequest']))
//    {
//        History_manege_cancel_reservation($_POST['manegeCancelRequest']);
//    }
//    if(isset($_POST['massageCancelRequest']))
//    {
//        History_massage_cancel_reservation($_POST['massageCancelRequest']);
//    }
//    if(isset($_POST['spaCancelRequest']))
//    {
//        History_spa_cancel_reservation($_POST['spaCancelRequest']);
//    }
//    if(isset($_POST['balloonCancelRequest']))
//    {
//        History_balloon_cancel_reservation($_POST['balloonCancelRequest']);
//    }
//
//    $tableString = "";
//    $header = " <h1 class='wonderland-h1'>Istoric Rezervări</h1>
//                <div class=\"histoy_tab\">
//                  <button class=\"histoy_tablinks\" onclick=\"showSelectedHistoryTable(event, 'Manege')\" id=\"defaultHistoryTab\">Ehitații manej</button>
//                  <button class=\"histoy_tablinks\" onclick=\"showSelectedHistoryTable(event, 'Massage')\">Masaj</button>
//                  <button class=\"histoy_tablinks\" onclick=\"showSelectedHistoryTable(event, 'Spa')\">SPA</button>
//                  <button class=\"histoy_tablinks\" onclick=\"showSelectedHistoryTable(event, 'Balloon')\">Balon</button>
//                </div>";
//
//    /*************************************** TABEL ECHITATII MANEJ *************************************/
//    // table header
//    $tableString .="
//                <div style='margin-top: 3%'></div>
//                <div id=\"Manege\" class=\"histoy_tab_content\">
//                    <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
//
//                        <col width=\"26%\">
//                        <col width=\"24%\">
//                        <col width=\"13%\">
//                        <col width=\"22%\">
//                        <col width=\"10%\">
//
//                        <thead>
//                            <tr>
//                                <th>Tip Echitație</th>
//                                <th>Data</th>
//                                <th>Ora</th>
//                                <th>Instructor</th>
//                                <th>Actions</th>
//                            </tr>
//                        </thead>
//                        <tbody>";
//
//    /* Table body */
//    $result = History_manege_get_slots();
//
//    if(empty($result))
//    {
//        $tableString
//            .="
//            <tr>
//                <td colspan='100' class='text-center font-weight-bold'>Istoric gol</td>
//            </tr>
//                ";
//    }
//    else
//    {
//        foreach ($result as $slot)
//        {
//            $tableString
//                .= "
//            <tr>
//                <td>" . $slot['service'] . "</td>
//                <td>" . date("d F Y",strtotime($slot['ziua'],0)) . "</td>
//                <td>" . date("H:i",strtotime($slot['start_time'],0)) . "</td>
//                <td>" . $slot['nume'] . ' ' . $slot['prenume'] . "</td>
//                <td >
//                    ". ($slot['tip_programare']=='anulat' ?
//                    "Anulat"
//                    :
//                    (awesome_check_date_cancel($slot['ziua'])?"
//                            <!-- Button trigger modal -->
//                            <button type=\"button\" id=\"mymodal\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#anulareModal".$slot['id_programare']."\">
//                              Anulează
//                            </button>
//
//                            <!-- Modal -->
//                            <div class=\"modal fade\" id=\"anulareModal".$slot['id_programare']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModal".$slot['id_programare']."Label\">
//                              <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
//                                <div class=\"modal-content\">
//                                  <div class=\"modal-header\">
//                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
//                                  </div>
//                                  <div class=\"modal-body\" style=\"color: #111;\">
//                                    Sunteți sigur că doriți să ștergeți rezervarea?<br>Schimbările nu mai pot fi modificate ulterior!
//                                  </div>
//                                  <div class=\"modal-footer\">
//                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Renunță</button>
//                                    <form action=\"\" method='post'>
//                                    <input type='hidden' value=\"".$slot['id_programare']."\" name='manegeCancelRequest'>
//                                        <button class=\"btn btn-warning\" name ='anuleaza_btn' type=\"submit\" style=\"width: 100%;\">Confirmă</button>
//                                    </form>
//                                  </div>
//                                </div>
//                              </div>
//                            </div>"
//                        :
//                        "Activat")
//                ) ."
//                </td>
//            </tr>
//            ";
//        }
//    }
//
//    /* Table footer */
//    $tableString.="
//                </tbody>
//                <tfoot>
//                    <tr>
//                        <th>Tip Echitație</th>
//                        <th>Data</th>
//                        <th>Ora</th>
//                        <th>Instructor</th>
//                        <th>Actions</th>
//
//                    </tr>
//                </tfoot>
//            </table>
//            </div>
//        ";
//
//    /*************************************** TABEL MASAJ ************************************************/
//    // table header
//    $tableString .="
//                <div style='margin-top: 3%'></div>
//                <div id=\"Massage\" class=\"histoy_tab_content\">
//                    <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
//
//                        <col width=\"39%\">
//                        <col width=\"20%\">
//                        <col width=\"9%\">
//                        <col width=\"24%\">
//                        <col width=\"8%\">
//
//                        <thead>
//                            <tr>
//                                <th>Tip Masaj</th>
//                                <th>Data</th>
//                                <th>Ora</th>
//                                <th>Maseur</th>
//                                <th>Actions</th>
//                            </tr>
//                        </thead>
//                        <tbody>";
//
//    /* Table body */
//    $result = History_massage_get_slots();
//
//    if(empty($result))
//    {
//        $tableString
//            .="
//            <tr>
//                <td colspan='100' class='text-center font-weight-bold'>Istoric gol</td>
//            </tr>
//                ";
//    }
//    else // !!! REVIEW DACA TOT E OK CU CODURILE LA BUTOANELE ANULARE
//    {
//        foreach ($result as $slot)
//        {
//            $tableString
//                .= "
//            <tr>
//                <td>" . $slot['tip_programare_show'] . "</td>
//                <td>" . date("d F Y",strtotime($slot['ziua'],0)) . "</td>
//                <td>" . date("H:i",strtotime($slot['start_time'],0)) . "</td>
//                <td>" . $slot['nume'] . ' ' . $slot['prenume'] . "</td>
//                <td >
//                    ". ($slot['masa']<0 ?
//                    "Anulat"
//                    :
//                    (awesome_check_date_cancel($slot['ziua'])?"
//                            <!-- Button trigger modal -->
//                            <button type=\"button\" id=\"mymodal\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#anulareModalM".$slot['id_programare_masaj']."\">
//                              Anulează
//                            </button>
//
//                            <!-- Modal -->
//                            <div class=\"modal fade\" id=\"anulareModalM".$slot['id_programare_masaj']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModalM".$slot['id_programare_masaj']."Label\">
//                              <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
//                                <div class=\"modal-content\">
//                                  <div class=\"modal-header\">
//                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
//                                  </div>
//                                  <div class=\"modal-body\" style=\"color: #111;\">
//                                    Sunteți sigur că doriți să ștergeți rezervarea?<br>Schimbările nu mai pot fi modificate ulterior!
//                                  </div>
//                                  <div class=\"modal-footer\">
//                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Renunță</button>
//                                    <form action=\"\" method='post'>
//                                    <input type='hidden' value=\"".$slot['id_programare_masaj']."\" name='massageCancelRequest'>
//                                        <button class=\"btn btn-warning\" name ='anuleaza_btn' type=\"submit\" style=\"width: 100%;\">Confirmă</button>
//                                    </form>
//                                  </div>
//                                </div>
//                              </div>
//                            </div>"
//                        :
//                        "Activat")
//                ) ."
//                </td>
//            </tr>
//            ";
//        }
//    }
//
//    /* Table footer */
//    $tableString.="
//                </tbody>
//                <tfoot>
//                    <tr>
//                        <th>Tip Masaj</th>
//                        <th>Data</th>
//                        <th>Ora</th>
//                        <th>Maseur</th>
//                        <th>Actions</th>
//
//                    </tr>
//                </tfoot>
//            </table>
//            <div style=\"margin-bottom: 50px;\"></div>
//            </div>
//        ";
//
//
//    /*************************************** TABEL SPA ************************************************/
//    // table header
//    $tableString .="
//                <div style='margin-top: 3%'></div>
//                <div id=\"Spa\" class=\"histoy_tab_content\">
//                    <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
//
//                        <col width=\"45%\">
//                        <col width=\"30%\">
//                        <col width=\"13%\">
//                        <col width=\"12%\">
//
//                        <thead>
//                            <tr>
//                                <th>Tip Serviciu</th>
//                                <th>Data</th>
//                                <th>Ora</th>
//                                <th>Actions</th>
//                            </tr>
//                        </thead>
//                        <tbody>";
//
//    /* Table body */
//    $result = History_spa_get_slots();
//
//    if(empty($result))
//    {
//        $tableString
//            .="
//            <tr>
//                <td colspan='100' class='text-center font-weight-bold'>Istoric gol</td>
//            </tr>
//                ";
//    }
//    else
//    {
//        foreach ($result as $slot)
//        {
//            $tableString
//                .= "
//            <tr>
//                <td>" . $slot['tip_programare_show'] . "</td>
//                <td>" . date("d F Y",strtotime($slot['ziua'],0)) . "</td>
//                <td>" . date("H:i",strtotime($slot['start_time'],0)) . "</td>
//                <td >
//                    ". ($slot['anulat']!=0 ?
//                    "Anulat"
//                    :
//                    (awesome_check_date_cancel($slot['ziua'])?"
//                            <!-- Button trigger modal -->
//                            <button type=\"button\" id=\"mymodal\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#anulareModalM".$slot['id_programare_spa']."\">
//                              Anulează
//                            </button>
//
//                            <!-- Modal -->
//                            <div class=\"modal fade\" id=\"anulareModalM".$slot['id_programare_spa']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModalM".$slot['id_programare_spa']."Label\">
//                              <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
//                                <div class=\"modal-content\">
//                                  <div class=\"modal-header\">
//                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
//                                  </div>
//                                  <div class=\"modal-body\" style=\"color: #111;\">
//                                    Sunteți sigur că doriți să ștergeți rezervarea?<br>Schimbările nu mai pot fi modificate ulterior!
//                                  </div>
//                                  <div class=\"modal-footer\">
//                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Renunță</button>
//                                    <form action=\"\" method='post'>
//                                    <input type='hidden' value=\"".$slot['id_programare_spa']."\" name='spaCancelRequest'>
//                                        <button class=\"btn btn-warning\" name ='anuleaza_btn' type=\"submit\" style=\"width: 100%;\">Confirmă</button>
//                                    </form>
//                                  </div>
//                                </div>
//                              </div>
//                            </div>"
//                        :
//                        "Activat")
//                ) ."
//                </td>
//            </tr>
//            ";
//        }
//    }
//
//    /* Table footer */
//    $tableString.="
//                </tbody>
//                <tfoot>
//                    <tr>
//                        <th>Tip Serviciu</th>
//                        <th>Data</th>
//                        <th>Ora</th>
//                        <th>Actions</th>
//
//                    </tr>
//                </tfoot>
//            </table>
//            <div style=\"margin-bottom: 50px;\"></div>
//            </div>
//        ";
//
//
//    /*************************************** TABEL BALLOON ************************************************/
//    // table header
//    $tableString .="
//                <div style='margin-top: 3%'></div>
//                <div id=\"Balloon\" class=\"histoy_tab_content\">
//                    <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
//
//                        <col width=\"46\">
//                        <col width=\"26%\">
//                        <col width=\"15%\">
//                        <col width=\"13%\">
//
//                        <thead>
//                            <tr>
//                                <th>Tip Serviciu</th>
//                                <th>Data</th>
//                                <th>Perioada</th>
//                                <th>Actions</th>
//                            </tr>
//                        </thead>
//                        <tbody>";
//
//    /* Table body */
//    $result = History_balloon_get_slots();
//
//    if(empty($result))
//    {
//        $tableString
//            .="
//            <tr>
//                <td colspan='100' class='text-center font-weight-bold'>Istoric gol</td>
//            </tr>
//                ";
//    }
//    else
//    {
//        foreach ($result as $slot)
//        {
//            $tableString
//                .= "
//            <tr>
//                <td>" . $slot['tip_programare_show'] . "</td>
//                <td>" . date("d F Y",strtotime($slot['ziua'],0)) . "</td>
//                <td>" . $slot['perioada'] . "</td>
//                <td >
//                    ". ($slot['anulat']!=0 ?
//                    "Anulat"
//                    :
//                    (awesome_check_date_cancel($slot['ziua'])?"
//                            <!-- Button trigger modal -->
//                            <button type=\"button\" id=\"mymodal\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#anulareModalM".$slot['id_programare_balon']."\">
//                              Anulează
//                            </button>
//
//                            <!-- Modal -->
//                            <div class=\"modal fade\" id=\"anulareModalM".$slot['id_programare_balon']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModalM".$slot['id_programare_balon']."Label\">
//                              <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
//                                <div class=\"modal-content\">
//                                  <div class=\"modal-header\">
//                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
//                                  </div>
//                                  <div class=\"modal-body\" style=\"color: #111;\">
//                                    Sunteți sigur că doriți să ștergeți rezervarea?<br>Schimbările nu mai pot fi modificate ulterior!
//                                  </div>
//                                  <div class=\"modal-footer\">
//                                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Renunță</button>
//                                    <form action=\"\" method='post'>
//                                    <input type='hidden' value=\"".$slot['id_programare_balon']."\" name='balloonCancelRequest'>
//                                        <button class=\"btn btn-warning\" name ='anuleaza_btn' type=\"submit\" style=\"width: 100%;\">Confirmă</button>
//                                    </form>
//                                  </div>
//                                </div>
//                              </div>
//                            </div>"
//                        :
//                        "Activat")
//                ) ."
//                </td>
//            </tr>
//            ";
//        }
//    }
//
//    /* Table footer */
//    $tableString.="
//                </tbody>
//                <tfoot>
//                    <tr>
//                        <th>Tip Serviciu</th>
//                        <th>Data</th>
//                        <th>Perioada</th>
//                        <th>Actions</th>
//
//                    </tr>
//                </tfoot>
//            </table>
//            <div style=\"margin-bottom: 50px;\"></div>
//            </div>
//        ";
//
//    return $header . $tableString;
//}
//add_shortcode("history_table",'table_history_shortcode');

// Reservation table shcode
//function reservation_table_shortcode($atts = [], $content = null)
//{
//
//
//    add_libraries();
//    add_reservation_table_libraries();
//
//    $tableString = "";
//    $header =  "<div style='margin-top: 1%'></div>
//                <h1 class='wonderland-h1'>Tabelul rezervări</h1>
//                <div class=\"reservation_tab\">
//                  <button class=\"reservation_tablinks\" onclick=\"showSelectedReservationTable(event, 'Manege')\" id=\"defaultReservationTab\">Ehitații manej</button>
//                  <button class=\"reservation_tablinks\" onclick=\"showSelectedReservationTable(event, 'Massage')\">Masaj</button>
//                  <button class=\"reservation_tablinks\" onclick=\"showSelectedReservationTable(event, 'Spa')\">SPA</button>
//                  <button class=\"reservation_tablinks\" onclick=\"showSelectedReservationTable(event, 'balloon')\">Balon</button>
//                </div>";
//
//    /////////////////////////////////////////////////////////////////////
//    /** TABEL ECHITATII MANEJ */
//    ////////////////////////////////////////////////////////////////////
//
//    $tableString .= "
//    <!-- Data picker form -->
//            <div style='margin-top: 3%'></div>
//            <div id=\"Manege\" class=\"reservation_tab_content\">
//    		<form>
//                <div class=\"nativeDatePicker\">
//                    <label class='wonderland-text' style='margin-right: 20px;' for=\"day\">Alegeți data:</label>
//                    <input
//                        type=\"date\"
//                        id=\"date_input\"
//                        name=\"day\" autocomplete=off
//                        value=\"". (isset($_GET['day']) ? $_GET['day'] : date("Y-m-d")) ."\"
//                        min=\"". date("Y-m-d") ."\"
//                        max=\"". date("Y-m-d",strtotime("+1 months")) ."\"
//                        onChange=\"manege_date_onchange(this)\">
//                </div>
//            </form>
//
//            <!-- Ambele maneje checkbox -->
//            <div class=\"ambele_maneje_checkbox\">
//                <label for=\"ambele_maneje\" class='wonderland-text'>
//                    <input type=\"checkbox\" id=\"ambele_maneje\" name=\"ambele_maneje\" autocomplete=off onchange=\"ambele_maneje_onchange(this.value);\">
//                    <span>Rezervă 2 maneje (costă 2 sesiuni) </span>
//                </label>
//            </div>
//
//            <!-- Showing user credit amount -->
//            ".
//        (is_user_logged_in() ?
//            "<div class=\"show_credits\">
//                    <div style='margin-top: 2%'></div>
//                    <h3><a href='shop/' style='color: #d9ddb5; font-size: 15px;' class='wonderland-text'>Aveti in cont <b id='session_amount'>" .Reservation_manege_get_sessions_amount(). "</b> sesiuni de Echitație - Manej</a></h3>
//                    <div style='margin-top: 1%'></div>
//                    ".
//            (($validity=Reservation_manege_get_sessions_validity()) ? "<h4 class='wonderland-text' title='Actualizarea valabilitații se face după achiziționarea unui nou pachet de sesiuni'>
//                Valabilitatea sesiunilor până la data de: <b>" .date("d m Y",strtotime($validity))."</b></h4>" : ""). "</div>"
//
//            :
//
//            "<div class=\"show_credits\">
//                    <h3><a href='login/' style='color:#3BA1DA'>Va rugam sa va logati pentru a rezerva maneje</a></h3>
//                </div>")
//            ."
//
//            <!-- Displaying reservation table -->
//            <div id=\"parent_table\"> " ." ". "</div>
//            </div>";
//
//    /////////////////////////////////////////////////////////////////////
//    /** TABEL MASAJ */
//    /////////////////////////////////////////////////////////////////////
//
//    /* Getting massage session amount from DB */
//    $massage_sessions_array = Reservation_massage_get_all_sessions();
//
//    $tableString .= "   <div style='margin-top: 3%'></div>
//                        <div id=\"Massage\" class=\"reservation_tab_content\">
//                        <form method='GET' action=\"../confirm-reservation/\">
//                            <div class=\"nativeDatePicker\">
//                                <label class='wonderland-text' style='margin-right: 20px;' for=\"day\">Alegeți data:</label>
//                                <input
//                                    type=\"date\"
//                                    id=\"date_input\"
//                                    name=\"date\"
//                                    value=\"". date('Y-m-d') ."\"
//                                    min=\"". date("Y-m-d") ."\"
//                                    max=\"". date("Y-m-d",strtotime("+1 months")) ."\"/>
//                                <input
//                                    type='hidden'
//                                    name='type'
//                                    value='massage'
//                                />
//                            </div>
//                        ";
//
//    // Table header
//    $tableString .= "       <div style='margin-top: 3%'></div>
//
//                            <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
//
//                                <col width=\"48%\">
//                                <col width=\"18%\">
//                                <col width=\"8%\">
//                                <col width=\"14%\">
//
//                                <thead>
//                                    <tr>
//                                        <th>Tip masaj</th>
//                                        <th>Durată</th>
//                                        <th>Sesiuni</th>
//                                        <th>Actions</th>
//                                    </tr>
//                                </thead>
//                                <tbody>";
//
//    /* Table body */
//    $tableString .="    <tr>
//                            <td>Masaj relaxare / antistres</td>
//                            <td>30 minute</td>
//                            <td>".$massage_sessions_array['relax_30']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M1"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj relaxare / antistres</td>
//                            <td>50 minute</td>
//                            <td>".$massage_sessions_array['relax_50']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M2"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj terapeutic</td>
//                            <td>30 minute</td>
//                            <td>".$massage_sessions_array['terapeut_30']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M3"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj terapeutic</td>
//                            <td>50 minute</td>
//                            <td>".$massage_sessions_array['terapeut_50']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M4"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj anticelulitic</td>
//                            <td>45 minute</td>
//                            <td>".$massage_sessions_array['anticel']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M5"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj anticelulitic cu miere albine</td>
//                            <td>60 minute</td>
//                            <td>".$massage_sessions_array['anticel_miere']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M6"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj reflexoterapie</td>
//                            <td>30 minute</td>
//                            <td>".$massage_sessions_array['reflex']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M7"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj cu pietre vulcanice</td>
//                            <td>60 minute</td>
//                            <td>".$massage_sessions_array['vulcan']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M8"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj Hawaian Lomi-Lomi</td>
//                            <td>60 minute</td>
//                            <td>".$massage_sessions_array['hawaii']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M9"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Masaj drenaj limfatic prin masaj manual</td>
//                            <td>50 minute</td>
//                            <td>".$massage_sessions_array['drenaj']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."M0"."\" name='massage_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//
//                        ";
//
//    /* Table footer */
//    $tableString .="    </tbody>
//                            <tfoot>
//                                <tr>
//                                    <th>Tip masaj</th>
//                                    <th>Durată</th>
//                                    <th>Sesiuni</th>
//                                    <th>Actions</th>
//                                </tr>
//                            </tfoot>
//                        </table>
//                        </form>
//                        <div style=\"margin-bottom: 50px;\"></div>
//                        </div>
//        ";
//
//    /////////////////////////////////////////////////////////////////////
//    /** TABEL SPA */
//    /////////////////////////////////////////////////////////////////////
//
//    /* Getting massage session amount from DB */
//    $spa_sessions_array = Reservation_spa_get_all_sessions();
//
//    //!!!
//    $tableString .= "   <div style='margin-top: 3%'></div>
//                        <div id=\"Spa\" class=\"reservation_tab_content\">
//                        <form action=\"../confirm-reservation/\" method='GET'>
//                            <div class=\"nativeDatePicker\">
//                                <label class='wonderland-text' style='margin-right: 20px;' for=\"date_input\">Alegeți data:</label>
//                                <input
//                                    type=\"date\"
//                                    id=\"date_input_spa\"
//                                    name=\"date\"
//                                    value=\"". date('Y-m-d') ."\"
//                                    min=\"". date("Y-m-d") ."\"
//                                    max=\"". date("Y-m-d",strtotime("+1 months")) ."\"
//                                    onchange='spa_check_week_day()'/>
//                                <input
//                                    type='hidden'
//                                    name='type'
//                                    value='spa'
//                                />
//                            </div>
//                        ";
//
//    // Table header
//    $tableString .= "       <div style='margin-top: 3%'></div>
//
//                            <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%; margin-bottom: 0.6%;\">
//
//                                <col width=\"40%\">
//                                <col width=\"25%\">
//                                <col width=\"15%\">
//                                <col width=\"14%\">
//
//                                <thead>
//                                    <tr>
//                                        <th>Denumire</th>
//                                        <th>Durată</th>
//                                        <th>Sesiuni</th>
//                                        <th>Actions</th>
//                                    </tr>
//                                </thead>
//                                <tbody>";
//
//    /* Table body */
//    $tableString .="    <tr>
//                            <td>SPA & Fitness</td>
//                            <td>1 Zi (L-V)</td>
//                            <td>".$spa_sessions_array['sf_1_lv']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" id='spa_lv_button' value=\""."sf_1_lv"."\" name='spa_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>SPA & Fitness</td>
//                            <td>1 Zi (S-D)</td>
//                            <td>".$spa_sessions_array['sf_1_sd']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" id='spa_sd_button' value=\""."sf_1_sd"."\" name='spa_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//
//                        <tr>
//                            <td>Închiriere SPA <br>(până la 15 persoane)</td>
//                            <td>1 Noapte <br>(22:00 - 5:00)</td>
//                            <td >".$spa_sessions_array['is_15']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."is_15"."\" name ='spa_type' type=\"submit\" style=\"width: 100%; margin-top: 6px;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Închiriere SPA <br>(până la 20 persoane)</td>
//                            <td>1 Noapte  <br>(22:00 - 5:00)</td>
//                            <td>".$spa_sessions_array['is_20']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."is_20"."\" name='spa_type' type=\"submit\" style=\"width: 100%; margin-top: 6px;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Închiriere SPA <br>(până la 25 persoane)</td>
//                            <td>1 Noapte  <br>(22:00 - 5:00)</td>
//                            <td>".$spa_sessions_array['is_25']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\" value=\""."is_25"."\" name='spa_type' type=\"submit\" style=\"width: 100%; margin-top: 6px;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        </tbody>
//                        <tfoot>
//                                <tr>
//                                    <th>Denumire</th>
//                                    <th>Durată</th>
//                                    <th>Sesiuni</th>
//                                    <th>Actions</th>
//                                </tr>
//                            </tfoot>
//                        </table>
//                        ";
//
//    $tableString .= "<h1 class='wonderland-h1' style='margin-top: 25px;'>Abonamente SPA</h1>";
//
//
///* Additional table */
//    $tableString .= "
//                        <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
//
//                            <col width=\"40%\">
//                            <col width=\"25%\">
//                            <col width=\"29%\">
//
//                            <thead>
//                                <tr>
//                                    <th>Denumire</th>
//                                    <th>Zile</th>
//                                    <th>Valabilitate</th>
//                                </tr>
//                            </thead>
//
//                            <tbody>
//                                <tr>
//                                    <td>Abonament: SPA</td>
//                                    <td>Luni - Vineri</td>
//                                    <td >
//                                        ".$spa_sessions_array['as_30_lv']."
//                                    </td>
//                                </tr>
//                                <tr>
//                                    <td>Abonament: Fitness</td>
//                                    <td>Luni - Duminică</td>
//                                    <td >
//                                        ".$spa_sessions_array['af_30_ld']."
//                                    </td>
//                                </tr>
//                                <tr>
//                                    <td>Abonament: SPA & Fitness</td>
//                                    <td>Luni - Vineri</td>
//                                    <td >
//                                        ".$spa_sessions_array['asf_30_lv']."
//                                    </td>
//                                </tr>
//                                <tr>
//                                    <td>Abonament: SPA & Fitness</td>
//                                    <td>Luni - Duminică</td>
//                                    <td >
//                                        ".$spa_sessions_array['asf_365_ld']."
//                                    </td>
//                                </tr>
//    ";
//
//    /* Table footer */
//    $tableString .="    </tbody>
//                            <tfoot>
//                                <tr>
//                                    <th>Denumire</th>
//                                    <th>Zile</th>
//                                    <th>Valabilitate</th>
//                                </tr>
//                            </tfoot>
//                        </table>
//                        </form>
//                        <div style=\"margin-bottom: 10px;\"></div>
//                        <p> * L-V : De Luni până Vineri
//                        <br> * S-D : De Sâmbătă până Duminică
//                        <div style=\"margin-bottom: 30px;\"></div>
//                        </div>
//        ";
//    /////////////////////////////////////////////////////////////////////
//
//
//    /////////////////////////////////////////////////////////////////////
//    /** TABEL BALLOON */
//    /////////////////////////////////////////////////////////////////////
//
//    /* Getting massage session amount from DB */
//    $balloon_sessions_array = Reservation_balloon_get_all_sessions();
//
//    $tableString .= "   <div style='margin-top: 3%'></div>
//                        <div id=\"balloon\" class=\"reservation_tab_content\">
//                        <form action=\"../confirm-reservation/\" method='GET'>
//                            <div class=\"nativeDatePicker\">
//                                <label class='wonderland-text' style='margin-right: 20px;' for=\"date_input\">Alegeți data:</label>
//                                <input
//                                    type=\"date\"
//                                    id=\"date_input_balloon\"
//                                    name=\"date\"
//                                    value=\"". date('Y-m-d') ."\"
//                                    min=\"". date("Y-m-d") ."\"
//                                    max=\"". date("Y-m-d",strtotime("+1 months")) ."\"
//                                    onchange='spa_check_week_day()'/>
//                                <input
//                                    type='hidden'
//                                    name='type'
//                                    value='balloon'
//                                />
//                            </div>
//                        ";
//
//    // Table header
//    $tableString .= "       <div style='margin-top: 3%'></div>
//
//                            <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%; margin-bottom: 0.6%;\">
//
//                                <col width=\"65%\">
//                                <col width=\"20%\">
//                                <col width=\"15%\">
//
//                                <thead>
//                                    <tr>
//                                        <th>Denumire</th>
//                                        <th>Sesiuni</th>
//                                        <th>Actions</th>
//                                    </tr>
//                                </thead>
//                                <tbody>";
//
//    /* Table body */
//    $tableString .="    <tr>
//                            <td>Zbor de agrement (maxim 3 persoane)</td>
//                            <td>".$balloon_sessions_array['agr3']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\"  value=\""."agr3"."\" name='balloon_type' "/*.($balloon_sessions_array['agr3'] ==='-' ? 'disabled':'')*/." type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Zbor de agrement (maxim 4 persoane)</td>
//                            <td>".$balloon_sessions_array['agr4']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\"  value=\""."agr4"."\" name='balloon_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Zbor de publicitate</td>
//                            <td>".$balloon_sessions_array['publ']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\"  value=\""."publ"."\" name='balloon_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        <tr>
//                            <td>Zbor de eveniment</td>
//                            <td>".$balloon_sessions_array['evnt']."</td>
//                            <td >
//                                <button class=\"btn btn-warning\"  value=\""."evnt"."\" name='balloon_type' type=\"submit\" style=\"width: 100%;\">Rezervă</button>
//                            </td>
//                        </tr>
//                        </tbody>
//                        <tfoot>
//                                <tr>
//                                    <th>Denumire</th>
//                                    <th>Sesiuni</th>
//                                    <th>Actions</th>
//                                </tr>
//                            </tfoot>
//                        </table>
//                        </form>
//                        <div style=\"margin-bottom: 30px;\"></div>
//                        </div>
//        ";
//    /////////////////////////////////////////////////////////////////////
//
//    return $header . $tableString;
//}
//add_shortcode("reservation_table", "reservation_table_shortcode");

// Reservation confirmation shcode
function reservation_confirmation_shortcode($atts = [], $content = null)
{
    add_libraries();
    $type = $_GET['type'];
    if(!isset($type))
        awesome_goto_fail_page("ConfirmationR unset GET type");

    // Unsetting old request if cancel button was clicked
    if (isset($_POST['confirmation_cancel']))
    {
        header("Location: reservation-table/");
        die();
    }

    switch ($type)
    {
        case 'manege':
            if (isset($_POST['confirmation_approve_manege']))
            {
                if(!isset($_POST['instructor_select']) || !isset($_POST['horse_select']))
                    awesome_goto_fail_page("ConfirmationR unset instructor | horse");

                $_SESSION['reservation']['instructor'] = $_POST['instructor_select'];
                $_SESSION['reservation']['horse'] = $_POST['horse_select'];
                Reservation_manege_reserve();
                die();
            }
            $return = confirmation_shortcode_manege();
        break;

        case 'massage':
            if (isset($_POST['confirmation_approve_massage']))
            {
                $table_link = explode("|", $_POST['massage_time_select']);
                $_SESSION['reservation']['table'] = $table_link[1];
                $_SESSION['reservation']['time'] = $table_link[0];

                if(!isset($_POST['masseur_select']) || !isset($_SESSION['reservation']['time']))
                    awesome_goto_fail_page("ConfirmationR unset masseur | hour");

                $_SESSION['reservation']['masseur'] = $_POST['masseur_select'];

                Reservation_massage_reserve();
                die;
            }
            $return = confirmation_shortcode_massage();
            break;

        case 'spa':
            if (isset($_POST['confirmation_approve_spa']))
            {
                if(!isset($_POST['spa_time_select']))
                    awesome_goto_fail_page("ConfirmationR unset spa time");

                $_SESSION['reservation']['time'] = $_POST['spa_time_select'];

                Reservation_spa_reserve();
                die;
            }
            $return = confirmation_shortcode_spa();
            break;

        case 'balloon':
            if (isset($_POST['confirmation_approve_balloon']))
            {
                if(!isset($_POST['balloon_time_select']))
                    awesome_goto_fail_page("ConfirmationR unset balloon time");

                $_SESSION['reservation']['time'] = $_POST['balloon_time_select'];

                Reservation_balloon_reserve();
                die;
            }
            $return = confirmation_shortcode_balloon();
            break;

        default:
            awesome_goto_fail_page("ConfirmationR wrong GET type");
    }

    return $return;
}
add_shortcode('reservation_confirmation','reservation_confirmation_shortcode');
//function confirmation_shortcode_manege()
//{
//// Case when user has no sessions available:
//    if($_SESSION['reservation']['service'])
//    {
//        $amount_needed = 2;
//    }
//    else
//    {
//        $amount_needed = 1;
//    }
//    if ( Reservation_manege_get_sessions_amount()<$amount_needed )
//        awesome_goto_fail_page(null,"
//            <h1>Insuficiente sesiuni de <u>Echitație manej</u>!</h1>
//            <div style='margin-top: 3%'></div>
//            <h3><a href='shop' >Mergi la magazin servicii</a></h3>
//        ");
//    elseif( date("Y-m-d") > Reservation_manege_get_sessions_validity())
//        awesome_goto_fail_page(null,"
//            <h1>Termenul sesiunilor achiziționate a expirat!</h1>
//            <div style='margin-top: 1%'></div>
//            <h1>Supliniți numărul sesiunilor <u>Echitație manej</u> pentru a extinde valabilitatea! </h1>
//            <div style='margin-top: 3%'></div>
//            <h3><a href='shop' >Mergi la magazin servicii</a></h3>
//        ");
//    else
//    {
//        Reservation_manege_get_details();
//        if(!isset($_SESSION['reservation']['time']))
//            awesome_goto_fail_page("Confirmation Manege unset time");
//
//        $return
//            = "
//            <h1 class='wonderland-h1'>Confirmare rezervare</h1>
//            <div style=\"margin-top: 4%\"></div>
//            <h1 class='wonderland-text' style='font-size:17px; font-weight:600;'>Detalii rezervare:</h1>
//            <div style=\"margin-top: 3%\"></div>
//            <h1>Nume: " . $_SESSION['reservation']['name'] . " </h1>
//            <h1>Serviciu: " . $_SESSION['reservation']['service'] . "</h1>
//            <h1>Ora: " . $_SESSION['reservation']['time'] . "</h1>
//            <h1>Data: " . date("d F Y",strtotime($_SESSION['reservation']['date'],0)) . "</h1>
//
//            <form class=\"\" action=\"\" method=\"post\">
//                <div style='padding-top: 4%'>
//                    <h1>Alege intructor<span style='color:red;'>*</span>:</h1>
//                    " . Reservation_manege_get_available_instructors($_SESSION['reservation']['date'], $_SESSION['reservation']['time']) . "
//                </div>
//                <div style='padding-top: 1%'>
//                    <h1>Alege cal<span style='color:red;'>*</span>:</h1>
//                    " . Reservation_manege_get_available_horses($_SESSION['reservation']['date'], $_SESSION['reservation']['time']) . "
//                    <br>
//                    <p style=\"font-size:12px;\">🛈 Instructorul iși rezervă dreptul de a schimba calul ședinței in funcție de gradul de oboseală al calului!</p>
//                </div>
//
//                <div style='padding-top: 3%'></div>
//
//                <button type=\"submit\" class='btn btn-secondary' name=\"confirmation_cancel\" value=\"1\">Înapoi</button>
//                <button type=\"submit\" class='btn btn-warning' name=\"confirmation_approve_manege\" id='confirmation_approve_manege' value=\"1\">Confirmă</button>
//            </form>
//        ";
//    }
//    return $return;
//}
function confirmation_shortcode_massage()
{
    $day = $_GET['date'];
    $type=$_GET['massage_type'];
    if (
        !isset($day) ||
        !isset($type) ||
        $day==""
    )
        awesome_goto_fail_page("Confirmation Massage unset day | m_type");
    else
    {
        $_SESSION['reservation']['date'] = $day;
    }

    switch ($type)
    {
        case 'M1':
            $_SESSION['reservation']['service'] = "Masaj relaxare / antistres (30 min)";
            break;

        case 'M2':
            $_SESSION['reservation']['service'] = "Masaj relaxare / antistres (50 min)";
            break;

        case 'M3':
            $_SESSION['reservation']['service'] = "Masaj terapeutic (30 min)";
            break;

        case 'M4':
            $_SESSION['reservation']['service'] = "Masaj terapeutic (50 min)";
            break;

        case 'M5':
            $_SESSION['reservation']['service'] = "Masaj anticelulitic";
            break;

        case 'M6':
            $_SESSION['reservation']['service'] = "Masaj anticelulitic cu miere albine";
            break;

        case 'M7':
            $_SESSION['reservation']['service'] = "Masaj reflexoterapie";
            break;

        case 'M8':
            $_SESSION['reservation']['service'] = "Masaj cu pietre vulcanice";
            break;

        case 'M9':
            $_SESSION['reservation']['service'] = "Masaj Hawaian Lomi-Lomi";
            break;

        case 'M0':
            $_SESSION['reservation']['service'] = "Masaj drenaj limfatic prin masaj manual";
            break;

        default:
            awesome_goto_fail_page("Confirmation Massage wrong type");
    }

    $current_user = wp_get_current_user();
    $_SESSION['reservation']['name'] = $current_user->display_name;
    $_SESSION['reservation']['wonder_id'] = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);

    // Case when user has no sessions available:
    if ( Reservation_massage_get_specific_sessions_amount( $_SESSION['reservation']['service'] )  <  1 )
        awesome_goto_fail_page(null,"
            <h1>Insuficiente sesiuni de <u>".$_SESSION['reservation']['service']."</u>!</h1>
            <div style='margin-top: 3%'></div>
            <h3><a href='shop' >Mergi la magazin servicii</a></h3>
        ");
    else
    {
        $return
            = "
            <h1 class='wonderland-h1'>Confirmare rezervare</h1>
            <div style=\"margin-top: 4%\"></div>
            <h1 class='wonderland-text' style='font-size:17px; font-weight:600;'>Detalii rezervare:</h1>
            <div style=\"margin-top: 3%\"></div>
            <h1>Nume: " . $_SESSION['reservation']['name'] . " </h1>
            <h1>Serviciu: " . $_SESSION['reservation']['service'] . "</h1>
            <h1>Data: " . date("d F Y",strtotime($_SESSION['reservation']['date'],0)) . "</h1>
            <input type='hidden' id='date_hid' value='".$_SESSION['reservation']['date']."'>
            
            <form class=\"\" action=\"\" method=\"post\">";

        $return.="<div style='padding-top: 3%'>
                    <h1>Alege ora<span style='color:red;'>*</span>:</h1>
                    ";

        $available_slots = Reservation_massage_get_slots($_SESSION['reservation']['date']);
        if(!empty($available_slots))
        {
            $return.= "<select name='massage_time_select' id='massage_time_select' class='confirm-select'> ";
            foreach ($available_slots as $slot)
            {
                $_hour = explode("|", $slot);
                $return .= "<option value='" . $slot . "'>" . $_hour[0] . "</option>";
            }
            $return .= "</select>";
        }
        else
        {
            $return .= "<h4 style='color: red;'>Nici un maseur disponibil la ora și data aleasă!</h4>";
        }

        $return.="<div style='padding-top: 3%'>
                    <h1>Alege masor<span style='color:red;'>*</span>:</h1>
                    <div id='masseur-select-div'></div>";

        /** MASSEUR LIST IS TAKEN FROM MASSAGE MASSEUR SCRIPT VIA AJAX REQUEST */

        $return .= "
                </div>
                <div style='padding-top: 3%'></div>
                <button type=\"submit\" class='btn btn-secondary' name=\"confirmation_cancel\" value=\"1\">Înapoi</button>
                <button type=\"submit\" class='btn btn-warning' name=\"confirmation_approve_massage\" id='confirmation_approve_massage' value=\"1\">Confirmă</button>
            </form>
        ";
    }
    return $return;
}
function confirmation_shortcode_spa()
{
    $_SESSION['reservation']['date'] = $_GET['date'];
    $_SESSION['reservation']['service'] = $_GET['spa_type'];

    if(!isset($_SESSION['reservation']['date']) || !isset($_SESSION['reservation']['service']))
        awesome_goto_fail_page("Confirmation SPA unset date | s_type");

    $current_user = wp_get_current_user();
    $_SESSION['reservation']['name'] = $current_user->display_name;
    $_SESSION['reservation']['wonder_id'] = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
    switch($_SESSION['reservation']['service'])
    {
        case "sf_1_lv":
            $_SESSION['reservation']['service_to_show'] = "SPA&Fitness : Luni-Vineri – 1x";
            break;
        case "sf_1_sd":
            $_SESSION['reservation']['service_to_show'] = "SPA&Fitness : Sâmbătă-Duminică – 1x";
            break;
        case "is_15":
            $_SESSION['reservation']['service_to_show'] = "Închiriere SPA: 15 persoane";
            break;
        case "is_20":
            $_SESSION['reservation']['service_to_show'] = "Închiriere SPA: 20 persoane";
            break;
        case "is_25":
            $_SESSION['reservation']['service_to_show'] = "Închiriere SPA: 25 persoane";
            break;
        default:
            awesome_goto_fail_page("Confirmation SPA wrong type");
    }

    // Case when user has no sessions available:
    if ( Reservation_spa_get_specific_sessions_amount( $_SESSION['reservation']['service'] )  <  1 )
        awesome_goto_fail_page(null,"
            <h1>Insuficiente sesiuni de <u>".$_SESSION['reservation']['service_to_show']."</u>!</h1>
            <div style='margin-top: 3%'></div>
            <h3><a href='shop' >Mergi la magazin servicii</a></h3>
        ");
    else
    {
        $slots = Reservation_spa_get_slots($_SESSION['reservation']['date'], $_SESSION['reservation']['service']);
        $return
            = "
            <h1 class='wonderland-h1'>Confirmare rezervare</h1>
            <div style=\"margin-top: 4%\"></div>
            <h1 class='wonderland-text' style='font-size:17px; font-weight:600;'>Detalii rezervare:</h1>
            <div style=\"margin-top: 3%\"></div>
            <h1>Nume: " . $_SESSION['reservation']['name'] . " </h1>
            <h1>Serviciu: " . $_SESSION['reservation']['service_to_show'] . "</h1>
            <h1>Data: " . date("d F Y",strtotime($_SESSION['reservation']['date'],0)) . "</h1>
            <form class=\"\" action=\"\" method=\"post\">
                <div style='padding-top: 3%'>
                    <h1>Alege ora<span style='color:red;'>*</span>:</h1>";
                    if(isset($slots))
                    {
                        $return .= "<select name='spa_time_select' id='spa_time_select' class='confirm-select'>";
                        foreach ($slots as $slot)
                        {
                            $return .= "<option value='$slot'>$slot</option>";
                        }
                        $return .= "</select>";
                    }
                    else
                        $return .=
                    "<h4 style='color: red;'>Nici o oră disponibilă la data curentă!</h4>";
     $return .="</div>
                <div style='padding-top: 3%'></div>
                <button type=\"submit\" class='btn btn-secondary' name=\"confirmation_cancel\" value=\"1\">Înapoi</button>
                <button type=\"submit\" class='btn btn-warning' ". ((!isset($slots))?"disabled":" ") ." name=\"confirmation_approve_spa\" id='confirmation_approve_spa' value=\"1\">Confirmă</button>
            </form>
        ";
    }
    return $return;
}
//function confirmation_shortcode_balloon()
//{
//    $_SESSION['reservation']['date'] = $_GET['date'];
//    $_SESSION['reservation']['service'] = $_GET['balloon_type'];
//
//    if(!isset($_SESSION['reservation']['date']) || !isset($_SESSION['reservation']['service']))
//        awesome_goto_fail_page("Confirmation Balloon unset date | b_type");
//
//    $current_user = wp_get_current_user();
//    $_SESSION['reservation']['name'] = $current_user->display_name;
//    $_SESSION['reservation']['wonder_id'] = get_user_meta(get_current_user_id(),'Wonderland_user_id',true);
//    switch($_SESSION['reservation']['service'])
//    {
//        case "agr3":
//            $_SESSION['reservation']['service_to_show'] = "Zbor de agrement (3 persoane)";
//            break;
//        case "agr4":
//            $_SESSION['reservation']['service_to_show'] = "Zbor de agrement (4 persoane)";
//            break;
//        case "publ":
//            $_SESSION['reservation']['service_to_show'] = "Zbor de publicitate";
//            break;
//        case "evnt":
//            $_SESSION['reservation']['service_to_show'] = "Zbor de eveniment";
//            break;
//        default:
//            awesome_goto_fail_page("Confirmation Balloon wrong type");
//    }
//
//    // Case when user has no sessions available:
//    if ( Reservation_balloon_get_specific_sessions_amount( $_SESSION['reservation']['service'] )  <  1 )
//    {
//        awesome_goto_fail_page(null,"
//            <h1>Insuficiente sesiuni de <u>".$_SESSION['reservation']['service_to_show']."</u>!</h1>
//            <div style='margin-top: 3%'></div>
//            <h3><a href='shop' >Mergi la magazin servicii</a></h3>
//        ");
//    }
//    else
//    {
//        $slots = Reservation_balloon_get_slots($_SESSION['reservation']['date'], $_SESSION['reservation']['service']);
//        $return
//            = "
//            <h1 class='wonderland-h1'>Confirmare rezervare</h1>
//            <div style=\"margin-top: 4%\"></div>
//            <h1 class='wonderland-text' style='font-size:17px; font-weight:600;'>Detalii rezervare:</h1>
//            <div style=\"margin-top: 3%\"></div>
//            <h1>Nume: " . $_SESSION['reservation']['name'] . " </h1>
//            <h1>Serviciu: " . $_SESSION['reservation']['service_to_show'] . "</h1>
//            <h1>Data: " . date("d F Y",strtotime($_SESSION['reservation']['date'],0)) . "</h1>
//            <form class=\"\" action=\"\" method=\"post\">
//                <div style='padding-top: 3%'>
//                    <h1>Alege perioada<span style='color:red;'>*</span>:</h1>";
//        if(isset($slots) && !empty($slots))
//        {
//            $return .= "<select name='balloon_time_select' class='confirm-select' id='balloon_time_select'>";
//            foreach ($slots as $slot)
//            {
//                $return .= "<option value='$slot'>".ucfirst($slot)."</option>";
//            }
//            $return .= "</select>";
//        }
//        else
//            $return .=
//                "<h4 style='color: red;'>Nici o perioadă disponibilă la data curentă!</h4>";
//        $return .="</div>
//                <div style='padding-top: 3%'></div>
//                <button type=\"submit\" class='btn btn-secondary' name=\"confirmation_cancel\" value=\"1\">Înapoi</button>
//                <button type=\"submit\" class='btn btn-warning' ". ((!isset($slots))?"disabled":" ") ." name=\"confirmation_approve_balloon\" id='confirmation_approve_spa' value=\"1\">Confirmă</button>
//            </form>
//        ";
//    }
//    return $return;
//}

// Reservation result shcode
function reservation_result_shortcode($atts = [], $content = null)
{
    if
    ( !isset($_SESSION['reservation']['date']) || !isset($_SESSION['reservation']['time']) )
        awesome_goto_fail_page(null,"Accesare neautorizată a paginii !");

    $toReturn = "<h1 class='wonderland-h1'>Rezervare</h1>
                <div style=\"margin-top: 6%;\"></div>";

    if(isset($_SESSION['reservation']['service']))
        $serv = $_SESSION['reservation']['service'];

    if(isset($_SESSION['reservation']['service_to_show']))
    {
        $_SESSION['reservation']['service'] = $_SESSION['reservation']['service_to_show'];
    }
    $toReturn .= "<h1 class=\"\" style=\"\">Rezervat cu succes!</h1>";
    $toReturn .= "<div style='margin-top: 3%'></div>";
    $toReturn .= "<h2>Ați rezervat <u>". $_SESSION['reservation']['service'] .
                 "</u> la data de <u>".date("d F Y",strtotime($_SESSION['reservation']['date'],0)).
        // In case of balloon service, don't show the time
        ($serv != 'agr3' && $serv != 'agr4' && $serv != 'agr3' && $serv != 'agr3'
            ?"</u> începând cu ora <u>".date("H:i",strtotime($_SESSION['reservation']['time'],0))
            :" în perioada de ".$_SESSION['reservation']['time']).
                 "</u></h2>";

    $toReturn .="<br><br>
                 <br>"
                 .(isset($_SESSION['reservation']) ? "<h3 style=\"color:#d4d1c2;\"><a href=\"../reservation-table/\">Încă o rezervare</a></h3><br>
                    <h3 style=\"color:#d4d1c2;\"><a href=\"history-table/\">Mergi în istoric</a></h3><br>" : "").
                 "<h3 style=\"color:#d4d1c2;\"><a href=\"home/\">Mergi la pagina principală</a></h3>
                 <div style=\"margin-top: 6%;\"></div>";

    return $toReturn;
}
add_shortcode('reservation_result','reservation_result_shortcode');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////NEW BEGGINING ******************************/////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * function that generates fitness reservation page
 * @return string : page string
 */
function shortcode_reservation_fitness()
{
    ////////////////////////////////////////////////////////////////////////////
    /// dealing with POST / GET requests
    ////////////////////////////////////////////////////////////////////////////

    if(isset($_POST['fitness_id_activation']))
    {
        $fitness_id_activation = $_POST['fitness_id_activation'];
        $status = awesome_activate_subscribtion($fitness_id_activation);

        if($status === 1)
            $_SESSION['alert'][]=[1,'<b>Success!</b> The selected subscription was activated successfully!'];
        if($status === -1)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like this subscription had already been activated!'];
        if($status === -2)
            awesome_goto_fail_page(null,"fitness activation: multiple booking for same user");
        if($status === -3)
            awesome_goto_fail_page(null,"fitness activation: given activation id is invalid");
    }

    ////////////////////////////////////////////////////////////////////////////
    /// showing requested alerts
    ////////////////////////////////////////////////////////////////////////////

    $header = "";
    if(isset($_SESSION['alert']))
    {
        foreach ($_SESSION['alert'] as $alert)
        {
            $header .= "<div class=\"alert ".($alert[0]?"alert-success":"alert-danger")."\">
                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            $alert[1]
                        </div>";
        }

        unset($_SESSION['alert']);
        unset($_POST['fitness_id_activation']);
    }

    ////////////////////////////////////////////////////////////////////////////
    /// generating front end code
    ////////////////////////////////////////////////////////////////////////////

    $subscription_header = "Subscription status: ";
    $table = "<br>";
    $status = fitness_get_status();
    //no subscr case
    if(!$status)
    {
        $subscription_header .= "no subscrtiption";
    }
    //expired subscr case
    elseif ($status[0] === 0)
    {
        $subscription_header .= "<span style='color: #d63324;'>expired from</span> " . $status[1];
    }
    //available subscr case
    elseif ($status[0] === 1)
    {
        $subscription_header .= "<span style='color: #00aff2;'>active until</span> " . $status[1];
    }
    //cancelled subscr case
    elseif ($status[0] === -1)
    {
        $subscription_header .= "cancelled";
    }
    // error case
    else
    {
        awesome_goto_fail_page(null,"fitness get subscription status: invalid status value");
    }

    $table_subscriptions = fitness_get_table_subscriptions();
    if($table_subscriptions)
    {
        $table .= "<table class=\"table table-striped table-hover table-bordered awesome-table\">
        
            <col width=\"10%\">
            <col width=\"50%\">
            <col width=\"15%\">
            <col width=\"15%\">
    
            <thead>
                <tr>
                    <th>Check #</th>
                    <th>Service Name</th>
                    <th>Time Span (days)</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                        ";

        foreach ($table_subscriptions as $row)
        {
            $table .= "
            <tr>
                <td>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$row[2]}</td>";

            $table .= ($row[3]) ? "<td>Activated</td>" :
                "<td>
                        <button type=\"button\" id=\"mymodal\" class=\"btn btn-light btn-awesome\" data-toggle=\"modal\" data-target=\"#anulareModal" . $row[4] . "\">
                            Activate
                        </button>
                        <!-- Modal -->
                        <div class=\"modal fade\" id=\"anulareModal" . $row[4] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModal" . $row[4] . "Label\">
                          <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
                            <div class=\"modal-content\">
                              <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                              </div>
                              <div class=\"modal-body\" style=\"color: #111;\">
                                Are you sure you want to activate this subscription?<br>This cannot be undone! <a href='#'>Learn more</a>
                              </div>
                              <div class=\"modal-footer\">
                              <form action=\"\" method='post'>
                                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>
                                <input type='hidden' value=\"" . $row[4] . "\" name='fitness_id_activation'>
                                    <button class=\"btn btn-primary\" name ='confirm_btn' type=\"submit\" style=\"\">Confirm</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                     </td>";

            $table .= " </tr>";
        }
        $table .= " </tbody>
            </table>
            </div>";
    }
    else
    {
        $table .= "<div class=\"row awesome-info-card center-block\">
                    <h3>
                       No subscriptions found...
                    </h3>
                    <br>
                    <h4>
                        You may want to <a href='".get_site_url() . '/product-category/fitness/'."'>buy more</a>
                    </h4>
                    <p>
                        If you already bought a fitness subscription but it is not displayed here,
                        <br>
                        make sure you <a href='".get_site_url().'/contact/'."'>contact us</a>
                    </p>
                   </div>";
    }


    return $header . $subscription_header . $table;
}
add_shortcode('reservation_fitness', 'shortcode_reservation_fitness');

/**
 * function that generates spa reservation page
 * @return string : page string
 */
function reservation_spa_shortcode()
{
    echo "<div class=\"row awesome-info-card center-block\">
                    <h3>
                       SPA service unavailable...
                    </h3>
                   </div>";
}
add_shortcode('reservation_spa','reservation_spa_shortcode');

/**
 * function that generates swimming reservation page
 * @return string : page string
 */
function reservation_swimming_shortcode()
{
    ////////////////////////////////////////////////////////////////////////////
    /// dealing with POST / GET requests
    ////////////////////////////////////////////////////////////////////////////

    if(isset($_POST['swimming_confirm']))
    {
        $swimming_date = $_POST['swimming_date_picker'];
        $swimming_time_start = $_POST['swimming_select_hour'];
        $swimming_time_end = date('ha', strtotime($swimming_time_start . " + 4 hour"));
        $id_service = 2;
        $status = awesome_make_new_booking($swimming_date,$swimming_time_start,$swimming_time_end,$id_service);

        // Generating alarms for next page & handling new booking status response
        if($status === 1)
            $_SESSION['alert'][]=[1,'<b>Success!</b> New booking added successfully!'];
        if($status === 0)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like there is another booking at the requested time!'];
        if($status === -1)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like you requested for a booking in the past!'];
        if($status === -2)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like you introduced an invalid date or time!'];
        if($status === -3)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like you do not have enough passes!'];

        unset($_POST['swimming_confirm']);
    }

    if(isset($_POST['swimming_id_cancellation']))
    {
        $id_service = 2; //premade
        $id_booking = $_POST['swimming_id_cancellation'];
        $status = awesome_cancel_booking($id_booking, $id_service);

        // Generating alarms for next page & handling new booking status response
        if($status === 1)
            $_SESSION['alert'][]=[1,'<b>Success!</b> Selected booking was cancelled successfully!'];
        if($status === 0)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like the booking you tried to cancel is already cancelled!'];
        if($status === -1)
            awesome_goto_fail_page("swimming booking cancel: pass increment failed");
        if($status === -2)
            awesome_goto_fail_page("swimming booking cancel: booking id not found in external");
    }

    ////////////////////////////////////////////////////////////////////////////
    /// showing requested alerts
    ////////////////////////////////////////////////////////////////////////////

    $header = "";
    if(isset($_SESSION['alert']))
    {
        foreach ($_SESSION['alert'] as $alert)
        {
            $header .= "<div class=\"alert ".($alert[0]?"alert-success":"alert-danger")."\">
                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            $alert[1]
                        </div>";
        }

        unset($_SESSION['alert']);
    }

    ////////////////////////////////////////////////////////////////////////////
    /// generating front end code
    ////////////////////////////////////////////////////////////////////////////

    $subscription_header = "<div style=\"display: flex; justify-content: space-between;\"><p>Swimming passes: ";
    $table = "<br>";
    $status = swimming_get_status();
    //no passes
    if(isset($status) && $status[0]==-1)
    {
        $subscription_header .= "no passes available";
    }
    //existing passes
    elseif ($status[0] === 1)
    {
        $subscription_header .= $status[1] . " available";
    }
    // error case
    else
    {
        awesome_goto_fail_page("swimming get status: invalid status value");
    }

    // generating New Booking button
    $subscription_header .= "
        </p>
        <button type=\"button\" id=\"mymodal\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#new_booking_form\" aria-expanded=\"false\" aria-controls=\"new_booking_form\">
            New Booking
        </button>
    </div>
    
    <!-- New Booking form div -->
    <div class=\"collapse awesome-swimming-add-form\" id=\"new_booking_form\">
      <div class=\"well\" style='text-align: center'>
        <form action method='POST'>
            <h3>
                New Swimming Booking Form
            </h3>
            <br>
            <h4>
                Choose Booking Day:
            </h4>
            <input id='swimming_date_picker' name='swimming_date_picker' value='".date("Y-m-d")."' type='date' style='width:50%'>
            <h4>
                Choose Booking Start Time:
            </h4>
            <select style='width:50%' name='swimming_select_hour' id='swimming_select_hour'>
            <!-- !!! -->
                <option>10am</option>
                <option>12pm</option>
                <option>02pm</option>
                <option>04pm</option>
            </select>
            <br>
            <div class='row' style='margin-top: 30px;'>
                <button type=\"button\" class=\"btn btn-default swimming-new-booking-button\" data-toggle=\"collapse\" data-target=\"#new_booking_form\" aria-expanded=\"false\" aria-controls=\"new_booking_form\">
                    Cancel
                </button>
                <button type=\"button\" id='swimming-new-booking-confirm-btn' class=\"btn btn-primary swimming-new-booking-button\" data-toggle=\"modal\" data-target=\"#awesome-confirm-new-swimming-modal\">
                    Confirm
                </button>
                <!-- Modal -->
                <div class=\"modal fade\" id=\"awesome-confirm-new-swimming-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
                  <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
                    <div class=\"modal-content\">
                      <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                        <h4 class=\"modal-title\" id=\"myModalLabel\"> New Swimming Booking Confirmation</h4>
                      </div>
                      <div class=\"modal-body\">
                        <span id='swimming-new-booking-modal-body'>Are you sure you want to make a new booking? <br>Confirming now it might be impossible to cancel it later!</span>
                      </div>
                      <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-default swimming-new-booking-button\" data-dismiss=\"modal\">Close</button>
                        <button type=\"submit\" name='swimming_confirm' class=\"btn btn-primary swimming-new-booking-button\">Confirm</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </form>
      </div>
    </div>
    ";

    //getting swimming bookings
    $table_bookings = swimming_get_table_bookings();

    //generating swimming booking table
    if($table_bookings)
    {
        $table .= "<table class=\"table table-striped table-hover table-bordered awesome-table table-swimming\">
        
            <col width=\26%\">
            <col width=\"25%\">
            <col width=\"17%\">
            <col width=\"17%\">
            <col width=\"15%\">
    
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Booking Date</th>
                    <th>Booking Start Time</th>
                    <th>Booking End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                        ";

        foreach ($table_bookings as $row)
        {
            $table .= "
            <tr>
                <td>{$row[0]}</td>
                <td>".date("F j, Y",strtotime($row[2],0))."</td>
                <td>".date("h:i a",strtotime($row[3],0))."</td>
                <td>".date("h:i a",strtotime($row[4],0))."</td>";

            $table .= ($row[5]) ? "<td>Cancelled</td>" :
                (!awesome_check_cancel_date($row[2])?"<td>Used</td>":
                "<td>
                        <button type=\"button\" id=\"mymodal\" class=\"btn btn-light btn-awesome\" data-toggle=\"modal\" data-target=\"#anulareModal" . $row[1] . "\">
                            Cancel
                        </button>
                        <!-- Modal -->
                        <div class=\"modal fade\" id=\"anulareModal" . $row[1] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModal" . $row[1] . "Label\">
                          <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
                            <div class=\"modal-content\">
                              <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                              </div>
                              <div class=\"modal-body\" style=\"color: #111;\">
                                Are you sure you want to cancel this booking?<br>This cannot be undone! <a href='#'>Learn more</a>
                              </div>
                              <div class=\"modal-footer\">
                              <form action=\"\" method='post'>
                                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>
                                <input type='hidden' value=\"" . $row[1] . "\" name='swimming_id_cancellation'>
                                    <button class=\"btn btn-primary\" name ='confirm_btn' type=\"submit\" style=\"\">Confirm</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                     </td>");

            $table .= " </tr>";
        }
        $table .= " </tbody>
            </table>
            </div>";
    }
    else
    {
        $table .= "<div class=\"row awesome-info-card center-block\">
                    <h3>
                       No bookings found...
                    </h3>
                    <br>
                    <h4>
                        You may want to <a id='awesome-new-swimming-anch' href='#new_booking_form'>make a booking</a>
                         or <a href='".get_site_url() . '/product-category/swimming/'."'>buy more passes</a>
                    </h4>
                    <p>
                        If you already made a swimming booking and it is not displayed here,
                        <br>
                        make sure you <a href='".get_site_url().'/contact/'."'>contact us</a>
                    </p>
                   </div>";
    }

    return $header . $subscription_header . $table;
}
add_shortcode('reservation_swimming','reservation_swimming_shortcode');

/**
 * function that generates massage reservation page
 * @return string : page string
 */
function reservation_massage_shortcode()
{
    ////////////////////////////////////////////////////////////////////////////
    /// dealing with POST / GET requests
    ////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['massage_confirm']))
    {
        $massage_date = $_POST['massage_date_picker'];
        $massage_time_start = $_POST['swimming_select_hour'];
        $massage_time_end = date('ha', strtotime($massage_time_start . " + 1 hour"));
        $id_service = $_POST['massage_id']; // 5 or 6
        $status = awesome_make_new_booking($massage_date, $massage_time_start, $massage_time_end, $id_service);

        // Generating alarms for next page & handling new booking status response
        if($status === 1)
            $_SESSION['alert'][]=[1,'<b>Success!</b> New booking added successfully!'];
        if($status === 0)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like there is another booking at the requested time!'];
        if($status === -1)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like you requested for a booking in the past!'];
        if($status === -2)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like you introduced an invalid date or time!'];
        if($status === -3)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like you do not have enough passes!'];

        unset($_POST['massage_confirm']);
    }

    if(isset($_POST['massage_id_cancellation']))
    {
        $id_service = [5,6]; //massage ids
        $id_booking = $_POST['massage_id_cancellation'];
        $status = awesome_cancel_booking($id_booking);

        // Generating alarms for next page & handling new booking status response
        if($status === 1)
            $_SESSION['alert'][]=[1,'<b>Success!</b> Selected booking was cancelled successfully!'];
        if($status === 0)
            $_SESSION['alert'][]=[0,'<b>Nope!</b> Seems like the booking you tried to cancel is already cancelled!'];
        if($status === -1)
            awesome_goto_fail_page("swimming booking cancel: pass increment failed");
        if($status === -2)
            awesome_goto_fail_page("swimming booking cancel: booking id not found in external");
    }


    ////////////////////////////////////////////////////////////////////////////
    /// showing requested alerts
    ////////////////////////////////////////////////////////////////////////////

    $header = "";
    if(isset($_SESSION['alert']))
    {
        foreach ($_SESSION['alert'] as $alert)
        {
            $header .= "<div class=\"alert ".($alert[0]?"alert-success":"alert-danger")."\">
                            <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            $alert[1]
                        </div>";
        }

        unset($_SESSION['alert']);
        unset($_POST['fitness_id_activation']);
    }

    ////////////////////////////////////////////////////////////////////////////
    /// requesting backend data
    ////////////////////////////////////////////////////////////////////////////

    $table_services = massage_get_status();
    $table_bookings = massage_get_table_booking();

    ////////////////////////////////////////////////////////////////////////////
    /// generating services table code
    ////////////////////////////////////////////////////////////////////////////
    $table = "";

    if($table_services)
    {
        $table .= "
        <table class=\"table table-striped table-hover table-bordered awesome-table\">
        
            <col width=\"50%\">
            <col width=\"15%\">
            <col width=\"15%\">
            <col width=\"15%\">
    
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Duration</th>
                    <th>Passes #</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                        ";

        foreach ($table_services as $row)
        {
            $table .= "
            <tr>
                <td>{$row[0]}</td>
                <td>60 minutes</td>";

            if (is_numeric($row[2])) {
                $table .= "<td>" . $row[2] . "</td>";
                $table .= "<td>
                    <button type=\"button\" id=\"mymodal\" class=\"btn btn-primary btn-awesome\" data-toggle=\"modal\" data-target=\"#bookingModal\">
                        Book now
                    </button>
                    <!-- Modal -->

                 </td>";
            } else {
                $table .= "<td>-</td>
                <td>
                    <button type=\"button\" class=\"btn btn-light btn-awesome\" onclick=\"location.href='".get_site_url() . "/product-category/massage/'\">
                        Buy more
                    </button>
                 </td>";
            }

            $table .= " </tr>";
        }
        $table .= " </tbody>
            </table>
            </div>";
    }
    else
    {
        $table .= "<div class=\"row awesome-info-card center-block\">
                    <h3>
                       No services available...
                    </h3>
                   </div>";
    }

    ////////////////////////////////////////////////////////////////////////////
    /// generating booking table code
    ////////////////////////////////////////////////////////////////////////////

    //generating  booking table
    if($table_bookings)
    {
        $table .= "<table class=\"table table-striped table-hover table-bordered awesome-table table-swimming\">
        
            <col width=\26%\">
            <col width=\"25%\">
            <col width=\"17%\">
            <col width=\"17%\">
            <col width=\"15%\">
    
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Booking Date</th>
                    <th>Booking Start Time</th>
                    <th>Booking End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                        ";

        foreach ($table_bookings as $row)
        {
            $table .= "
            <tr>
                <td>{$row[0]}</td>
                <td>".date("F j, Y",strtotime($row[2],0))."</td>
                <td>".date("h:i a",strtotime($row[3],0))."</td>
                <td>".date("h:i a",strtotime($row[4],0))."</td>";

            $table .= ($row[5]) ? "<td>Cancelled</td>" :
                (!awesome_check_cancel_date($row[2])?"<td>Used</td>":
                    "<td>
                        <button type=\"button\" id=\"mymodal\" class=\"btn btn-light btn-awesome\" data-toggle=\"modal\" data-target=\"#anulareModal" . $row[1] . "\">
                            Cancel
                        </button>
                        <!-- Modal -->
                        <div class=\"modal fade\" id=\"anulareModal" . $row[1] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"anulareModal" . $row[1] . "Label\">
                          <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
                            <div class=\"modal-content\">
                              <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                              </div>
                              <div class=\"modal-body\" style=\"color: #111;\">
                                Are you sure you want to cancel this booking?<br>This cannot be undone! <a href='#'>Learn more</a>
                              </div>
                              <div class=\"modal-footer\">
                              <form method='post'>
                                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>
                                <input type='hidden' value=\"" . $row[1] . "\" name='massage_id_cancellation'>
                                    <button class=\"btn btn-primary\" name ='confirm_btn' type=\"submit\" style=\"\">Confirm</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                     </td>");

            $table .= " </tr>";
        }
        $table .= " </tbody>
            </table>
            <form action method='POST'>
            <input type='hidden' name='massage_id' value='5'>
                    <div class=\"modal fade\" id=\"bookingModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"bookingModalLabel\">
                      <div class=\"modal-dialog modal-massage-booking\" role=\"document\" style='padding-top: 10%'>
                        <div class=\"modal-content\">
                        
                          <div class=\"modal-header\">
                            <h3 class=\"modal-title\" id=\"exampleModalCenterTitle\" style='float: left;width: 89%;margin-left: 7%; text-align: center;'>New massage booking</h3>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span id='massageModalClose' aria-hidden=\"true\">&times;</span></button>
                          </div>
                          
                          <div class=\"modal-body\" style=\"color: #111;\">
                            <div class=\"well\" style='text-align: center'>
                                
                                    <h4>
                                        Choose Booking Day:
                                    </h4>
                                    <input id='swimming_date_picker' name='massage_date_picker' value='".date("Y-m-d")."' type='date' style='width:50%'>
                                    <h4>
                                        Choose Booking Start Time:
                                    </h4>
                                    <select style='width:50%' name='swimming_select_hour' id='swimming_select_hour'>
                                    <!-- !!! -->
                                        <option>10am</option>
                                        <option>11am</option>
                                        <option>12pm</option>
                                        <option>1pm</option>
                                        <option>2pm</option>
                                        <option>3pm</option>
                                        <option>4pm</option>
                                        <option>5pm</option>
                                    </select>
                                    <br>
                                    <div class='row' style='margin-top: 30px;'>
                                        <button type=\"button\" class=\"btn btn-default swimming-new-booking-button\" data-dismiss='modal' \">
                                            Cancel
                                        </button>
                                        <button type=\"button\" id='swimming-new-booking-confirm-btn' class=\"btn btn-primary swimming-new-booking-button\" onclick='close_f()' data-toggle=\"modal\" data-target=\"#awesome-confirm-new-swimming-modal\">
                                            Continue
                                        </button>
                                    </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <!-- Modal -->
                        <div class=\"modal fade\" id=\"awesome-confirm-new-swimming-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
                          <div class=\"modal-dialog\" role=\"document\" style='padding-top: 15%'>
                            <div class=\"modal-content\">
                              <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <h4 class=\"modal-title\" id=\"myModalLabel\"> New Massage Booking Confirmation</h4>
                              </div>
                              <div class=\"modal-body\">
                                <span id='swimming-new-booking-modal-body'>Are you sure you want to make a new booking? <br>Confirming now it might be impossible to cancel it later!</span>
                              </div>
                              <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-default swimming-new-booking-button\" data-dismiss=\"modal\">Close</button>
                                <button type=\"submit\" name='massage_confirm' class=\"btn btn-primary swimming-new-booking-button\">Confirm</button>
                              </div>
                            </div>
                          </div>
                        </div>
            </form>
            </div>";
    }
    else
    {
        $table .= "<div class=\"row awesome-info-card center-block\">
                    <h3>
                       No bookings found...
                    </h3>
                    <br>
                    <h4>
                        You may want to <a id='awesome-new-swimming-anch' href='#new_booking_form'>make a booking</a>
                         or <a href='".get_site_url() . '/product-category/massage/'."'>buy more passes</a>
                    </h4>
                    <p>
                        If you already made a massage booking and it is not displayed here,
                        <br>
                        make sure you <a href='".get_site_url().'/contact/'."'>contact us</a>
                    </p>
                   </div>";
    }

    return $header . $table;
}
add_shortcode('reservation_massage','reservation_massage_shortcode');





function redirect_shortcode($atts = [], $content = null)
{

    $url = $atts['url'];
    wp_redirect($url);
    exit();

}
add_shortcode('redirect','redirect_shortcode');

function fail_page_shortcode($atts = [], $content = null)
{

    if(isset($_SESSION['FAILS']))
    {
        $return = "<h1>" . $_SESSION['FAILS']['message'] . "</h1>";
        $return .= "<div style='margin-top: 2%'></div>";

        if(isset($_SESSION['FAILS']['exception']))
        {
            $return
                .= "
        <div class=\"col justify-end\" >
          <button class=\"btn btn-primary\" type=\"button\" data-toggle=\"collapse\" data-target=\"#multiCollapseExample2\" aria-expanded=\"false\" aria-controls=\"multiCollapseExample2\">Detalii dev</button>
        </div>
        <div class=\"col\">
            <div class=\"collapse multi-collapse\" id=\"multiCollapseExample2\">
              <div class=\"card card-body\">";
            $return .= $_SESSION['FAILS']['exception'];
            $return
                .= "
              </div>
            </div>
          </div>
        </div>
        ";
        }
        return $return;
    }
    else
    {
        wp_redirect(home_url());
        exit();
    }
}
add_shortcode('fail_page','fail_page_shortcode');

// Order details shcode
function order_details_shortcode($atts = [], $content = null)
{

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }
    elseif(!isset($_POST['order_id']))
    {
        // SESSION FAILS
        return "
            <div style='margin-top: 5%'></div>
            			<h1 class='wonderland-h1'>Comandă invalidă! </h1>
            <div style='margin-top: 4%'></div>
            <a href=\"home/\"><h3 class=\"text - center\">Mergi la pagina principală</h3></a>
        ";
    }?>
    <p>
        <?php
        /* translators: 1: order number 2: order date 3: order status */
        $order = wc_get_order($_POST['order_id']);
        printf(
            __( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
            '<mark class="order-number">' . $order->get_order_number() . '</mark>',
            '<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
            '<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
        );
        ?></p>

    <?php if ( $notes = $order->get_customer_order_notes() ) : ?>
    <h2><?php _e( 'Order updates', 'woocommerce' ); ?></h2>
    <ol class="woocommerce-OrderUpdates commentlist notes">
        <?php foreach ( $notes as $note ) : ?>
            <li class="woocommerce-OrderUpdate comment note">
                <div class="woocommerce-OrderUpdate-inner comment_container">
                    <div class="woocommerce-OrderUpdate-text comment-text">
                        <p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
                        <div class="woocommerce-OrderUpdate-description description">
                            <?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>

    <?php
    $order_id = wc_get_order_id_by_order_key($order->get_order_key());
    do_action( 'woocommerce_view_order', $order_id );
}
add_shortcode("order_details","order_details_shortcode");

// Orders table shcode
function orders_table_shortcode($atts = [], $content = null)
{

    if($atts) die($atts['title']);

    $args = array(
        'created_via' => 'checkout',
        'customer_id' => get_current_user_id(),
    );
    $table_rows = wc_get_orders($args);

    $tableString
        = "
            <div style='margin-top: 50px'></div>

            <table id=\"table12\" class=\"table table-striped table-hover table-bordered\" style=\"width:100%;\">
            
                <col width=\"10%\">
                <col width=\"20%\">
                <col width=\"20%\">
                <col width=\"40%\">
                <col width=\"10%\">
                
                <thead>
                    <tr>
                        <th>Comanda</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            
            ";

    /* Table body */
    if (!count($table_rows))
    {
        $tableString
            .= "
            <tr>
                <td colspan='100' class='text-center font-weight-bold'>Nici o comandă</td>
            </tr>
                ";
    }
    else
    {
        foreach ($table_rows as $row)
        {
            $tableString
                .= "
            <tr>
                <td>#" . $row->get_id() . "</td>
                <td>" . date("d/m/Y", strtotime($row->get_date_created())) . "</td>
                <td>" . $row->get_status() . "</td>
                <td>" . $row->get_currency() . " " . $row->get_total() . " pentru " . $row->get_remaining_refund_items() . " produse" . "</td>
                <td>
                    <form action='../order-details/' method='post'>
                        <button class='btn btn-warning' name='order_id' value='" . $row->get_id() . "'>Detalii</button>
                    </form>
                </td>
            </tr>

            ";
        }
    }

    /* Table footer */
    $tableString
        .= "
                </tbody>
            </table>
            
            <div style=\"margin-bottom: 40px;\"></div>
        ";

    return $tableString;
}
add_shortcode("orders_table","orders_table_shortcode");