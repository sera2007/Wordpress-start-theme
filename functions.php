<?php
/** Hide admin bar on site **/
add_filter('show_admin_bar', '__return_false');

add_action( 'admin_enqueue_scripts', 'chrome_fix' );
function chrome_fix() {

    if ( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Chrome' ) !== false ) {
        wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0) }' );
    }
}

// This theme uses post thumbnails
add_theme_support('post-thumbnails');


/** Front end styles and scripts **/
function load_style_script(){
	wp_enqueue_style('slick', get_template_directory_uri() . '/public/css/slick.css');
	wp_enqueue_style('dev_css', get_template_directory_uri() . '/public/css/dev.css');
	wp_enqueue_style('default', get_template_directory_uri() . '/public/css/default.css');

	wp_enqueue_script('jquery', get_template_directory_uri() . '/public/js/jquery-1.11.3.min.js','','',true );
	wp_enqueue_script('slick', get_template_directory_uri() . '/public/js/slick.min.js','','',true );
	wp_enqueue_script('fancybox_js', get_template_directory_uri() . '/public/js/jquery.fancybox.pack.js','','',true );
	wp_enqueue_script('common_js', get_template_directory_uri() . '/public/js/common.js','','',true );
	wp_enqueue_script('common_dev_js', get_template_directory_uri() . '/public/js/common_dev.js','','',true );
}
add_action('wp_enqueue_scripts', 'load_style_script');

/** Turn on menus  **/
function register_my_menu() {
  register_nav_menu('top-menu',__( 'Top Menu' ));
}
add_action( 'init', 'register_my_menu' );
function register_my_menu2() {
  register_nav_menu('top-menu2',__( 'Top Menu (inner pages)' ));
}
add_action( 'init', 'register_my_menu2' );


/** Get menu items **/
function carat_get_menu_items($menu_name){
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        return wp_get_nav_menu_items($menu->term_id);
		wp_reset_query();
    }
}

function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<ul class='paginator'>";
         //if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' title='' class='prev'>&#171; <span>Попередня</span></a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."' title='' class='prev'>&#171; <span>Попередня</span></a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><a title='' class='active'>$i</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a><li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' title='' class='next'><span>Наступна</span> &#187;</a></li>"; 
        // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</ul>\n";
     }
}

?>