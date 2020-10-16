<?php

    $nazov = $_POST['nazov'];
    $tVoda = $_POST['tVoda'];
    $vHladiny = $_POST['vHladiny'];
    $datum = $_POST['datum'];
    $senzor = $_POST['senzor'];

       require "connect.php";
       if (!$spojenie):
        echo '<script> alert("Spojenie s databázou sa nepodarilo!"); </script>';
        
       else:
            $sql = MySQLi_Query($spojenie, "INSERT INTO vodnediela VALUES (null, '$nazov', $tVoda, $vHladiny, '$datum', '$senzor')");
            if (!$sql):
                echo '<script> alert("Došlo k chybe pri vytváraní SQL!"); </script>';
                
            else:
                header('Location: index.php');
            endif;
        endif; 
            ?>

