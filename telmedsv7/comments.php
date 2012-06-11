<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php 
/*     This is comment.phps by Christian Montoya, http://www.christianmontoya.com

    Available to you under the do-whatever-you-want license. If you like it, 
    you are totally welcome to link back to me. 
    
    Use of this code does not grant you the right to use the design or any of the 
    other files on my site. Beyond this file, all rights are reserved, unless otherwise noted. 
    
    Enjoy!
*/
?>

<!-- Comments code provided by christianmontoya.com -->

<?php if (!empty($post->post_password) && $_COOKIE['wp-postpass_'.COOKIEHASH]!=$post->post_password) : ?>
    <p id="comments-locked">Enter your password to view comments.</p>
<?php return; endif; ?>

<?php if (pings_open()) : //tracbacks??? ?>

<?php endif; ?>

<?php if ($comments) : ?>

<?php 

    /* Author values for author highlighting */
    /* Enter your email and name as they appear in the admin options */
    $author = array(
            "highlight" => "highlight",
            "email" => "YOUR EMAIL HERE",
            "name" => "YOUR NAME HERE"
    ); 

    /* Count the totals */
    $numPingBacks = 0;
    $numComments  = 0;

    /* Loop throught comments to count these totals */
    foreach ($comments as $comment) {
        if (get_comment_type() != "comment") { $numPingBacks++; }
        else { $numComments++; }
    }
    
    /* Used to stripe comments */
    $thiscomment = 'odd'; 
?>

<?php

    /* This is a loop for printing pingbacks/trackbacks if there are any */
    if ($numPingBacks != 0) : ?>

    <h2 class="comments-header"><?php _e($numPingBacks); ?> Trackbacks/Pingbacks</h2>
    <ol id="trackbacks">
    
<?php foreach ($comments as $comment) : ?>
<?php if (get_comment_type()!="comment") : ?>

    <li id="comment-<?php comment_ID() ?>" class="<?php _e($thiscomment); ?>">
    <?php comment_type(__('Comment'), __('Trackback'), __('Pingback')); ?>: 
    <?php comment_author_link(); ?> on <?php comment_date(); ?>
    </li>
    
    <?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>
    
<?php endif; endforeach; ?>

    </ol>

<?php endif; ?>

<?php 

    /* This is a loop for printing comments */
    if ($numComments != 0) : ?>

    <h2 class="comments-header"><?php comments_number('Sin comentarios', 'Un comentario', '% Comentarios' );?></h2>
    <ol id="comments">
    
    <?php foreach ($comments as $comment) : ?>
    <?php if (get_comment_type()=="comment") : ?>
    
        <li id="comment-<?php comment_ID(); ?>" class="<?php 
        
        /* Highlighting class for author or regular striping class for others */
        
        /* Get current author name/e-mail */
        $this_name = $comment->comment_author;
        $this_email = $comment->comment_author_email;
        
        /* Compare to $author array values */
        if (strcasecmp($this_name, $author["name"])==0 && strcasecmp($this_email, $author["email"])==0)
            _e($author["highlight"]); 
        else 
            _e($thiscomment); 
        
        ?>">
            <div class="comment-meta">
<?php 
if (function_exists('get_avatar')) {
echo get_avatar($email, '32');
} else {
//alternate gravatar code for < 2.5
$grav_url = "http://www.gravatar.com/avatar/" . 
md5(strtolower($email)) . "?d=" . urlencode($default) . "&s=" . $size;
echo "<img src='$grav_url'/>";
}
?>
                <small><span class="comment-author"><?php comment_author_link() ?></span>, 
                <span class="comment-date">escribió hace <?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')); ?></span>:</small>
            </div>
            <div class="comment-text">
<?php comment_text(); ?>
            </div>
        </li>
        
    <?php if('odd'==$thiscomment) { $thiscomment = 'even'; } else { $thiscomment = 'odd'; } ?>
    
    <?php endif; endforeach; ?>
    
    </ol>
    
    <?php endif; ?>
    
<?php else : ?>

<p>Aun no hay comentarios, ¡puedes ser el primero en comentar esta entrada!</p>
    
<?php endif; ?>

<?php if (comments_open()) : ?>

<?php /* This would be a good place for live preview... 
    <div id="live-preview">
        <h2 class="comments-header">Live Preview</h2>
        <?php live_preview(); ?>
    </div>
 */ ?>

    <div id="comments-form">
    
    <h2 id="comments-header">Escribe un comentario</h2>
    
    <?php if (get_option('comment_registration') && !$user_ID ) : ?>
        <p id="comments-blocked">Debes haber <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=
        <?php the_permalink(); ?>">iniciado sesión</a> para dejar un comentario.</p>
    <?php else : ?>

    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

    <?php if ($user_ID) : ?>

<div class="comment-meta">
	<p>Has entrado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
	<?php echo $user_identity; ?></a>. <?php wp_loginout(); ?>.</p>
</div>
    
    <?php else : ?>

<div class="comment-meta">

	<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" />
	<label for="author">Nombre<?php if ($req) _e(' (required)'); ?></label></p>

	<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" />
	<label for="email">E-mail (no será publicado)<?php if ($req) _e(' (required)'); ?></label></p>

	<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" />
	<label for="url">Sitio web</label></p>

</div>

    <?php endif; ?>

    <?php /* You might want to display this: */ ?>

<div class="comment-text">

	<p><small>El CIMTe se reserva el derecho de eliminar y/o modificar los comentarios que contengan lenguaje inapropiado, spam u otras conductas no apropiadas en una comunidad civilizada. Si su comentario no aparece, puede ser que nuestro filtro de spam lo haya capturado, si es así, pronto estará en su lugar. Sentimos las molestias.</small></p>

	<p><textarea name="comment" id="comment" rows="9" cols="90"></textarea></p>

	<?php /* Buttons are easier to style than input[type=submit], 
	but you can replace: 
	<button type="submit" name="submit" id="sub">Submit</button>
	with: 
	<input type="submit" name="submit" id="sub" value="Submit" />
	if you like */ 
	?>
	<p><button type="submit" name="submit" id="sub">Enviar</button>
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>"></p>

</div>

    <?php do_action('comment_form', $post->ID); ?>

    </form>
    </div>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
    <p id="comments-closed">Lo sentimos, los comentarios para esta entrada están cerrados.</p>
<?php endif; ?> 
