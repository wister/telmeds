<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php
/*
Template Name: AVIM
*/
?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="atlas">Atlas Virtuales</a></li>
				</ul>
				<div id="atlas">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php endwhile; endif; ?>
<?php
// Set up the arguments for retrieving the pages
$args = array(
'post_type' => 'page',
'numberposts' => -1,
'post_status' => null,
'post_parent' => $post->ID, // $post->ID gets the ID of the current page
'order' => ASC,
'orderby' => title
);
$subpages = get_posts($args);
// Just another Wordpress Loop
foreach($subpages as $post) :
setup_postdata($post);
?>
		<div class="iatlas">
			<a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_url');?>/images/atlas/<?php echo $post->post_name;?>.jpg" alt="<?php the_title();?>" /></a><br/>
			<!-- <div class="atlasref tabdiv">
				<p><strong>Editores del <?php the_title();?></strong>: <?php the_content(); ?></p>
			</div>-->
		</div>
<?php endforeach; ?>
			<div class="clear"></div>
<?php $wp_query = null; $wp_query = $temp;?>

				</div>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>