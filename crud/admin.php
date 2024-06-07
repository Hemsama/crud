<?php 

    // Importar la conexión
    require 'database.php';
    $db = conectarDB();
    
    // Escribir el Query
    $query = "SELECT * FROM referencias";
    
    // Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query); 
    
    $resultado = $_GET['resultado']?? null;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            // Elimiar la referencia
            $query = "DELETE FROM referencias WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);

            if($resultado){
                header('location: /admin.php');
            }
        }
    }
?>

<h1>Panel de administración</h1>

<a href="/index.php">crear registro</a>

<table class="lenceria">
    <thead>
        <tr>
            <th>ID</th>
            <th>lenceria</th>
            <th>cantidad</th>
            <th>descripcion</th>
            <th>Acciones</th>
        </tr>

        <tbody>
            <?php while( $referencias = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $referencias['id'];?></td>
                <td><?php echo $referencias['lenceria'];?></td>
                <td><?php echo $referencias['cantidad'];?></td>
                <td><?php echo $referencias['descripcion'];?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $referencias['id'];?>">
                        <input type="submit" value="Eliminar">
                    </form>
                    <a href="actualizar.php?id=<?php echo $referencias['id'];?>">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </thead>
</table>