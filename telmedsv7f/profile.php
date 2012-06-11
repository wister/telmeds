<?php bb_get_header(); ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
					<li><a href="<?php bb_uri(); ?>">Foros</a></li>
					<li><a href="<?php user_profile_link( $user_id ); ?>">Perfil</a></li>
					<li class="ui-tabs-selected"><a href="#item-1"><?php echo get_user_display_name( $user_id ); ?></a></li>
					<?php if (bb_current_user_can( 'edit_user', $user->ID )) : ?><li><?php printf(__('<a href="%1$s">Editar</a>.'), esc_attr( get_profile_tab_link( $user_id, 'edit' ) ) ); ?></li><?php endif; ?>
					<?php if (bb_current_user_can( 'edit_user', $user->ID )) : ?><li><a href="<?php profile_tab_link($user->ID, 'avatar'); ?>">Avatar</a></li><?php else: endif; ?>
					<?php if (bb_current_user_can( 'edit_favorites_of', $user->ID )) : ?><li><?php printf(__('<a href="%1$s">Favoritos</a>'), esc_attr( get_favorites_link() ) ); ?></li><?php else: endif; ?>
				</ul>

				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Atlas de Dermatología" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="item-1" class="tabdiv">

<div id="discussions">

<div class="vcard" role="main">

			<div class="threadauthor">
				<?php avatarupload_display($user->ID); ?>
				<?php post_author_avatar_link(); ?>
				<p>
					<small><strong><?php echo get_user_display_name( $user->ID ); ?></strong></small><br />
				</p>
			</div>

<?php if ( $updated ) : ?>
<div class="notice">
<p><?php _e('Profile updated'); ?>. <a href="<?php profile_tab_link( $user_id, 'edit' ); ?>"><?php _e('Edit again &raquo;'); ?></a></p>
</div>
<?php elseif ( $user_id == bb_get_current_user_info( 'id' ) ) : ?>
<p>
<?php _e('This is how your profile appears to a logged in member.'); ?>

</p>

<?php endif; ?>

<?php bb_profile_data(); ?>

<div class="clear"></div>

</div>

<div id="user-replies" class="user-recent"><h4><?php _e('Recent Replies'); ?></h4>
<?php if ( $posts ) : ?>
<ol>
<?php foreach ($posts as $bb_post) : $topic = get_topic( $bb_post->topic_id ) ?>
<li<?php alt_class('replies'); ?>>
	<a href="<?php topic_link(); ?>"><?php topic_title(); ?></a> -
	<?php if ( $user->ID == bb_get_current_user_info( 'id' ) ) printf(__('You last replied: %s ago'), bb_get_post_time()); else printf(__('User last replied: %s ago'), bb_get_post_time()); ?> |

	<span class="freshness"><?php
		if ( bb_get_post_time( 'timestamp' ) < get_topic_time( 'timestamp' ) )
			printf(__('Most recent reply: %s ago'), get_topic_time());
		else
			_e('No replies since');
	?></span>
</li>
<?php endforeach; ?>
</ol>
<?php else : if ( $page ) : ?>
<p><?php _e('No more replies.') ?></p>
<?php else : ?>
<p><?php _e('No replies yet.') ?></p>
<?php endif; endif; ?>
</div>

<div id="user-threads" class="user-recent">
<h4><?php _e('Topics Started') ?></h4>
<?php if ( $topics ) : ?>
<ol>
<?php foreach ($topics as $topic) : ?>
<li<?php alt_class('topics'); ?>>
	<a href="<?php topic_link(); ?>"><?php topic_title(); ?></a> -
	<?php printf(__('Started: %s ago'), get_topic_start_time()); ?> |

	<span class="freshness"><?php
		if ( get_topic_start_time( 'timestamp' ) < get_topic_time( 'timestamp' ) )
			printf(__('Most recent reply: %s ago'), get_topic_time());
		else
			_e('No replies.');
	?></span>
</li>
<?php endforeach; ?>
</ol>
<?php else : if ( $page ) : ?>
<p><?php _e('No more topics posted.') ?></p>
<?php else : ?>
<p><?php _e('No topics posted yet.') ?></p>
<?php endif; endif;?>
</div>

</div>

				</div>

<?php profile_pages( array( 'before' => '<div class="wp-pagenavi">', 'after' => '</div>' ) ); ?>

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
<?php bb_get_footer(); ?>
