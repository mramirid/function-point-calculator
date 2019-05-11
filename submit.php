<?php
    // Ambil array yang dikirm dari JavaScript
    $fpc_array = json_decode($_POST["fpc"], true);
    $tca_array = json_decode($_POST["tca"], true);

    // Bobot
    $fpc_weight = array(3, 4, 6, 4, 5, 7, 7, 10, 15, 5, 7, 10, 3, 4, 6);

    $ufp = 0;
    $tdi_result = 0;
	for ($i = 0; $i < 15; $i++) { 
        // Hitung Unajusted Function Point (UFP) dari Function Point Complexity (FPC)
        if ($fpc_array[$i] != "") {
            $ufp += ($fpc_array[$i] * $fpc_weight[$i]);
        }

        // Hitung Total Degree of Influence (TDI)
        if ($i < 14) {
            if ($tca_array[$i] != "") {
                $tdi_result += $tca_array[$i];
            }
        }
    }

    $tca = 0.65 + 0.01 * $tdi_result;
    $fp = $ufp * $tca;

	echo '<input type="text" class="form-control" value='.$fp.' disabled />';
?>