<?php
require_once(__DIR__ . 'script_massage....php/');

$data = explode("|", $_POST['select']);
$date = $_POST['date'];

$return = "";
$masseurs = Reservation_massage_get_available_masseurs($date,$data[0]);
if(!empty($masseurs))
{
    $return.= "<select name='masseur_select' class='confirm-select' id='masseur_select'>";
    foreach ($masseurs as $masseur)
    {
        $return .= "<option value='" . $masseur['id'] . "'>" . $masseur['prenume'] . " " . $masseur['nume'] . "</option>";
    }
    $return .= "</select>";
}
else
{
    $return .= "<h4 style='color: red;'>Nici un maseur disponibil la ora și data aleasă!</h4>";
}

echo $return;
