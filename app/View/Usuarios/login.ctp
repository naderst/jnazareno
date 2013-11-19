<form id="UsuarioLoginForm" action="<?php echo Router::url(array('controller' => 'usuarios', 'action' => 'login')); ?>" method="post">
    <div class="form-group">
        <input name="data[Usuario][usuario]" type="text" placeholder="Nombre de usuario" id="username">
        <i class="fa fa-user"></i>
    </div>
    <br>
    <div class="form-group">
        <input name="data[Usuario][password]" type="password" class="login-password" placeholder="Contraseña" id="password">
        <i class="fa fa-lock"></i>
    </div>
    <br>
    <input type="submit" id="login-button" value="Iniciar sesión">
</form>