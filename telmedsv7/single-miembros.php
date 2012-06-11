<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt2">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li><a href="<?php bloginfo('url');?>/miembros/">Miembros CIMTe</a></li>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li class="ui-tabs-selected"><a href="#"><?php echo get_post_meta($post->ID, 'autores', true); ?></a></li>
				</ul>
				<div class="tabdiv">
					<h2><?php echo get_post_meta($post->ID, 'autores', true); ?></h2>

					<div id="colab-<?php the_ID();?>" class="colabfull">
						<a href="<?php
$uri = get_post_meta($post->ID, 'col_uri', true);
if ( $uri ) {
	echo $uri;
}
else {
	echo 'http://www.telmeds.org/';
} ?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
						<div id="item-1" class="colabcontentfull">
<?php the_content();?>

						</div>
						<div class="clear"></div>
					</div>
<?php endwhile; else: endif; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
