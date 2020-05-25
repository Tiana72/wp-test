<?php

require_once __DIR__ . '/Test_Menu.php';

    function test_scripts() {
	    // подключаем файлы стилей темы
	    wp_enqueue_style( 'test-bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
        wp_enqueue_style( 'test-style', get_stylesheet_uri() );

	    // подключаем js файлы темы
        wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), false, true);
	    wp_enqueue_script( 'test-popper', '//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array('jquery'), false, true);
	    wp_enqueue_script( 'test-bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);
    }
    add_action( 'wp_enqueue_scripts', 'test_scripts' );

    function test_setup() {
    // Действия
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        add_image_size( 'test-thumb', 100, 100 );
        register_nav_menus( array(
            'header_menu1' => 'Основное меню',
            'footer_menu2' => 'Подвал'
        ) );
    }
    add_action( 'after_setup_theme', 'test_setup' );

add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

