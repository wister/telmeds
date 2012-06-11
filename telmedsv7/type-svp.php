<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#svparchive">Sala Virtual de Profesores</a></li>
				</ul>
				<div id="svparchive" class="colabdiv">
					<h1>Sala Virtual de Profesores</h1>
<?php 
//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)

$taxonomy     = 'materias';
$orderby      = 'name'; 
$show_count   = 1;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';

$args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title
);
?>
<ul id="materias">
<?php wp_list_categories( $args ); ?>
</ul>
<hr />
<?php $odd_or_even = 'odd'; ?>
<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('post_type=svp&order=DESC&showposts=10'.'&paged='.$paged); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $do_not_duplicate = $post->ID; ?>
<?php $odd_or_even = ('odd'==$odd_or_even) ? 'colabizq' : 'colabder'; ?>
					<div id="colab-<?php the_ID();?>" class="colab <?php echo $odd_or_even; ?>">
						<a href="<?php if (!empty($post->post_password)) { the_permalink(); } else { echo get_post_meta($post->ID, 'IR_imagen', true); }?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=90" alt="<?php the_title();?>" width="120" /></a>
						<div class="colabcontent">
							<h3><?php the_title();?></h3>
							<p>
							<span><a href="<?php if (!empty($post->post_password)) { the_permalink(); } else { echo get_post_meta($post->ID, 'IR_imagen', true); }?>">Descargar</a> <?php if ( post_password_required($post) ) { echo '<img class="protegido" src="' . get_bloginfo(template_url) . '/images/candado.gif" alt="Algunos contenidos pueden estar protegidos." />'; } else { /*nada que mostrar*/ } ?> </span><br />
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
						</div>
						<div class="clear"></div>
					</div>
<?php endwhile; ?>
					<div class="clear"></div>
				</div>
<?php wp_pagenavi(); ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
