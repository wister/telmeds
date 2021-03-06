<?php bb_get_header(); ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
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
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Atlas de Dermatología" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="item-1">

<div id="discussions">

<div class="infobox" role="main">

<div id="topic-info" class="tabdiv">
	
	<h1<?php topic_class( 'topictitle' ); ?>><?php topic_title(); ?></h1>
	<span id="topic_posts">(<?php topic_posts_link(); ?>)</span>
	<span id="topic_labels"><?php bb_topic_labels(); ?></span>
	<span id="topic_voices">(<?php printf( _n( '%s voice', '%s voices', bb_get_topic_voices() ), bb_get_topic_voices() ); ?>)</span>

	<ul class="topicmeta">
		<li><?php printf(__('Started %1$s ago by %2$s'), get_topic_start_time(), get_topic_author()) ?></li>
	<?php if ( 1 < get_topic_posts() ) : ?>
		<li><?php printf(__('<a href="%1$s">Latest reply</a> from %2$s'), esc_attr( get_topic_last_post_link() ), get_topic_last_poster()) ?></li>
		<li><a href="<?php topic_rss_link(); ?>" class="rss-link"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> feed for this topic') ?></a></li>
	<?php endif; ?>
	<?php if ( bb_is_user_logged_in() ) : ?>
		<li<?php echo $class;?> id="favorite-toggle"><?php user_favorites_link(); ?></li>
	<?php endif; do_action('topicmeta'); ?>
	</ul>

	<p class="citacion">
	<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php topic_link(); ?>&amp;t=<?php topic_title(); ?>" title="Compartir en Facebook"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/facebook.png" alt="Compartir en Facebook" /></a>
	<a rel="nofollow" href="http://twitter.com/home?status=<?php topic_title(); ?>+<?php topic_link(); ?>" title="Compartir en Twitter"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/twitter.png" alt="Compartir en Twitter" /></a>
	<a rel="nofollow" href="http://del.icio.us/post?url=<?php topic_link(); ?>&amp;title=<?php topic_title(); ?>" title="Compartir en delicious"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/delicious.png" alt="Compartir en delicious" /></a>
	<a rel="nofollow" href="http://technorati.com/faves?add=<?php topic_link(); ?>" title="Compartir en Technorati"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/technorati.png" alt="Compartir en Technorati" /></a>
	<a href="http://www.google.com/reader/link?url=<?php topic_link(); ?>&amp;title=<?php topic_title(); ?>&amp;srcURL=http://www.telmeds.org/" target="_blank" rel="nofollow external"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/google-buzz.png" alt="Compartir en Google Buzz" /></a>
	<a href="<?php topic_rss_link(); ?>"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/rss.png" alt="Seguir por RSS" /></a>
	<a href="mailto:?subject=[Foros Telmeds.org] - <?php topic_title(); ?>"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/social/email.png" alt="Enviar por email" /></a>
	</p>

</div>



<div style="clear:both;"></div>
</div>
<?php do_action('under_title'); ?>
<?php if ($posts) : ?>
<?php topic_pages( array( 'before' => '<div class="wp-pagenavi tabdiv">', 'after' => '</div>' ) ); ?>
	<div id="ajax-response"></div>

	<div class="tabdiv">

	<?php foreach ($posts as $bb_post) : $del_class = post_del_class(); ?>
		<div id="post-<?php post_id(); ?>" <?php alt_class('post', $del_class); ?>>

	<?php bb_post_template(); ?>

		</div>
	<?php endforeach; ?>

	</div>

<?php if ( topic_is_open( $bb_post->topic_id ) ) : ?>
<?php post_form(); ?>
<?php else : ?>
<h2><?php _e('Topic Closed') ?></h2>
<p><?php _e('This topic has been closed to new replies.') ?></p>
<?php endif; ?>
<?php if ( bb_current_user_can( 'delete_topic', get_topic_id() ) || bb_current_user_can( 'close_topic', get_topic_id() ) || bb_current_user_can( 'stick_topic', get_topic_id() ) || bb_current_user_can( 'move_topic', get_topic_id() ) ) : ?>
<?php endif; ?>
<div class="admin">
<?php bb_topic_admin(); ?>
</div>

<div class="clearit"><br style=" clear: both;" /></div>
<?php topic_pages( array( 'before' => '<div class="wp-pagenavi tabdiv">', 'after' => '</div>' ) ); ?>
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
						<a href="http://www.telmeds.net/patrocinio/"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/jj.jpg" alt="Eventos Telmeds" /></a>
						<p><a href="http://www.telmeds.net/patrocinio/">Patrocinadores</a></p>
					</div>
				</div>
		</div>
	</div><!-- termina cuerpo -->
<?php endif; ?>
<?php bb_get_footer(); ?>