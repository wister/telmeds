<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#item-1">Búsqueda: <em><?php the_search_query(); ?></em></a></li>
				</ul>
				<div id="busqueda" class="tabdiv">
<span>Palabra clave: <?php  /* Contador de busqueda */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count =$allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key;_e('</span>'); _e(' &mdash; '); echo  $count . ' '; _e('resultados');wp_reset_query(); ?></span><br /><br />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<span><a href="<?php the_permalink();?>"><?php the_title();?></a></span><br />
<span><?php contenido_limite(300); ?></span><br />
<span class="enlace"><?php the_permalink();?></span><br /><br />
<?php endwhile; else: endif; ?>
				</div>
<?php wp_pagenavi(); ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
