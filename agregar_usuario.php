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
        if(!empty($_POST['documento'])){
            $documento=$_POST['documento'];
            $nombre =$_POST['nombre'];
            $correo=$_POST["correo"];
            $password=$_POST['password'];
            $password2=$_POST['password2'];
            $tipo=$_POST['tipo_usuario'];
            $verificacion=0;
            $verificacion_correo=0;
            if ($password===$password2) {
                if ($documento>0) {
                    $consulta=mysqli_query($conexion,"SELECT * FROM username WHERE documento='$documento' ");
                    while ($row=mysqli_fetch_array($consulta)) {
                        if ($row['documento']==$documento  ) {
                            $verificacion=1;
                        }
                    }
                    $consulta2=mysqli_query($conexion,"SELECT * FROM username WHERE correo='$correo' ");
                    while ($row=mysqli_fetch_array($consulta2)) {
                        if ($row['correo']==$correo) {
                            $verificacion_correo=1;
                        }  
                    }
                    if ($verificacion!=1 && $verificacion_correo!=1) {
                        if ($tipo=='a') {
                            $permisos=1;
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('$permisos','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('3','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('4','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('5','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('6','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('7','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('8','$documento','s')");
                        }elseif ($tipo=='c') {
                            $permisos=2;
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('$permisos','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('3','$documento','n')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('4','$documento','n')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('5','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('6','$documento','s')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('7','$documento','n')");
                            mysqli_query($conexion,"INSERT INTO permisos(permiso,usu,estado)VALUES('8','$documento','n')");
                        }
                        mysqli_query($conexion,"INSERT INTO username(documento,usu,con,correo,tipo) VALUES ('$documento','$nombre','$password','$correo','$tipo')");
                        echo "
                        <script>
                            Swal.fire(
                                'Usuario agregado con exito',
                                'En unos instantes volvera al inicio',
                                'success'
                            )
                        </script>
                        <meta http-equiv='refresh' content='2;url=inicio.php'>";           
                    }else {
                        echo "
                        <script>
                            Swal.fire(
                                'Usuario o correo duplicado',
                                'En unos instantes volvera al inicio',
                                'info'
                            )
                        </script>
                        <meta http-equiv='refresh' content='2;url=inicio.php'>";;
                    }
                }else {
                    echo "
                    <script>
                        Swal.fire(
                            'Digite un documento valido',
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
                        'Las contraseñas deben coincidir',
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