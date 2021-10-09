<?php 
    include 'menu.php';
    $id_producto=0;
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
        if (!empty($_POST['id_eli'])) {
            
            $id = $_POST['id_eli'];
            $consulta=mysqli_query($conexion,"SELECT * FROM carrito INNER JOIN productos WHERE productos.id = carrito.id_producto AND carrito.id_user='$documento'");
            
            while ($row=mysqli_fetch_array($consulta)) {
                $id_producto=$row['id_producto'];
                $cantidad_carrito=$row['cantidad_carrito'];
                $productos=mysqli_query($conexion,"SELECT * FROM  productos WHERE id='$id_producto'");
                while ($row=mysqli_fetch_array($productos)) {
                    $cantidad=$row['cantidad'];
                    $cantidad_total=$cantidad_carrito+$cantidad;
            
                    mysqli_query($conexion,"UPDATE productos SET cantidad='$cantidad_total' WHERE id='$id_producto'");
                    mysqli_query($conexion,"DELETE FROM carrito WHERE id_producto ='$id_producto' AND id_user='$documento'");
                }
                
            }
            echo "
            <script>
                Swal.fire(
                    'Producto eliminado con exito',
                    'En unos instantes volvera al inicio',
                    'success'
                )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>";
        } else {
            echo "
            <script>
                Swal.fire(
                    'No se ha recibido ningun dato',
                    'En unos instantes volvera al inicio',
                    'warning'
                )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>";
        }
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