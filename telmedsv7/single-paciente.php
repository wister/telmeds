<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<ul id="singletxt">
					<li><a href="#item-1">Inicio</a></li>
					<li><a href="#item-5">Comentarios</a></li>
				</ul>
				<div id="item-1" class="tabdiv">
					<h1><?php the_title();?></h1>
					<p class='autores'>Presentado por: <?php the_author();?></p><br />
<?php the_content();?>
				</div>
				<div id="ganador" class="tabdiv">
					<span class="medalla"><img src="http://www.softicons.com/download/application-icons/pixelophilia-2-icons-by-omercetin/png/32/medal.png" /><span>Ganador!</span></span>
				</div>
				<div class="tabdiv">
					<span id="pacientesocial" class="citacion">
<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>&amp;t=<?php the_title();?>" title="Compartir en Facebook"><img src="<?php bloginfo('template_url');?>/images/social/facebook.png" alt="Compartir en Facebook" /></a>
<a rel="nofollow" href="http://twitter.com/home?status=<?php the_title();?>+<?php the_permalink() ?>" title="Compartir en Twitter"><img src="<?php bloginfo('template_url');?>/images/social/twitter.png" alt="Compartir en Twitter" /></a>
<a rel="nofollow" href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title();?>" title="Compartir en delicious"><img src="<?php bloginfo('template_url');?>/images/social/delicious.png" alt="Compartir en delicious" /></a>
<a rel="nofollow" href="http://technorati.com/faves?add=<?php the_permalink() ?>" title="Compartir en Technorati"><img src="<?php bloginfo('template_url');?>/images/social/technorati.png" alt="Compartir en Technorati" /></a>
<a href="http://www.google.com/reader/link?url=<?php the_permalink() ?>&amp;title=<?php the_title();?>&amp;srcURL=http://www.telmeds.org/" target="_blank" rel="nofollow external"><img src="<?php bloginfo('template_url');?>/images/social/google-buzz.png" alt="Compartir en Google Buzz" /></a>
<a href="mailto:?subject=[Telmeds.org] - <?php the_title();?>"><img src="<?php bloginfo('template_url');?>/images/social/email.png" alt="Enviar por email" /></a>
 					</span>
				</div>
				<div id="item-4" class="tabdiv">
				<div class="crunch">
					<img src="<?php bloginfo(template_url);?>/images/crunch2.png" alt="Crunch" />
					<small>Recuerda que al competir por este caso es posible que ganes una barra de chocolate Crunch 	&reg; que te será proporcionada por ¡¡Skipper, el pingüino de los chocolates!! Cada caso que ganes representa un punto para el gran premio semestral. Recuerda que quien más puntos acumule más posibilidades tiene de ganar. Telmeds.org y Dr.Kaso les recuerdan que ninguna persona, alma, extraterrestre o espiritu fue dañada durante la confección de este caso clínico.</small>
				</div>
<?php comments_template( '', true ); ?>
				</div>
<?php endwhile; else: endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
