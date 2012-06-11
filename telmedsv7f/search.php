<?php bb_get_header(); ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="<?php bb_uri(); ?>">Foros</a></li>
				</ul>

				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Atlas de Dermatología" />
				</div>
				<div class="atlasref tabdiv">
					<p><?php mensaje();?></p>
				</div>
				<div id="item-1">

<div id="busqueda" class="tabdiv">

<?php bb_topic_search_form(); ?>

<?php if ( !empty ( $q ) ) : ?>
<h3 id="search-for"><?php _e('Search for')?> &#8220;<?php echo esc_html($q); ?>&#8221;</h3>
<?php endif; ?>

<?php if ( $recent ) : ?>
<div id="results-recent" class="search-results">
	<h4><?php _e('Recent Posts')?></h4>
	<ol>
<?php foreach ( $recent as $bb_post ) : ?>
		<li<?php alt_class( 'recent' ); ?>>
			<a href="<?php post_link(); ?>"><?php topic_title($bb_post->topic_id); ?></a>
			<span class="freshness"><?php printf( __('Posted %s'), bb_datetime_format_i18n( bb_get_post_time( array( 'format' => 'timestamp' ) ) ) ); ?></span>
			<p><?php echo bb_show_context($q, $bb_post->post_text); ?></p>
		</li>
<?php endforeach; ?>
	</ol>
</div>
<?php endif; ?>

<?php if ( $relevant ) : ?>
<div id="results-relevant" class="search-results">
	<h4><?php _e('Relevant posts')?></h4>
	<ol>
<?php foreach ( $relevant as $bb_post ) : ?>
		<li<?php alt_class( 'relevant' ); ?>>
			<a href="<?php post_link(); ?>"><?php topic_title($bb_post->topic_id); ?></a>
			<span class="freshness"><?php printf( __('Posted %s'), bb_datetime_format_i18n( bb_get_post_time( array( 'format' => 'timestamp' ) ) ) ); ?></span>
			<p><?php post_text(); ?></p>
		</li>
<?php endforeach; ?>
	</ol>
</div>
<?php endif; ?>

<?php if ( $q && !$recent && !$relevant ) : ?>
<p><?php _e('No results found.') ?></p>
<?php endif; ?>
<br />
<p><?php printf(__('You may also try your <a href="http://google.com/search?q=site:%1$s %2$s">search at Google</a>'), bb_get_uri(null, null, BB_URI_CONTEXT_TEXT), urlencode($q)) ?></p>

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
