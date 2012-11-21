<?php
/* Custom Widgets && Custom Shortcodes

Developed by: Marco Godínez (@Markotom)
URL: http://about.me/markotom
*/

/*************
[WIDGETS]
**************/
?>

<?php

class social_media extends WP_Widget {
  function social_media() {
    $widget_ops  = array(
                    'class'       => 'social_media',
                    'description' => __('Añade las redes sociales que puedes configurar en la administración de Pleroma Theme', 'pleromatheme') );

    $control_ops = array(
                    'width'   => 300,
                    'height'  => 350,
                    'id_base' => 'social_media');

    $this->WP_Widget( 'social_media', __('Redes Sociales', 'pleromatheme'), $widget_ops, $control_ops ); 
  
  }

  function form($instance) {
    $title = esc_attr($instance['title']);

?>

  <p>
    <label for="<?php print $this->get_field_id('title'); ?>">
      Título: <input class="widefat" id="<?php print $this->get_field_id('title'); ?>" name="<?php print $this->get_field_name('title'); ?>" type="text" value="<?php print attribute_escape($title); ?>"/>
    </label>
  </p>

<?php

  } // end form

  function update($new_instance, $old_instance) {

    $instance          = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);

    return $instance;

  } // end update
    
  function widget($args, $instance) { 

    $socials = array(
        'facebook' => get_option('pleroma_facebook'),
        'twitter'  => get_option('pleroma_twitter'),
        'youtube'  => get_option('pleroma_youtube'),
        'vimeo'    => get_option('pleroma_vimeo')
    );
    $socials = array_filter($socials);
    if(count($socials) > 0 ) {

      extract( $args );

      $title     = apply_filters('widget_title', $instance['title'] );
        
      echo $before_widget; 
      // Display the widget title   
      if ( $title )  
          echo $before_title . $title . $after_title;

      print "<ul>";
      
      $format = '<li class="%1$s"><a href="%2$s" rel="external">%3$s</a></li>';
      foreach($socials as $name => $option){
        switch ($name) {
          case 'twitter':
           $option = "http://twitter.com/$option";
          break;
          case 'youtube':
           $option = "http://youtube.com/$option";
          break;
          case 'vimeo':
           $option = "http://vimeo.com/$option";
          break;
        }
        printf($format, $name, $option, ucwords($name));
      }
      
      print "</ul>";

      print $after_widget;  

    }

    

  }

} // end social_media widget

?>

<?php

/*************
[SHORTCODES]
**************/


//[slider current_post="0" category="" number="5" size="pleroma-700x320" caption="1" title="1" description="0"]
function slider_func( $atts ){
  extract( shortcode_atts( array(
    'category'     => '',
    'number'       => 5,
    'size'         => 'pleroma-700x320',
    'caption'      => true,
    'title'        => true,
    'description'  => false,
    'current_post' => false,
  ), $atts ) );


  if(true == (bool) $current_post)
  {

    $images = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
    if( count($images) > 0 )
    {

?>
<div id="myCarousel" class="carousel slide carousel-fade">
  <div class="carousel-inner">
<?php

      $i = 0; foreach ($images as $attachment_id => $image) : $i++;
        $active = ($i == 1) ? 'active ' : '';

        $img_title       = $image->post_title;   // title.
        $img_description = $image->post_content; // description.
        $img_alt         = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
        $img_alt         = empty($img_alt) ? $img_title : $img_alt;

        
          $big_array = image_downsize( $image->ID, $size );
          $img_src   = $big_array[0];
          $img_url   = wp_get_attachment_url($image->ID);

?>
    <section class="<?php print $active ?>item">
      <figure>
        <a rel="" href="<?php print $img_url ?>"><img src="<?php print $img_src ?>" alt="<?php print $img_alt ?>"></a>
      </figure>
      <?php if ( true == (bool) $caption ) : ?>
      <hgroup class="carousel-caption">
        <?php if ( true == (bool) $title ) : ?>
        <h1 class="h5"><?php print $img_title ?></h1>
        <?php endif; ?>
        <?php if (true == (bool) $description) : ?>
        <h2 class="h5"><?php print $img_description ?></h2>
        <?php endif; ?>
      </hgroup>
      <?php endif; ?>
    </section>

<?php endforeach; ?>
  </div>
      <?php if ( count($images) > 1 ) : ?>
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    <?php endif; ?>
</div>
<?php
    }

  } else // not current
  {

    $query = new wp_query(array(
      'category_name' => $category,
      'posts_per_page' => $number,
    ));

    if ( $query->post_count > 0 ) {

?>
<div id="myCarousel" class="carousel slide carousel-fade">
  <div class="carousel-inner">
    <?php

      $i = 0; while ( $query->have_posts() ) : $i++;

        $active = ($i == 1) ? 'active ' : '';
        $query->the_post();

    ?>
    <section class="<?php print $active ?>item">
      <figure>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($size); ?></a>
      </figure>
      <?php if ( true == (bool) $caption ) : ?>
      <hgroup class="carousel-caption">
        <?php if ( true == (bool) $title ) : ?>
        <h1 class="h5"><?php the_title() ?></h1>
        <?php endif; ?>
        <?php if (true == (bool) $description) : ?>
        <h2 class="h5"><?php the_excerpt() ?></h2>
        <?php endif; ?>
      </hgroup>
      <?php endif; ?>
    </section>
    <?php endwhile; ?>
  </div>

  <?php if ( $query->post_count > 1 ) : ?>
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
  <?php endif; ?>

</div>
<?php
    } // if slides > 0
  }
}
add_shortcode( 'slider', 'slider_func' );

?>