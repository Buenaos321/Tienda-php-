<?php 
    include "menu.php";
        if (!empty( $_POST['documento'])) {
        $docuento = $_POST['documento'];
        $estado1= $_POST['opcion1'];
        $estado2= $_POST['opcion2'];
        $estado3= $_POST['opcion3'];
        $estado4= $_POST['opcion4'];
        $estado5= $_POST['opcion5'];
        $estado6= $_POST['opcion6'];
        mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='$estado1' WHERE permiso='3' AND usu=$docuento");
        mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='$estado2' WHERE permiso='4' AND usu=$docuento");
        mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='$estado3' WHERE permiso='5' AND usu=$docuento");
        mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='$estado4' WHERE permiso='6' AND usu=$docuento");
        mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='$estado5' WHERE permiso='7' AND usu=$docuento");
        mysqli_query($conexion,"UPDATE  permisos SET usu=$docuento ,estado='$estado6' WHERE permiso='8' AND usu=$docuento");
        echo "
        <script>
            Swal.fire(
                'Cambio exitoso',
                'En unos instantes volvera al inicio',
                'success'
            )
        </script>
        <meta http-equiv='refresh' content='2;url=inicio.php'>";
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
    include 'footer.php';
?>