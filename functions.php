<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, etc.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
  - enqeueing scripts & styles
  - theme support functions
    - custom menu output & fallbacks
  - related post function
  - page-navi function
  - removing <p> from around images
  - customizing the post excerpt
  - custom google+ integration
  - adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
//require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
require_once('library/translation/translation.php'); // this comes turned off by default

/*
5. library/widgets.php 
    - agregando widgets personalizados
*/ 
require_once('library/widgets.php'); // added by @Markotom


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'pleroma-700x320', 10000, 320, true );
add_image_size( 'pleroma-460x210', 460, 210, true );
add_image_size( 'pleroma-220x90', 220, 90, true );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function pleroma_register_sidebars() {


    register_sidebar(array(
        'id'            => 'navigation',
        'name'          => 'Navigation',
        'description'   => 'Navigation',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'showcase',
        'name'          => 'Showcase',
        'description'   => 'Showcase',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'feature',
        'name'          => 'Feature',
        'description'   => 'Feature',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'main-top',
        'name'          => 'Main Top',
        'description'   => 'Main Top',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'sidebar1',
      'name' => 'Sidebar 1',
      'description' => 'Barra lateral 1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
      'id' => 'sidebar2',
      'name' => 'Sidebar 2',
      'description' => 'Barra lateral 2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widgettitle">',
      'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'content-top',
        'name'          => 'Content Top',
        'description'   => 'Content Top',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'content-bottom',
        'name'          => 'Content Bottom',
        'description'   => 'Content Bottom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'main-bottom',
        'name'          => 'Main Bottom',
        'description'   => 'Main Bottom',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'bottom',
        'name'          => 'Bottom',
        'description'   => 'Aquí no olvides añadir en "custom class" la opción "first" o "last" según la posición del widget.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'footer1',
        'name'          => 'Footer 1',
        'description'   => 'Footer 1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h2 widgettitle">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'id'            => 'footer2',
        'name'          => 'Footer 2',
        'description'   => 'Footer 2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="h2 widgettitle">',
        'after_title'   => '</h4>',
    ));

} // don't remove this bracket!


function pleroma_register_widgets() { // add widgets in /library/widgets.php

  register_widget('social_media');

}


/************* COMMENT LAYOUT *********************/
    
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="clearfix">
      <header class="comment-author vcard">
          <?php /*
              this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
              echo get_avatar($comment,$size='32',$default='<path_to_url>' );
          */ ?>
          <!-- custom gravatar call -->
          <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>&s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
          <!-- end custom gravatar call -->
        <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
        <?php edit_comment_link(__('(Edit)', 'pleromatheme'),'  ','') ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
            <div class="alert info">
                <p><?php _e('Your comment is awaiting moderation.', 'pleromatheme') ?></p>
              </div>
      <?php endif; ?>
      <section class="comment_content clearfix">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function pleroma_search($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'pleromatheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','pleromatheme').'">
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'">
    </form>';
    return $form;
} // don't remove this bracket!


/************* BREADCRUMB *****************/    
function the_breadcrumb() {
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
    $delimiter    = '<span class="delimiter"> &raquo; </span>';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1   = '<span class="delimiter1"> &bull; </span>';
    //text link for the 'Home' page
    $main         = 'Inicio';
    //Display only the first 30 characters of the post title.
    $maxLength    = 30;
    //variable for archived year
    $arc_year     = get_the_time('Y');
    //variable for archived month
    $arc_month    = get_the_time('F');
    //variables for archived day number + full
    $arc_day      = get_the_time('d');
    $arc_day_full = get_the_time('l');  
    //variable for the URL for the Year
    $url_year     = get_year_link($arc_year);
    //variable for the URL for the Month
    $url_month    = get_month_link($arc_year,$arc_month);
 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
 
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page() and !is_category('boletin'))
    {
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<div class="breadcrumb">';
 
        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;
        //A safe way of getting values for a named option from the options database table.
        $homeLink = get_option('home'); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        echo '<a href="' . $homeLink . '">' . $main . '</a>' . $delimiter;    
 
        //Display breadcrumb for single post
        if (is_single())
        {   //check if any single post is being displayed.
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat = count($category); //counts the number of categories the post is listed in.
 
            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat <= 1)  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                if($category[0])
                {
                  echo get_category_parents($category[0],  true,' ' . $delimiter . ' ');
                  
                }
                //Display the full post title.
                echo ' ' . get_the_title();
            } else
            {   //then the post is listed in more than 1 category.
                //Put bullets between categories, since they are at the same level in the hierarchy.
                echo the_category( $delimiter1);
                    //Display partial post title, in order to save space.
                    if (strlen(get_the_title()) >= $maxLength)
                    {   //If the title is long, then don't display it all.
                        echo ' ' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
                    } else
                    {   //the title is short, display all post title.
                        echo ' ' . $delimiter . get_the_title();
                    }
            }
        }
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links separated by '»'
            echo _e("Posts Categorized:", "pleromatheme") . ' ' . get_category_parents($cat, true,' ' . $delimiter . ' ') . '' ;
        }
        //Display breadcrumb for tag archive
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo _e("Posts Tagged:", "pleromatheme") . ' "' . single_tag_title("", false) . '"';
        }
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
            echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo $arc_year;
        }
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
            echo __('Search Results for:', 'pleromatheme') . ' "' .  get_search_query() . '"';
        }
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo get_the_title();
        }
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.
            $post_array = get_post_ancestors($post);
 
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array); 
 
            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
            }
            the_title(); //returns the title of the current page.
        }
        //Display breadcrumb for author archive
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  _e("Posts By:", "pleromatheme") . ' ' . $user_info->display_name ;
        }
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed
            echo  _e("Error 404 - Article Not Found", "pleromatheme");
        }
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       echo '</div>';
    }
}
// end breadcrumb
?>