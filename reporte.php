<?php 
    include 'menu.php';
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='5' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
        # code...
?>
    <div class="container  rounded shadow-lg p-3 my-5" style="background:#060606ad; color:white;">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <h4>Reporte ventas</h4>
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
                <input class="form-control" type="date" name="fecha1">
                <input class="form-control" type="date" name="fecha2">
            </div>
        </form>
        <table class="table table-hover table-dark table-bordered my-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">total</th>
                    <th scope="col">fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr><?php
                if (!empty($_POST['fecha1'])) {
                    $fecha1=$_POST['fecha1'];
                    $fecha2=$_POST['fecha2'];
                    $productos=mysqli_query($conexion,"SELECT * FROM ventas INNER JOIN productos WHERE ventas.fecha BETWEEN '$fecha1' AND '$fecha2'");
                }else{
                    $productos=mysqli_query($conexion,"SELECT * FROM ventas INNER JOIN productos");
                }
                $numFacturas=0;
                while ($row=mysqli_fetch_array($productos)) {
                    $numFacturas+=1;
            ?>
                    <th scope="row"><?php echo $numFacturas ?></th>
                    <td><?php echo $row['nombre_producto'] ?></td>
                    <td><?php echo $row['cantidad_ventas'] ?> Unidades</td>
                    <td>$<?php echo $row['total'] ?></td>
                    <td><?php echo $row['fecha'] ?></td>
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
