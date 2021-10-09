<?php
    include 'menu.php';
    if(!empty($_POST['documento'])){
        $documento=$_POST['documento'];
        $nombre =$_POST['nombre'];
        $correo=$_POST["correo"];
        $password=$_POST['password'];
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $consulta=mysqli_query($conexion,"SELECT * FROM username WHERE documento=$documento");
        while ($row=mysqli_fetch_array($consulta)) {
            $contrasena=$row['contrasena'];
            $documento_usuario=$row['documento'];
        }
        if ($password1!="" && $password1!="" && $password==$contrasena) {
            $password_nuevo=$password1;
            mysqli_query($conexion,"UPDATE username SET  usuario='$nombre',contrasena='$password_nuevo',correo='$correo' WHERE documento='$documento'"); 
            echo "
            <script>
                Swal.fire(
                    'Cambio de contraseña exitoso',
                    'En unos instantes volvera al inicio',
                    'success'
                )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>";
        }else{
            if ($contrasena==$password) {
                mysqli_query($conexion,"UPDATE username SET  usuario='$nombre', correo='$correo' WHERE documento='$documento'");
                echo "
                <script>
                    Swal.fire(
                        'Actualizacion de datos Exitosa',
                        'En unos instantes volvera al inicio',
                        'success'
                    )
                </script>
                <meta http-equiv='refresh' content='2;url=inicio.php'>";
            }else{
                echo "
            <script>
                Swal.fire(
                    'Las contraseñas no coinciden',
                    'En unos instantes volvera al inicio',
                    'warning'
                )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>";;
            }      
        }
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
    include 'footer.php';
?>