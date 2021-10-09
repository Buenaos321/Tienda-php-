<?php 
    include_once 'menu.php';
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
        if(isset($_POST['documento'])){
            $documento = $_POST['documento'];
            mysqli_query($conexion,"UPDATE username SET tipo='Inactivo' WHERE documento ='$documento'");
        
            echo "
            <script>
                Swal.fire(
                    'Usuario eliminado con exito',
                    'En unos instantes volvera al inicio',
                    'warning'
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
    include 'footer.php';  
?>