<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); }
add_filter("manage_upload_columns", 'upload_columns');
add_action("manage_media_custom_column", 'media_custom_columns', 0, 2);

function upload_columns($columns) {

	unset($columns['parent']);
	$columns['better_parent'] = "Parent";

	return $columns;

}
 function media_custom_columns($column_name, $id) {

	$post = get_post($id);

	if($column_name != 'better_parent')
		return;

		if ( $post->post_parent > 0 ) {
			if ( get_post($post->post_parent) ) {
				$title =_draft_or_post_title($post->post_parent);
			}
			?>
			<strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo get_the_time(__('Y/m/d')); ?>
			<br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Re-Attach'); ?></a>

			<?php
		} else {
			?>
			<?php _e('(Unattached)'); ?><br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Attach'); ?></a>
			<?php
		}

}



add_filter('manage_posts_columns', 'my_columns');
//--------------------------------------------------------[Wister edits]-----------------------------------------------//
function my_columns($columns) {
$newcolumns = array();
	foreach ($columns as $position => $value){
		$newcolumns[$position] = $value;
		if ($position == "title"){
			$newcolumns['data'] = 'Autor';
		}
	}
	//echo "<pre>"; print_r($columns); echo "</pre>";
$columns = $newcolumns;    
return $columns;
}
add_action('manage_posts_custom_column',  'my_show_columns');
function my_show_columns($name) {
    global $post;
    switch ($name) {
        case 'data':
            //$views = get_post_meta($post->ID, 'views', true);
                $userinfo = get_userdata($post->post_author);
		$views = $userinfo->user_nicename . ' <strong>|</strong> ' . $userinfo->display_name;
		//$views = print_r($post);
            echo $views;
    }
}

add_action( 'admin_bar_menu', 'additional_admin_bar_menu', 70 );
function additional_admin_bar_menu( $wp_admin_bar ) {
    $wp_admin_bar->add_menu( array( 'title' => 'Cronograma', 'href' => 'http://www.telmeds.org/cronograma' ) );
    $wp_admin_bar->add_menu( array( 'title' => 'Subir', 'href' => 'http://www.telmeds.org/subir' ) );
}

/*
remove_role( 'Editorplus' );
$editorrole = get_role( 'editor' );
$editorrole->add_cap( 'subir_subir' );
$editorrole->add_cap( 'subir_borrar' );
$capabilities = get_object_vars(get_role( 'editor' ));
$capabilities = $capabilities["capabilities"];
$capabilities["crono"] = true;
//$capabilities["subir_borrar"] = true;
//$capabilities["subir_borrar"] = true;
add_role('Editorplus', 'Editor+', $capabilities);
*/

// ----------------------------------------------------------- End of Wister edits -----------------------------------------//
function telmeds_remove_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['nejm_feed']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_nejm']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
} 
add_action('wp_dashboard_setup', 'telmeds_remove_widgets' );

function remove_boxes() {
	remove_meta_box( 'postcustom' , 'page' , 'normal' );
	remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
	remove_meta_box( 'authordiv' , 'page' , 'normal' );
	remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
	remove_meta_box( 'revisionsdiv' , 'page' , 'normal' );
	remove_meta_box( 'slugdiv' , 'page' , 'normal' );
}
add_action( 'admin_menu' , 'remove_boxes' );

add_theme_support('post-thumbnails');
set_post_thumbnail_size( 120, 120, true ); 

global $menu, $submenu, $user_ID;
function remove_the_dashboard () {
	if (current_user_can('edit_posts')) {
		return;
	} else {
 
global $menu, $submenu, $user_ID;
        $the_user = new WP_User($user_ID);
        reset($menu); $page = key($menu);
        while ((__('Dashboard') != $menu[$page][0]) && next($menu))
                $page = key($menu);
        if (__('Dashboard') == $menu[$page][0]) unset($menu[$page]);
        reset($menu); $page = key($menu);
        while (!$the_user->has_cap($menu[$page][1]) && next($menu))
                $page = key($menu);
        if (preg_match('#wp-admin/?(index.php)?$#',$_SERVER['REQUEST_URI']) && ('index.php' != $menu[$page][2]))
                wp_redirect(get_option('siteurl') . '/wp-admin/post-new.php');
}
}
add_action('admin_menu', 'remove_the_dashboard');


function excerpt($num) {
	$link = get_permalink();
	$ending = '... ';
	$limit = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).$ending;
	echo $excerpt;
	$readmore = 'Leer más';
	if($readmore!="") {
		$readmore = '<a href="'.$link.'">'.$readmore.'</a>';
		echo $readmore;
	}
}

function acorta($str, $length, $minword = 3){
	$sub = '';
	$len = 0;
	foreach (explode(' ', $str) as $word){
		$part = (($sub != '') ? ' ' : '') . $word;
		$sub .= $part;
		$len += strlen($part);
		if (strlen($word) > $minword && strlen($sub) >= $length){
			break;
		}
	}
	return $sub . (($len < strlen($str)) ? '...' : '');
}

/* Custom post types de Telmeds.org

	atlas
	articulos
	capsula
	casos
	perlas
	prosalud
	reto
	imagen
	video
	quiz
	eventos
	svp

*/

register_post_type('articulos', array(
	'label' => __('Artículos'),
	'singular_label' => __('Artículo'),
	'description' => __( 'Artículos de revisión y originales de Telmeds.org' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'articulos', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 5,
	'exclude_from_search' => false,
	'supports' => array('title', 'editor', 'thumbnail', 'comments'),
));

register_post_type('noticias', array(
	'label' => __('Noticias'),
	'singular_label' => __('Noticia'),
	'description' => __( 'Noticias Telmeds.org' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'noticias', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 25,
	'exclude_from_search' => false,
	'supports' => array('title', 'editor', 'thumbnail', ),
));

register_post_type('capsula', array(
	'label' => __('Cápsulas'),
	'singular_label' => __('Cápsula'),
	'description' => __( 'Cápsulas Médicas' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'capsula-medica', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 5,
	'exclude_from_search' => false,
	'supports' => array('title', 'editor', 'thumbnail'),
));

register_post_type('casos', array(
	'label' => __('Casos'),
	'singular_label' => __('Caso'),
	'description' => __( 'Casos Clínicos de Telmeds.org' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'casos-clinicos', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 5,
	'exclude_from_search' => false,
	'supports' => array('title', 'editor', 'thumbnail'),
));

register_post_type('perlas', array(
	'label' => __('Perlas'),
	'singular_label' => __('Perla'),
	'description' => __( 'Perlas de Medicina' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'perlas', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 25,
	'exclude_from_search' => false,
	'supports' => array('title', 'editor'),
	'register_meta_box_cb' => 'reto_css',
));

register_post_type('prosalud', array(
	'label' => __('ProSalud'),
	'singular_label' => __('ProSalud'),
	'description' => __( 'Artículos de ProSalud' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'prosalud', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 5,
	'exclude_from_search' => false,
	'supports' => array('title', 'editor', 'thumbnail'),
));

register_post_type('reto', array(
	'label' => __('Imagen Reto'),
	'singular_label' => __('Imagen Reto'),
	'description' => __( 'Imagen Reto' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'imagen-reto', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 101,
	'exclude_from_search' => true,
	'supports' => array( 'title', 'editor'),
	'register_meta_box_cb' => 'reto_css',
));

register_post_type('imagen', array(
	'label' => __('Imagen Médica'),
	'singular_label' => __('Imagen Médica'),
	'description' => __( 'Imagen Médica de la Semana' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'imagen-medica', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 10,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor', 'thumbnail'),
));

register_post_type('video', array(
	'label' => __('Videos'),
	'singular_label' => __('Video'),
	'description' => __( 'Video de Medicina y Salud' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'videos', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 10,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor'),
));

register_post_type('quiz', array(
	'label' => __('Quizes'),
	'singular_label' => __('Quiz'),
	'description' => __( 'Telmeds Quiz' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'quizes', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 100,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor'),
));

add_action('admin_menu', 'med_quiz_menu');
function med_quiz_menu() {
	add_submenu_page('edit.php?post_type=quiz', 'Quizes', 'Editar Quiz', 'edit_posts', 'edit.php?page=quizzin/quiz.php' );
}

register_post_type('eventos', array(
	'label' => __('Eventos'),
	'singular_label' => __('Evento'),
	'description' => __( 'Eventos de Telmeds.org' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'eventos', 'with_front' => false ),
	'query_var' => false,
	'menu_position' => 20,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'thumbnail'),
));

register_post_type('svp', array(
	'label' => __('Profesores'),
	'singular_label' => __('Sala Virtual de Profesores'),
	'description' => __( 'Archivos de los profesores de la Facultad de Medicina de la Universidad de Panamá' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'clases-virtuales', 'with_front' => false ),
	'query_var' => true,
	'menu_position' => 20,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor' ),
	//'register_meta_box_cb' => 'svp_css',
));

register_post_type('sve', array(
	'label' => __('Estudiantes'),
	'singular_label' => __('Documento Virtual'),
	'description' => __( 'Archivos de los profesores de la Facultad de Medicina de la Universidad de Panamá' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'documentos-virtuales', 'with_front' => false ),
	'query_var' => true,
	'menu_position' => 20,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor', 'comments' ),
	'register_meta_box_cb' => 'sve_css',
));

register_post_type('colaboradores', array(
	'label' => __('Colaboradores'),
	'singular_label' => __('Colaborador'),
	'description' => __( 'Colaboradores de Telmeds.org' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'colaboradores', 'with_front' => false ),
	'query_var' => true,
	'menu_position' => 60,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor' ),
));

register_post_type('miembros', array(
	'label' => __('CIMTe'),
	'singular_label' => __('CIMTe'),
	'description' => __( 'Miembros CIMTe' ),
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array( 'slug' => 'miembros', 'with_front' => false ),
	'query_var' => true,
	'menu_position' => 60,
	'exclude_from_search' => false,
	'supports' => array( 'title', 'editor' ),
));

//---------------------------------------LIBROS-------------------------------------------------------//
register_post_type('libro', array(
		'label' => __('Libros'),
		'singular_label' => __('Libro'),
		'description' => __( 'Libros Panameños' ),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'libro', 'with_front' => false ),
		'query_var' => false,
		'menu_position' => 50,
		'exclude_from_search' => false,
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array('post_tag'),
	));

//----------------------------------------------------------------------------------------------------//

function reto_css() {
	echo " <style type='text/css'>#titlediv { display:none !important }</style> "; //Esta línea oculta el cuestión de títulos para evitar que se genere un título automático por WordPress y se mantenga un esquema de números en los retos
}

function svp_css() {
	echo " <style type='text/css'>#postdivrich { display:none !important }</style> "; //Esta línea oculta el cuestión de títulos para evitar que se genere un título automático por WordPress y se mantenga un esquema de números en los retos
}

function sve_css() {
	echo " <style type='text/css'>#commentstatusdiv, #commentsdiv, #titlediv { display:none !important }</style> "; //Esta línea oculta el cuestión de títulos para evitar que se genere un título automático por WordPress y se mantenga un esquema de números en los retos
}

function create_theme_taxonomy() {
	if (!is_taxonomy('mesh')) {
		register_taxonomy( 'mesh', array( 'articulos', 'capsula', 'casos', 'prosalud', 'podcast', 'imagen' ), array( 'hierarchical' => false, 'label' => __('MeSH'), 'query_var' => 'mesh', 'rewrite' => array( 'slug' => 'mesh' ) ) );
	}
}
add_action( 'init', 'create_theme_taxonomy', 0 ); // Añade la taxonomía MeSH para palabras clave


function create_theme_taxonomy_mat() {
	if (!is_taxonomy('materias')) {
		register_taxonomy( 'materias', array( 'svp' ), array( 'hierarchical' => false, 'label' => __('Materias'), 'query_var' => 'materias', 'rewrite' => array( 'slug' => 'c' ) ) );
	}
}
add_action( 'init', 'create_theme_taxonomy_mat', 1 ); // Añade la taxonomía MeSH para palabras clave


function create_theme_taxonomy_mate() {
	if (!is_taxonomy('materia')) {
		register_taxonomy( 'materia', array( 'sve' ), array( 'hierarchical' => false, 'label' => __('Materias'), 'query_var' => 'materia', 'rewrite' => array( 'slug' => 'd' ) ) );
	}
}
add_action( 'init', 'create_theme_taxonomy_mate', 1 ); // Añade la taxonomía MeSH para palabras clave


//---------------------------------------LIBROS-------------------------------------------------------//

function create_theme_taxonomy_libros() {
	if (!is_taxonomy('materias_libros')) {
		register_taxonomy( 'materias_libros', array( 'libro' ), array( 'hierarchical' => false, 'label' => __('Materias'), 'query_var' => 'materia_libros', 'rewrite' => array( 'slug' => 'libros' ) ) );
	}
}
add_action( 'init', 'create_theme_taxonomy_libros', 1 );

//-----------------------------------------------------------------------------------------------------//


function create_meta_box() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		$seccion = articulos;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );
		$seccion = casos;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );
		$seccion = prosalud;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );
		$seccion = perlas;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );
		$seccion = imagen;
		add_meta_box( 'new-meta-boxes-12', 'Imagen Médica', 'new_meta_boxes_12', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );
		$seccion = capsula;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );

		$seccion = video;
		add_meta_box( 'new-meta-boxes', 'Video de Medicina y Salud', 'new_meta_boxes', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );

		$seccion = eventos;
		add_meta_box( 'new-meta-boxes-7', 'Actividades y Eventos', 'new_meta_boxes_7', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-21', 'Temas Expuestos', 'new_meta_boxes_21', $seccion , 'normal', 'low' );

		$seccion = svp;
		add_meta_box( 'new-meta-boxes-13', 'Diapositivas de clase', 'new_meta_boxes_13', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-6', 'Códigos de materia', 'new_meta_boxes_6', $seccion, 'side', 'low' );

		$seccion = sve;
		add_meta_box( 'new-meta-boxes-25', 'Nuevo documento', 'new_meta_boxes_25', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );

		$seccion = reto;
		add_meta_box( 'new-meta-boxes-4', 'Imagen Reto', 'new_meta_boxes_4', $seccion , 'normal', 'low' );

		$seccion = colaboradores;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-3', 'Cargos de los autores', 'new_meta_boxes_3', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-12', 'Fotografía del colaborador', 'new_meta_boxes_12', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-20', 'Sitio Web', 'new_meta_boxes_20', $seccion , 'normal', 'low' );

		$seccion = miembros;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-12', 'Fotografía del miembro', 'new_meta_boxes_12', $seccion , 'normal', 'low' );

//---------------------------------------LIBROS-------------------------------------------------------//
		$seccion = libro;
		add_meta_box( 'new-meta-boxes-2', 'Autor(es)', 'new_meta_boxes_2', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-7', 'Información del Libro', 'new_meta_boxes_70', $seccion , 'normal', 'low' );
		add_meta_box( 'new-meta-boxes-25', 'Información Web del Libro', 'new_meta_boxes_250', $seccion , 'normal', 'low' );
//----------------------------------------------------------------------------------------------------//


	}
}

$new_meta_boxes =
	array(
	"image" => array(
		"name" => "imagen-reto",
		"std" => "",
		"title" => "Imagen Reto",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Aquí va la explicación de la Imagen Reto!")
	);


function new_meta_boxes() {
	global $post, $new_meta_boxes;
	foreach($new_meta_boxes as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, VMS_shot, true);
		$meta_box_value_2 = get_post_meta($post->ID, VMS_video, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	//echo'<h2>'.$meta_box['title'].'</h2>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/vms.js"></script>';
	echo '<p>Suba una imagen representativa del video publicado</p><label for="VMS_shot"><input id="VMS_shot" type="text" size="55" name="VMS_shot" value="'.$meta_box_value_1.'" /><input id="upload_image_button" type="button" value="Subir Imagen del video" /><br /></label>';

 	echo'<p><label for="VMS_video">Subir el video a través de la interfaz de WordTube y colocar el código aquí. Debe ser parecido a esto: <strong>[media id=1 width=620 height=465]</strong>. Para videos 4:3 <em>width=620 height=465</em> y widescreen: <em>width=620 height=349</em>. <a href="#">Ver Tutorial</a></label></p>';
 	echo'<input type="text" size="55" id="VMS_video" tabindex="6" name="VMS_video" value="'.$meta_box_value_2.'" />';

	}
}

function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;

	foreach($new_meta_boxes as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[VMS_shot];

	if(get_post_meta($post_id, VMS_shot) == "")
	add_post_meta($post_id, VMS_shot, $data, true);
	elseif($data != get_post_meta($post_id, VMS_shot, true))
	update_post_meta($post_id, VMS_shot, $data);
	elseif($data == "")
	delete_post_meta($post_id, VMS_shot, get_post_meta($post_id, VMS_shot, true));
	
	
	$data2 = $_POST[VMS_video];

	if(get_post_meta($post_id, VMS_video) == "")
	add_post_meta($post_id, VMS_video, $data2, true);
	elseif($data2 != get_post_meta($post_id, VMS_video, true))
	update_post_meta($post_id, VMS_video, $data2);
	elseif($data2 == "")
	delete_post_meta($post_id, VMS_video, get_post_meta($post_id, VMS_video, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

$new_meta_boxes_2 =
	array(
	"image" => array(
		"name" => "autores",
		"std" => "",
		"title" => "Autor(es)",
		"description" => "Separar autores por comas, colocar un símbolo con el tag html <em>&lt;sup&gt;</em>, ejemplo: <em>Tomás Owens &lt;sup&gt;&#167;&lt;/sup&gt;</em>. Algunos símbolos para usar dentro del tag <em>&lt;sup&gt;</em>: &#8224;, &#8225;, &#167;, *, &para;. <a href='#'>Ver Tutorial</a>")
	);

function new_meta_boxes_2() {
	global $post, $new_meta_boxes_2;
	foreach($new_meta_boxes_2 as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, autores, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	echo'<textarea class="attachmentlinks" id="autores" tabindex="6" name="autores" cols="40" rows="1">'.$meta_box_value.'</textarea>';
	echo'<p><label for="autores">'.$meta_box['description'].'</label></p>';
	}
}

function save_postdata_2( $post_id ) {
	global $post, $new_meta_boxes_2;

	foreach($new_meta_boxes_2 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[autores];

	if(get_post_meta($post_id, autores) == "")
	add_post_meta($post_id, autores, $data, true);
	elseif($data != get_post_meta($post_id, autores, true))
	update_post_meta($post_id, autores, $data);
	elseif($data == "")
	delete_post_meta($post_id, autores, get_post_meta($post_id, autores, true));
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_2');

$new_meta_boxes_20 =
	array(
	"image" => array(
		"name" => "sitio-web",
		"std" => "",
		"title" => "Sitio Web",
		"description1" => "Sitio web relacionado con el autor",
		"description2" => "Aquí va la explicación de la Imagen Reto!")
	);


function new_meta_boxes_20() {
	global $post, $new_meta_boxes_20;
	foreach($new_meta_boxes_20 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, col_web, true);
		$meta_box_value_2 = get_post_meta($post->ID, col_uri, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	//echo'<h2>'.$meta_box['title'].'</h2>';

	echo '<p>Escriba el nombre del sitio web del colaborador.</p><label for="col_web"><input id="col_web" type="text" size="55" name="col_web" value="'.$meta_box_value_1.'" /><br /></label>';

	echo '<p>Escriba el URI del sitio web del colaborador.</p><label for="col_web"><input id="col_web" type="text" size="55" name="col_web" value="'.$meta_box_value_2.'" /><br /></label>';

	}
}

function save_postdata_20( $post_id ) {
	global $post, $new_meta_boxes_20;

	foreach($new_meta_boxes_20 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[col_web];

	if(get_post_meta($post_id, col_web) == "")
	add_post_meta($post_id, col_web, $data, true);
	elseif($data != get_post_meta($post_id, col_web, true))
	update_post_meta($post_id, col_web, $data);
	elseif($data == "")
	delete_post_meta($post_id, col_web, get_post_meta($post_id, col_web, true));
	
	
	$data2 = $_POST[col_uri];

	if(get_post_meta($post_id, col_uri) == "")
	add_post_meta($post_id, col_uri, $data2, true);
	elseif($data2 != get_post_meta($post_id, col_uri, true))
	update_post_meta($post_id, col_uri, $data2);
	elseif($data2 == "")
	delete_post_meta($post_id, col_uri, get_post_meta($post_id, col_uri, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_20');

$new_meta_boxes_3 =
	array(
	"image" => array(
		"name" => "cargos",
		"std" => "",
		"title" => "Cargo(s)",
		"description" => "Aquí se describe el cargo de cada uno de los autores mencionados en el cuadro de texto anterior, colocar el símbolo con el tag html <em>&lt;sup&gt;</em> seguido de la descripción, ejemplo: <em>&lt;sup&gt;&#167;&lt;/sup&gt; Médico Especialista en Medicina Familiar</em>. <a href='#'>Ver Tutorial</a>")
	);

function new_meta_boxes_3() {
	global $post, $new_meta_boxes_3;
	foreach($new_meta_boxes_3 as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, cargos, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	//echo'<h2>'.$meta_box['title'].'</h2>';
	//echo'<input type="text" name="cargos" value="'.$meta_box_value.'" size="55" /><br />';
	echo'<textarea class="attachmentlinks" id="cargos" tabindex="6" name="cargos" cols="40" rows="1">'.$meta_box_value.'</textarea>';
	echo'<p><label for="cargos">'.$meta_box['description'].'</label></p>';
	}
}

function save_postdata_3( $post_id ) {
	global $post, $new_meta_boxes_3;

	foreach($new_meta_boxes_3 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[cargos];

	if(get_post_meta($post_id, cargos) == "")
	add_post_meta($post_id, cargos, $data, true);
	elseif($data != get_post_meta($post_id, cargos, true))
	update_post_meta($post_id, cargos, $data);
	elseif($data == "")
	delete_post_meta($post_id, cargos, get_post_meta($post_id, cargos, true));
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_3');

$new_meta_boxes_4 =
	array(
	"image" => array(
		"name" => "imagen-reto",
		"std" => "",
		"title" => "Imagen Reto",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Aquí va la explicación de la Imagen Reto!")
	);


function new_meta_boxes_4() {
	global $post, $new_meta_boxes_4;
	foreach($new_meta_boxes_4 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IR_imagen, true);
		$meta_box_value_2 = get_post_meta($post->ID, IR_respuesta, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	echo'<h2>'.$meta_box['title'].'</h2>';
// 	echo'<p><label for="IR_imagen">'.$meta_box['description1'].'</label></p>';
// 	echo'<input type="text" name="IR_imagen" value="'.$meta_box_value_1.'" size="55" /><br />';
// 	echo'<p><label for="IR_respuesta">'.$meta_box['description2'].'</label></p>';
// 	echo'<textarea class="attachmentlinks" id="IR_respuesta" tabindex="6" name="IR_respuesta" cols="40" rows="1">'.$meta_box_value_2.'</textarea>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/poster-reto.js"></script>';
	echo '<p>Suba la imagen</p><label for="IR_imagen"><input id="IR_imagen" type="text" size="55" name="IR_imagen" value="'.$meta_box_value_1.'" /><input id="upload_image_button" type="button" value="Subir Imagen Reto" /><br /></label>';

	}
}

function save_postdata_4( $post_id ) {
	global $post, $new_meta_boxes_4;

	foreach($new_meta_boxes_4 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[IR_imagen];

	if(get_post_meta($post_id, IR_imagen) == "")
	add_post_meta($post_id, IR_imagen, $data, true);
	elseif($data != get_post_meta($post_id, IR_imagen, true))
	update_post_meta($post_id, IR_imagen, $data);
	elseif($data == "")
	delete_post_meta($post_id, IR_imagen, get_post_meta($post_id, IR_imagen, true));
	
	
	$data2 = $_POST[IR_respuesta];

	if(get_post_meta($post_id, IR_respuesta) == "")
	add_post_meta($post_id, IR_respuesta, $data2, true);
	elseif($data2 != get_post_meta($post_id, IR_respuesta, true))
	update_post_meta($post_id, IR_respuesta, $data2);
	elseif($data2 == "")
	delete_post_meta($post_id, IR_respuesta, get_post_meta($post_id, IR_respuesta, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_4');


$new_meta_boxes_6 =
	array(
	"image" => array(
		"name" => "tutoriales",
		"std" => "",
		"title" => "Enlaces a tutoriales Telmeds",
		"description" => "Videotutoriales de explicación.")
	);
	
function new_meta_boxes_6() {
	echo '
<table style="width: 100%; text-align: center;">
<caption>Medicina</caption>
<thead>
<tr>
<th>Sem</th>
<th>Materia</th>
<th>Código</th>
</tr>
</thead>
<tbody>
<tr>
<td>I</td>
<td>Biología 1</td>
<td>MED 135A</td>
</tr>
</tbody>
</table>
';
}
add_action('admin_menu', 'create_meta_box');


$new_meta_boxes_7 =
	array(
	"image" => array(
		"name" => "actividades",
		"std" => "",
		"title" => "Actividades y Eventos",
		"description1" => "Fecha de inicio <strong>en formato aaaa-mm-dd</strong>",
		"description2" => "Fecha de finalización <strong>en formato aaaa-mm-dd</strong>",
		"description3" => "Lugar",
		"description4" => "Costo",
		"description5" => "Información de contacto",
		"description6" => "Póster. Use el botón \"Añadir una imagen\" para subir una imagen y después pegue el URI aquí.",
		"description7" => "Sitio web del evento (recordar poner el http:// por delante).",
		"description8" => "GeoData (latitud, longitud)",
		"description9" => "<strong>Algunos ejemplos: </strong><br />Auditorio de Farmacología: 8.982691,-79.534836<br />Bioquímica: 8.982272,-79.535437<br />Salón de Profesores: 8.981975,-79.534895",)
	);

function new_meta_boxes_7() {
	global $post, $new_meta_boxes_7;
	foreach($new_meta_boxes_7 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IP_fecha_inicio, true);
		$meta_box_value_2 = get_post_meta($post->ID, IP_fecha_final, true);
		$meta_box_value_3 = get_post_meta($post->ID, IP_lugar, true);
		$meta_box_value_4 = get_post_meta($post->ID, IP_costo, true);
		$meta_box_value_5 = get_post_meta($post->ID, IP_info_contacto, true);
		$meta_box_value_6 = get_post_meta($post->ID, IP_poster, true);
		$meta_box_value_7 = get_post_meta($post->ID, IP_web, true);
		$meta_box_value_8 = get_post_meta($post->ID, IP_geo, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	echo'<h2>Información General del Evento, Congreso o Diplomado</h2>';
	echo'<p><label for="IP_fecha_inicio">'.$meta_box['description1'].'</label></p>';
	echo'<input type="text" name="IP_fecha_inicio" value="'.$meta_box_value_1.'" size="55" /><br />';
	echo'<p><label for="IP_fecha_final">'.$meta_box['description2'].'</label></p>';
	echo'<input type="text" name="IP_fecha_final" value="'.$meta_box_value_2.'" size="55" /><br />';
	echo'<p><label for="IP_lugar">'.$meta_box['description3'].'</label></p>';
	echo'<input type="text" name="IP_lugar" value="'.$meta_box_value_3.'" size="55" /><br />';
	echo'<p><label for="IP_costo">'.$meta_box['description4'].'</label></p>';
	echo'<textarea class="attachmentlinks" id="IP_costo" tabindex="6" name="IP_costo" cols="40" rows="1">'.$meta_box_value_4.'</textarea>';
	echo'<p><label for="IP_info_contacto">'.$meta_box['description5'].'</label></p>';
	echo'<textarea class="attachmentlinks" id="IP_info_contacto" tabindex="6" name="IP_info_contacto" cols="40" rows="1">'.$meta_box_value_5.'</textarea>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/poster-ip.js"></script>';
	echo '<p>Suba el poster del evento</p><label for="IP_poster"><input id="IP_poster" type="text" size="55" name="IP_poster" value="'.$meta_box_value_6.'" /><input id="upload_image_button" type="button" value="Subir Imagen" /><br /></label>';

	echo'<p><label for="IP_web">'.$meta_box['description7'].'</label></p>';
	echo'<input type="text" name="IP_web" value="'.$meta_box_value_7.'" size="55" /><br />';
	echo'<h2>Información Geográfica del Evento</h2>';
	echo'<p><label for="IP_geo">'.$meta_box['description8'].'</label></p>';
	echo'<input type="text" name="IP_geo" value="'.$meta_box_value_8.'" size="55" /><br />';
	echo'<p><label for="IP_geo">'.$meta_box['description9'].'</label></p>';

	}
}

function save_postdata_7( $post_id ) {
	global $post, $new_meta_boxes_7;

	foreach($new_meta_boxes_7 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
			} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		}

		$data = $_POST[IP_fecha_inicio];

		if(get_post_meta($post_id, IP_fecha_inicio) == "")
			add_post_meta($post_id, IP_fecha_inicio, $data, true);
		elseif($data != get_post_meta($post_id, IP_fecha_inicio, true))
			update_post_meta($post_id, IP_fecha_inicio, $data);
		elseif($data == "")
			delete_post_meta($post_id, IP_fecha_inicio, get_post_meta($post_id, IP_fecha_inicio, true));
		
		
		$data2 = $_POST[IP_fecha_final];

		if(get_post_meta($post_id, IP_fecha_final) == "")
			add_post_meta($post_id, IP_fecha_final, $data2, true);
		elseif($data2 != get_post_meta($post_id, IP_fecha_final, true))
			update_post_meta($post_id, IP_fecha_final, $data2);
		elseif($data2 == "")
			delete_post_meta($post_id, IP_fecha_final, get_post_meta($post_id, IP_fecha_final, true));
			
		
		$data3 = $_POST[IP_lugar];

		if(get_post_meta($post_id, IP_lugar) == "")
			add_post_meta($post_id, IP_lugar, $data3, true);
		elseif($data3 != get_post_meta($post_id, IP_lugar, true))
			update_post_meta($post_id, IP_lugar, $data3);
		elseif($data3 == "")
			delete_post_meta($post_id, IP_lugar, get_post_meta($post_id, IP_lugar, true));
			
		
		$data4 = $_POST[IP_costo];

		if(get_post_meta($post_id, IP_costo) == "")
			add_post_meta($post_id, IP_costo, $data4, true);
		elseif($data4 != get_post_meta($post_id, IP_costo, true))
			update_post_meta($post_id, IP_costo, $data4);
		elseif($data4 == "")
			delete_post_meta($post_id, IP_costo, get_post_meta($post_id, IP_costo, true));
		
		
		$data5 = $_POST[IP_info_contacto];

		if(get_post_meta($post_id, IP_info_contacto) == "")
			add_post_meta($post_id, IP_info_contacto, $data5, true);
		elseif($data5 != get_post_meta($post_id, IP_info_contacto, true))
			update_post_meta($post_id, IP_info_contacto, $data5);
		elseif($data5 == "")
			delete_post_meta($post_id, IP_info_contacto, get_post_meta($post_id, IP_info_contacto, true));
		
		
		$data6 = $_POST[IP_poster];

		if(get_post_meta($post_id, IP_poster) == "")
			add_post_meta($post_id, IP_poster, $data6, true);
		elseif($data6 != get_post_meta($post_id, IP_poster, true))
			update_post_meta($post_id, IP_poster, $data6);
		elseif($data6 == "")
			delete_post_meta($post_id, IP_poster, get_post_meta($post_id, IP_poster, true));
		
		
		$data7 = $_POST[IP_web];

		if(get_post_meta($post_id, IP_web) == "")
			add_post_meta($post_id, IP_web, $data7, true);
		elseif($data7 != get_post_meta($post_id, IP_web, true))
			update_post_meta($post_id, IP_web, $data7);
		elseif($data7 == "")
			delete_post_meta($post_id, IP_web, get_post_meta($post_id, IP_web, true));
			
		
		$data8 = $_POST[IP_geo];

		if(get_post_meta($post_id, IP_geo) == "")
			add_post_meta($post_id, IP_geo, $data8, true);
		elseif($data8 != get_post_meta($post_id, IP_geo, true))
			update_post_meta($post_id, IP_geo, $data8);
		elseif($data8 == "")
			delete_post_meta($post_id, IP_web, get_post_meta($post_id, IP_geo, true));
	}
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_7');

$new_meta_boxes_10 =
	array(
	"image" => array(
		"name" => "tquiz",
		"std" => "",
		"title" => "Telmeds Quiz",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Pegue aquí el código del quiz. <a href='#'>Ver Tutorial</a>"),
	);


function new_meta_boxes_10() {
	global $post, $new_meta_boxes_10;
	foreach($new_meta_boxes_10 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, TQ_imagen, true);
		$meta_box_value_2 = get_post_meta($post->ID, TQ_id, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	echo'<h2>'.$meta_box['title'].'</h2>';
	echo'<p><label for="TQ_imagen">'.$meta_box['description1'].'</label></p>';
	echo'<input type="text" name="TQ_imagen" value="'.$meta_box_value_1.'" size="55" /><br />';
	echo'<p><label for="TQ_id">'.$meta_box['description2'].'</label></p>';
	echo'<input type="text" name="TQ_id" value="'.$meta_box_value_2.'" size="55" /><br />';

	}
}

function save_postdata_10( $post_id ) {
	global $post, $new_meta_boxes_10;

	foreach($new_meta_boxes_10 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[TQ_imagen];
	$data_ = TQ_imagen;

	if(get_post_meta($post_id, $data_) == "")
	add_post_meta($post_id, $data_, $data, true);
	elseif($data != get_post_meta($post_id, $data_, true))
	update_post_meta($post_id, $data_, $data);
	elseif($data == "")
	delete_post_meta($post_id, $data_, get_post_meta($post_id, $data_, true));
	
	
	$data1 = $_POST[TQ_id];
	$data1_ = TQ_id;

	if(get_post_meta($post_id, $data1_) == "")
	add_post_meta($post_id, $data1_, $data1, true);
	elseif($data1 != get_post_meta($post_id, $data1_, true))
	update_post_meta($post_id, $data1_, $data1);
	elseif($data1 == "")
	delete_post_meta($post_id, $data1_, get_post_meta($post_id, $data1_, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_10');

$new_meta_boxes_12 =
	array(
	"image" => array(
		"name" => "ims",
		"std" => "",
		"title" => "Imagen para mostrar",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Escriba aquí la descripción de la imagen."),
	);


function new_meta_boxes_12() {
	global $post, $new_meta_boxes_12;
	foreach($new_meta_boxes_12 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IMS_imagen, true);
		$meta_box_value_2 = get_post_meta($post->ID, IMS_descripcion, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	echo'<h2>'.$meta_box['title'].'</h2>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/poster-ims.js"></script>';
	echo '<p>Suba la imagen</p><label for="IMS_imagen"><input id="IMS_imagen" type="text" size="55" name="IMS_imagen" value="'.$meta_box_value_1.'" /><input id="upload_image_button" type="button" value="Subir Imagen" /><br /></label>';

	}
}

function save_postdata_12( $post_id ) {
	global $post, $new_meta_boxes_12;

	foreach($new_meta_boxes_12 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[IMS_imagen];
	$data_ = IMS_imagen;

	if(get_post_meta($post_id, $data_) == "")
	add_post_meta($post_id, $data_, $data, true);
	elseif($data != get_post_meta($post_id, $data_, true))
	update_post_meta($post_id, $data_, $data);
	elseif($data == "")
	delete_post_meta($post_id, $data_, get_post_meta($post_id, $data_, true));
	
	
	$data1 = $_POST[IMS_descripcion];
	$data1_ = IMS_descripcion;

	if(get_post_meta($post_id, $data1_) == "")
	add_post_meta($post_id, $data1_, $data1, true);
	elseif($data1 != get_post_meta($post_id, $data1_, true))
	update_post_meta($post_id, $data1_, $data1);
	elseif($data1 == "")
	delete_post_meta($post_id, $data1_, get_post_meta($post_id, $data1_, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_12');

$new_meta_boxes_13 =
	array(
	"image" => array(
		"name" => "ims",
		"std" => "",
		"title" => "Imagen para mostrar",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Escriba aquí la descripción de la imagen."),
	);


function new_meta_boxes_13() {
	global $post, $new_meta_boxes_13;
	foreach($new_meta_boxes_13 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IMS_imagen, true);
		$meta_box_value_2 = get_post_meta($post->ID, IR_imagen, true);
		$meta_box_value_3 = get_post_meta($post->ID, swf, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

 	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
// 	echo'<h2>'.$meta_box['title'].'</h2>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/poster-ims.js"></script>';
	echo '<p>Suba la imagen</p><label for="IMS_imagen"><input id="IMS_imagen" type="text" size="60" name="IMS_imagen" value="'.$meta_box_value_1.'" /><input id="upload_image_button" type="button" value="Subir Imagen" /><br /></label>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/svp.js"></script>';
	echo '<p>Suba las diapositivas</p><label for="IR_imagen"><input id="IR_imagen" type="text" size="60" name="IR_imagen" value="'.$meta_box_value_2.'" /><input id="upload_object_button" type="button" value="Subir Diapositivas" /><br /></label>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/swf.js"></script>';
	echo '<p>Suba el archivo swf</p><label for="swf"><input id="swf" type="text" size="60" name="swf" value="'.$meta_box_value_3.'" /><input id="upload_swf_button" type="button" value="Subir swf" /><br /></label>';

	}
}

function save_postdata_13( $post_id ) {
	global $post, $new_meta_boxes_13;

	foreach($new_meta_boxes_13 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[IMS_imagen];
	$data_ = IMS_imagen;

	if(get_post_meta($post_id, $data_) == "")
	add_post_meta($post_id, $data_, $data, true);
	elseif($data != get_post_meta($post_id, $data_, true))
	update_post_meta($post_id, $data_, $data);
	elseif($data == "")
	delete_post_meta($post_id, $data_, get_post_meta($post_id, $data_, true));
	

	$data1 = $_POST[IR_imagen];

	if(get_post_meta($post_id, IR_imagen) == "")
	add_post_meta($post_id, IR_imagen, $data1, true);
	elseif($data1 != get_post_meta($post_id, IR_imagen, true))
	update_post_meta($post_id, IR_imagen, $data1);
	elseif($data1 == "")
	delete_post_meta($post_id, IR_imagen, get_post_meta($post_id, IR_imagen, true));

	$data2 = $_POST[swf];

	if(get_post_meta($post_id, swf) == "")
	add_post_meta($post_id, swf, $data2, true);
	elseif($data2 != get_post_meta($post_id, swf, true))
	update_post_meta($post_id, swf, $data2);
	elseif($data2 == "")
	delete_post_meta($post_id, swf, get_post_meta($post_id, swf, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_13');

$new_meta_boxes_25 =
	array(
	"image" => array(
		"name" => "ims",
		"std" => "",
		"title" => "Imagen para mostrar",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Escriba aquí la descripción de la imagen."),
	);


function new_meta_boxes_25() {
	global $post, $new_meta_boxes_25;
	foreach($new_meta_boxes_25 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IMS_imagen, true);
		$meta_box_value_2 = get_post_meta($post->ID, IR_imagen, true);
		$meta_box_value_3 = get_post_meta($post->ID, swf, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

 	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
// 	echo'<h2>'.$meta_box['title'].'</h2>';

	echo '<p>Título</p><label for="IMS_imagen"><input id="IMS_imagen" type="text" size="60" name="IMS_imagen" value="'.$meta_box_value_1.'" /><br /></label>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/svp.js"></script>';
	echo '<p>Suba las diapositivas</p><label for="IR_imagen"><input id="IR_imagen" type="text" size="60" name="IR_imagen" value="'.$meta_box_value_2.'" /><input id="upload_object_button" type="button" value="Subir Diapositivas" /><br /></label>';

	echo '<p>Rating <em>(escriba [rating=n] donde n es un número menor o igual a 5)</em></p><label for="swf"><input id="swf" type="text" size="60" name="swf" value="'.$meta_box_value_3.'" /><br /></label>';

	}
}

function save_postdata_25( $post_id ) {
	global $post, $new_meta_boxes_25;

	foreach($new_meta_boxes_25 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[IMS_imagen];
	$data_ = IMS_imagen;

	if(get_post_meta($post_id, $data_) == "")
	add_post_meta($post_id, $data_, $data, true);
	elseif($data != get_post_meta($post_id, $data_, true))
	update_post_meta($post_id, $data_, $data);
	elseif($data == "")
	delete_post_meta($post_id, $data_, get_post_meta($post_id, $data_, true));
	

	$data1 = $_POST[IR_imagen];

	if(get_post_meta($post_id, IR_imagen) == "")
	add_post_meta($post_id, IR_imagen, $data1, true);
	elseif($data1 != get_post_meta($post_id, IR_imagen, true))
	update_post_meta($post_id, IR_imagen, $data1);
	elseif($data1 == "")
	delete_post_meta($post_id, IR_imagen, get_post_meta($post_id, IR_imagen, true));

	$data2 = $_POST[swf];

	if(get_post_meta($post_id, swf) == "")
	add_post_meta($post_id, swf, $data2, true);
	elseif($data2 != get_post_meta($post_id, swf, true))
	update_post_meta($post_id, swf, $data2);
	elseif($data2 == "")
	delete_post_meta($post_id, swf, get_post_meta($post_id, swf, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_25');

$new_meta_boxes_21 =
	array(
	"image" => array(
		"name" => "temas",
		"std" => "",
		"title" => "Imagen para mostrar",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Escriba aquí la descripción de la imagen."),
	);


function new_meta_boxes_21() {
	global $post, $new_meta_boxes_21;
	foreach($new_meta_boxes_21 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IP_temas, true);


		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

 	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

	echo '<script type="text/javascript">/* <![CDATA[ */jQuery(document).ready( function () { jQuery("#IP_temas").addClass("mceEditor"); if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) { tinyMCE.execCommand("mceAddControl", false, "IP_temas"); } }); /* ]]> */ </script>';
	echo '<textarea name="IP_temas" id="IP_temas">'.$meta_box_value_1.'</textarea>';

	}
}

function save_postdata_21( $post_id ) {
	global $post, $new_meta_boxes_21;

	foreach($new_meta_boxes_21 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[IP_temas];
	$data_ = IP_temas;

	if(get_post_meta($post_id, $data_) == "")
	add_post_meta($post_id, $data_, $data, true);
	elseif($data != get_post_meta($post_id, $data_, true))
	update_post_meta($post_id, $data_, $data);
	elseif($data == "")
	delete_post_meta($post_id, $data_, get_post_meta($post_id, $data_, true));
	
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_21');

$new_meta_boxes_70 =
	array(
	"image" => array(
		"name" => "actividades",
		"std" => "",
		"title" => "Actividades y Eventos",
		"description1" => "ISBN-10 <small>(retirar los guiones)</small>",
		"description2" => "ISBN-13 <small>(retirar los guiones)</small> <strong>Reemplazar con este número el permalink</strong>",
		"description3" => "Editor",
		"description4" => "Edición <small>(solo números)</small>",
		"description5" => "Formato",
		"description6" => "Portada. Use el botón \"Añadir una imagen\" para subir una imagen y después pegue el URI aquí.",
		"description7" => "Dirección de descarga (recordar poner el http:// por delante).",
		"description8" => "Dirección en Amazon",
		)
	);

//----------------------------------------LIBROS-------------------------------------------------------//

function new_meta_boxes_70() {
	global $post, $new_meta_boxes_70;
	foreach($new_meta_boxes_70 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IP_fecha_inicio, true);
		$meta_box_value_2 = get_post_meta($post->ID, IP_fecha_final, true);
		$meta_box_value_3 = get_post_meta($post->ID, IP_lugar, true);
		$meta_box_value_4 = get_post_meta($post->ID, IP_costo, true);
		$meta_box_value_5 = get_post_meta($post->ID, IP_info_contacto, true);
		$meta_box_value_6 = get_post_meta($post->ID, IP_poster, true);
		$meta_box_value_7 = get_post_meta($post->ID, IP_web, true);
		$meta_box_value_8 = get_post_meta($post->ID, IP_geo, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	echo'<h2>Información General del Libro</h2>';
	echo'<p><label for="IP_fecha_inicio">'.$meta_box['description1'].'</label></p>';
	echo'<input type="text" name="IP_fecha_inicio" value="'.$meta_box_value_1.'" size="55" /><br />';
	echo'<p><label for="IP_fecha_final">'.$meta_box['description2'].'</label></p>';
	echo'<input type="text" name="IP_fecha_final" value="'.$meta_box_value_2.'" size="55" /><br />';
	echo'<p><label for="IP_lugar">'.$meta_box['description3'].'</label></p>';
	echo'<input type="text" name="IP_lugar" value="'.$meta_box_value_3.'" size="55" /><br />';
	echo'<p><label for="IP_costo">'.$meta_box['description4'].'</label></p>';
	echo'<input type="text" name="IP_costo" value="'.$meta_box_value_4.'" size="55" /><br />';
	echo'<p><label for="IP_info_contacto">'.$meta_box['description5'].'</label></p>';
	echo'<input type="text" name="IP_info_contacto" value="'.$meta_box_value_5.'" size="55" /><br />';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/poster-ip.js"></script>';
	echo '<p>Portada del documento</p><label for="IP_poster"><input id="IP_poster" type="text" size="75" name="IP_poster" value="'.$meta_box_value_6.'" /><input id="upload_image_button" type="button" value="Subir Imagen" /><br /></label>';

	echo'<p><label for="IP_geo">'.$meta_box['description8'].'</label></p>';
	echo'<input type="text" name="IP_geo" value="'.$meta_box_value_8.'" size="75" /><br />';

	}
}

function save_postdata_70( $post_id ) {
	global $post, $new_meta_boxes_70;

	foreach($new_meta_boxes_70 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
			} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		}

		$data = $_POST[IP_fecha_inicio];

		if(get_post_meta($post_id, IP_fecha_inicio) == "")
			add_post_meta($post_id, IP_fecha_inicio, $data, true);
		elseif($data != get_post_meta($post_id, IP_fecha_inicio, true))
			update_post_meta($post_id, IP_fecha_inicio, $data);
		elseif($data == "")
			delete_post_meta($post_id, IP_fecha_inicio, get_post_meta($post_id, IP_fecha_inicio, true));
		
		
		$data2 = $_POST[IP_fecha_final];

		if(get_post_meta($post_id, IP_fecha_final) == "")
			add_post_meta($post_id, IP_fecha_final, $data2, true);
		elseif($data2 != get_post_meta($post_id, IP_fecha_final, true))
			update_post_meta($post_id, IP_fecha_final, $data2);
		elseif($data2 == "")
			delete_post_meta($post_id, IP_fecha_final, get_post_meta($post_id, IP_fecha_final, true));
			
		
		$data3 = $_POST[IP_lugar];

		if(get_post_meta($post_id, IP_lugar) == "")
			add_post_meta($post_id, IP_lugar, $data3, true);
		elseif($data3 != get_post_meta($post_id, IP_lugar, true))
			update_post_meta($post_id, IP_lugar, $data3);
		elseif($data3 == "")
			delete_post_meta($post_id, IP_lugar, get_post_meta($post_id, IP_lugar, true));
			
		
		$data4 = $_POST[IP_costo];

		if(get_post_meta($post_id, IP_costo) == "")
			add_post_meta($post_id, IP_costo, $data4, true);
		elseif($data4 != get_post_meta($post_id, IP_costo, true))
			update_post_meta($post_id, IP_costo, $data4);
		elseif($data4 == "")
			delete_post_meta($post_id, IP_costo, get_post_meta($post_id, IP_costo, true));
		
		
		$data5 = $_POST[IP_info_contacto];

		if(get_post_meta($post_id, IP_info_contacto) == "")
			add_post_meta($post_id, IP_info_contacto, $data5, true);
		elseif($data5 != get_post_meta($post_id, IP_info_contacto, true))
			update_post_meta($post_id, IP_info_contacto, $data5);
		elseif($data5 == "")
			delete_post_meta($post_id, IP_info_contacto, get_post_meta($post_id, IP_info_contacto, true));
		
		
		$data6 = $_POST[IP_poster];

		if(get_post_meta($post_id, IP_poster) == "")
			add_post_meta($post_id, IP_poster, $data6, true);
		elseif($data6 != get_post_meta($post_id, IP_poster, true))
			update_post_meta($post_id, IP_poster, $data6);
		elseif($data6 == "")
			delete_post_meta($post_id, IP_poster, get_post_meta($post_id, IP_poster, true));
		
		
		$data7 = $_POST[IP_web];

		if(get_post_meta($post_id, IP_web) == "")
			add_post_meta($post_id, IP_web, $data7, true);
		elseif($data7 != get_post_meta($post_id, IP_web, true))
			update_post_meta($post_id, IP_web, $data7);
		elseif($data7 == "")
			delete_post_meta($post_id, IP_web, get_post_meta($post_id, IP_web, true));
			
		
		$data8 = $_POST[IP_geo];

		if(get_post_meta($post_id, IP_geo) == "")
			add_post_meta($post_id, IP_geo, $data8, true);
		elseif($data8 != get_post_meta($post_id, IP_geo, true))
			update_post_meta($post_id, IP_geo, $data8);
		elseif($data8 == "")
			delete_post_meta($post_id, IP_web, get_post_meta($post_id, IP_geo, true));
	}
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_70');

$new_meta_boxes_250 =
	array(
	"image" => array(
		"name" => "ims",
		"std" => "",
		"title" => "Imagen para mostrar",
		"description1" => "Use el botón \"<em>Añadir una imagen</em>\" para subir una imagen y después pegue el URI aquí. <a href='#'>Ver Tutorial</a>",
		"description2" => "Escriba aquí la descripción de la imagen."),
	);


function new_meta_boxes_250() {
	global $post, $new_meta_boxes_250;
	foreach($new_meta_boxes_250 as $meta_box) {
		$meta_box_value_1 = get_post_meta($post->ID, IMS_imagen, true);
		$meta_box_value_2 = get_post_meta($post->ID, IR_imagen, true);
		$meta_box_value_3 = get_post_meta($post->ID, swf, true);
		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

 	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
// 	echo'<h2>'.$meta_box['title'].'</h2>';

	echo '<p>Clave de apertura del 7z</p><label for="IMS_imagen"><input id="IMS_imagen" type="text" size="60" name="IMS_imagen" value="'.$meta_box_value_1.'" /><br /></label>';

	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() .'/js/svp.js"></script>';
	echo '<p>Suba el libro en 7z</p><label for="IR_imagen"><input id="IR_imagen" type="text" size="60" name="IR_imagen" value="'.$meta_box_value_2.'" /><input id="upload_object_button" type="button" value="Subir Libro" /><br /></label>';

	echo '<p>Calidad del documento <em>(escriba [rating=n] donde n es un número menor o igual a 5)</em></p><label for="swf"><input id="swf" type="text" size="60" name="swf" value="'.$meta_box_value_3.'" /><br /></label>';

	}
}

function save_postdata_250( $post_id ) {
	global $post, $new_meta_boxes_250;

	foreach($new_meta_boxes_250 as $meta_box) {
	// Verify
	if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
	return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
		return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	}

	$data = $_POST[IMS_imagen];
	$data_ = IMS_imagen;

	if(get_post_meta($post_id, $data_) == "")
	add_post_meta($post_id, $data_, $data, true);
	elseif($data != get_post_meta($post_id, $data_, true))
	update_post_meta($post_id, $data_, $data);
	elseif($data == "")
	delete_post_meta($post_id, $data_, get_post_meta($post_id, $data_, true));
	

	$data1 = $_POST[IR_imagen];

	if(get_post_meta($post_id, IR_imagen) == "")
	add_post_meta($post_id, IR_imagen, $data1, true);
	elseif($data1 != get_post_meta($post_id, IR_imagen, true))
	update_post_meta($post_id, IR_imagen, $data1);
	elseif($data1 == "")
	delete_post_meta($post_id, IR_imagen, get_post_meta($post_id, IR_imagen, true));

	$data2 = $_POST[swf];

	if(get_post_meta($post_id, swf) == "")
	add_post_meta($post_id, swf, $data2, true);
	elseif($data2 != get_post_meta($post_id, swf, true))
	update_post_meta($post_id, swf, $data2);
	elseif($data2 == "")
	delete_post_meta($post_id, swf, get_post_meta($post_id, swf, true));
	
	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata_250');

//----------------------------------------------------------------------------------------------------//


function med_dashboard_right_now() {
        //Libros
        $med_cat = libro;
	$med_cat_s = Libro;
	$med_cat_p = Libro;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';


	// Artículos
	$med_cat = articulos;
	$med_cat_s = Artículo;
	$med_cat_p = Artículos;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = capsula;
	$med_cat_s = Cápsula;
	$med_cat_p = Cáspulas;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = casos;
	$med_cat_s = Caso;
	$med_cat_p = Casos;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = prosalud;
	$med_cat_s = ProSalud;
	$med_cat_p = ProSalud;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = perlas;
	$med_cat_s = Perla;
	$med_cat_p = Perlas;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = reto;
	$med_cat_s = Reto;
	$med_cat_p = Retos;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = imagen;
	$med_cat_s = Imagen;
	$med_cat_p = Imágenes;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = video;
	$med_cat_s = Video;
	$med_cat_p = Videos;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// 
	$med_cat = quiz;
	$med_cat_s = Quiz;
	$med_cat_p = Quizes;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	$num_tags = wp_count_terms('mesh');

	// 
	$med_cat = eventos;
	$med_cat_s = Evento;
	$med_cat_p = Eventos;
	$med_cat_count = wp_count_posts( $med_cat );

	$num = number_format_i18n( $med_cat_count->publish );
	$text = _n( $med_cat_s , $med_cat_p , $med_cat_count->publish );
	if ( current_user_can( 'edit_pages' ) ) {
		$num = "<a href='edit.php?post_type=$med_cat'>$num</a>";
		$text = "<a href='edit.php?post_type=$med_cat'>$text</a>";
	}
	echo '<td class="first b b_pages">' . $num . '</td>';
	echo '<td class="t pages">' . $text . '</td>';

	echo '</tr><tr>';

	// MeSH
	$num = number_format_i18n( $num_tags );
	$text = _n( 'Etiqueta MeSH', 'Etiquetas MeSH', $num_tags );
	if ( current_user_can( 'manage_categories' ) ) {
		$num = "<a href='edit-tags.php?taxonomy=mesh'>$num</a>";
		$text = "<a href='edit-tags.php?taxonomy=mesh'>$text</a>";
	}
	echo '<td class="first b b-tags">' . $num . '</td>';
	echo '<td class="t tags">' . $text . '</td>';
}
add_action("right_now_content_table_end", "med_dashboard_right_now");

//



add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-eventos_columns", "my_eventos_columns");
 
function my_eventos_columns($columns)
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Evento",
		"datei" => "Inicio <span style='font-size: 0.8em; font-weight: normal;'>(aaaa-mm-dd)</span>",
		"datef" => "Finalización <span style='font-size: 0.8em; font-weight: normal;'>(aaaa-mm-dd)</span>",
		"lugar" => "Lugar",
		//"expirationdate" => "Fecha de inactivación",
	);	
	return $columns;
}
 
function my_custom_columns($column)
{
	global $post;
	$finicio = get_post_meta($post->ID, 'IP_fecha_inicio');
	$ffinal = get_post_meta($post->ID, 'IP_fecha_final');
	$flugar = get_post_meta($post->ID, 'IP_lugar');
	$svpautor = get_post_meta($post->ID, 'autores');

	$titlealtv = get_post_meta($post->ID, 'IMS_imagen');

	if ("ID" == $column) echo '<a href="'. get_edit_post_link($post->ID) .'">'. $post->ID .'</a>';
	elseif ("datei" == $column) echo $finicio[0];
	elseif ("datef" == $column) echo $ffinal[0];
	elseif ("lugar" == $column) echo $flugar[0];
	elseif ("svpautor" == $column) echo $svpautor[0];
	elseif ("materias" == $column) echo get_the_term_list($post->ID, 'materias', '', ', ', '');
	elseif ("materia" == $column) echo get_the_term_list($post->ID, 'materia', '', ', ', '');
        elseif ("materias_libros" == $column) echo get_the_term_list($post->ID, 'materias_libros', '', ', ', '');
	elseif ("titlealt" == $column) echo $titlealtv[0];
}

add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-svp_columns", "my_svp_columns");
 
function my_svp_columns($columns)
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Clase",
		"materias" => "Materias",
		"svpautor" => "Autor",
		"author" => "Subido por",
		"comments" => '<div class="vers"><img src="http://www.telmeds.net/wp-admin/images/comment-grey-bubble.png" alt="Comments"></div>',
		"date" => "Fecha",
	);
	return $columns;
}

add_filter("manage_edit-sve_columns", "my_sve_columns");
function my_sve_columns($columns)
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"ID" => "ID",
		"titlealt" => "Nombre del documento <style>#ID {width: 4em;} #materia, #svpautor, #author {width:10em;}</style>",
		"materia" => "Materias",
		"svpautor" => "Autor",
		"author" => "Subido por",
		"comments" => '<div class="vers"><img src="http://www.telmeds.net/wp-admin/images/comment-grey-bubble.png" alt="Comments"></div>',
		"date" => "Fecha",
	);
	return $columns;
}

//---------------------------------------LIBROS-------------------------------------------------------//
//add_filter("manage_edit-libro_columns", "my_libro_columns");
function my_libro_columns($columns)
{
	$columns = array(
                "cb" => "<input type=\"checkbox\" />",
		"titlealt" => "Libro <style>#materias_libros, #svpautor, #author {width:10em;}</style>",
		"materias_libros" => "Materias",
		"svpautor" => "Autor",
		"author" => "Subido por",
		"comments" => '<div class="vers"><img src="http://www.telmeds.net/wp-admin/images/comment-grey-bubble.png" alt="Comments"></div>',
		"date" => "Fecha",
	);
	return $columns;
}
//---------------------------------------------------------------------------------------------------//

add_editor_style('editor-estilos.css');

function byteConvert( $bytes ) {
	if ($bytes<=0)
	return '0 Byte';
$convention=1000; //[1000->10^x|1024->2^x]
$s=array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB');
$e=floor(log($bytes,$convention));
return round($bytes/pow($convention,$e),2).' '.$s[$e];
}

// Insert Rating function
function insertRating($attr) {
	// defaults
	if (!$attr['stars'] && !$attr[0]) {
		$attr['stars'] = 0;
	}
	$rs = '&#9733;';
	$ts = 5;
	$theRating .= '<span class="rating">';
	// output stars
	if ($attr['stars']) {
		$total_stars = $attr['stars'];
	} else if ($attr[0]) {
		$total_stars = str_replace( "=" , "" , $attr[0] ) ;
		$total_stars = str_replace( '"' , "" , $total_stars ) ;
		$total_stars = str_replace( '/' , "" , $total_stars ) ;
	}
	// output
	for ($i=0; $i<$total_stars; $i++) {
		$theRating .= '<span>' . $rs . '</span>';
	}
	if (!is_feed()) {
		// output empty stars
		$empty = $ts - $total_stars;
		for ($j=0; $j<$empty; $j++) {
			$theRating .= '<span class="empty">' . $rs . '</span>';
		}
	}
	$theRating .= '</span>';
	return $theRating;

}
add_shortcode('rating', 'insertRating');

function contenido_limite($max_char, $stripteaser = 0) {
	$content = get_the_content();
	$content = apply_filters('the_content', $content);
	$content = str_replace('/<(.|\n)*?>/g', '', $content);
	$content = strip_tags($content);

	if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ",
$max_char ))) {
		$content = substr($content, 0, $espacio);
		$content = $content;
		echo $content;
		echo "&nbsp;...";
	}

	else {
		echo $content;
	}
}

add_filter('protected_title_format', 'no_title_prefix');
add_filter('private_title_format', 'no_title_prefix');
function no_title_prefix( $prefix ) {
	return '%s';
}

function atlas_autores($atts) {
	extract(shortcode_atts(array(
		'id' => '',
		'nombre' => '',
		'detalle' => 'ídem',
	), $atts));

/*	print "{$nombre}<sup>{$id}</sup>, ";

	return "<br /><sup>{$id}</sup> {$detalle}";
*/

	return "{$nombre} ({$detalle}),";

}
add_shortcode('autor', 'atlas_autores');

add_action('admin_head', 'hide_menus');
function hide_menus() {
	if ( !current_user_can('manage_options') ) {
		?>
		<style>
		   #menu-posts {
				display:none;
			}
		</style>
		<?php
	}
}

/*
Plugin Name: Ozh' Simpler Login URL
Plugin URI: http://planetozh.com/blog/2011/01/pretty-login-url-a-simple-rewrite-api-plugin-example/
Description: Pretty Login URL: /login instead of /wp-login.php (a Rewrite API example)
Version: 0.1
Author: Ozh
Author URI: http://ozh.org/
*/

// Add rewrite rule and flush on plugin activation
register_activation_hook( __FILE__, 'wp_ozh_plu_activate' );
function wp_ozh_plu_activate() {
	wp_ozh_plu_rewrite();
	flush_rewrite_rules();
}

// Flush on plugin deactivation
register_deactivation_hook( __FILE__, 'wp_ozh_plu_deactivate' );
function wp_ozh_plu_deactivate() {
	flush_rewrite_rules();
}

// Create new rewrite rule
add_action( 'init', 'wp_ozh_plu_rewrite' );
function wp_ozh_plu_rewrite() {
	add_rewrite_rule( 'entrar/?$', 'wp-login.php', 'top' );
}

?>