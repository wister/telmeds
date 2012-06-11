<?php bb_get_header(); ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.org/">Inicio</a></li>
					<li><a href="<?php bb_uri(); ?>">Foros</a></li>
<?php if (bb_get_forum_is_category()) : ?>
					<li class="ui-tabs-selected"><a href="<?php echo forum_link($forum->forum_parent); ?>"><?php echo forum_name($forum->forum_parent); ?></a></li>
<?php endif; ?>
<?php if (!bb_get_forum_is_category()) : ?>
					<li><a href="<?php echo forum_link($forum->forum_parent); ?>"><?php echo forum_name($forum->forum_parent); ?></a></li>
					<li class="ui-tabs-selected"><a href="#item-1"><?php forum_name($topic->forum_id); ?></a></li>
<?php endif; ?>
				</ul>
				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Foros" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="item-1" class="tabdiv">

<div id="discussions">

<!-- recientes -->

<?php if ( $topics || $stickies ) : ?>
<h2><?php forum_name($topic->forum_id); ?></h2>
<table id="forumlist" role="main">
<tr>
	<th><?php _e('Topic'); ?> &#8212; <?php bb_new_topic_link(); ?></th>
	<th><?php _e('Posts'); ?></th>
	<th><?php _e('Voices'); ?></th>
	<th><?php _e('Last Poster'); ?></th>
</tr>

<?php if ( $stickies ) : foreach ( $stickies as $topic ) : ?>
<tr<?php topic_class(); ?>>
	<td><?php bb_topic_labels(); ?> <big><a href="<?php topic_link(); ?>"><?php topic_title(); ?></a></big><?php topic_page_links(); ?></td>
	<td class="num"><?php topic_posts(); ?></td>
	<td class="num"><?php bb_topic_voices(); ?></td>
	<td class="num"><small><a href="<?php topic_last_post_link(); ?>"><?php topic_last_poster(); ?></a> <br /> hace <?php topic_time(); ?></small></td>
</tr>
<?php endforeach; endif; ?>

<?php if ( $topics ) : foreach ( $topics as $topic ) : ?>
<tr<?php topic_class(); ?>>
	<td><?php bb_topic_labels(); ?> <a href="<?php topic_link(); ?>"><?php topic_title(); ?></a><?php topic_page_links(); ?></td>
	<td class="num"><?php topic_posts(); ?></td>
	<td class="num"><?php bb_topic_voices(); ?></td>
	<td class="num"><small><a href="<?php topic_last_post_link(); ?>"><?php topic_last_poster(); ?></a> <br /> hace <?php topic_time(); ?></small></td>
</tr>
<?php endforeach; endif; ?>
</table>
<?php forum_pages( array( 'before' => '<div class="wp-pagenavi">', 'after' => '</div>' ) ); ?>
<?php endif; ?>

<?php if ( bb_forums( $forum_id ) ) : ?>
<h2><?php _e('Subforums'); ?></h2>
<table id="forumlist">

<tr>
	<th><?php _e('Main Theme'); ?></th>
	<th><?php _e('Last Poster'); ?></th>
	<th><?php _e('Topics'); ?></th>
	<th><?php _e('Posts'); ?></th>
</tr>

<?php while ( bb_forum() ) : ?>
<?php if (bb_get_forum_is_category()) : ?>
<tr<?php bb_forum_class('bb-category'); ?>>
	<td colspan="4"><?php bb_forum_pad( '<div class="nest">' ); ?><h2><?php forum_name(); ?></h2><?php forum_description( array( 'before' => '<small> &#8211; ', 'after' => '</small>' ) ); ?><?php bb_forum_pad( '</div>' ); ?></td>
</tr>
<?php continue; endif; ?>
<tr<?php bb_forum_class(); ?>>
	<td><?php bb_forum_pad( '<div class="nest">' ); ?><a href="<?php forum_link(); ?>"><?php forum_name(); ?></a><?php forum_description( array( 'before' => '<small> &#8211; ', 'after' => '</small>' ) ); ?> <small><?php bb_new_topic_link(); ?> </small><?php bb_forum_pad( '</div>' ); ?></td>
	<td class="num"><small><a href="<?php topic_last_post_link(); ?>"><?php forum_last_poster(); ?></a> <br /> hace <?php forum_time();?></small></td>
	<td class="num"><?php forum_topics(); ?></td>
	<td class="num"><?php forum_posts(); ?></td>
</tr>
<?php endwhile; ?>
</table>
<?php endif; // bb_forums() ?>

</div>
</div>

<?php post_form(); ?>

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