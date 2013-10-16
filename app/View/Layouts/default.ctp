<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Parroquia Jesús Nazareno</title>
        <?php
		echo $this->Html->meta('icon')."\n";
		echo "\t".$this->Html->css('estilo')."\n";
        ?>
        <meta charset="utf-8">
    </head>
    <body>
        <header id="cabecera">
            <form id="buscador" method="post" action="index.html">
                <input type="text" id="buscar" placeholder="Introduzca el nombre o número de cédula de la persona a buscar">
            </form>
        </header>
        <nav id="nav">
            <ul>
                <li><?php echo $this->Html->link('INICIO', '/', $this->name == 'Pages'?array('class' => 'active'):null); ?></li>
                <li><a href="#">BAUTIZOS</a></li>
                <li><a href="#">MATRIMONIOS</a></li>
            </ul>
        </nav>
        <section id="contenido"><?php echo $this->fetch('content'); ?></section>
        <?php echo $this->Html->script('jquery-1.10.2.min')."\n"; ?>
        <script type="text/javascript">
            $('#buscador').submit(function(){
                alert($('#buscar').val());
                return false;
            });
        </script>
    </body>
</html>
