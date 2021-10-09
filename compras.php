<?php 
    include "menu.php"; 
    $documento = $_SESSION['cod_user'];
    $acceso=0;
    $consultar=mysqli_query($conexion,"SELECT * FROM permisos
    where permisos.usu = '$documento'");
    while ($row=mysqli_fetch_array($consultar)) {
        if($row['permiso'] =='4' && $row['estado'] == 'n'){
            $acceso=1;
        }
    }
    if ($acceso==0) {
?>
<div class="container  p-3 my-5">
    <div class="row">
        <?php 
            $documento=$_SESSION['cod_user'];
            $consulta=mysqli_query($conexion,"SELECT * FROM carrito INNER JOIN productos WHERE productos.id = carrito.id_producto and carrito.id_user='$documento'");
            $totalProductos=0;
            $totalFactura=0;
            while ($row=mysqli_fetch_array($consulta)) {
                $totalProductos += $row['cantidad_carrito'];
                $totalFactura = $row['precio_unidad']*$totalProductos;
		?>

            <div class="col-4">
                <div class="card  border shadow-lg" style="background:#060606ad; color:white;">
                    <img src="<?php echo $row['url_imagen'];?>" class="card-img-top imagen" height="200px">
                    <div class="card-body ">
                        <h5 class="card-title"><b><?php echo $row['nombre_producto'] ?></b></h5>
                        <p class="card-text"><b><?php echo $row['descripcion']; ?></b></p>
                        <p class="card-text">valor:<small><b>$<?php echo $row['precio_unidad']; ?></b></small></p>
                        <p class="card-text">cantidad: <small><b>#<?php echo $row['cantidad_carrito']; ?></b></small></p>
                    </div>
                    <div class="form-group p-4 ">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-warning  btn-block"
                                    onclick="editArt('<?php echo $row['cantidad_carrito'];?>','<?php echo $row['id'] ?>');"><i
                                        class="fas fa-edit"></i> editar</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger   btn-block"
                                    onclick="eliArt('<?php echo $row['id']; ?>');"><i class="fas fa-trash-alt"></i>
                                    Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <!--modales-->
            <div class="modal fade" id="cantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="editar_carrito.php">
                            <div class="modal-header text-white">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidadProducto" name="cantidad"
                                        value="0" autocomplete="off">
                                </div>
                                <input type="hidden" class="form-control " id="id_producto" name="id_producto" autocomplete="off">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Actualizar carrito</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade text-white" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="eliminar_carrito.php">
                            <div class="modal-header">
                                <h5>¿Esta seguro de retirar este articulo de la lista de compras ?</h5>
                                <input type="hidden" class="form-control " id="id_eli" name="id_eli">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } 
            echo'<div class="card w-50 m-auto mb-5" style="background:#060606ad; color:white;">
                <div class="card-header">
                    <h4>Factura</h4>
                </div>
                <div class="card-body">
                    <h5>Total productos: '.$totalProductos.'</h5>
                    <h5>Total: $'.$totalFactura.'</h5><br>
                    <a href="finalizar_compra.php?comprar=si" class="btn btn-success float-right"><i class="fas fa-folder-plus"></i> Terminar compra</a>
                </div>
            </div>'
            
        ?>
    </div>
</div>


<script type="text/javascript">
    function editArt(cantidad, id_producto) {
        $('#cantidad').modal(open);
        $('#cantidadProducto').val(cantidad);
        $('#id_producto').val(id_producto);

    }

    function eliArt(id_eli) {
        $('#eliminar').modal(open);
        $('#id_eli').val(id_eli);
    }
</script>
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