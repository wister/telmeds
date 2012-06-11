<div id="comments-form" class="tabdiv">
<h2 id="comments-header">Escribe una respuesta</h2>
<div id="post-form-post-container" class="comment-text">
<?php if ( !bb_is_topic() ) : ?>
<p id="post-form-title-container">
	<label for="topic"><?php _e('Title'); ?>
		<input name="topic" type="text" id="topic" size="50" maxlength="80" tabindex="1" />
	</label>
</p>
<?php endif; do_action( 'post_form_pre_post' ); ?>
<?php if ( bb_is_tag() || bb_is_front() ) : ?>
<p id="post-form-forum-container">
	<label for="forum-id"><?php _e('Forum'); ?>
		<?php bb_new_topic_forum_dropdown(); ?>
	</label>
</p>
<?php endif; ?>
	<p><small>El CIMTe se reserva el derecho de eliminar y/o modificar los comentarios que contengan lenguaje inapropiado, spam u otras conductas no apropiadas en una comunidad civilizada. Si su comentario no aparece, puede ser que nuestro filtro de spam lo haya capturado, si es así, pronto estará en su lugar. Sentimos las molestias.</small></p>
	<p><textarea cols="122" rows="9" id="post_content" name="post_content"></textarea></p>


<p id="post-form-submit-container" class="submit">
<input type="submit" id="postformsub" name="Submit" value="<?php echo esc_attr__( 'Enviar respuesta &raquo;' ); ?>" tabindex="4" />
</p>
</div>
</div>
