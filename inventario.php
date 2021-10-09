<?php 
    include "menu.php"; 
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='7' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
?>
<div class="container  rounded shadow-lg p-3 my-5" style="background:#060606ad; color:white;">
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <h4>Inventario</h4>
        </li>
        <div class="my-2 my-lg-0">
            <button type="button" class="btn btn-success" onclick="javascript:window.print()">Imprimir</button>
        </div>
    </ul>
    <hr color="white">
    <form action="" width="80%" method="POST">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="Submit" class="btn btn-primary">Buscar</button>
            </div>
            <input class="form-control" type="text" name="buscar">
        </div>
    </form>
    <table class="table table-hover table-dark table-bordered my-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre producto</th>
                <th scope="col">Precio unidad</th>
                <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <tr><?php
            if (!empty($_POST['buscar'])) {
                $buscar=$_POST['buscar'];
                $productos=mysqli_query($conexion,"SELECT * FROM  productos WHERE id_producto='$buscar' OR nombre_producto LIKE '%$buscar%'");
            }else{
                $productos=mysqli_query($conexion,"SELECT * FROM  productos");
            }
            while ($row=mysqli_fetch_array($productos)) {

        ?>
                <th scope="row"><?php echo $row['id_producto'] ?></th>
                <td><?php echo $row['nombre_producto'] ?></td>
                <td>$<?php echo $row['precio_unidad'] ?> </td>
                <td><?php echo $row['cantidad'] ?> Unidades</td>
            </tr>
            <tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<?php
    } elseif($acceso==1) {
        echo "<script>
            Swal.fire(
                'Acceso denegado',
                'En unos instantes volvera al inicio',
                'error',
            )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>";
    }
    include 'footer.php';
?>