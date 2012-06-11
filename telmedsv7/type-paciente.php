<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#paciente">Paciente Virtual</a></li>
				</ul>
				<div id="atlas">
					<img src="<?php bloginfo('template_url');?>/images/atlas/paciente.jpg" alt="<?php the_title();?>" />
				</div>
				<div id="paciente" class="tabdiv">
					<div class="pacientecontent">
<?php $odd_or_even = 'odd'; ?>
<?php $temp = $wp_query; $wp_query= null; $wp_query = new WP_Query(); $wp_query->query('post_type=paciente&order=ASC&&orderby=title&showposts=10'.'&paged='.$paged); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $do_not_duplicate = $post->ID; ?>
<?php $odd_or_even = ('odd'==$odd_or_even) ? 'colabizq' : 'colabder'; ?>
					<div id="colab-<?php the_ID();?>" class="colab <?php echo $odd_or_even; ?>">
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
						<div class="colabcontent">
							<h3><?php the_title();?></h3>
							<em>Presentado por: <?php the_author();?></em><br /><br />
<?php the_excerpt();?>
							<span class="medalla"><img src="http://www.softicons.com/download/application-icons/pixelophilia-2-icons-by-omercetin/png/32/medal.png" /><span><a href="<?php the_permalink();?>#commentform">¡Añade tu respuesta!</a></span></span><br />
							<!--<span id="pacientenum"><a href="<?php the_permalink();?>#commentform"><b>+</b> <span>Añade tu respuesta</span></a></span>-->
						</div>
						<div class="clear"></div>
					</div>
<?php endwhile; ?>
					</div>
					<div class="pacientesidebar">
						<div class="widget">Tabla de líderes
						</div>
						<div class="widget">Premio
						</div>
						<div class="widget">Normas
						</div>
					</div>
					<div class="clear"></div>
				</div>
<?php wp_pagenavi(); ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
