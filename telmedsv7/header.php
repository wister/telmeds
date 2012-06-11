<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } 

ini_set('zlib.output_compression', 'On');

ini_set('zlib.output_compression_level', '1');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">

<head>

	<title>Telmeds.org <?php wp_title();?></title>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<meta name="author" content="Club de Informática Médica y Telemedicina" />

	<meta name="author" content="Moisés A. Serrano" />

<?php if ( is_home() ) { ?>

	<meta name="description" content="Telmeds.org es un sitio web con información médica y científica que es diseñado y mantenido por estudiantes de la Facultad de Medicina de la Universidad de Panamá que pertenecen al Club de Informática Médica y Telemedicina." />

	<meta name="robots" content="noindex,nofollow" />

<?php } ?>

	<link rel="icon" type="image/png" href="http://www.telmeds.org/wp-content/themes/telmedsv7/images/favicon.png" />

	<link rel="stylesheet" type="text/css" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/core.css" />

	<link rel="stylesheet" type="text/css" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/text.css" />

	<link rel="stylesheet" type="text/css" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/reset.css" />

	<!--[if lte IE 7]><link rel="stylesheet" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/ie.css" type="text/css" /><![endif]-->

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<?php if ( is_home() ) { ?>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/ui.core.js"></script>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/ui.tabs.js"></script>

	<script type='text/javascript'>$(document).ready(function(){

		$('#rotativo > ul').tabs({ fx: { opacity: 'toggle' } }).tabs('rotate', 5000);

		$('#caps > ul').tabs({ fx: { opacity: 'toggle' } }).tabs('rotate', 7000);

		$("#nav li span").click(function() {

			var hidden = $(this).parents("li").children("ul").is(":hidden");

			$("#nav>li>ul").hide()        

			$("#nav>li").removeClass();

			if (hidden) {

				$(this)

				.parents("li").children("ul").toggle()

				.parents("li").addClass("resalto");

			}

		});

	});

	</script>

<?php } ?>

<?php if ( is_search() ) { ?>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/ui.core.js"></script>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/ui.tabs.js"></script>

	<script type='text/javascript'>$(document).ready(function(){

		$("#nav li span").click(function() {

			var hidden = $(this).parents("li").children("ul").is(":hidden");

			$("#nav>li>ul").hide()        

			$("#nav>li").removeClass();

			if (hidden) {

				$(this)

				.parents("li").children("ul").toggle()

				.parents("li").addClass("resalto");

			}

		});

	});

	</script>

<?php } ?>

<?php if ( is_custom_post_type_archive() ) { ?>

	<script type='text/javascript'>$(document).ready(function(){

		$("#nav li span").click(function() {

			var hidden = $(this).parents("li").children("ul").is(":hidden");

			$("#nav>li>ul").hide()        

			$("#nav>li").removeClass();

			if (hidden) {

				$(this)

				.parents("li").children("ul").toggle()

				.parents("li").addClass("resalto");

			}

		});

	});

	</script>

<?php } ?>

<?php if ( is_singular( $post_type = eventos ) ) { ?>

<?php $gps = get_post_meta($post->ID, 'IP_geo', $single = true); //GPS info for location using Google Maps API ?>

	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAZ9Ac7wNAaa8LGFiCLIYEQxRFY9EVuk4rXDP45bp2hXcI3fPsGRQu2Qut4-7fccbAFHQ6Lx0YTsuCuA" type="text/javascript"></script>

	<script type="text/javascript">

		google.load("maps", "2");

		// Call this function when the page has been loaded

		function initialize() {

			if (GBrowserIsCompatible()) {

			var map = new google.maps.Map2(document.getElementById("map_canvas"));

			map.setCenter(new google.maps.LatLng(<?php echo $gps; ?>), 15);



			// map controls

			map.setMapType(G_NORMAL_MAP);

			map.addControl(new GSmallMapControl());

			map.addControl(new GMenuMapTypeControl());



			// marker for location

			var marker = new GMarker(new GLatLng(<?php echo $gps; ?>));

			map.addOverlay(marker);

			}

		}

		google.setOnLoadCallback(initialize);

	</script>

<?php } ?>

<?php if ( is_singular( $post_type = video ) ) { ?>

	<script type='text/javascript' src="<?php bloginfo('url');?>/wp-content/plugins/wordtube/javascript/swfobject.js"></script>

<?php } ?>

<?php if ( is_singular( $post_type = svp ) ) { ?>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/swfobject.js"></script>

	<script type="text/javascript">

		if(window.addEventListener)

		window.addEventListener('DOMMouseScroll', handleWheel, false);

		window.onmousewheel = document.onmousewheel = handleWheel;

		

		if (window.attachEvent) 

		window.attachEvent("onmousewheel", handleWheel);

		

		function handleWheel(event){

			try{

				if(!window.document.FlexPaperViewer.hasFocus()){return true;}

				window.document.FlexPaperViewer.setViewerFocus(true);

				window.document.FlexPaperViewer.focus();

				

				if(navigator.appName == "Netscape"){

					if (event.detail)

						delta = 0;

					if (event.preventDefault){

						event.preventDefault();

						event.returnValue = false;

						}

				}

				return false;	

			}catch(err){return true;}		

		}

		

		function onExternalLinkClicked(link){

		   window.location.href = link;

		}			

	</script>

        <script type="text/javascript"> 

            <!-- For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. --> 

            var swfVersionStr = "9.0.124";

            <!-- To use express install, set to playerProductInstall.swf, otherwise the empty string. -->

            var xiSwfUrlStr = "${expressInstallSwf}";

            var flashvars = { 

                  SwfFile : escape("<?php echo get_post_meta($post->ID, 'swf', true); ?>"),

				  Scale : 0.6, 

				  ZoomTransition : "easeOut",

				  ZoomTime : 0.5,

  				  ZoomInterval : 0.1,

  				  FitPageOnLoad : false,

  				  FitWidthOnLoad : true,

  				  PrintEnabled : false,

  				  FullScreenAsMaxWindow : false,

				  ProgressiveLoading : true,

  				  localeChain: "es_ES"

				  };

			 var params = {

				

			    }

            params.quality = "high";

            params.bgcolor = "#ffffff";

            params.allowscriptaccess = "sameDomain";

            params.allowfullscreen = "true";

            var attributes = {};

            attributes.id = "FlexPaperViewer";

            attributes.name = "FlexPaperViewer";

            swfobject.embedSWF(

                "http://www.telmeds.org/wp-content/themes/telmedsv7/scripts/FlexPaperViewer.swf", "flashContent", "620", "475", 

                swfVersionStr, xiSwfUrlStr, 

                flashvars, params, attributes);

			swfobject.createCSS("#flashContent", "display:block;text-align:left;");

        </script> 

<?php } ?>

<?php if ( is_single() ) { ?>

	<meta name="robots" content="noindex,nofollow" />

	<link rel="canonical" href="<?php the_permalink(); ?>" />

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/ui.core.js"></script>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/ui.tabs.js"></script>

	<script type='text/javascript'>$(document).ready(function(){

		$('ul#singletxt').tabs();

		$("#nav li span").click(function() {

			var hidden = $(this).parents("li").children("ul").is(":hidden");

			$("#nav>li>ul").hide()        

			$("#nav>li").removeClass();

			if (hidden) {

				$(this)

				.parents("li").children("ul").toggle()

				.parents("li").addClass("resalto");

			}

		});

	});

	</script>

	<meta name="author" content="<?php echo get_post_meta($post->ID, 'autores', true); ?>" />

	<meta name="description" content="<?php echo get_post_meta($post->ID, 'descripcion', true); ?>" />

<?php } ?>

<?php if ( is_page() ) { ?>

	<link rel="canonical" href="<?php the_permalink(); ?>" />

	<script type='text/javascript'>$(document).ready(function(){

		$("#nav li span").click(function() {

			var hidden = $(this).parents("li").children("ul").is(":hidden");

			$("#nav>li>ul").hide()        

			$("#nav>li").removeClass();

			if (hidden) {

				$(this)

				.parents("li").children("ul").toggle()

				.parents("li").addClass("resalto");

			}

		});

	});

	</script>

	<meta name="author" content="<?php echo get_post_meta($post->ID, 'autores', true); ?>" />

	<meta name="description" content="<?php echo get_post_meta($post->ID, 'descripcion', true); ?>" />

<?php } ?>

<?php $parent_link = get_permalink($post->ID);

if (strpos($parent_link, "atlas") !== false) { ?>

	<script type='text/javascript' src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/autocolumn.min.js"></script>

	<script type='text/javascript'>$(document).ready(function(){

		$('.thin').columnize({width:300});

	});

	</script>

<?php }?>

	<meta name="generator" content="Telmeds 7.0" />

	<meta name="keywords" content="">

	<meta name="subject" content="medicina">

	<meta name="revisit-after" content="21">

	<meta name="distribution" content="global">

	<meta name="country" content="Panama" />

	<meta name="google-site-verification" content="a56r4WwowSB_olifdzd0wYBN53CAUcvr4najv-sun9U" />

<?php telmeds_header_hook(); ?>

</head>

