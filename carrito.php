<?php 
    include 'menu.php';
    $documento= $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='4' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
        if (!empty( $_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $cantidad = $_POST['cantidad'];
            $precio_producto = 0;
            $resultado=0;
            $canfirmacion=0;
            $cantidad_carrito=0;
            $carrito=mysqli_query($conexion,"SELECT * FROM carrito  WHERE id_producto='$idProducto' AND id_user='$documento'");
            while ($ventacarrito=mysqli_fetch_array($carrito)) {
                $canfirmacion=$ventacarrito['id_producto'];
                $cantidad_carrito=$ventacarrito['cantidad_carrito'];
            }
            if($canfirmacion==$idProducto){
                $resultado=1; 
                echo 'valido';
            }else {
                $resultado=0; 
            }
            $consulta=mysqli_query($conexion,"SELECT * FROM productos WHERE id='$idProducto'");
            while ($venta=mysqli_fetch_array($consulta)) {
                $cantidad_producto=$venta['cantidad'];
                $precio_producto=$venta['precio_unidad'];
                if ($cantidad<=$venta['cantidad'] && $cantidad>0) {   
                    $cantidad_restante=$cantidad_producto-$cantidad;
                    if($resultado==1){
                        $cantidad_total=$cantidad_carrito+$cantidad;
                        mysqli_query($conexion,"UPDATE carrito SET cantidad_carrito='$cantidad_total' WHERE id_producto='$idProducto' AND id_user='$documento'");
                        mysqli_query($conexion,"UPDATE productos SET cantidad='$cantidad_restante' WHERE id='$idProducto'");
                        echo "
                        <script>
                            Swal.fire(
                                'Cantidad añadida al carrito de compras',
                                'En unos instantes volvera al inicio',
                                'success'
                            )
                        </script>
                        <meta http-equiv='refresh' content='2;url=inicio.php'>"; 
                    }else{
                        $sql = mysqli_query($conexion,"INSERT INTO carrito (id_producto,cantidad_carrito, id_user)  VALUES ('$idProducto','$cantidad','$documento')"); 
                        mysqli_query($conexion,"UPDATE productos SET cantidad='$cantidad_restante' WHERE id='$idProducto'");        
                        echo "
                        <script>
                            Swal.fire(
                                'Producto añadido al carrito de compras',
                                'En unos instantes volvera al inicio',
                                'success'
                            )
                        </script>
                        <meta http-equiv='refresh' content='2;url=inicio.php'>";
                    }
                }else{
                    echo "
                    <script>
                        Swal.fire(
                            'Cantidad ingresada no disponible',
                            'En unos instantes volvera al inicio',
                            'warning'
                        )
                    </script>
                    <meta http-equiv='refresh' content='2;url=inicio.php'>";
                }
            } 
        }else {
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
