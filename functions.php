<?php

require_once __DIR__ . '/Test_Menu.php';

function debug($data) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

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

// Добавляем новые объекты в макет
function test_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array(
        'height'      => 40,
        'width'       => 150,
    ) );    
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => get_template_directory_uri() . '/assets/image/background.png',
    ) );    
    add_theme_support( 'custom-header', array(
        'default-color' => 'cccccc',
        'default-image' => get_template_directory_uri() . '/assets/image/coffee.jpg',
        'height'      => 1300,
        'width'       => 2000,
    ) );    
    add_image_size( 'test-thumb', 100, 100 );
    register_nav_menus( array(
        'header_menu1' => 'Основное меню',
        'footer_menu2' => 'Подвал'
    ) );
}
add_action( 'after_setup_theme', 'test_setup' );

// Убираем H2 из списка пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
    <nav class="navigation" role="navigation">
        <div class="nav-links">%3$s</div>
    </nav>    
    ';
}

// Добавляем сайдбары для виджетов
add_action( 'widgets_init', 'test_widgets' );
function test_widgets(){
	register_sidebar( array(
		'name'          => 'Right sidebar',
		'id'            => "sidebar-right",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",	) );
}

add_action( 'widgets_init', 'test_widgets1' );
function test_widgets1(){
	register_sidebar( array(
		'name'          => 'Left sidebar',
		'id'            => "sidebar-left",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",	) );
}

// Кастомайзер

function test_customize_register($wp_customize) {
    // Добавляем опцию
    $wp_customize -> add_setting('test_link_color', array (
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage', 
    ) );

    // Добавляем элемент управления
    $wp_customize -> add_control(
        new WP_Customize_Color_Control (
            $wp_customize,
            'test_link_color',
            array (
                'label' => 'Цвет ссылок',
                'section' => 'colors',
                'setting' => 'test_link_color',
            )
        ) );

    // custom section
    $wp_customize -> add_section ('test_site_data', array (
        'title' => 'Информация о сайте',
        'priority' => 20,
    ) );
    $wp_customize -> add_setting('test_phone', array (
        'default' => '',
        'transport' => 'postMessage', 
    ) );
    $wp_customize -> add_control(
            'test_phone',
            array (
                'label' => 'Телефон',
                'section' => 'test_site_data',
                'type' => 'text',
            )
        );

        $wp_customize -> add_setting('test_show_phone', array (
            'default' => true,
            'transport' => 'postMessage', 
        ) );
        $wp_customize -> add_control(
                'test_show_phone',
                array (
                    'label' => 'Показать',
                    'section' => 'test_site_data',
                    'type' => 'checkbox',
                )
            );
    
}


add_action('customize_register', 'test_customize_register');

/* function test_customize_css() {
    ?>
         <style type="text/css">
             a, a:hover { color:<?php echo get_theme_mod('test_link_color'); ?>; }
         </style>
    <?php
} */

// Другой вариант записи этой функции
function test_customize_css() {
    $test_link_color = get_theme_mod('test_link_color');
    echo <<<HEREDOC
<style type="text/css">
a, a:hover { color: $test_link_color; }
</style>
HEREDOC;
}

add_action( 'wp_head', 'test_customize_css');

function test_customize_js () {
    wp_enqueue_script( 'test_customize_js', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery','customize-preview' ), false, true);
}
add_action( 'customize_preview_init', 'test_customize_js' );