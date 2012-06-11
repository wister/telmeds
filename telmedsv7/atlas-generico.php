<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php
/*
Template Name: Atlas genérico
*/
?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/">Atlas Virtuales</a></li>
<?php
$parent_link = get_permalink($post->ID);

if (strpos($parent_link, "anatomia") !== false) {
	$atlas_nombre = 'Anatomía';
	$atlas_link = 'anatomia';
}
elseif (strpos($parent_link, "bacteriologia") !== false) {
	$atlas_nombre = 'Bacteriología';
	$atlas_link = 'bacteriologia';
}
elseif (strpos($parent_link, "dermatologia") !== false) {
	$atlas_nombre = 'Dermatología';
	$atlas_link = 'dermatologia';
}
elseif (strpos($parent_link, "electrocardiografia") !== false) {
	$atlas_nombre = 'Electrocardiografía';
	$atlas_link = 'electrocardiografia';
}
elseif (strpos($parent_link, "embriologia") !== false) {
	$atlas_nombre = 'Embriología';
	$atlas_link = 'embriologia';
}
elseif (strpos($parent_link, "hematologia") !== false) {
	$atlas_nombre = 'Hematología';
	$atlas_link = 'hematologia';
}
elseif (strpos($parent_link, "histologia") !== false) {
	$atlas_nombre = 'Histología';
	$atlas_link = 'histologia';
}
elseif (strpos($parent_link, "micologia") !== false) {
	$atlas_nombre = 'Micología';
	$atlas_link = 'micologia';
}
elseif (strpos($parent_link, "neurorradiologia") !== false) {
	$atlas_nombre = 'Neurorradiología';
	$atlas_link = 'neurorradiologia';
}
elseif (strpos($parent_link, "otorrinolaringologia") !== false) {
	$atlas_nombre = 'Otorrinolaringología';
	$atlas_link = 'otorrinolaringologia';
}
elseif (strpos($parent_link, "parasitologia") !== false) {
	$atlas_nombre = 'Parasitología';
	$atlas_link = 'parasitologia';
}
elseif (strpos($parent_link, "patologia") !== false) {
	$atlas_nombre = 'Patología';
	$atlas_link = 'patologia';
}
elseif (strpos($parent_link, "radiologia-pediatrica") !== false) {
	$atlas_nombre = 'Radiología Pediátrica';
	$atlas_link = 'radiologia-pediatrica';
}
elseif (strpos($parent_link, "virologia") !== false) {
	$atlas_nombre = 'Virología';
	$atlas_link = 'virologia';
}?>
					<li class="ui-tabs-selected"><a href="<?php bloginfo('url');?>/atlas/<?php echo $atlas_link ?>/"><?php echo $atlas_nombre; ?></a></li>
				</ul>
				<div id="atlas">
					<img src="<?php bloginfo('template_url');?>/images/atlas/<?php echo $atlas_link ?>.jpg" alt="<?php the_title();?>" />
				</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="atlasref tabdiv">
<?php the_content(); ?>
				</div>
				<div id="item-1" class="tabdiv">
<?php
// alternativa generalizada a cualquier atlas
if($page->ID)
	$children = wp_list_pages("title_li=&sort_column=menu_order&child_of=".$page->ID."&echo=0");
else
	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
if ($children) { ?>
<div class="thin">
<ul>
<?php echo $children; ?>
</ul>
</div>
<?php } ?>

				</div>
<?php endwhile; endif; ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>