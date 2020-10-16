<?php 
require "connect.php";
if (!$spojenie)
{
    echo "Spojenie s DB sa nepodarilo!";
}

if(isset($_POST['deleteData']))
{
    $id = $_POST['id_delete'];

    $query = "DELETE FROM vodnediela WHERE id_diela = $id";
    $query_run = mysqli_query($spojenie, $query);

    if($query_run)
    {
        echo '<script> alert("Vymazane!"); </script>';
        header('Location: index.php');
    }
    else 
    {
        echo '<script> alert("Dáta sa nepodarilo vymazat!"); </script>';
        
    }

}
?>