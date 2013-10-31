<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Parroquia Jesús Nazareno</title>
        <?php
		echo $this->Html->meta('icon')."\n";
		echo "\t".$this->Html->css('estilo')."\n";
		echo "\t".$this->Html->css('font-awesome')."\n";
        ?>
        <meta charset="utf-8">
    </head>
    <body>
        <header id="cabecera">

        </header>
        <nav id="nav">
            <form id="buscador">
                    <input type="text" id="buscar" placeholder="Buscar">
                    <i class="fa fa-search"></i>
            </form>
            <ul>
                <li><a href="<?php echo Router::url('/'); ?>"<?php echo $this->name == 'Pages'?'class="active"':'' ?>><i class="fa fa-home"></i> INICIO</a></li>
                <li><li><a href="<?php echo Router::url('/bautizos'); ?>"<?php echo $this->name == 'Bautizos'?'class="active"':'' ?>><i class="fa fa-angle-double-right"></i> BAUTIZOS</a></li>
                <li><li><a href="<?php echo Router::url('/matrimonios'); ?>"<?php echo $this->name == 'Matrimonios'?'class="active"':'' ?>><i class="fa fa-angle-double-right"></i> MATRIMONIOS</a></li>
                <?php
                    if($rol == 'A') {
                        /* Admin stuff */
                ?>
                <li><li><a href="<?php echo Router::url('/usuarios'); ?>"<?php echo $this->name == 'Usuarios'?'class="active"':'' ?>><i class="fa fa-user"></i> USUARIOS DEL SISTEMA</a></li>
                <li><a href="<?php echo Router::url('/configuracion'); ?>"><i class="fa fa-cog"></i>CONFIG. DEL SISTEMA</a></li>
                <?php } ?>
                
                <li><a href="<?php echo Router::url('/usuarios/logout'); ?>"><i class="fa fa-power-off"></i> CERRAR SESIÓN</a></li>
            </ul>
        </nav>
        <section id="contenido">
            <?php echo $this->Session->flash('good'); ?>
            <?php echo $this->Session->flash('bad'); ?>
            <?php echo $this->fetch('content'); ?>
        </section>
        <?php echo $this->Html->script('jquery-1.10.2.min')."\n"; ?>
        <script type="text/javascript">
            $('#buscador').submit(function(){
                alert($('#buscar').val());
                return false;
            });
        </script>
    </body>
</html>
