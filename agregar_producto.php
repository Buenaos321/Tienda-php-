<?php 
    include 'menu.php';
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='3' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
        if (!empty( $_POST['id_producto'])) {
            $id=$_POST['id_producto'];
            $url_imagen=$_POST['url_imagen']; 
            $nombre_producto=$_POST['nombre_producto'];
            $id_tipo=$_POST['id_tipo'];
            $descripcion=$_POST['descripcion']; 
            $precio_unidad=$_POST['precio_unidad'];
            $cantidad=$_POST['cantidad'];
            $resultado=0; 
            $canfirmacion=0;
            $cantidad_consulta=0;
            $cantidad_final=0;
            if ($cantidad>0) {
                $consulta=mysqli_query($conexion,"SELECT * FROM productos  WHERE id_producto='$id'");
                while ($row=mysqli_fetch_array($consulta)) {
                    $canfirmacion=$row['id_producto'];
                    $cantidad_consulta=$row['cantidad'];
                }
                if($canfirmacion==$id){
                    $resultado=1; 
                }
                if($resultado==1){
                    $cantidad_final=$cantidad+$cantidad_consulta;
                    mysqli_query($conexion,"UPDATE productos SET cantidad='$cantidad_final' WHERE id_producto='$id'");
                    echo "
                    <script>
                            Swal.fire(
                                'Se ha actualizado la cantidad del producto',
                                'En unos instantes volvera al inicio',
                                'success'
                            )
                    </script>
                    <meta http-equiv='refresh' content='2;url=inicio.php'>";
                }else {
                    mysqli_query($conexion,"INSERT INTO productos 
                    (id_producto, url_imagen, nombre_producto, id_tipo, descripcion, precio_unidad, cantidad, estado)
                    VALUES ($id, '$url_imagen', '$nombre_producto', '$id_tipo', '$descripcion', '$precio_unidad', '$cantidad', 'Activo') ");
                    echo "
                    <script>
                        Swal.fire(
                            'Producto agregado con exito',
                            'En unos instantes volvera al inicio',
                            'success'
                        )
                    </script>
                    <meta http-equiv='refresh' content='2;url=inicio.php'>";
                }
            }else {
                echo "
                <script>
                    Swal.fire(
                        'Digite una cantidad Valida',
                        'En unos instantes volvera al inicio',
                        'warning'
                    )
                </script>
                <meta http-equiv='refresh' content='2;url=inicio.php'>";   
            }
        }else{
            echo "
            <script>
                Swal.fire(
                    'Error al agregar el producto',
                    'No se ha recibido ningun dato',
                    'error'
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