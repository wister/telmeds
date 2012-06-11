<?php bb_get_header(); ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
					<li><a href="<?php bb_uri(); ?>">Foros</a></li>
					<li class="ui-tabs-selected"><a href="#item-1">Entrar</a></li>
				</ul>

				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Atlas de Dermatología" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="item-1" class="tabdiv">

<h2 id="userlogin" role="main"><?php isset($_POST['user_login']) ? _e('Log in Failed') : _e('Log in') ; ?></h2>

<form method="post" action="<?php bb_uri('bb-login.php', null, BB_URI_CONTEXT_FORM_ACTION + BB_URI_CONTEXT_BB_USER_FORMS); ?>">
<fieldset>
<table>
<?php
	$user_login_error = $bb_login_error->get_error_message( 'user_login' );
	$user_email_error = $bb_login_error->get_error_message( 'user_email' );
	$user_password_error = $bb_login_error->get_error_message( 'password' );
?>
	<tr valign="top" class="form-field <?php if ( $user_login_error || $user_email_error ) echo ' form-invalid error'; ?>">
		<th scope="row">
			<label for="user_login"><?php _e('Username'); ?></label>
			<?php if ( $user_login_error ) echo "<em>$user_login_error</em>"; ?>
			<?php if ( $user_email_error ) echo "<em>$user_email_error</em>"; ?>
		</th>
		<td>
			<input name="user_login" id="user_login" type="text" value="<?php echo $user_login; ?>" />
		</td>
	</tr>
	<tr valign="top" class="form-field <?php if ( $user_password_error ) echo 'form-invalid error'; ?>">
		<th scope="row">
			<label for="password"><?php _e('Password'); ?></label>
			<?php if ( $user_password_error ) echo "<em>$user_password_error</em>"; ?>
		</th>
		<td>
			<input name="password" id="password" type="password" />
		</td>
	</tr>

	<tr valign="top" class="form-field">
		<th scope="row"><label for="remember"><?php _e('Remember me'); ?></label></th>
		<td><input name="remember" type="checkbox" id="remember" value="1"<?php echo $remember_checked; ?> /></td>
	</tr>
	<tr>
		<th scope="row">&nbsp;</th>
		<td>
			<input name="re" type="hidden" value="<?php echo $redirect_to; ?>" />
			<input type="submit" value="<?php echo esc_attr( isset($_POST['user_login']) ? __('Try Again &raquo;'): __('Log in &raquo;') ); ?>" />
			<?php wp_referer_field(); ?>
		</td>
	</tr>
</table>

</fieldset>
</form>

<h2 id="passwordrecovery"><?php _e( 'Password Recovery' ); ?></h2>
<form method="post" action="<?php bb_uri('bb-reset-password.php', null, BB_URI_CONTEXT_FORM_ACTION + BB_URI_CONTEXT_BB_USER_FORMS); ?>">
<fieldset>
	<p><?php _e('To recover your password, enter your information below.'); ?></p>
	<table>
		<tr valign="top" class="form-field">
			<th scope="row">
				<label for="user_login_reset_password"><?php _e( 'Username' ); ?></label>
			</th>
			<td>
				<input name="user_login" id="user_login_reset_password" type="text" value="<?php echo $user_login; ?>" />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"></th>
			<td>
				<input type="submit" value="<?php echo esc_attr__( 'Recover Password &raquo;' ); ?>" />
			</td>
		</tr>
	</table>
</fieldset>
</form>

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
