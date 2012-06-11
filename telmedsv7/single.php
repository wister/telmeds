<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<ul id="singletxt">
					<li><a href="#item-1">Inicio</a></li>
					<li><a href="#item-3">Citar</a></li>
					<li><a href="#item-4">Comentarios</a></li>
				</ul>
				<div id="item-1" class="tabdiv">
					<h1><?php the_title();?></h1>
<?php $autores = get_post_meta($post->ID, 'autores', true); ?>
<?php
if (!empty($autores)) {
echo "\t\t\t\t\t<p class='autores'>" . $autores . "</p>\n";
}
?>
<?php $cargos = get_post_meta($post->ID, 'cargos', true); ?>
<?php
if (!empty($cargos)) {
echo "\t\t\t\t\t<p class='cargos'>" . $cargos . "</p><br />\n";
}
?>
<?php the_content(); ?>
				</div>
				<div id="item-3" class="citas tabdiv">
					<h2>Citar</h2>
					<p>Puede citar el presente documento utilizando el texto presentado a continuación en sus documentos. También puede descargar la referencia para almacenarla en su administrador de citaciones.</p>
					<p class="citacion"><em><?php echo $autores ?>. <strong><?php the_title();?></strong>. Telmeds.org [publicada en línea]. <?php the_time('Y');?>(<?php the_time('m');?>). [citado <?php echo date ( 'd \d\e M \d\e Y' );?>]. Disponible en: <?php the_permalink();?></em></p><br />
					<h2>Entradas relacionadas</h2>
<?php related_posts();?>
				</div>
				<div id="item-4" class="tabdiv">
<?php comments_template( '', true ); ?>
				</div>
<?php endwhile; else: endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
