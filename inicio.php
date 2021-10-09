<?php
    include_once "menu.php";
    ?>
<div class="container my-5 rounded px-3 py-1" style="background:#060606ad; color:white;">
    <h2 class="text-center">Buscar articulos</h2>

    <form action="" width="80%" method="POST">
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="Submit" class="btn btn-primary">Buscar</button>
            </div>
            <input class="form-control" type="text" name="buscar">
        </div>
    </form>
    <div class="row">
        <?php
        if ($_SESSION['tipo_user']=='a') {
            if (!empty($_POST['buscar'])) {
                $buscar=$_POST['buscar'];
                $productos=mysqli_query($conexion,"SELECT * FROM productos WHERE productos.id_tipo='$buscar' OR productos.nombre_producto LIKE '%$buscar%'");
            }else{
                $productos=mysqli_query($conexion,"SELECT * FROM productos ");
            }
            while ($row=mysqli_fetch_array($productos)) {
            ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="card alert-dark border caja my-3" style="background:#060606ad; color:white; ">
                    <img src="<?php echo $row['url_imagen'];?>" class="card-img-top imagen" height="150px">
                    <div class="card-body" height="150px">
                        <h5 class="card-title"><b><?php echo $row['nombre_producto'] ?></b></h5>
                        <p class="card-text"><b><?php echo $row['descripcion']; ?></b></p>
                        <p class="card-text"><small
                                class="text-muted"><b>Precio:$<?php echo $row['precio_unidad']; ?></b></small></p>
                        <p class="card-text"><small class="text-muted"><b>Cantidad:<?php echo $row['cantidad']; ?></b>
                                unidades</small></p>
                    </div>
                    <?php if ($_SESSION['tipo_user']=='a') { ?>
                        <div class="btn-group" role="group" >
                            <a class="btn btn-success "
                                href="editar_producto.php?id_producto_editar=<?php echo $row['id_producto']; ?>">Editar</a>
                            <a class="btn btn-danger "
                                href="eliminar_producto.php?id_producto_eliminar=<?php echo $row['id_producto']; ?>">Eliminar</a>
                        </div>
                    <?php } ?>
                    <button class="btn btn-primary" onclick="comprarArt('<?php echo $row['id']; ?>');">Agregar
                        al carrito</button>
                    <!--agregar al carrito-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Cantidad de articulos a comprar</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="carrito.php">
                                        <div class="modal-header">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Cantidad</label>
                                                <input type="number" class="form-control" placeholder="Cantidad"
                                                    name="cantidad" autocomplete="off">
                                            </div>
                                            <input type="number" class="form-control d-sm-none" id="idProducto"
                                                name="idProducto" autocomplete="off">
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group" role="group" >
                                                <button type="button" class="btn btn btn-info" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Enviar al Carrito</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            } else {
                if (!empty($_POST['buscar'])) {
                    $buscar=$_POST['buscar'];
                    $productos=mysqli_query($conexion,"SELECT * FROM productos  WHERE estado='Activo' productos.id_tipo='$buscar' OR productos.nombre_producto LIKE '%$buscar%'");
                }else{
                    $productos=mysqli_query($conexion,"SELECT * FROM productos  WHERE estado='Activo' ");
                }
                while ($row=mysqli_fetch_array($productos)) {
                ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                    <div class="card alert-dark border caja my-3" style="background:#060606ad; color:white; ">
                        <img src="<?php echo $row['url_imagen'];?>" class="card-img-top imagen" height="150px">
                        <div class="card-body" height="150px">
                            <h5 class="card-title"><b><?php echo $row['nombre_producto'] ?></b></h5>
                            <p class="card-text"><b><?php echo $row['descripcion']; ?></b></p>
                            <p class="card-text"><small
                                    class="text-muted"><b>Precio:$<?php echo $row['precio_unidad']; ?></b></small></p>
                            <p class="card-text"><small class="text-muted"><b>Cantidad:<?php echo $row['cantidad']; ?></b>
                                    unidades</small></p>
                        </div>
                        <?php if ($_SESSION['tipo_user']=='a') { ?>
                            <div class="btn-group" role="group" >
                                <a class="btn btn-success "
                                    href="editar_producto.php?id_producto_editar=<?php echo $row['id_producto']; ?>">Editar</a>
                                <a class="btn btn-danger "
                                    href="eliminar_producto.php?id_producto_eliminar=<?php echo $row['id_producto']; ?>">Eliminar</a>
                            </div>
                        <?php } ?>
                        <button class="btn btn-primary" onclick="comprarArt('<?php echo $row['id']; ?>');">Agregar
                            al carrito</button>
                        <!--agregar al carrito-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4>Cantidad de articulos a comprar</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="carrito.php">
                                            <div class="modal-header">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Cantidad</label>
                                                    <input type="number" class="form-control" placeholder="Cantidad"
                                                        name="cantidad" autocomplete="off">
                                                </div>
                                                <input type="number" class="form-control d-sm-none" id="idProducto"
                                                    name="idProducto" autocomplete="off">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group" role="group" >
                                                    <button type="button" class="btn btn btn-info" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Enviar al Carrito</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
                }?>

    </div>
</div>





<script type="text/javascript">
    function comprarArt(id) {
        $('#exampleModal').modal(open);
        $('#idProducto').val(id);
    }
</script>
<?php 

    include 'footer.php';
?>