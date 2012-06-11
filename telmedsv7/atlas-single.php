<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php
/*
Template Name: Atlas item
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
if($post->post_parent) {
$parent_title = get_the_title($post->post_parent);
$parent_link = get_permalink($post->post_parent);
}
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
					<li><a href="<?php bloginfo('url');?>/atlas/<?php echo $atlas_link ?>/"><?php echo $atlas_nombre; ?></a></li>
					<li class="ui-tabs-selected"><a href="#item-1"><?php the_title(); ?></a></li>
				</ul>
				<div id="atlas">
					<img src="<?php bloginfo('template_url');?>/images/atlas/<?php echo $atlas_link ?>.jpg" alt="<?php the_title();?>" />
				</div>
				<div id="item-1" class="tabdiv">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h1><?php the_title();?></h1><br />
<?php the_content();?>
					<h2>Citar</h2>
					<p>Puede citar el presente documento utilizando el texto presentado a continuación en sus documentos. También puede descargar la referencia para almacenarla en su administrador de citaciones.</p>
					<p class="citacion"><em>Club de Informática Médica y Telemedicina (Universidad de Panamá)<?php echo $autores ?>. <strong><?php the_title();?></strong>. Telmeds.org [publicada en línea]. <?php the_time('Y');?>(<?php the_time('m');?>). [citado <?php echo date ( 'd \d\e M \d\e Y' );?>]. Disponible en: <?php the_permalink();?></em></p>
<?php edit_post_link('Editar', '<p>', '</p>'); ?>
<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
