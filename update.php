<?php

    $nazov = $_POST['nazov'];
    $tVoda = $_POST['tVoda'];
    $vHladiny = $_POST['vHladiny'];
    $datum = $_POST['datum'];
    $senzor = $_POST['senzor'];
    $idDiela = $_POST['idDiela'];

       require "connect.php";
       if (!$spojenie):
        echo '<script> alert("Spojenie s databázou sa nepodarilo!"); </script>';
        
       else:
            $sql = MySQLi_Query($spojenie, "UPDATE vodnediela SET nazov_diela='$nazov', teplota_vody=$tVoda, vyska_hladiny=$vHladiny, datum_merania='$datum', 
            cislo_senzor='$senzor' WHERE id_diela=$idDiela");
            if (!$sql):
                echo '<script> alert("Došlo k chybe pri vytváraní SQL!"); </script>';
                
            else:
                header('Location: index.php');
            endif;
        endif; 
            ?>