<?php bb_get_header(); ?>

<?php if ( $forums ) : ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="<?php bb_uri(); ?>">Foros</a></li>
				</ul>

				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Foros de Telmeds.org" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="item-1" class="tabdiv">

<div id="discussions">

<!-- last -->

<?php if ( $topics || $super_stickies ) : ?>

<h1><?php _e('Latest Discussions'); ?></h1>

<table id="latest">
<tr class="indic">
	<th><?php _e('Topic'); ?> &#8212; <?php bb_new_topic_link(); ?></th>
	<th><?php _e('Posts'); ?></th>
	<!-- <th><?php _e('Voices'); ?></th> -->
	<th><?php _e('Last Poster'); ?></th>
	<th><?php _e('Freshness'); ?></th>
</tr>

<?php if ( $super_stickies ) : foreach ( $super_stickies as $topic ) : ?>
<tr<?php topic_class(); ?>>
	<td><?php bb_topic_labels(); ?> <big><a href="<?php topic_link(); ?>"><?php topic_title(); ?></a></big><?php topic_page_links(); ?></td>
	<td class="num"><?php topic_posts(); ?></td>
	<!-- <td class="num"><?php bb_topic_voices(); ?></td> -->
	<td class="num"><?php topic_last_poster(); ?></td>
	<td class="num"><a href="<?php topic_last_post_link(); ?>"><?php topic_time(); ?></a></td>
</tr>
<?php endforeach; endif; // $super_stickies ?>

<?php if ( $topics ) : foreach ( $topics as $topic ) : ?>
<tr<?php topic_class(); ?>>
	<td><?php bb_topic_labels(); ?> <a href="<?php topic_link(); ?>"><?php topic_title(); ?></a><?php topic_page_links(); ?></td>
	<td class="num"><?php topic_posts(); ?></td>
	<!-- <td class="num"><?php bb_topic_voices(); ?></td> -->
	<td class="num"><?php topic_last_poster(); ?></td>
	<td class="num"><a href="<?php topic_last_post_link(); ?>"><?php topic_time(); ?></a></td>
</tr>
<?php endforeach; endif; // $topics ?>
</table>
<?php endif; // $topics or $super_stickies ?>

<!-- foros -->

<?php if ( bb_forums() ) : ?>
<h1><?php _e('Forums'); ?></h1>
<table id="forumlist">

<tr class="indic">
	<th><div class="nest"><?php _e('Main Theme'); ?> <small><?php bb_new_topic_link(); ?> </small></div></th>
	<th><div class="nest">Último comentario</div></th>
	<th><div class="nest"><?php _e('Topics'); ?></div></th>
	<th><div class="nest"><?php _e('Posts'); ?></div></th>
</tr>
<?php while ( bb_forum() ) : ?>
<?php if (bb_get_forum_is_category()) : ?>
<tr<?php bb_forum_class('bb-category'); ?>>
	<td colspan="4"><?php bb_forum_pad( '<div class="nest">' ); ?><h2><?php forum_name(); ?></h2><?php forum_description( array( 'before' => '<small> &#8211; ', 'after' => '</small>' ) ); ?><?php bb_forum_pad( '</div>' ); ?></td>
</tr>
<?php continue; endif; ?>
<tr<?php bb_forum_class(); ?>>
	<td><?php bb_forum_pad( '<div class="nest">' ); ?><a href="<?php forum_link(); ?>"><?php forum_name(); ?></a><?php forum_description( array( 'before' => '<small> &#8211; ', 'after' => '</small>' ) ); ?><?php bb_forum_pad( '</div>' ); ?></td>
	<td class="num"><small><a href="<?php forum_last_post_link(); ?>"><?php forum_last_poster(); ?></a> <br /> hace <?php forum_time();?></small></td>
	<td class="num"><?php forum_topics(); ?></td>
	<td class="num"><?php forum_posts(); ?></td>
</tr>
<?php endwhile; ?>
</table>
<?php endif; // bb_forums() ?>

</div>

<?php else : // $forums ?>

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
					<li><a href="<?php bb_uri(); ?>">Foros</a></li>
					<li class="ui-tabs-selected"><a href="#item-1">Nuevo tema</a></li>
				</ul>

				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Atlas de Dermatología" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="new" class="tabdiv">

<div id="discussions">

<?php post_form(); ?>

</div>

<?php endif; // $forums ?>

<div class="miembros">
<p><small>Miembros en línea <strong>ahora:</strong> <?php members_online_now(); ?>. <strong>Hoy:</strong> <?php members_online_today(); ?>.</small></p>
</div>

				</div>
			</div>
		</div>
		<div class="wrapper">
			<div id="main" class="contenedor">
				<div id="widgetareal">
					<div id="svp" class="widget">
						<a href="http://www.telmeds.net/documentos-virtuales/"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/sve.jpg" alt="Sala Virtual de Estudiantes" /></a>
						<p><a href="http://www.telmeds.net/documentos-virtuales/">Sala Virtual de Estudiantes</a></p>
					</div>
				</div>
				<div id="widgetaread">
					<div id="tls" class="widget">
						<a href="http://www.telmeds.net/clases-virtuales/"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/tls.jpg" alt="Clases Virtuales" /></a>
						<p><a href="http://www.telmeds.net/clases-virtuales/">Sala Virtual de Profesores</a></p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
				<div id="sidebar">
					<div id="patrocinio" class="widget">
						<a href="http://www.up.ac.pa/PortalUp/index.aspx"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/jj1.jpg" alt="Universidad de Panamá" /></a><a href="http://www.up.ac.pa/PortalUp/FacMedicina.aspx?menu=99"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/jj2.jpg" alt="Facultad de Medicina" /></a>
						<p><a href="http://www.telmeds.net/patrocinio/">Patrocinadores</a></p>
					</div>
				</div>
		</div>
	</div><!-- termina cuerpo -->
<?php bb_get_footer(); ?>