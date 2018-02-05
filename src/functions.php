<?php

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

if ( ! function_exists( 'scaffold_setup' ) ) :
	function enqueue_styles() {
		wp_enqueue_style( 'whitesquare-style', get_stylesheet_uri());
		wp_register_style('font-style', 'http://fonts.googleapis.com/css?family=Oswald:400,300');
		wp_enqueue_style( 'font-style');
	}
	endif;
	add_action('wp_enqueue_scripts', 'enqueue_styles');

	function enqueue_scripts () {
		wp_register_script('html5-shim', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.js');
		wp_enqueue_script('html5-shim');
	}
	add_action('wp_enqueue_scripts', 'enqueue_scripts');

	if (function_exists('add_theme_support')) {
		add_theme_support('menus');
	}

	remove_filter('the_content', 'wpautop');

	// Получение первой картинки с поста
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
  
  // Если изображение отсутствует, то выводим изображение по умолчанию (указать путь к изображению)
	if(empty($first_img)){
	  $first_img = "/images/default.jpg";
	}
	return $first_img;
  }


?>