<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="img/IconoPestana.png" />
	<link rel="stylesheet" href="css/bootstrap4.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/sweetalert2.min.js"></script>
	<!--inicia el menu para la pagina-->

	<script src="js/poper.min.js">
	</script>
	<link rel="stylesheet" href="css/style.css">
	<title>Fenix</title>
</head>

<body>

	<?php

	include 'conexion.php';
	session_start();
	$documento=$_SESSION['cod_user'];
	if ($_SESSION['cod_user']!="") {
	$consulta=mysqli_query($conexion,"SELECT * FROM permisos, username  WHERE documento=$documento and usu=$documento");
	if ($_SESSION['tipo_user']=='a' || $_SESSION['tipo_user']=='c') {
		
?>


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="inicio.php">
			<img src="img/MenuFenix.png">
		</a>
		<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
			<div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
				<ul class="navbar-nav mr-auto">
					<?php while ($row=mysqli_fetch_array($consulta)) { ?>
						<?php if($row['permiso'] =='2' || $row['permiso'] =='1'  && $row['estado'] == 's'){?>
							<li class="nav-item">
								<a class="nav-link " href="inicio.php">Productos</a>
							</li>
						<?php } ?>
						<?php if($row['permiso'] =='3' && $row['estado'] == 's'){?>
							<li class="nav-item">
							<a class="nav-link boton_modal" data-toggle="modal"
								data-target="#agregar_producto">
								Agregar_producto
							</a>
							</li>
						<?php } ?>
						<?php if($row['permiso'] =='4' && $row['estado'] == 's'){?>
							<li class="nav-item">
								<a class="nav-link " href="compras.php">Carrito</a>
							</li>
						<?php }?>
						<?php if($row['permiso'] =='5' && $row['estado'] == 's'){?>
							<li class="nav-item">
								<a class="nav-link " href="reporte.php">Reporte ventas</a>
							</li>
						<?php }?>
						<?php if($row['permiso'] =='6' && $row['estado'] == 's'){?>
							<li class="nav-item">
								<a class="nav-link " href="factura.php">Mis Facturas</a>
							</li>
						<?php }?>
						
						<?php if($row['permiso'] =='7' && $row['estado'] == 's'){?>
							<li class="nav-item">
								<a class="nav-link " href="inventario.php">Inventario</a>
							</li>
						<?php }?>
						<?php if($row['permiso'] =='8' && $row['estado'] == 's'){?>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Usuarios
								</a>
								<div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
									<a class="dropdown-item bg-dark text-white" href="usuarios.php">usuarios</a>
									<a class="dropdown-item boton_modal bg-dark text-white" data-toggle="modal"
										data-target="#agregar_user">Agregar_usuario</a>
								</div>
							</li>
						<?php }?>
					<?php } ?>
				</ul>
				
				<div class="form-inline my-2 my-lg-0">
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" class="btn btn-outline-success text-white" data-toggle="modal"
							data-target="#editar_mi">
							Editar Usuario:<?php echo $_SESSION['nombre'] ?> </button>
						<a class="btn btn-info" href="salir.php">Cerrar sesion</a>
					</div>
				</div>
			</div>
		
	</nav>
	



	<!-- Agregar usuario -->
	<div class="modal text-white" id="agregar_user" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registrar usuarios </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="agregar_usuario.php" method="POST">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="recipient-docu" class="col-form-label">Documento:</label>
									<input type="number" class="form-control" name="documento" id="recipient-docu"
										required="" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="nombre" class="col-form-label">Nombre:</label>
									<input type="text" class="form-control" name="nombre" id="nombre" required=""
										autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="correo" class="col-form-label">Correo</label>
									<input type="text" class="form-control" name="correo" id="correo"
										autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="password" class="col-form-label">Tipo_usuario</label>
									<select name="tipo_usuario" class="form-control">
										<option value="a">Administrador</option>
										<option value="c">Cajero</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="password" class="col-form-label">Contraseña</label>
									<input type="text" class="form-control" name="password" id="password" required=""
										autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label for="password2" class="col-form-label">Confirma Contraseña</label>
									<input type="text" class="form-control" name="password2" id="password2" required=""
										autocomplete="off">
								</div>
							</div>
							
						</div>


						<div class="modal-footer text-center">
							<div class="btn-group" role="group" aria-label="Basic example" lass="mx-auto"
								style="width: 400px;">
								<button type="button" class="btn btn-info" data-dismiss="modal">cancelar</button>
								<button type="submit" class="btn btn-success">Registrarse</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>




	<!-- Agregar producto -->
	<div class="modal text-white" id="agregar_producto" tabindex="-1" role="dialog"
		aria-labelledby="agregar_productoLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="agregar_productoLabel">Agregar Producto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="agregar_producto.php" method="POST">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Id producto</label>
									<input type="number" class="form-control" name="id_producto" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Url imagen</label>
									<input type="text" class="form-control" name="url_imagen" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Nombre</label>
									<input type="text" class="form-control" name="nombre_producto" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Precio por unidad</label>
									<input type="number" class="form-control" name="precio_unidad" autocomplete="off">
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>Descripcion</label>
									<input type="text" class="form-control" name="descripcion" autocomplete="off">
								</div>
							</div>
							
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
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
							</div>
							
							
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Cantidad</label>
									<input type="number" class="form-control" name="cantidad" autocomplete="off">
								</div>
							</div>
						</div>
						
						<div class="modal-footer">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php 
	if ($_SESSION['tipo_user']=='') {
		header ('location: index.php');
	}
	$usuario=$_SESSION['cod_user'];
	$consulta_usuario=mysqli_query($conexion,"SELECT * FROM username WHERE documento='$usuario'");
	while ($row=mysqli_fetch_array($consulta_usuario)) {
	?>
	<!-- Editar usuario -->
	<div class="modal text-white" id="editar_mi" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Mi perfil</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="actualizar.php" method="POST">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="recipient-documento" class="col-form-label">Documento:</label>
								<input readonly="readonly" type="number" class="form-control" name="documento"
									id="recipient-documento" value="<?php echo $row['documento'];?>" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="nombre" class="col-form-label">Nombre:</label>
								<input required="" type="text" class="form-control" name="nombre"
									value="<?php echo $row['usuario'];?>" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="correo" class="col-form-label">email:</label>
								<input required="" type="email" class="form-control" name="correo"
									value="<?php echo $row['correo'];?>" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="password" class="col-form-label">contraseña actual</label>
								<input required="" type="password" class="form-control" name="password" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="form-group">
								<label for="password" class="col-form-label">contraseña nueva</label>
								<input type="password" class="form-control" name="password1" autocomplete="off">
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group">
							<label for="password" class="col-form-label">confirmar contraseña</label>
							<input type="password" class="form-control" name="password2" autocomplete="off">
						</div>
						</div>
					</div>	
						<div class="modal-footer">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-info" data-dismiss="modal">cancelar</button>
								<button type="submit" class="btn btn-success">Actualizar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php }
}
}else{
	header("location:index.php");
}?>