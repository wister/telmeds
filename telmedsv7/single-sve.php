<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header_sve();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="<?php bloginfo('url');?>/documentos-virtuales/">Sala Virtual de Estudiantes</a></li>
				</ul>
				<div class="tabdiv">

						<div id="singlesve" class="svecontent">
							<a href="<?php if (!empty($post->post_password)) { the_permalink(); } else { echo get_post_meta($post->ID, 'IR_imagen', true); }?>"><img src="<?php bloginfo('template_url');?>/images/icons/<?php $filename = get_post_meta($post->ID, 'IR_imagen', true); if (($pos = strrpos($filename, '.')) === FALSE) echo 'http://www.telmeds.net/wp-content/themes/telmedsv7/images/txt.png' ; else { $extension = substr($filename, $pos + 1); echo $extension; } ?>.png"  alt="<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>" width="128" /></a>
							<h2><?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?></h2>
							<p>
							<span><a href="<?php if (!empty($post->post_password)) { the_permalink(); } else { echo get_post_meta($post->ID, 'IR_imagen', true); }?>">Descargar</a></span> <?php $values = get_post_custom_values('swf');
$shortcode_output = do_shortcode($values[0]);
print $shortcode_output; ?> <br />
							<span>Por: <?php echo get_post_meta($post->ID, 'autores', true); ?></span><br />
<?php echo get_the_term_list($post->ID, 'materia', '<span>Etiquetado en: ', ', ', '</span><br />'); ?>
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
						</div>

					<h2>Compartir</h2>
					<p class="citacion">
<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>" title="Compartir en Facebook"><img src="<?php bloginfo('template_url');?>/images/social/facebook.png" alt="Compartir en Facebook" /></a>
<a rel="nofollow" href="http://twitter.com/home?status=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>+<?php the_permalink() ?>" title="Compartir en Twitter"><img src="<?php bloginfo('template_url');?>/images/social/twitter.png" alt="Compartir en Twitter" /></a>
<a rel="nofollow" href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>" title="Compartir en delicious"><img src="<?php bloginfo('template_url');?>/images/social/delicious.png" alt="Compartir en delicious" /></a>
<a rel="nofollow" href="http://technorati.com/faves?add=<?php the_permalink() ?>" title="Compartir en Technorati"><img src="<?php bloginfo('template_url');?>/images/social/technorati.png" alt="Compartir en Technorati" /></a>
<a href="http://www.google.com/reader/link?url=<?php the_permalink() ?>&amp;title=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;srcURL=http://www.telmeds.org/" target="_blank" rel="nofollow external"><img src="<?php bloginfo('template_url');?>/images/social/google-buzz.png" alt="Compartir en Google Buzz" /></a>
<a href="mailto:?subject=[Telmeds.org] - <?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>"><img src="<?php bloginfo('template_url');?>/images/social/email.png" alt="Enviar por email" /></a>
 					</p>

<?php edit_post_link('Editar', '<p>', '</p>'); ?>

						<div class="clear"></div>

				<div id="item-4" class="">
<?php comments_template( '', true ); ?>
				</div>
				</div>
<?php endwhile; else: endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
