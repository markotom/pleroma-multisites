<?php get_header(); ?>
      
      <div id="content">
      
        <div id="inner-content" class="wrap clearfix">
      
            <?php get_sidebar(1);  ?>

            <div id="main" class="sixcol clearfix" role="main">

              <?php

                if (have_posts()) : while (have_posts()) : the_post();

                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'pleroma-220x90' );
              ?>
          
              <article id="post-<?php the_ID(); ?>" role="article">
            
                <header class="article-header">
              
                  <h2 class="page-title"<?php if (is_front_page()) print ' style="display: none"'; ?>><?php the_title(); ?></h2>
              
                </header> <!-- end article header -->
          
                <section class="post-content">
                  <?php the_content(); ?>
                </section> <!-- end article section -->
                
              </article> <!-- end article -->
          
              <?php endwhile; ?>
          
              <?php endif; ?>
      
            </div> <!-- end #main -->
    
            <?php get_sidebar(2); // sidebar page 2 ?>
            
        </div> <!-- end #inner-content -->
    
      </div> <!-- end #content -->

<?php get_footer(); ?>