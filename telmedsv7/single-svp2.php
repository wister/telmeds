<?php 
require_once('/home/telmeds2/public_html/wp-load.php'); 
require_once('/home/telmeds2/public_html/wp-includes/plugin.php'); 
require_once('/home/telmeds2/public_html/wp-includes/theme.php'); 
require_once('/home/telmeds2/public_html/wp-includes/general-template.php');
//require_once('functions.php'); 
?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<ul id="singletxt">
					<li><a href="#protegido">Inicio</a></li>
					<li><a href="#item-3">Citar</a></li>
					<p class="derecho"><a href="<?php bloginfo('url');?>/clases-virtuales/">Sala Virtual de Profesores</a></p>
				</ul>
				<div id="protegido" class="tabdiv">
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
<img class="diapo" src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=600" alt="<?php the_title();?>" width="600" />
<?php // the_content();?>
<?php if ( post_password_required() ) { 
	echo get_the_password_form(); 
}
elseif ( !post_password_required() ) {?>

							<p class="linkp">
							<span><a class="descarga" href="<?php echo get_post_meta($post->ID, 'IR_imagen', true); ?>">Descargar</a></span><br />
							<span>Por: <?php echo get_post_meta($post->ID, 'autores', true); ?></span><br />
<?php echo get_the_term_list($post->ID, 'materias', '<span>Etiquetado en: ', ', ', '</span><br />'); ?>
							<span>Última modificación: <?php the_modified_date(); ?></span><br />
<?php $book = get_post_meta($post->ID, 'IR_imagen', true); 
$raiz = $_SERVER['DOCUMENT_ROOT'];
$newstring = str_replace("http://www.telmeds.org", $raiz , $book ); //recordar reemplazar el document root
$size = filesize($newstring);
$size2 = byteConvert($size);
?>
<?php
if (!empty($book)) {
echo '<span><small>Tamaño: ' . $size2 . '</small></span>';
}
?>
							</p>
<?php }
?>
				</div>
				<div id="item-3" class="citas tabdiv">
					<h2>Citar</h2>
					<p>Puede citar el presente documento utilizando el texto presentado a continuación en sus documentos. También puede descargar la referencia para almacenarla en su administrador de citaciones.</p>
					<p class="citacion"><em><?php echo $autores ?>. <strong><?php the_title();?></strong>. Telmeds.org [publicada en línea]. <?php the_time('Y');?>(<?php the_time('m');?>). [citado <?php echo date ( 'd \d\e M \d\e Y' );?>]. Disponible en: <?php the_permalink();?></em></p><br />
<?php edit_post_link('Editar', '<p>', '</p>'); ?>
				</div>
<?php endwhile; else: endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
