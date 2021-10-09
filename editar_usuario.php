<?php 
    include 'menu.php';
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='8' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
        if (!empty( $_POST['docuento'])) {
            $docuento = $_POST['docuento'];
            $tipo = $_POST['tipo'];
            if($tipo=='c'){
                mysqli_query($conexion,"UPDATE username SET tipo='$tipo' WHERE documento='$docuento' ");
                mysqli_query($conexion,"UPDATE permisos SET permiso=2 WHERE usu=$docuento AND permiso=1");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='n' WHERE permiso=3 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='n' WHERE permiso=4 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=5 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=6 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='n' WHERE permiso=7 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='n' WHERE permiso=8 AND usu=$docuento");
                echo "
                <script>
                    Swal.fire(
                        'Cambio de admin a cajero exitoso',
                        'En unos instantes volvera al inicio',
                        'success'
                    )
                </script>
                <meta http-equiv='refresh' content='2;url=inicio.php'>";;
            }else if($tipo=='a'){
                mysqli_query($conexion,"UPDATE username SET tipo='$tipo' WHERE documento='$docuento' ");
                mysqli_query($conexion,"UPDATE permisos SET permiso=1 WHERE usu=$docuento AND permiso=2");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=3 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=4 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=5 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=6 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=7 AND usu=$docuento");
                mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='s' WHERE permiso=8 AND usu=$docuento");
                echo "
                <script>
                    Swal.fire(
                        'Cambio de cajero a admin exitoso',
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
                    'No se ha recibido ningun datos',
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