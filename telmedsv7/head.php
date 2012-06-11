<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<body id="telmeds" <?php if ( is_singular( $post_type = eventos ) ) { ?>onload="initialize()" onunload="GUnload()"<?php } ?>>
	<div id="cabeza">
		<div class="wrapper">
			<h1><a href="<?php bloginfo('url');?>/">Telmeds.org</a></h1>
			<form action="<?php bloginfo('url');?>/" id="searchform" method="get"><input type="text" class="text" id="s" name="s" value="Buscar en Telmeds.org" maxlength="250" onfocus="this.value=(this.value=='Buscar en Telmeds.org') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Buscar en Telmeds.org' : this.value;"/><input type="submit" value="Buscar" id="searchsubmit" /></form>
			<ul id="nav">
				<li id="inicio" class="resalto"><a href="<?php bloginfo('url');?>/">Inicio</a></li>
				<li><span>Atlas &raquo; </span><ul class="sublistaatlas">
					<li><a href="<?php bloginfo('url');?>/atlas/anatomia/">Anatomía</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/bacteriologia/">Bacteriología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/dermatologia/">Dermatología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/electrocardiografia/">Electrocardiografía</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/embriologia">Embriología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/hematologia/">Hematología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/histologia/">Histología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/micologia/">Micología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/neurorradiologia/">Neurorradiología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/otorrinolaringologia">Otorrinolaringología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/parasitologia/">Parasitología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/patologia/">Patología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/radiologia/">Radiología</a></li>
					<li><a href="<?php bloginfo('url');?>/atlas/virologia/">Virología</a></li>
				</ul></li>
				<li><span>Secciones &raquo;</span><ul class="sublistainfo">
					<li><a href="<?php bloginfo('url');?>/articulos/">Artículos</a></li>
					<li><a href="<?php bloginfo('url');?>/casos-clinicos/">Casos Clínicos</a></li>
					<li><a href="<?php bloginfo('url');?>/imagen-medica/">Imagen Médica</a></li>
					<li><a href="<?php bloginfo('url');?>/videos/">Videos</a></li>
					<li><a href="<?php bloginfo('url');?>/imagen-reto/">Imagen Reto</a></li>
					<li><a href="<?php bloginfo('url');?>/capsula-medica/">Cápsula Médica</a></li>
					<li><a href="<?php bloginfo('url');?>/perlas/">Perlas</a></li>
					<li><a href="<?php bloginfo('url');?>/prosalud/">ProSalud</a></li>
					<li><a href="<?php bloginfo('url');?>/quizes/">Quizes</a></li>
					<li><a href="<?php bloginfo('url');?>/noticias/">Noticias</a></li>
					<li><a href="<?php bloginfo('url');?>/documentos-virtuales/">Sala Virtual de Estudiantes</a></li>
					<li><a href="<?php bloginfo('url');?>/clases-virtuales/">Sala Virtual de Profesores</a></li>
					<li><a href="<?php bloginfo('url');?>/foros/forum/6">Paciente Virtual</a></li>
					<li><a href="<?php bloginfo('url');?>/eventos/">Eventos</a></li>
					<li><a href="<?php bloginfo('url');?>/enlaces/">Enlaces</a></li>
				</ul></li>
				<li><span>Nosotros &raquo; </span><ul class="sublistanosotros">
					<li><a href="<?php bloginfo('url');?>/nosotros/">Nosotros</a></li>
					<li><a href="<?php bloginfo('url');?>/cimte/">CIMTe</a></li>
					<li><a href="<?php bloginfo('url');?>/directiva/">Directiva</a></li>
					<li><a href="<?php bloginfo('url');?>/estatutos/">Estatutos</a></li>
					<li><a href="<?php bloginfo('url');?>/galeria-de-presidentes/">Presidentes</a></li>
					<li><a href="<?php bloginfo('url');?>/miembros/">Miembros</a></li>
					<li><a href="<?php bloginfo('url');?>/colaboradores/">Colaboradores</a></li>
					<li><a href="<?php bloginfo('url');?>/logros/">Actividades</a></li>
					<li><a href="<?php bloginfo('url');?>/mapa/">Mapa del sitio</a></li>
					<li><a href="<?php bloginfo('url');?>/preguntas/">¿Preguntas?</a></li>
					<li><a href="<?php bloginfo('url');?>/contacto/">Contáctenos</a></li>
				</ul></li>
				<li id="residencias" class="residencias"><a href="<?php bloginfo('url');?>/residencias-medicas/">Residencias</a></li>
				<li id="foros" class="foros"><a href="<?php bloginfo('url');?>/foros/">Comunidad</a></li>
			</ul>
		</div>
	</div><!-- termina cabeza del sitio --> 