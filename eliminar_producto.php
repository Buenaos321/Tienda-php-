<?php
    include "menu.php";
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
        if (!empty( $_GET['id_producto_eliminar'])) {
            $id_producto=$_GET['id_producto_eliminar']; 

            mysqli_query($conexion,"UPDATE productos SET estado ='Inactivo' WHERE id_producto=$id_producto");
            echo "
            <script>
                Swal.fire(
                    'Producto eliminado con exito',
                    'En unos instantes volvera al inicio',
                    'success'
                )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>";
        }else{
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
    include 'footer.php'
?>
