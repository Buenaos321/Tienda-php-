<?php 
    include "menu.php"; 
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='6' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
?>
<div class="container  rounded shadow-lg p-3 my-5" style="background:#060606ad; color:white;">
    <ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <h4>Facturas</h4>
        </li>
    </ul>
    <hr color="white">
    <div class=" container">
        <table class="table table-hover table-dark table-bordered my-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cantidad productos</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $usuario=$_SESSION['nombre'];
                    $numFacturas = 0;
                    $sql = "SELECT * FROM factura WHERE usuario='$usuario'";
                    $result = $conexion->query($sql);
                    while($row = $result->fetch_assoc()) {
                        $numFacturas += 1;
                ?>
                <tr>
                    <th scope="row"><?php echo $row['id'] ?></th>
                    <td><?php echo $row['numero_productos'] ?></td>
                    <td>$<?php echo $row['total'] ?></td>
                    <td><a href="ver_compras.php?id=<?php echo $row['id'] ?>" class="btn btn-success"><i
                                class="far fa-eye"></i> ver</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
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