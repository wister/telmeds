<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="#item-1">Inicio</a></li>
					<p class="derecho"><a href="<?php bloginfo('url');?>/libro/">Archivo de Libros</a></p>
				</ul>
				<div id="item-1" class="tabdiv">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h1><?php the_title();?></h1>
					<p class="autores"><?php echo get_post_meta($post->ID, 'autores', true); ?></p>

<div class="ip-info">
<img class="bookshot" src="<?php bloginfo('template_url');?>/scripts/timthumb.php?zc=1&amp;w=300&amp;src=<?php echo get_post_meta ($post->ID, 'IP_poster', true);?>" alt="<?php the_title();?>" />
<br /><br />
<?php if ( get_post_meta($post->ID, 'IP_lugar', true) ) { ?>
<div class="metabook">
<?php the_tags('<small>Etiquetas: ', ', ', '</small><br />'); ?>
<small>ISBN-10: <?php echo get_post_meta($post->ID, 'IP_fecha_inicio', true) ?></small><br />
<small>ISBN-13: <?php echo get_post_meta($post->ID, 'IP_fecha_final', true) ?></small><br />
<small>Editor: <?php echo get_post_meta($post->ID, 'IP_lugar', true) ?></small><br />
<small>No. Edición: <?php echo get_post_meta($post->ID, 'IP_costo', true) ?></small><br />
<small>Formato: <?php echo get_post_meta($post->ID, 'IP_info_contacto', true) ?></small><br />
<small>Calidad: <?php $values = get_post_custom_values('swf');
$shortcode_output = do_shortcode($values[0]);
print $shortcode_output; ?><br />
<?php edit_post_link('Editar', '<small>', '</small><br />'); ?>
</div>
<br />
<?php } ?>
<?php if (current_user_can( edit_posts )) { ?>
<div class="metabook">
Contraseña: <tt><?php echo get_post_meta($post->ID, 'IMS_imagen', true) ?></tt><br />
</div>
<br />
<a href="<?php echo get_post_meta($post->ID, 'IR_imagen', true) ?>"><img src="<?php bloginfo(template_url); ?>/images/download-buttons04.png" /></a>
<?php } ?>
</div>
<div class="ip-poster">
<?php the_content(); ?>
<?php $amazon_link = get_post_meta($post->ID, 'IP_geo', true); 
if(!empty($amazon_link)){ ?>
<a href="<?php echo $amazon_link; ?>" target="_blank"><img src="http://i671.photobucket.com/albums/vv78/stevegrdn/amazon_myspace.gif" /></a>
<?php } ?>
</div>
<div class="clear"></div>
				</div>
<?php endwhile; else: endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>