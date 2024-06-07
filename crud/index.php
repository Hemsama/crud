<?php 
    //Base de datos

    require 'database.php';

    $db = conectarDB();

    $lenceria = '';
    $cantidad = '';
    $descripcion = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $lenceria = $_POST['lenceria'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];

        //Insertar en la base de datos
        $query = " INSERT INTO referencias (lenceria, cantidad, descripcion) VALUES ('$lenceria', '$cantidad', '$descripcion')";
    
        $resultado = mysqli_query($db, $query);
        
        if($resultado){
            header('Location: /admin.php');
        }
    }
?>


<form action="index.php" method="POST">
    <legend>Agregar Lenceria</legend>

    <label for="">Lenceria:</label>
    <input type="text" id="lenceria" name="lenceria" placeholder="Lencería roja" value="<?php echo $lenceria ?>">

    <label for="">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" placeholder="1" min="1" value="<?php echo $cantidad ?>" >

    <label for="">Descripción:</label>
    <textarea name="descripcion" id="descripcion" name="descripcion" placeholder="Hermosa lencería roja"  value="<?php echo $descripcion ?>"></textarea>

    <input type="submit" placeholder="Enviar">
</form>