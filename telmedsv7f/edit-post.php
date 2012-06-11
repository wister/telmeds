<?php bb_get_header(); ?>

	<div id="foro">

		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="http://www.telmeds.net/">Inicio</a></li>
					<li><a href="<?php bb_uri(); ?>">Foros</a></li>
					<li class="ui-tabs-selected"><a href="#item-1">Editar entrada</a></li>
				</ul>

				<div id="atlas">
					<img src="http://www.telmeds.net/foros/my-templates/telmedsv7f/images/foros.jpg" alt="Atlas de Dermatología" />
				</div>
				<div class="atlasref tabdiv">
					<p>texto de prueba para anuncios</p>
				</div>
				<div id="item-1">

<?php edit_form(); ?>
<?php if (function_exists('bb_attachments')) {bb_attachments();} ?>

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
