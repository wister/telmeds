		<div id="position-<?php post_position(); ?>" class="entrada">
			<div class="threadauthor">
				<?php avatarupload_display(get_post_author_id()); ?>
				<?php post_author_avatar_link(); ?>
				<p>
					<small><strong><?php post_author_link(); ?></strong></small><br />
					<small><?php post_author_title_link(); ?></small>
				</p>
			</div>
			<div class="threadpost">
				<div class="post">
<?php post_text(); ?>
				</div>
				<div class="poststuff"><small><?php printf( __('Posted %s ago'), bb_get_post_time() ); ?> <a href="<?php post_anchor_link(); ?>">#</a> <?php bb_post_admin(); ?></small></div>
			</div>
			<div class="clear"></div>
		</div>
