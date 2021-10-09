<?php
    include "menu.php"; 
    $correo = $_SESSION['cod_user'];
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$correo'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='4' && $row['estado'] == 'n'){
            echo "<script>
            alert('Acceso denegado');
                window.location='inicio.php';
            </script>";
        }
    }
?>
    <div class="container  rounded shadow-lg p-3 my-5" style="background:#060606ad; color:white;">
        <h4 class="text-center">Buscar Usuarios</h4>
        <hr color="white">
        <form action="" width="80%" method="POST">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="Submit" class="btn btn-primary">Buscar</button>
                </div>
                <input class="form-control" type="text " name="buscar">
            </div>
        </form>

        <table class="table table-hover table-dark table-bordered my-4">
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Fecha de registro</th>
                    <th>Tipo de usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $documento=$_SESSION['cod_user'];
                if(!empty($_POST['buscar'])){
                    $buscar=$_POST['buscar'];
                    $consulta=mysqli_query($conexion,"SELECT * FROM username WHERE documento='$buscar' OR usu LIKE '$buscar%' ORDER BY usu");
                }else{
                    $consulta=mysqli_query($conexion,"SELECT * FROM username WHERE documento!=$documento");
                }

                while ($row=mysqli_fetch_array($consulta)) {
                    # code...
                    
                ?>
                    <tr>
                    
                        <td><?php echo $row['documento'] ?></td>
                        <td><?php echo $row['usuario'] ?></td>
                        <td><?php echo $row['correo'] ?></td>
                        <td><?php echo $row['fecha'] ?></td>
                        <td><?php echo $row['tipo'] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">

                                <button class="btn btn-success"
                                    onclick="edituser('<?php echo $row['documento'];?>','<?php echo $row['tipo'];?>');">Editar</button>
                                <a class="btn btn-info"
                                    href="permisos.php?documento=<?php echo $row['documento'] ?>&nombre=<?php echo $row['usuario'] ?>">Permisos</a>
                                <button class="btn btn-danger"
                                    onclick="eliuser('<?php echo $row['documento'];?>');">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    
                <?php } ?>
            </tbody>
        </table>
    </div>








    <div class="modal fade text-white" id="editar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="editar_usuario.php">
                    <div class="modal-header">
                        <label class="form">TIPO_USUARIO</label>
                        <br>
                        <input type="hidden" class="form-control " id="documento_edi" name="docuento">
                        <br>
                        <select name="tipo" class="form-control" id="tipo">
                            <option value="a">admin</option>
                            <option value="c">cajero</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade text-white" id="eliminar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="eliminar_usuario.php">
                    <div class="modal-header">
                        <h5>En realidad desea elimnar este usuario?</h5>
                        <input type="hidden" class="form-control " id="documento_eli" name="documento">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">
    function edituser(documento) {
        $('#editar_usuario').modal(open);
        $('#documento_edi').val(documento);
    }

    function eliuser(documento) {
        $('#eliminar_usuario').modal(open);
        $('#documento_eli').val(documento);
    }
</script>
<?php   
    include 'footer.php';
?>