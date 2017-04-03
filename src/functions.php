<?php

//No directly files load

if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

if ( ! function_exists( 'theme_setup_features' ) ) {

	function theme_setup_features() {

		 /* nav menu registrations */

		register_nav_menus(
			array(
			    'menu-desktop'         => 'Menu Desktop',
				'footer-menu'		=> 'Footer Menu',
				'mobile-menu'		=> 'Mobile Menu',
				'extra-menu'		=> 'Extra Menu 1',
				'extra-menu-2'	    => 'Extra Menu 2',
			)
		);


		register_sidebar(
			array(
				'name'          => __( 'Home Widgets', 'theme_text_domain' ),
				'id'            => 'home-widgets',
				'description'   => 'Configura os Widgets da Homepage',
				'class'         => '',
				'before_widget' => '<li>',
				'after_widget'  => '</li>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			)

		);


		register_sidebar(
			array(
				'name'          => __( 'Single Posts', 'theme_text_domain' ),
				'id'            => 'single-post-sidebar',
				'description'   => 'Configura os Widgets da Single',
				'class'         => '',
				'before_widget' => '<li>',
				'after_widget'  => '</li>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
			)

		);

		
		/*
		 * add theme support for thumbnails
		 */

		add_theme_support( 'post-thumbnails' );
		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array(
		    'aside',
		    'gallery',
		    'link',
		    'image',
		    'quote',
		    'status',
		    'video',
		    'audio',
		    'chat'
		) );

		/**
		 * Support The Excerpt on pages.
		 */
		add_post_type_support( 'page', 'excerpt' );
		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}


function excerptExists() {
	
	if ( has_excerpt( $post->ID ) ) {

	    the_excerpt();
	    echo '<a class="btn-default btn-excerpt" href="'. get_permalink($post->ID) . '"> LEIA MAIS </a>';
	}

	 else {
	   
    the_excerpt();

	}
	
}

// Sets the thumbnail image size
//add_image_size( 'Name', width, height, array( 'center', 'center' ) );

add_image_size( 'Box Thumbnail', 200, 200, array( 'center', 'center' ) );
add_image_size( 'Horizontal Large', 1920, 480, array( 'top', 'center' ) );
add_image_size( 'Noticias', 900, 300, array('center', 'center'));

// Register Custom Post Type
function Carousel() {

	$labels = array(
		'name'                  => _x( 'Carousel', 'Post Type General Name', 'Carousel' ),
		'singular_name'         => _x( 'Carousel', 'Post Type Singular Name', 'Carousel' ),
		'menu_name'             => __( 'Carousel', 'Carousel' ),
		'name_admin_bar'        => __( 'Carousel', 'Carousel' ),
		'archives'              => __( 'Item Archives', 'Carousel' ),
		'parent_item_colon'     => __( 'Parent Item:', 'Carousel' ),
		'all_items'             => __( 'Todos Items', 'Carousel' ),
		'add_new_item'          => __( 'Add Novo Item', 'Carousel' ),
		'add_new'               => __( 'Add novo', 'Carousel' ),
		'new_item'              => __( 'Novo Item', 'Carousel' ),
		'edit_item'             => __( 'Editar Item', 'Carousel' ),
		'update_item'           => __( 'Atualizar Item', 'Carousel' ),
		'view_item'             => __( 'Visualizar Item', 'Carousel' ),
		'search_items'          => __( 'Buscar Item', 'Carousel' ),
		'not_found'             => __( 'Não Encontrado', 'Carousel' ),
		'not_found_in_trash'    => __( 'Não encontrado na lixeira', 'Carousel' ),
		'featured_image'        => __( 'Imagem em Destaque', 'Carousel' ),
		'set_featured_image'    => __( 'Configurar Imagem em Destaque', 'Carousel' ),
		'remove_featured_image' => __( 'Remover Imagem em Destaque', 'Carousel' ),
		'use_featured_image'    => __( 'Usar como Imagem em Destaque', 'Carousel' ),
		'insert_into_item'      => __( 'Insert dentro do item', 'Carousel' ),
		'uploaded_to_this_item' => __( 'Enviar para este item', 'Carousel' ),
		'items_list'            => __( 'Listar Items', 'Carousel' ),
		'items_list_navigation' => __( 'Items list navigation', 'Carousel' ),
		'filter_items_list'     => __( 'Filter items list', 'Carousel' ),
	);
	$args = array(
		'label'                 => __( 'Carousel', 'Carousel' ),
		'description'           => __( 'Configura as imagens do Carousel', 'Carousel' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'Carousel', $args );

}

add_action( 'init', 'Carousel', 0 );



// hide WP version
function wp_remove_version() {
	return '';
}

function new_excerpt_more($more) {
       global $post;
	return '<p><a class="btn-default btn-excerpt" href="'. get_permalink($post->ID) . '"> LEIA MAIS</a></p>';
}

add_filter('excerpt_more', 'new_excerpt_more');
add_filter('the_generator', 'wp_remove_version');
add_action( 'after_setup_theme', 'theme_setup_features' );
add_action( 'wp_enqueue_scripts', 'custom_scripts' ); // Enfileira os scripts
add_action( 'wp_enqueue_scripts', 'custom_styles' ); // enfileira os estilos




// Add SVG Mime type 

function custom_upload_mimes ( $existing_mimes=array() ) {
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}

add_filter( 'upload_mimes', 'custom_upload_mimes' );


// Register and queue the Scripts
function custom_scripts() {

	wp_register_script( 'Jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', true );
	wp_enqueue_script( 'Jquery' );

	wp_register_script( 'main-js', get_template_directory_uri().'/assets/js/main.js', array(), '1.0.0', true );
	wp_enqueue_script( 'main-js' );


}

// Register and queue the Stlyes
function custom_styles() {

	wp_register_style( 'font-awesome', get_template_directory_uri().'/assets/lib/font-awesome-4.7.0/css/font-awesome.min.css' , false , '4.7.0', 'all' );
	wp_enqueue_style( 'font-awesome' );

	wp_register_style( 'ui-kit', get_template_directory_uri().'/assets/lib/uikit/css/uikit.min.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit' );

	wp_register_style( 'ui-kit-slide-flat', get_template_directory_uri().'/assets/lib/uikit/css/uikit.almost-flat.min.css' , false , '1.0', 'all' );
	wp_enqueue_style( 'ui-kit-slide-flat' );

	wp_register_style( 'style', get_stylesheet_uri() , false , '1.0', 'all' );
	wp_enqueue_style( 'style' );

}
