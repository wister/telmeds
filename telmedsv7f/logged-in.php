<p class="login">
	<?php printf(__('Welcome, %1$s'), bb_get_profile_link(bb_get_current_user_info( 'name' )));?>
	<?php bb_admin_link( 'before= | ' );?>
	| <?php bb_logout_link(); ?>
	| <a href="http://www.telmeds.org/ver">Ver Clases</a>
</p>