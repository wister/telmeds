<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
<style type="text/css">
#caps li.cia {
padding-left: 3px;
padding-right: 3px;
}
  </style>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="main" class="contenedor">
				<div id="rotativo">
					<ul>
						<li><a href="#item-1">Atlas Virtuales</a></li>
						<li><a href="#item-2">Imágenes</a></li>
						<li><a href="#item-3">Videos</a></li>
						<li><a href="#item-4">Artículos</a></li>
						<li><a href="#item-5">Casos Clínicos</a></li>
						<li><a href="#item-7">ProSalud</a></li>
						<li><a href="#item-6">Noticias</a></li>
					</ul>
					<div id="item-1" class="tabdiv">
						<a href="http://www.telmeds.org/atlas/"><img src="<?php bloginfo('template_url');?>/images/atlas.jpg" alt="Atlas Virtual de Medicina"/></a>
					</div>
					<div id="item-2" class="tabdiv">
<?php $loop = new WP_Query( array( 'post_type' => 'imagen', 'posts_per_page' => 1 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="shot">
							<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory');?>/scripts/timthumb.php?src=<?php echo get_post_meta ($post->ID, 'IMS_imagen',true);?>&amp;zc=1&amp;w=295&amp;h=220&amp;q=99" alt="Imagen Reto"/></a>
						</div>
						<div class="info">
							<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
							<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true);?></p>
							<p><?php contenido_limite(240);?></p>
							<a href="http://www.telmeds.org/imagen-medica/" class="archivoboton">Archivo de Imágenes</a>
						</div>
<?php endwhile; ?>
					</div>
					<div id="item-3" class="tabdiv">
<?php $loop = new WP_Query( array( 'post_type' => 'video', 'posts_per_page' => 1 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="shot">
							<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory');?>/scripts/timthumb.php?src=<?php echo get_post_meta ($post->ID, 'VMS_shot',true);?>&amp;zc=1&amp;w=295&amp;h=220&amp;q=99" alt="<?php the_title(); ?>"/></a>
						</div>
						<div class="info">
							<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
							<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true);?></p>
							<p><?php contenido_limite(240);?></p>
							<a href="http://www.telmeds.org/videos/" class="archivoboton">Archivo de Videos</a>
						</div>
<?php endwhile; ?>
					</div>
					<div id="item-4" class="tabdiv">
						<div class="articulospor">
<?php $loop = new WP_Query( array( 'post_type' => 'articulos', 'posts_per_page' => 5 ) ); ?>
<?php $count = 0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $count++; ?>
<?php if ($count == 1) : ?>
							<div class="miniart">
								<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
								<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true);?></p>
<div class="minipor"><?php if(has_post_thumbnail()) { ?>
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
<?php } else { ?>
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
<?php } ?></div>
								<p><?php contenido_limite(240);?></p>
								<div class="clear"></div>
							</div>
							<div class="miniart">
								<h2>Otras publicaciones</h2>
<ol>
<?php else : ?>
<li class="adicional"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></li>
<?php endif; ?>
<?php endwhile; ?>
</ol>
<a class="archivoboton" href="http://www.telmeds.org/articulos/">Archivo de Artículos</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div id="item-5" class="tabdiv">
						<div class="articulospor">
<?php $loop = new WP_Query( array( 'post_type' => 'casos', 'posts_per_page' => 4 ) ); ?>
<?php $count = 0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $count++; ?>
<?php if ($count == 1) : ?>
							<div class="miniart">
								<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
								<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true);?></p>
<div class="minipor"><?php if(has_post_thumbnail()) { ?>
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
<?php } else { ?>
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
<?php } ?></div>
								<p><?php contenido_limite(240);?></p>
								<div class="clear"></div>
							</div>
							<div class="miniart">
								<h2>Otras publicaciones</h2>
<ol>
<?php else : ?>
<li class="adicional"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></li>
<?php endif; ?>
<?php endwhile; ?>
</ol>
<a class="archivoboton" href="http://www.telmeds.org/casos-clinicos/">Archivo de Casos Clínicos</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div id="item-7" class="tabdiv">
						<div class="articulospor">
<?php $loop = new WP_Query( array( 'post_type' => 'prosalud', 'posts_per_page' => 5 ) ); ?>
<?php $count = 0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $count++; ?>
<?php if ($count == 1) : ?>
							<div class="miniart">
								<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
								<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true);?></p>
<div class="minipor"><?php if(has_post_thumbnail()) { ?>
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
<?php } else { ?>
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
<?php } ?></div>
								<p><?php contenido_limite(240);?></p>
								<div class="clear"></div>
							</div>
							<div class="miniart">
								<h2>Otras publicaciones</h2>
<ol>
<?php else : ?>
<li class="adicional"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></li>
<?php endif; ?>
<?php endwhile; ?>
</ol>
<a class="archivoboton" href="http://www.telmeds.org/prosalud/">Archivo de ProSalud</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div id="item-6" class="tabdiv">
						<div class="articulospor">
<?php $loop = new WP_Query( array( 'post_type' => 'noticias', 'posts_per_page' => 5 ) ); ?>
<?php $count = 0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $count++; ?>
<?php if ($count == 1) : ?>
							<div class="miniart">
								<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
								<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true);?></p>
<div class="minipor"><?php if(has_post_thumbnail()) { ?>
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
<?php } else { ?>
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
<?php } ?></div>
								<p><?php contenido_limite(240);?></p>
								<div class="clear"></div>
							</div>
							<div class="miniart">
								<h2>Otras publicaciones</h2>
<ol>
<?php else : ?>
<li class="adicional"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></li>
<?php endif; ?>
<?php endwhile; ?>
</ol>
<a class="archivoboton" href="http://www.telmeds.org/noticias/">Archivo de Noticias</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div id="widgetareal">
					<div id="caps" class="widget">
						<ul>
<!--<li class="cia"><a href="#cap-5"><img style="height: 12px;" src="http://www.telmeds.org/wp-content/themes/telmedsv7/images/fav.png"/></a></li>-->
							<li class="cia"><a href="#cap-1">Cápsulas Médicas</a></li>
							<li class="cia"><a href="#cap-2">Perlas Clínicas</a></li>
                                                        <li class="cia"><a href="#cap-4">Libros</a></li>
						</ul>
<!--<div id="cap-5" class="tabdiv"><h2><a href="http://www.telmeds.org/eventos/ix-curso-intensivo-de-anatomia/">IX Curso Intensivo de Anatomía</a></h2><a href="http://www.telmeds.org/eventos/ix-curso-intensivo-de-anatomia/"><img src="http://www.telmeds.org/wp-content/themes/telmedsv7/images/cia/cia2012-310.jpg" alt="IX Curso Intensivo de Anatomía" style="margin: 0pt auto; display: block;" /></a></div>-->


	<div id="cap-1" class="tabdiv">
<?php $loop = new WP_Query( array( 'post_type' => 'capsula', 'posts_per_page' => 1 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
<p class='autorescap'><?php echo get_post_meta ($post->ID, 'autores',true); ?></p>
<div class="minipor"><?php if(has_post_thumbnail()) { ?>
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
<?php } else { ?>
						<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?>&amp;zc=1&amp;w=120&amp;h=120" alt="<?php the_title();?>" width="120" height="120" /></a>
<?php } ?></div>
<?php the_excerpt(); ?>
<a href="http://www.telmeds.org/capsula-medica/" class="archivoboton">Archivo de Cápsulas</a>
<?php endwhile; ?>
					</div>
	<div id="cap-2" class="tabdiv">
<?php $loop = new WP_Query( array( 'post_type' => 'perlas', 'posts_per_page' => 1 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<div class="perlita">
<?php the_content(); ?>
<p class="perlac"><?php echo get_post_meta($post->ID, 'autores', true); ?><br />
<?php echo get_post_meta($post->ID, 'cargos', true); ?></p>
</div>
<?php endwhile; ?>
						</div>

<div id="cap-4" class="tabdiv">
<?php //$wp_query = new WP_Query( array ( 'post_type' => 'libro', 'orderby' => 'rand', 'posts_per_page' => '1' ) ); ?>
<?php $wp_query = new WP_Query( array ( 'post_type' => 'libro', 'id' => '10069', 'posts_per_page' => '1' ) ); ?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $do_not_duplicate = $post->ID; ?>
<h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo get_post_meta($post->ID, 'IP_poster', true); ?>&amp;zc=1&amp;w=220&amp;h=260&amp;q=75&amp;a=t" alt="<?php the_title();?>" width="220" height="260" style="margin: 0pt auto; display: block;" /></a>
<?php endwhile; ?>
</div>


					</div>
				</div>
				<div id="widgetaread">
					<div id="svp" class="widget">
						<a href="http://www.telmeds.org/documentos-virtuales/"><img src="<?php bloginfo('template_url');?>/images/sve.jpg" alt="Sala Virtual de Estudiantes" /></a>
						<p><a href="http://www.telmeds.org/documentos-virtuales/">Sala Virtual de Estudiantes</a></p>
					</div>
					<div id="tls" class="widget">
						<a href="http://www.telmeds.org/clases-virtuales/"><img src="<?php bloginfo('template_url');?>/images/tls.jpg" alt="Clases Virtuales" /></a>
						<p><a href="http://www.telmeds.org/clases-virtuales/">Sala Virtual de Profesores</a></p>
					</div>
				</div>
			</div>
			<div id="sidebar">
				<div id="reto" class="widget">
<?php $loop = new WP_Query( array( 'post_type' => 'reto', 'posts_per_page' => 1 ) ); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<a href="http://www.telmeds.org/imagen-reto/"><img src="<?php bloginfo('template_directory');?>/scripts/timthumb.php?src=<?php echo get_post_meta ($post->ID, 'IR_imagen',true);?>&amp;zc=1&amp;w=296&amp;h=248&amp;q=99" alt="<?php the_title(); ?>"/></a>
					<p><a href="http://www.telmeds.org/imagen-reto/">Imagen Reto</a></p>
<?php endwhile; ?>
				</div>
				<div id="eventos" class="widget">
					<a href="http://www.telmeds.org/eventos/"><img src="<?php bloginfo('template_url');?>/images/calendar.jpg" alt="Eventos Telmeds" /></a>
					<p><a href="http://www.telmeds.org/eventos/">Próximos Eventos</a></p>
				</div>
				<div id="patrocinio" class="widget">
					<a href="http://www.up.ac.pa/PortalUp/index.aspx"><img src="<?php bloginfo('template_url');?>/images/jj1.jpg" alt="Universidad de Panamá" /></a><a href="http://www.up.ac.pa/PortalUp/FacMedicina.aspx?menu=99"><img src="<?php bloginfo('template_url');?>/images/jj2.jpg" alt="Facultad de Medicina" /></a>
					<p><a href="http://www.telmeds.org/patrocinio/">Patrocinadores</a></p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>