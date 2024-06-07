<?php 
    //Base de datos
    require 'database.php';
    $db = conectarDB();

    //Valira la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin.php');
    }

    //Obtener los datos de la lenceria
    $consulta = "SELECT * FROM referencias WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $referencias = mysqli_fetch_assoc($resultado);


    $lenceria = $referencias['lenceria'];
    $cantidad = $referencias['cantidad'];
    $descripcion = $referencias['descripcion'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $lenceria = mysqli_real_escape_string($db ,$_POST['lenceria']);
        $cantidad = mysqli_real_escape_string($db ,$_POST['cantidad']);
        $descripcion = mysqli_real_escape_string($db ,$_POST['descripcion']);

        //Insertar en la base de datos
        $query = " UPDATE referencias SET lenceria = '${lenceria}', cantidad = ${cantidad}, descripcion = '${descripcion}' WHERE id = ${id}";
    
        $resultado = mysqli_query($db, $query);
        
        if($resultado){
            header('Location: /admin.php');
        }
    }
?>


<form  method="POST">
    <legend>Actualizar</legend>

    <label for="lenceria">Lenceria:</label>
    <input type="text" id="lenceria" name="lenceria" placeholder="Lencería roja" value="<?php echo $lenceria ?>">

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" placeholder="1" min="1" value="<?php echo $cantidad ?>" >

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>

    <input type="submit" placeholder="Actualizar">
</form>