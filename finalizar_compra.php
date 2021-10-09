<?php
    include 'menu.php';
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
        if (!empty($_GET['comprar'])) {
            $usuario=$_SESSION['nombre'];
            $totalProductos=0;
            $totalFactura=0;
            $sql = "INSERT INTO factura (estado,usuario) VALUES ('ac','$usuario')";
            $conexion->query($sql);
            $idFactura = mysqli_insert_id($conexion);

            $sql = "SELECT * FROM carrito INNER JOIN productos WHERE productos.id = carrito.id_producto and carrito.id_user='$documento'";
            $result = $conexion->query($sql);

            while($row = $result->fetch_assoc()) {
                $totalProductos += $row['cantidad_carrito'];
                $idProducto = $row['id_producto'];
                $cantidad = $row['cantidad_carrito'];
                $total = $row['precio_unidad']*$totalProductos;
                if ($totalProductos>0) {
                    $sql = "INSERT INTO ventas (id_producto_ventas,id_factura,cantidad_ventas,total,estado_venta) VALUES ('$idProducto','$idFactura','$cantidad','$total','vendido')";
                    $conexion->query($sql);

                    $sql = "DELETE FROM carrito";
                    $conexion->query($sql);
                }
                
            }
            if ($totalProductos>0) {
                $sql = "UPDATE factura SET numero_productos = '$totalProductos', total = '$total' WHERE id = '$idFactura'";

                $conexion->query($sql);
                echo "
                <script>
                    Swal.fire(
                        'Compra exitosa',
                        'En unos instantes volvera al inicio',
                        'success'
                    )
                </script>
                <meta http-equiv='refresh' content='2;url=inicio.php'>";
            }else{
                echo "
                <script>
                    Swal.fire(
                        'Por favor agregue productos al carrito',
                        'En unos instantes volvera al inicio',
                        'info'
                    )
                </script>
                <meta http-equiv='refresh' content='2;url=inicio.php'>";
            }
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