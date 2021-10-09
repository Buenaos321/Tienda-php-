<?php 
    include 'menu.php';
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='7' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
    $usuario_permisos = $_GET['documento'];
    $usuario_nombre = $_GET['nombre'];
    if(isset($_GET['activar'])){
        $id = $_GET['activar'];
        $sql = "UPDATE permisos SET estado = 's' WHERE usu = '$usuario_permisos' AND permiso = '$id'";
        $resultPermisos = $conexion->query($sql);
    }

    if(isset($_GET['inactivar'])){
        $id = $_GET['inactivar'];
        $sql = "UPDATE permisos SET estado = 'n' WHERE usu = '$usuario_permisos' AND permiso = '$id'";
        $resultPermisos = $conexion->query($sql);
    }
?>




<div class="container my-5 rounded px-3 py-2" style="background:#060606ad; color:white;">
    <div class="row">
        <div class="col">
            <h4>Editando permisos de: <b class="text-capitalize"><?php echo $usuario_nombre?></b> </h4>
            <hr color="white">
            <table class="table table-hover table-dark table-bordered my-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre permiso</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="post">
                        <?php 
                            $index = 1;
                            $sql = "SELECT * FROM permisos INNER JOIN permisos_tmp ON permisos.permiso = permisos_tmp.id_permisostmp AND permisos.usu = '$usuario_permisos' AND permisos_tmp.id_permisostmp!='1' AND permisos_tmp.id_permisostmp!='2'";
                            $resultPermisos = $conexion->query($sql);
                            while($row = $resultPermisos->fetch_assoc()) {
                                if($row['estado'] == 's'){
                                    echo    '
                                    <tr>
                                        <th scope="row">'.$index.'</th>
                                        <td>'.$row['nombre'].'</td>
                                        <td>
                                            <a class="btn btn-success" href="?documento='.$usuario_permisos.'&nombre='. $usuario_nombre.'&inactivar='.$row['permiso'].'"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGPSURBVEhL3ZXPSsNAEMYLok9npWrVq4q+gvgKVo+KPoB/oBcFPdSLgofubih6CajEHoQkvRfv63zppBvjJtn0ph98kOzu/Cbs7E4a/1u+7y/0R2pdxupKxPJNRPIrMZ5jdYk5rOHl9SRj2ZaR/CC4rnAgYrHKYdXq6u6ciNShBVRqxCCWMcWirz6yAVxMSTqMsSvZFktgLUeyxbifQrGogENrUIkfPh/1ycuZGaO6DfRgnrFGIvQ2soEuBnyrt6sXr1v6+Pl0Oq5Gao2xRjh22eAqA759P4EjCd7NvDxnrBGd7fcsoMzlcCo2sRhrJCM1zi6Csbf54Cp4YmIx1iifAHuahzjBYVuC/BYhGBDANns7+nZ45wYno5Uw1ogGL/ILs1/cvFmeJiuDT2wpMje1X4uzSdzgsGwz1ggXrai5Abr3tO8IV4H1okEi9lYsAbUsQrHEOLtm6aSp6bIeMKZY3K47NkCZAXdq16nQFSkwyIMsDvqh1+SwekLh0bhw7Miv6S8TzxjD3My/zD+iRuMbPr5iSSJy0csAAAAASUVORK5CYII="></a>
                                        </td>
                                    </tr>';
                                }else if ($row['estado'] == 'n'){
                                    echo'
                                    <tr>
                                        <th scope="row">'.$index.'</th>
                                        <td>'.$row['nombre'].'</td>
                                        <td>
                                            <a class="btn btn-danger" href="?documento='.$usuario_permisos.'&nombre='. $usuario_nombre.'&activar='.$row['permiso'].'"><img src="https://img.icons8.com/office/30/000000/shutdown.png"></a>
                                        </td>
                                    </tr>';
                                }

                                $index += 1;
                            }
                        ?>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
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