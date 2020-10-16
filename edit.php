<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
    <?php
        $id_diela = $_GET['id'];

       require "connect.php";
       if (!$spojenie):
        echo "Spojenie s DB sa nepodarilo!";
       else:
        $sql0 = MySQLi_Query($spojenie, "SELECT * FROM vodnediela WHERE id_diela=$id_diela");
            if (!$sql0):
                echo "Doslo k chybe pri vytvarani SQL dotazu 0!";
            else:
                $row = mysqli_fetch_array($sql0, MYSQLI_NUM);
                $nazov_diela = $row[1];
                $teplota_vody = $row[2];
                $vyska_hladiny = $row[3];
                $datum_merania = $row[4];
                $cislo_senzor = $row[5];
            endif;

            $sql = MySQLi_Query($spojenie, "SELECT nazov_senzor, cislo_senzor FROM senzory");
            if (!$sql):
                echo "Doslo k chybe pri vytvarani SQL dotazu 1!";
            else:
                
                
                ?>
        
        <div class="container cont2">
      <form action="update.php" method="POST" >
            
            <h3 class="editH3">Edituj Meranie</h3>
            <hr>
           
              <div class="form-group">
                <label> Názov </label>
                <input type="text" name="nazov" class="form-control " placeholder="Názov" required 
                 maxlength="32" value="<?php echo $nazov_diela; ?>">
              </div>
              
              <div class="form-group">
              <label> Teplota Vody </label>
                <input type="number" name="tVoda" class="form-control" placeholder="Teplota Vody" min="-150" max="150" required value="<?php echo $teplota_vody; ?>"> 
              </div>

              <div class="form-group">
              <label> Výška Hladiny </label>
              <input type="number" name="vHladiny" class="form-control" placeholder="Teplota Vzduchu" min="-150" max="150" required value="<?php echo $vyska_hladiny; ?>">
              </div>

              <div class="form-group">
              <label>Dátum Merania</label> 
                    <input type="date" class="form-control" name="datum" required value="<?php echo $datum_merania; ?>">
              </div>

              <div class="form-group">
              <label>Senzor</label> 
                <select name="senzor" class="form-control senzCls" required>
             <?php 
                    while ($zaznam=mysqli_fetch_row($sql)): 
                    
            ?>
            <option value="<?php echo $zaznam[1]; ?>"<?php if($zaznam[1] == $cislo_senzor): echo ' selected'; endif; ?> > <?php echo $zaznam[0]; ?> </option>
            <?php endwhile; ?>

            </select>
              </div>

              <input type="hidden" name="idDiela" value="<?php echo $id_diela; ?>">
              <hr>
        <div class="editBtns">
        <button type="submit"  name="saveData" class="btn btn-primary btn-lg">Uložiť</button>
        <a href="index.php" ><button class="btn btn-secondary btn-lg">Zatvoriť</button></a>
        </div>

      </form>
      <?php 
            endif; 
            endif;
        ?>
      </div>

      
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="./js/app.js"></script>
    </body>
</html>