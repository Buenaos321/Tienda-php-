<?php
	session_start();
	include 'conexion.php';
	if (isset($_SESSION['nombre'])) {
		header("location:inicio.php");
	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>login</title>
	<link rel="shortcut icon" href="img/IconoPestana.png" />
	<link rel="stylesheet" href="css/bootstrap4.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/poper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body id="body">
	<div class="modal fade text-white" id="agregar_user" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" >
					<h5 class="modal-title">Registrar usuarios </h5>
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









	<?php
		if (!empty($_POST['email']) and !empty($_POST['password'])) {
			$documento=$_POST['email'];
			$password=$_POST['password'];

			$consulta=mysqli_query($conexion,"SELECT * FROM username, permisos WHERE username.documento='$documento' AND username.contrasena='$password' AND permisos.usu='$documento'");
			if($row=mysqli_fetch_array($consulta)){
				if ($row['estado']=='s') {
					$_SESSION['nombre']=$row['usuario'];
					$_SESSION['tipo_user']=$row['tipo'];
					$_SESSION['cod_user']=$row['documento'];
					if ($row['tipo']=='a' ) {
						echo "
							<div class='carta' style='width: 22rem;'>
								<img src='img/Bienvenido.png'>
								</br>
								</br>
								<h4>Tipo de cuenta: Administrador</h4>
							</div>
							<meta http-equiv='refresh' content='3;url=inicio.php'>";
					}else if ($row['tipo']=='c') {
						echo "
							<div class='carta' style='width: 22rem;'>
								<img src='img/Bienvenido.png'>
								</br>
								</br>
								<h4>Tipo de cuenta: Cajero</h4>
							</div>
							<meta http-equiv='refresh' content='3;url=inicio.php'>";
					}
				}else{
					echo"<div class='alert alert-success'>No se encuentra habilitado</div>";
					echo '<center><a href="login.php" class="btn"><strong>Intentar de Nuevo</strong></a></center>';
				}
			}else{
				echo"
				<div class='carta' style='width: 22rem;'>
					<h4>Usuario o Contraseña incorrectas</h4>
					<div class='card-footer'>
						<a href='login.php' class='btn'>Intentar de Nuevo</a>
					</div>
				</div>
				";
			}
		}else {
			echo'
		<div class="container">
			<div class="login fade show " style="display: block; padding-left: 17px;">
				<div class="modal-dialog modal-dialog-centered ">
					<div class="modal-content center">
						<div class="user-img align-self-center">
							<img src="img/face.png">
						</div>
						
						<div class="form-input mx-4" >
							<hr color="white">
							<form method="POST">
								<div class="form-group">
									<label  class="col-form-label ">Documento:</label>
									<input type="number" required="" class="form-control inicio_sesion" name="email" placeholder="Ingrese cedula" autocomplete="off" autofocus>
								</div>
								<div class="form-group">
									<label  class="col-form-label">Contraseña:</label>
									<input type="password" required="" class="form-control inicio_sesion" name="password"   placeholder="Ingrese clave de acceso" autocomplete="off">
								</div>
								<div class="text-center">
									<div class="btn-group" role="group"  lass="mx-auto" style="width: 400px;">
										<button type="submit" class="btn btn-success" >Iniciar Sesion</button>
										<button type="button" class="btn btn-info " data-toggle="modal" data-target="#agregar_user">Registrarse</button>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>';
		}
	?>
</body>

</html>