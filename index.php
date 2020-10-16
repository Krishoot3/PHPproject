<!DOCTYPE html>
    <head>
        <meta charset="utf8_slovak_ci">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
    <div class="container animationIndex">
    <h1>Merania</h1>
    <?php

            require "connect.php";
            if (!$spojenie)
            {
                echo "Spojenie s DB sa nepodarilo!";
            }

            $query = "SELECT vodnediela.id_diela, vodnediela.nazov_diela, vodnediela.teplota_vody, 
            vodnediela.vyska_hladiny, vodnediela.datum_merania, vodnediela.cislo_senzor, senzory.nazov_senzor  
            FROM vodnediela, senzory
            WHERE vodnediela.cislo_senzor = senzory.cislo_senzor";
             $query_run = mysqli_query($spojenie, $query);
             $row12 = mysqli_fetch_array($query_run, MYSQLI_NUM);
             $cislo_senzor = $row12[5];

            $query2 = "SELECT nazov_senzor, cislo_senzor FROM senzory";
            $query_run2 = mysqli_query($spojenie, $query2);

            
            
            
          
        ?>
    <table class="table table-bordered table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Číslo záznamu</th>
      <th scope="col">Názov</th>
      <th scope="col">Teplota Vody</th>
      <th scope="col">Výška Hladiny</th>
      <th scope="col">Dátum Merania</th>
      <th scope="col">Názov Senzoru</th>
      <th scope="col">Akcie</th>
    </tr>
  </thead>
  <?php
            if($query_run)
            {
                $x = 0;
               
                foreach($query_run as $row)
                { $x = $x + 1;
                  $datum = $row['datum_merania'];
                  $datum2 = substr($datum,8,2).substr($datum,4,3).'-'.substr($datum,0,4);
                 
         ?>     
  <tbody>
    <tr>
      <td class="hiddenCls"> <?php echo $row['id_diela'];?></td>
      <td> <?php echo $x;?></td>
      <td> <?php echo $row['nazov_diela'];?></td>
      <td> <?php echo $row['teplota_vody']; echo '°C';?> </td>
      <td> <?php echo $row['vyska_hladiny']; echo 'm';?> </td>
      <td> <?php  echo $datum2;?></td>
      <td> <?php echo $row['nazov_senzor'];?></td>
      <td>  
      <a href="edit.php?id=<?php echo $row['id_diela']; ?>"> <img src="./pictures/edit.png" class="imgEd"> </a>      
      <a> <img src="./pictures/delete.png" class="imgDel deleteBtn"> </a>      
      </td>
    </tr>
  </tbody>
  <?php           
                }
            }
            else {
              echo '<script> alert("Žiadne dáta sa nenašli!"); </script>';
            }
        ?>
</table>
<div class="centrovac">
<button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#addModal">
  Pridaj Meranie
</button>
</div>
</div>


<!-- pattern="[a-zA-Z]*" -->
<!-- Modal Pridaj -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pridaj Meranie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="insert.php" method="POST">
      <div class="modal-body">
      
              <div class="form-group">
                <label> Názov </label>
                <input type="text" name="nazov" class="form-control" placeholder="Názov" 
                 maxlength="32" required>
              </div>

              <div class="form-group">
              <label> Teplota Vody </label>
                <input type="number" name="tVoda" class="form-control" placeholder="Teplota Vody" min="-150" max="150" value="0" required>
              </div>

              <div class="form-group">
              <label for="number"> Výška Hladiny </label>
              <input type="number" name="vHladiny" class="form-control" placeholder="Teplota Vzduchu" min="-150" max="150" value="0" required>
              </div>

              <div class="form-group">
              <label for="dt">Dátum Merania</label> 
                    <input type="date" class="form-control" name="datum" required>
              </div>

              <div class="form-group">
              <label>Senzor</label> 
                <select name="senzor" class="form-control" required>
                <?php
                    if($query_run2)
                    {
                        
                        foreach($query_run2 as $row)
                        { 
                ?>  
                <option value="<?php echo $row['cislo_senzor']; ?>"> <?php echo $row['nazov_senzor']; ?> </option>
                <?php           
                        }
                    }
                    else {
                      echo '<script> alert("Žiadne dáta sa nenašli!"); </script>';
                    }
                ?>
                  </select>
              </div>

      </div>
      <div class="modal-footer">
        <button type="submit"  name="saveData" class="btn btn-primary btn-lg">Uložiť</button>
        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Zatvoriť</button>
      </div>
      </form>

    </div>
  </div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Vymaž Meranie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="delete.php" method="POST">
      <div class="modal-body">
              <input type="hidden" name="id_delete" id="id_delete">

              <h4>Prajte si vymazať dáta?</h4>

      </div>
      <div class="modal-footer">
        <button type="submit"  name="deleteData" class="btn btn-primary">Áno</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
      </div>
      </form>

    </div>
  </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="./js/app.js"></script>
    </body>
</html>