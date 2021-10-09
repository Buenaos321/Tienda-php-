<?php
include "menu.php"; 
$documento = $_SESSION['cod_user'];
$acceso=0;
$consultar=mysqli_query($conexion,"SELECT * FROM permisos
where permisos.usu = '$documento'");
while ($row=mysqli_fetch_array($consultar)) {
    if($row['permiso'] =='4' && $row['estado'] == 'n'){
        $acceso=1;
    }
}
if ($acceso==0) {
?>
<div class="container  rounded shadow-lg p-3 my-5" style="background:#060606ad; color:white;">
<ul class="nav nav-pills nav-justified">
        <li class="nav-item">
            <h4>Compras</h4>
        </li>
        <div class="my-2 my-lg-0">
            <button type="button" class="btn btn-success" onclick="javascript:window.print()">Imprimir</button>
        </div>
    </ul>
    <hr color="white">
        <table class="table table-hover table-dark table-bordered my-4">
            <thead>
                <tr>
                    <th scope="col">Id producto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $id = $_GET['id'];

                        $sql = 
                            "SELECT * FROM ventas
                            INNER JOIN productos
                            ON ventas.id_producto_ventas = productos.id_producto AND ventas.id_factura = '$id'";
                        $result = $conexion->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                <tr>

                    <td><?php echo $row['id_producto_ventas'] ?></td>
                    <td><?php echo $row['nombre_producto'] ?></td>
                    <td>$<?php echo $row['precio_unidad'] ?></td>
                    <td><?php echo $row['cantidad_ventas'] ?></td>
                    <td>$<?php echo $row['total'] ?></td>
                </tr>
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
    include "footer.php"; 
?>