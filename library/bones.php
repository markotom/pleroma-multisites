<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have 
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

/*********************
LAUNCH BONES
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

// we're firing all out initial functions at the start
add_action('after_setup_theme','pleroma_ahoy', 15);

function pleroma_ahoy() {
    
    // launching operation cleanup
    add_action('init', 'bones_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'bones_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'bones_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'bones_gallery_style');
    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 999);
    // ie conditional wrapper
    add_filter( 'style_loader_tag', 'bones_ie_conditional', 10, 2 );
    // launching this stuff after theme setup
    add_action('after_setup_theme','pleroma_theme_support');  
    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'pleroma_register_sidebars' );
    add_action( 'widgets_init', 'pleroma_register_widgets' );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'pleroma_search' );
    // add custom order "post__in" (@Markotom)
    add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );
    // cleaning up random code around images
    add_filter('the_content', 'pleroma_filter_ptags_on_images');
    // custom excerpt
    add_filter('excerpt_length', 'pleroma_excerpt_length');
    add_filter('excerpt_more',   'pleroma_excerpt_more');
    
    
} /* end pleroma ahoy */

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by 
removing all the junk we don't
need. 
*********************/

function bones_head_cleanup() {
  // category feeds
  // remove_action( 'wp_head', 'feed_links_extra', 3 );                    
  // post and comment feeds
  // remove_action( 'wp_head', 'feed_links', 2 );                          
  // EditURI link
  remove_action( 'wp_head', 'rsd_link' );                               
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );                       
  // index link
  remove_action( 'wp_head', 'index_rel_link' );                         
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
  // WP version
  remove_action( 'wp_head', 'wp_generator' );                           

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
  
// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************
SCRIPTS & ENQEUEING
*********************/

// loading modernizr and jquery, and reply script 
function bones_scripts_and_styles() {
  if (!is_admin()) {

    // bootstrap twitter
    wp_register_script( 'bones-transition', get_stylesheet_directory_uri() . '/library/js/libs/twitter/bootstrap-transition.js', array(), '2.0.4', false);
    wp_register_script( 'bones-carousel', get_stylesheet_directory_uri() . '/library/js/libs/twitter/bootstrap-carousel.js', array(), '2.0.4', false);

    // modernizr (without media query polyfill)
    wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
 
    // register main stylesheet
    wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

    // ie-only style sheet
    wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );
    
    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
    
    //adding scripts file in the footer
    wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
    
    // enqueue styles and scripts
    wp_enqueue_script( 'bones-modernizr' );
    wp_enqueue_style( 'bones-stylesheet' );
    wp_enqueue_style( 'bones-ie-only' );
    /*
    I reccomend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' ); 
    wp_enqueue_script( 'bones-js' ); 

    /*
    Bootstrap Twitter
      - Transition
      - Carrousel
    */
    wp_enqueue_script( 'bones-transition' );
    wp_enqueue_script( 'bones-carousel' );
    
  }
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function bones_ie_conditional( $tag, $handle ) {
  if ( 'bones-ie-only' == $handle )
    $tag = '<!--[if lte IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
  return $tag;
}

/*********************
THEME SUPPORT
*********************/
  
// Adding WP 3+ Functions & Theme Support
function pleroma_theme_support() {
  
  // wp thumbnails (sizes handled in functions.php)
  add_theme_support('post-thumbnails');   
  
  // default thumb size   
  set_post_thumbnail_size(100, 100, true);   
  
  // wp custom background (thx to @bransonwerner for update)
  add_theme_support( 'custom-background',
      array( 
        'default-image'          => '',  // background image default
        'default-color'          => '', // background color default (dont add the #)
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
      )
  );      
  
  // rss thingy           
  add_theme_support('automatic-feed-links'); 
  
  // to add header image support go here: http://themble.com/support/adding-header-background-image-support/
  
  // adding post format support
  add_theme_support( 'post-formats',  
    array(
      'aside',             // title less blurb
      'gallery',           // gallery of images
      'link',              // quick link to other site
      'image',             // an image
      'quote',             // a quick quote
      'status',            // a Facebook like status update
      'video',             // video 
      'audio',             // audio
      'book',              // book
    )
  );
  
  // wp menus
  add_theme_support( 'menus' );  
  
  // registering wp3+ menus       
  register_nav_menus(                      
    array( 
      'main-nav'       => __( 'The Main Menu',      'pleromatheme' ),   // main nav in header
      'footer-links'   => __( 'Footer Links',       'pleromatheme' ),   // secondary nav in footer
      'footer-links-2' => __( 'Footer Links 2',     'pleromatheme' )    // secondary nav in footer
    )
  );
} /* end pleroma theme support */


/*********************
MENUS & NAVIGATION
*********************/  
 
// the main menu 
function pleroma_main_nav() {
    wp_nav_menu(array( 
      'container' => false,                           // remove nav container
      'container_class' => 'menu',                    // class of container (should you choose to use it)
      'menu' => 'The Main Menu',                      // nav name
      'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
      'theme_location' => 'main-nav',                 // where it's located in the theme
      'before' => '',                                 // before the menu
      'after' => '',                                  // after the menu
      'link_before' => '',                            // before each link
      'link_after' => '',                             // after each link
      'depth' => 0,                                   // limit the depth of the nav
      'fallback_cb' => 'pleroma_main_nav_fallback'    // fallback function
  ));
} /* end main menu */

// fallback main menu
function pleroma_main_nav_fallback() { 
  wp_page_menu( 'show_home=Inicio' ); 
}

function pleroma_footer_links() { 
    wp_nav_menu(array( 
      'container' => '',
      'container_class' => 'footer-links',
      'menu' => 'Footer Links',
      'menu_class' => 'nav footer-links',
      'theme_location' => 'footer-links',
      'before' => '',
      'after' => '',
      'link_before' => '',
      'link_after' => '',
      'depth' => 0,
      'fallback_cb' => ''
  ));
} /* end bones footer link */

function pleroma_footer_links_2() { 
    wp_nav_menu(array( 
      'container' => '',
      'container_class' => 'footer-links',
      'menu' => 'Footer Links 2',
      'menu_class' => 'nav footer-links-2',
      'theme_location' => 'footer-links-2',
      'before' => '',
      'after' => '',
      'link_before' => '',
      'link_after' => '',
      'depth' => 0,
      'fallback_cb' => ''
  ));
} /* end bones footer link */


function pleroma_get_info_nav( $location_id ) {
  $locations    = get_registered_nav_menus();
  $menus        = wp_get_nav_menus();
  $menu_locations = get_nav_menu_locations();
  if (isset($menu_locations[ $location_id ])) {
    foreach ($menus as $menu) {
      if ($menu->term_id == $menu_locations[$location_id]) {
        return $menu;
        break;
      }

    }

  }
}

/*********************
RELATED POSTS FUNCTION
*********************/  
  
// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
  echo '<ul id="bones-related-posts">';
  global $post;
  $tags = wp_get_post_tags($post->ID);
  if($tags) {
    foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
          'tag' => $tag_arr,
          'numberposts' => 5, /* you can change this to show more */
          'post__not_in' => array($post->ID)
      );
        $related_posts = get_posts($args);
        if($related_posts) {
          foreach ($related_posts as $post) : setup_postdata($post); ?>
              <li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
          <?php endforeach; } 
      else { ?>
            <li class="no_related_post">No Related Posts Yet!</li>
    <?php }
  }
  wp_reset_query();
  echo '</ul>';
} /* end bones related posts function */


/*********************
PAGE NAVI
*********************/  

// Numeric Page Navi (built into the theme by default)
function pleroma_page_nav($before = '', $after = '') {
  global $wpdb, $wp_query;
  $request = $wp_query->request;
  $posts_per_page = intval(get_query_var('posts_per_page'));
  $paged = intval(get_query_var('paged'));
  $numposts = $wp_query->found_posts;
  $max_page = $wp_query->max_num_pages;
  if ( $numposts <= $posts_per_page ) { return; }
  if(empty($paged) || $paged == 0) {
    $paged = 1;
  }
  $pages_to_show = 7;
  $pages_to_show_minus_1 = $pages_to_show-1;
  $half_page_start = floor($pages_to_show_minus_1/2);
  $half_page_end = ceil($pages_to_show_minus_1/2);
  $start_page = $paged - $half_page_start;
  if($start_page <= 0) {
    $start_page = 1;
  }
  $end_page = $paged + $half_page_end;
  if(($end_page - $start_page) != $pages_to_show_minus_1) {
    $end_page = $start_page + $pages_to_show_minus_1;
  }
  if($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page = $max_page;
  }
  if($start_page <= 0) {
    $start_page = 1;
  }
  echo $before.'<nav class="page-navigation"><ol class="pleroma_page_nav">'."";
  if ($start_page >= 2 && $pages_to_show < $max_page) {
    $first_page_text = "First";
    echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
  }
  echo '<li class="bpn-prev-link">';
  previous_posts_link('‹');
  echo '</li>';
  for($i = $start_page; $i  <= $end_page; $i++) {
    if($i == $paged) {
      echo '<li class="bpn-current">'.$i.'</li>';
    } else {
      echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    }
  }
  echo '<li class="bpn-next-link">';
  next_posts_link('Siguiente ›');
  echo '</li>';
  if ($end_page < $max_page) {
    $last_page_text = "Last";
    echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
  }
  echo '</ol></nav>'.$after."";
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/  

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function pleroma_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

function pleroma_excerpt_more($more) {
  global $post;
  // edit here if you like
  return '...  <a href="'. get_permalink($post->ID) . '" title="Leer '.get_the_title($post->ID).'">Leer más &raquo;</a>';
}
function pleroma_excerpt_length($length) {
  return 25;
}

function sort_query_by_post_in( $sortby, $thequery ) {
  if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
    $sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
  
  return $sortby;
}   


?>