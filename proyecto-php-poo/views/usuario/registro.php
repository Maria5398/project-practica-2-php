<h1>Registrarse</h1>
<!--si el registro esta cargado correecttamente envie sms-->
<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?><!--borrar sesion de registro-->
<!--FORMULARIO DE REGISTRRO-->
<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" required/>
	
	<label for="email">Email</label>
	<input type="email" name="email" required/>
	
	<label for="password">Contraseña</label>
	<input type="password" name="password" required/>
	
	<input type="submit" value="Registrarse" />
</form>