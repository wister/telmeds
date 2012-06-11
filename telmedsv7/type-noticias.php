<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#capsulas">Noticias</a></li>
				</ul>
				<div id="capsulas" class="colabdiv">
					<h1>Archivo de Noticias de Telmeds.org</h1>
<?php $odd_or_even = 'odd'; ?>
<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('post_type=noticias&order=ASC&orderby=title&showposts=10'.'&paged='.$paged); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $do_not_duplicate = $post->ID; ?>
<?php $odd_or_even = ('odd'==$odd_or_even) ? 'colabizq' : 'colabder'; ?>
					<div id="colab-<?php the_ID();?>" class="colab <?php echo $odd_or_even; ?>">
<?php if(has_post_thumbnail()) { ?>
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
<?php } else { ?>
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
<?php } ?>
						<div class="colabcontent">
							<h3><?php the_title();?></h3>
<?php the_excerpt();?>
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
