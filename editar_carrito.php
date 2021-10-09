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
        if(!empty($_POST['cantidad'])){
            $cantidad = $_POST['cantidad'];
            $id_producto = $_POST['id_producto'];
            $TotalPrecio = 0;
            $cantidad_carrito=0;
            $cantidad_producto=0;
            $cantidad_producto2=0;
            $cantidad_total=0;
            $consulta=mysqli_query($conexion,"SELECT * FROM productos WHERE id='$id_producto'");
            while ($venta=mysqli_fetch_array($consulta)) {
                $cantidad_producto2=$venta['cantidad'];
            }
            if ($cantidad<=$cantidad_producto2 && $cantidad>0) {
                $sql =mysqli_query($conexion,"SELECT * FROM productos WHERE id = '$id_producto'");
                while($row=mysqli_fetch_array($sql)) {
                    $cantidad_producto=$row['cantidad'];
                }
                $total=$TotalPrecio* $cantidad;
                $consulta=mysqli_query($conexion,"SELECT * FROM carrito WHERE id_producto = '$id_producto' AND id_user='$documento'");
                while($row=mysqli_fetch_array($consulta)) {
                    $cantidad_carrito=$row['cantidad_carrito'];
                    
                }
                $cantidad_total=($cantidad_carrito-$cantidad)+$cantidad_producto;
                mysqli_query($conexion,"UPDATE carrito SET cantidad_carrito='$cantidad' WHERE id_producto='$id_producto' "); 
                mysqli_query($conexion,"UPDATE productos SET cantidad='$cantidad_total' WHERE id='$id_producto' ");
                echo "'cambios exitosos'";
            } else {
                echo "
                        <script>
                            Swal.fire(
                                'Cantidad mayor a la disponible(El numero insertado debe ser mayor que cero)',
                                'En unos instantes volvera al inicio',
                                'warring'
                            )
                        </script>
                        <meta http-equiv='refresh' content='2;url=inicio.php'>"; 
            }
            
        }else {
            echo "
                <script>
                    Swal.fire(
                        'Datos vacios',
                        'En unos instantes volvera al inicio',
                        'info'
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