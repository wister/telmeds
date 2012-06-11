<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#item-1">Colaboradores</a></li>
				</ul>
				<div class="colabdiv">
					<h2>Colaboradores de Telmeds.org</h2>
<?php $odd_or_even = 'odd'; ?>
<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('post_type=colaboradores&order=ASC&orderby=title&showposts=10'.'&paged='.$paged); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $do_not_duplicate = $post->ID; ?>
<?php $odd_or_even = ('odd'==$odd_or_even) ? 'colabizq' : 'colabder'; ?>
					<div id="colab-<?php the_ID();?>" class="colab <?php echo $odd_or_even; ?>">
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
						<div class="colabcontent">
							<h3><?php echo get_post_meta($post->ID, 'autores', true); ?></h3>
							<p><?php echo get_post_meta($post->ID, 'cargos', true); ?></p>
							<p><a href="<?php the_permalink();?>">Ver curriculum</a></p>
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
