<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header_reto();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#item-3">Imagen Reto</a></li>
				</ul>
				<div id="item-3" class="tabdiv">

<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('post_type=reto&showposts=5'.'&paged='.$paged); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $do_not_duplicate = $post->ID; ?>
			<div id="reto-<?php the_ID();?>" class="imagen-reto">
				<h2>Imagen Reto de Telmeds.org</h2>
<?php remove_filter ('the_content', 'wpautop'); ?>
				<div class="incognita grid_8 alpha">
					<a class="thickbox" href="<?php echo get_post_meta($post->ID, 'IR_imagen', true); ?>" title="¿Cuál es el diagnóstico?">
						<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IR_imagen', true); ?>&amp;zc=1&amp;w=418" alt="Imagen Reto" width="418" />
					</a>
				</div>
<?php the_content();?>
				<div class="clear"></div>
			</div>
<?php endwhile; ?>

<h2>Archivo de Imágenes Reto</h2>
<div id="incognita">
<ul id="archivo-reto" class="reto-nav">
<?php $wp_query = null; $wp_query = $temp;?>
<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('post_type=reto&showposts=5'.'&paged='.$paged); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <li>
					<a href="#reto-<?php the_ID();?>">
						<img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IR_imagen', true); ?>&amp;zc=1&amp;w=140&amp;h=100" alt="Imagen Reto" width="140" height="100" />
					</a>
				</li>
<?php endwhile; ?>
</ul>
</div>

				</div>
<?php wp_pagenavi(); ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
