<?php
/*
Template Name: Páginas sin sidebars
*/
?>

<?php get_header(); ?>
      
      <div id="content">
      
        <div id="inner-content" class="wrap clearfix">

            <div id="main" role="main">

              <?php

                if (have_posts()) : while (have_posts()) : the_post();

                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'pleroma-220x90' );
              ?>
          
              <article id="post-<?php the_ID(); ?>" role="article">
            
                <header class="article-header">
              
                  <h1 class="page-title"<?php if (is_front_page()) print ' style="display: none"'; ?>><?php the_title(); ?></h1>
              
                </header> <!-- end article header -->
          
                <section class="post-content">
                  <?php the_content(); ?>
                </section> <!-- end article section -->
                
              </article> <!-- end article -->
          
              <?php endwhile; ?>
          
              <?php endif; ?>
      
            </div> <!-- end #main -->
            
        </div> <!-- end #inner-content -->
    
      </div> <!-- end #content -->

<?php get_footer(); ?>