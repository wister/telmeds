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
					<p class="derecho"><a href="<?php bloginfo('url');?>/articulos/">Archivo de Artículos</a></p>
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
<?php edit_post_link('Editar', '<p>', '</p>'); ?>
				</div>
				<div id="item-3" class="citas tabdiv">
					<h2>Citar</h2>
					<p>Puede citar el presente documento utilizando el texto presentado a continuación en sus documentos. También puede descargar la referencia para almacenarla en su administrador de citaciones.</p>
					<p class="citacion"><em><?php echo $autores ?>. <strong><?php the_title();?></strong>. Telmeds.org [publicada en línea]. <?php the_time('Y');?>(<?php the_time('m');?>). [citado <?php echo date ( 'd \d\e M \d\e Y' );?>]. Disponible en: <?php the_permalink();?></em></p><br />
					<h2>Compartir</h2>
					<p class="citacion">
<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php the_title(); ?>" title="Compartir en Facebook"><img src="<?php bloginfo('template_url');?>/images/social/facebook.png" alt="Compartir en Facebook" /></a>
<a rel="nofollow" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" title="Compartir en Twitter"><img src="<?php bloginfo('template_url');?>/images/social/twitter.png" alt="Compartir en Twitter" /></a>
<a rel="nofollow" href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" title="Compartir en delicious"><img src="<?php bloginfo('template_url');?>/images/social/delicious.png" alt="Compartir en delicious" /></a>
<a rel="nofollow" href="http://technorati.com/faves?add=<?php the_permalink() ?>" title="Compartir en Technorati"><img src="<?php bloginfo('template_url');?>/images/social/technorati.png" alt="Compartir en Technorati" /></a>
<a href="http://www.google.com/reader/link?url=<?php the_permalink() ?>&amp;title=<?php the_title () ?>&amp;srcURL=http://www.telmeds.org/" target="_blank" rel="nofollow external"><img src="<?php bloginfo('template_url');?>/images/social/google-buzz.png" alt="Compartir en Google Buzz" /></a>
<a href="mailto:?subject=[Telmeds.org] - <?php the_title();?>"><img src="<?php bloginfo('template_url');?>/images/social/email.png" alt="Enviar por email" /></a>
 					</p>
				</div>
				<div id="item-4" class="tabdiv">
<?php comments_template( '', true ); ?>
				</div>
<?php endwhile; else: endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
