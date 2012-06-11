<div id="comments-form" class="tabdiv">
<div id="post-form-post-container" class="comment-text">
<?php if ( $topic_title ) : ?>
<p role="main">
  <label><?php _e('Topic:'); ?><br />

  <input name="topic" type="text" id="topic" size="50" maxlength="80"  value="<?php echo esc_attr( get_topic_title() ); ?>" />
</label>
</p>
<?php endif; do_action( 'edit_form_pre_post' ); ?>
<h2 id="comments-header">Editando entrada #<?php post_id(); ?> en <?php forum_name($topic->forum_id); ?></h2>
<p><small>El CIMTe se reserva el derecho de eliminar y/o modificar los comentarios que contengan lenguaje inapropiado, spam u otras conductas no apropiadas en una comunidad civilizada. Si su comentario no aparece, puede ser que nuestro filtro de spam lo haya capturado, si es así, pronto estará en su lugar. Sentimos las molestias.</small></p>
<p><textarea name="post_content" cols="122" rows="9" id="post_content"><?php echo apply_filters('edit_text', get_post_text() ); ?></textarea></p>
<p class="submit">
<input type="submit" name="Submit" value="<?php echo esc_attr__( 'Editar entrada &raquo;' ); ?>" />
<input type="hidden" name="post_id" value="<?php post_id(); ?>" />
<input type="hidden" name="topic_id" value="<?php topic_id(); ?>" />
</p>
</div>
</div>
