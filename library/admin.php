<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard. Updates to this page are coming soon.
It's turned off by default, but you can call it
via the functions file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

Special Thanks for code & inspiration to:
@jackmcconnell - http://www.voltronik.co.uk/
Digging into WP - http://digwp.com/2010/10/customize-wordpress-dashboard/

*/

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// removing plugin dashboard boxes
	//remove_meta_box('yoast_db_widget', 'dashboard', 'normal');       // Yoast's SEO Plugin Widget

	/*
	have more plugin widgets you'd like to remove?
	share them with us so we can get a list of
	the most commonly used. :D
	https://github.com/eddiemachado/bones/issues
	*/
}

/*
Now let's talk about adding your own custom Dashboard widget.
Sometimes you want to show clients feeds relative to their
site's content. For example, the NBA.com feed for a sports
site. Here is an example Dashboard Widget that displays recent
entries from an RSS Feed.

For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// RSS Dashboard Widget
function bones_rss_dashboard_widget() {
	if(function_exists('fetch_feed')) {
		include_once(ABSPATH . WPINC . '/feed.php');               // include the required file
		$feed = fetch_feed('http://themble.com/feed/rss/');        // specify the source feed
		$limit = $feed->get_item_quantity(7);                      // specify number of items
		$items = $feed->get_items(0, $limit);                      // create an array of items
	}
	if ($limit == 0) echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
	else foreach ($items as $item) : ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_date('j F Y @ g:i a'); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php endforeach;
}

// calling all custom dashboard widgets
function pleroma_custom_dashboard_widgets() {
	wp_add_dashboard_widget('bones_rss_dashboard_widget', 'Recently on Themble (Customize on admin.php)', 'bones_rss_dashboard_widget');
	

	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}


// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
//add_action('wp_dashboard_setup', 'pleroma_custom_dashboard_widgets');


/************* CUSTOMIZE ADMIN *******************/

/*
I don't really reccomend editing the admin too much
as things may get funky if Wordpress updates. Here
are a few funtions which you can choose to use if
you like.
*/

// Custom Backend Footer
function pleroma_custom_admin_footer() {
	echo '<span id="footer-thankyou"><a href="http://www.filos.unam.mx">Pleroma Theme</a> desarrollado por <a href="http://twitter.com/Markotom">@Markotom</a></span>. Construído sobre <a href="http://themble.com/bones">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'pleroma_custom_admin_footer');



/************* PLEROMA THEME *******************/

add_action('admin_menu', 'pleroma_admin_menu');
add_action('admin_init', 'pleroma_add_init');

// select all categories!
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array('Elige una categoría');
foreach ( $categories as $category_list )
  $wp_cats[$category_list->cat_ID] = $category_list->cat_name;


// select all posts!
$args  = array( 'post_type' => array('post', 'page', 'event', 'book'), 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC' ); 
$posts = get_posts($args);
$wp_posts = array('Elige un contenido');
foreach ( $posts as $post_list )
  $wp_posts[$post_list->ID] = $post_list->post_title;

// options!
$options = array (  

  array( "name" => "Opciones generales",  
         "type" => "section"),

  array( "type" => "open"), 

  array("name" => "Logotipo del sitio",  
        "desc" => "Elige la URL de tu logotipo",  
        "id" => "pleroma_logo",  
        "type" => "text",  
        "std" => ""),

  array( "type" => 'close'),
    
  array( "name" => "Página inicial",  
         "type" => "section"),

  array( "type" => "open"), 

  array(
      "name"    => "Categoría del slider",  
      "desc"    => "Elige una categoría para destacarla en el <strong>Slider</strong> de la página inicial.",  
      "id"      => "pleroma_home_slider",  
      "type"    => "select",  
      "options" => $wp_cats,
      "std"     => "Elige una categoría"
  ), 

  array(
        "name"    => "Ocultar slider del home",  
        "desc"    => "Si está activado no se mostrará el slider.",  
        "id"      => "pleroma_home_slider_inactive",  
        "type"    => "checkbox",  
        "std"     => "0"
  ),
           
  array(
        "name"    => "Categoría destacada",  
        "desc"    => "Elige una categoría para destacarla en la página inicial.",  
        "id"      => "pleroma_home_featured",  
        "type"    => "select",  
        "options" => $wp_cats,
        "std"     => "Elige una categoría"
  ),  

  array(
        "name"    => "Mostrar contenido destacado elegido manualmente",  
        "desc"    => "Si está activado podrá desplegarse el contenido que se añade manualmente.",  
        "id"      => "pleroma_home_manual",  
        "type"    => "checkbox",  
        "std"     => "0"
  ),

  array(
        "name"    => "#1 contenido destacado", 
        "desc"    => "En la primera columna (1/3)",  
        "id"      => "pleroma_home_featured_1",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#2 contenido destacado", 
        "desc"    => "En la segunda columna (2/3)",  
        "id"      => "pleroma_home_featured_2",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#3 contenido destacado", 
        "desc"    => "En la tercera columna (3/3)",  
        "id"      => "pleroma_home_featured_3",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#4 contenido destacado", 
        "desc"    => "En la primera columna (1/3)",  
        "id"      => "pleroma_home_featured_4",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#5 contenido destacado", 
        "desc"    => "En la segunda columna (2/3)",  
        "id"      => "pleroma_home_featured_5",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#6 contenido destacado", 
        "desc"    => "En la tercera columna (3/3)",  
        "id"      => "pleroma_home_featured_6",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#7 contenido destacado", 
        "desc"    => "En la primera columna (1/3)",  
        "id"      => "pleroma_home_featured_7",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#8 contenido destacado", 
        "desc"    => "En la segunda columna (2/3)",  
        "id"      => "pleroma_home_featured_8",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array(
        "name"    => "#9 contenido destacado", 
        "desc"    => "En la tercera columna (3/3)",  
        "id"      => "pleroma_home_featured_9",
        "type"    => "select",
        "options" => $wp_posts,  
        "std"     => ""
  ),

  array( "type" => "close"),


  // Social Media
  array( "name" => "Extras",  
         "type" => "section"),

  array( "type" => "open"), 

  array("name" => "Facebook",  
        "desc" => "Agrega la URL de tu página o perfil de Facebook",  
        "id" => "pleroma_facebook",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Twitter",  
        "desc" => "Agrega el <strong>nickname</strong> de tu cuenta de Twitter",  
        "id" => "pleroma_twitter",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Youtube",  
        "desc" => "Agrega el <strong>nickname</strong> de tu cuenta de Youtube",  
        "id" => "pleroma_youtube",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Vimeo",  
        "desc" => "Agrega el <strong>nickname</strong> de tu cuenta de Vimeo",  
        "id" => "pleroma_vimeo",  
        "type" => "text",  
        "std" => ""),

  array("name" => "Google Analytics",  
        "desc" => "Agrega el UID de tu cuenta de Google Analytics",  
        "id" => "pleroma_google_analytics",  
        "type" => "text",  
        "std" => ""),

  array( "type" => "close"),
   
);  

function pleroma_admin_menu ()
{

  global $options;  
     
  

  if ( 'pleroma_admin_home' == $_REQUEST['page'] )
  {
      
    if ( 'save' == $_REQUEST['action'] )
    {  
      
   
        foreach ($options as $value)
        {  
          update_option( $value['id'], $_REQUEST[ $value['id'] ] );
        }  
     
        foreach ($options as $value) {
          if( isset( $_REQUEST[ $value['id'] ] ) )
          {
            update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
          } else
          {
            delete_option( $value['id'] );
          }
        }  
       
        header("Location: admin.php?page=pleroma_admin_home&saved=true");  
        die;  

    } else if( 'reset' == $_REQUEST['action'] )
    {
       
        foreach ($options as $value)
        {  
          delete_option( $value['id'] );
        } 
       
        header("Location: admin.php?page=pleroma_admin_home&reset=true");  
        die;  
    }
  }

  add_theme_page(__('Pleroma Theme', 'pleromatheme'), __('Pleroma Theme', 'pleromatheme'), 'switch_themes', 'pleroma_admin_home', 'pleroma_admin_home');


}

function pleroma_add_init() {
  wp_enqueue_style("functions", get_template_directory_uri() ."/library/css/admin.css", false, "1.0", "all");
}  


function pleroma_admin_home() {
  global $options;

    if ( $_REQUEST['saved'] )
      echo '<div id="message" class="updated fade"><p><strong>Opciones guardadas.</strong></p></div>';

    if ( $_REQUEST['reset'] )
      echo '<div id="message" class="updated fade"><p><strong>Valores predeterminados guardados.</strong></p></div>'; 

  $format = '
              <div class="wrap rm_wrap">
                <h2>%1$s. Opciones del sitio</h2>
                <div class="rm_opts">
                  <form method="post">

            ';
  
  printf($format, 'Pleroma Theme', get_bloginfo('name'));

  $i = 0;

  foreach ($options as $value)
  {
    switch ( $value['type'] )
    { 
      case 'open': break;
      case "close":
        print '
                  </div>  
                </div>  
                <br />';
      break;

      case "text":

        $format = '
                    <div class="rm_input rm_text">  
                      <label for="%1$s">%3$s</label>  
                      <input name="%1$s" id="%1$s" type="%2$s" value="%5$s" />  
                      <small>%4$s</small>
                    </div>
                  ';

        $default  = get_settings( $value['id'] )
                  ? stripslashes(get_settings( $value['id'] ))
                  : $value['std'];

        printf( $format, $value['id'], $value['type'], $value['name'], $value['desc'], $default );

      break;

      case 'textarea':
        $format = '
                    <div class="rm_input rm_textarea">  
                      <label for="%1$s">%3$s</label>  
                      <textarea name="%1$s" type="%2$s" cols="" rows="">%5$s</textarea>  
                      <small>%4$s</small>
                    </div>
                  ';

        $default  = get_settings( $value['id'] )
                  ? stripslashes(get_settings( $value['id'] ))
                  : $value['std'];

        printf( $format, $value['id'], $value['type'], $value['name'], $value['desc'], $default );

      break;

      case 'select':

        $format = '
                    <div class="rm_input rm_select">  
                      <label for="%1$s">%2$s</label>  
                      <select name="%1$s" id="%1$s">  
                        %4$s
                      </select>
                      <small>%3$s</small>
                    </div>
                  ';
        if ( is_array( $value['options'] ) )
        {
          $options_select = '';
          foreach ($value['options'] as $id => $option)
          {
            $selected = (get_settings( $value['id'] ) == $id)
                      ? ' selected="selected"'
                      : '';
            $options_select .= "<option value=\"$id\"$selected>$option</option>\n";
          }
        }

        printf( $format, $value['id'], $value['name'], $value['desc'], $options_select );

      break;

      case 'checkbox':
        $format = '
                    <div class="rm_input rm_checkbox">  
                      <label for="%1$s">%2$s</label>  
                      <input type="checkbox" name="%1$s" id="%1$s" value="true" %4$s/>  
                      <small>%3$s</small>
                    </div>
                  ';
        $checked = get_option($value['id'])
                  ? 'checked="checked"'
                  : '';
        printf( $format, $value['id'], $value['name'], $value['desc'], $checked );

      break;


      case "section":  
        $i++;

        print '
              <div class="rm_section">  
              <div class="rm_title">
                <h3>
                  <img src="'. get_template_directory_uri() .'/library/images/x.gif" class="inactive" alt="">
                  '. $value['name'] .'
                </h3>
                <span class="submit">
                  <input name="save'. $i .'" type="submit" value="Guardar cambios" />  
                </span>
              </div>  
              <div class="rm_options">  
              ';
      break;

    }

  }

  print '
                    <input type="hidden" name="action" value="save" />  
                  </form>

                  <form method="post">  
                    <p class="submit">  
                      <input name="reset" type="submit" value="Reset" />  
                      <input type="hidden" name="action" value="reset" />  
                    </p>  
                  </form> 
               </div>

            ';

}


