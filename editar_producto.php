<?php
    include "menu.php";
    $id_producto=0;
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
        if (!empty( $_GET['id_producto_editar'])) {
            $id_producto=$_GET['id_producto_editar']; 
            $opciones=mysqli_query($conexion,"SELECT * FROM productos WHERE id_producto=$id_producto");
            while ($row=mysqli_fetch_array($opciones)) {
?>

    <div class="container rounded shadow-lg p-3 my-5" style="background:#060606ad; color:white;">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <h4>Editar Producto</h4>
            </li>
        </ul>
        <hr color="white">
        <form action="editar_producto.php" method="POST">
            <div class="row">
                <div class="col my-1">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre_producto"
                        value="<?php echo $row['nombre_producto']?>" autocomplete="off">
                </div>
                <div class="col my-1">
                    <label>Url imagen</label>
                    <input type="text" class="form-control" name="url_imagen" value="<?php echo $row['url_imagen']?>" autocomplete="off">
                </div>
            </div>
            <input type="hidden" calss="form-control" name="id_producto" value="<?php echo $row['id_producto']?>" autocomplete="off">

            <div class="row">
                <div class="col my-1"><label>Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" value="<?php echo $row['descripcion']?>" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col my-1">
                    <label>Precio por unidad</label>
                    <input type="text" class="form-control" name="precio_unidad" value="<?php echo $row['precio_unidad']?>" autocomplete="off">
                </div>
                <div class="col my-1">
                    <label>Cantidad</label>
                    <input type="text" class="form-control" name="cantidad" value="<?php echo $row['cantidad']?>" autocomplete="off">
                </div>
            </div>

            <div class="row">
                <div class="col my-1">
                    <label>Tipo</label>
                    <select class="form-control" name="id_tipo">
                        <?php 
                            $opciones=mysqli_query($conexion,"SELECT * FROM tipo_producto");
                            while ($row=mysqli_fetch_array($opciones)) {
                        ?>
                        <option value="<?php echo $row['id_tipo'];?>"><?php echo $row['nombre_tipo'];?></option>

                        <?php } ?>
                    </select>
                </div>
                <div class="col my-1 py-2">
                    <br>
                    <button type="submit" class="btn btn-success " data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </form>
    </div>



<?php 
        }
        }elseif(empty($_POST['id_producto'])){
            "<script>
            Swal.fire(
                'Editar producto',
                'No se han recibido datos',
                'warring',
            )
            </script>
            <meta http-equiv='refresh' content='2;url=inicio.php'>"; 
        }
        if (!empty($_POST['id_producto'])) {
            $id_producto=$_POST['id_producto']; 
            $url_imagen=$_POST['url_imagen']; 
            $nombre_producto=$_POST['nombre_producto'];
            $id_tipo=$_POST['id_tipo'];
            $descripcion=$_POST['descripcion']; 
            $precio_unidad=$_POST['precio_unidad'];
            $cantidad=$_POST['cantidad'];
            
            mysqli_query($conexion,"UPDATE productos SET url_imagen ='$url_imagen', nombre_producto='$nombre_producto', id_tipo='$id_tipo', descripcion='$descripcion', precio_unidad='$precio_unidad', cantidad='$cantidad' WHERE productos.id_producto ='$id_producto';");
            
            echo "<script>
            Swal.fire(
                'Editar producto',
                'Cambios guardados con exito',
                'success',
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
?>
</body>

</html>