<?php bb_get_header(); ?>

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
				<div id="item-1" class="tabdiv">



		<div class="wrapper">

<div id="discussions">

<h2 id="register" role="main"><?php _e('Registration'); ?></h2>

<?php if ( !bb_is_user_logged_in() ) : ?>

<form method="post" action="<?php bb_uri('register.php', null, BB_URI_CONTEXT_FORM_ACTION + BB_URI_CONTEXT_BB_USER_FORMS); ?>">

<fieldset>

<p><?php _e("Your password will be emailed to the address you provide."); ?></p>

<?php

$user_login_error = $bb_register_error->get_error_message( 'user_login' );

?>

<table width="100%">
	<tr class="form-field form-required required<?php if ( $user_login_error ) echo ' form-invalid error'; ?>">
		<th scope="row">
			<label for="user_login"><?php _e('Username'); ?></label>
			<?php if ( $user_login_error ) echo "<em>$user_login_error</em>"; ?>
		</th>
		<td>
			<input name="user_login" type="text" id="user_login" size="30" maxlength="30" value="<?php echo $user_login; ?>" />
		</td>
	</tr>

<?php

if ( is_array($profile_info_keys) ) :
	foreach ( $profile_info_keys as $key => $label ) :
		$class = 'form-field';
		if ( $label[0] ) {
			$class .= ' form-required required';
		}
		if ( $profile_info_key_error = $bb_register_error->get_error_message( $key ) )
			$class .= ' form-invalid error';

?>

	<tr class="<?php echo $class; ?>">
		<th scope="row">
			<label for="<?php echo $key; ?>"><?php echo $label[1]; ?></label>
			<?php if ( $profile_info_key_error ) echo "<em>$profile_info_key_error</em>"; ?>
		</th>
		<td>
			<input name="<?php echo $key; ?>" type="text" id="<?php echo $key; ?>" size="30" maxlength="140" value="<?php echo $$key; ?>" />
		</td>
	</tr>

<?php

	endforeach; // profile_info_keys
endif; // profile_info_keys

?>

</table>

<p class="required-message"><?php _e('These items are <span class="required">required</span>.') ?></p>

</fieldset>

<?php do_action('extra_profile_info', $user); ?>

<p class="submit">
	<input type="submit" name="Submit" value="<?php echo esc_attr__( 'Register &raquo;' ); ?>" />
</p>

</form>

<?php else : ?>

<p><?php _e('You&#8217;re already logged in, why do you need to register?'); ?></p>

<?php endif; ?>

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
						<a href="http://www.telmeds.net/patrocinio/"><img src="http://www.telmeds.net/wp-content/themes/telmedsv7/images/jj.jpg" alt="Eventos Telmeds" /></a>
						<p><a href="http://www.telmeds.net/patrocinio/">Patrocinadores</a></p>
					</div>
				</div>
		</div>
	</div><!-- termina cuerpo -->
<?php bb_get_footer(); ?>
