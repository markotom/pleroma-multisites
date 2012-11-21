<?php get_header(); ?>
  <div class="wrap">
    
    <?php

      get_sidebar(1);

    ?>
    
    <div class="ninecol last">
        <?php
          $inactive_slider = get_option('pleroma_home_slider_inactive');

          if( is_home() && !$inactive_slider) : 

            $query = new wp_query(array(
              'cat' => get_option('pleroma_home_slider'),
              'posts_per_page' => 8
            ));

            if ( $query->post_count > 0 ) :

        ?>
      <div id="showcase">
        <div id="myCarousel" class="carousel slide carousel-fade">
          <div class="carousel-inner">
            <?php

              $i = 0; while ( $query->have_posts() ) : $i++;

                $active = ($i == 1) ? 'active ' : '';
                $query->the_post();

            ?>
            <section class="<?php print $active ?>item">
              <figure>
                <?php the_post_thumbnail('pleroma-700x320'); ?>
              </figure>
              <hgroup class="carousel-caption">
                <h1 class="h4">
                  <a href="<?php the_permalink() ?>">
                    <?php the_title() ?>
                  </a>
                </h1>
                <h2 class="h5"><?php the_excerpt() ?></h2>
              </hgroup>
            </section>
            <?php endwhile; ?>
          </div>

          <?php if ( $query->post_count > 1 ) : ?>
          <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
          <?php endif; ?>
        
        </div>
        <?php endif; // end if slides > 0 ?>

      </div><!-- end showcase -->
      <?php endif; // end if home ?>
      

      <div id="content">
        <div id="inner-content">
        <?php if ( !is_home() ) : ?>

            <div id="main" class="sixcol first" role="main">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          
              <article id="post-<?php the_ID(); ?>" role="article">
            
                <header class="article-header">
              
                  <h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  <p class="meta"><?php _e("Posted", "pleromatheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F j, Y'); ?></time>
                  <?php if ( get_the_category() ) : ?>
                    <span class="amp">&</span> <?php _e("filed under", "pleromatheme"); ?> <?php the_category(', '); ?>
                  <?php endif; ?>
                  </p>
                  
                </header> <!-- end article header -->
          
                <section class="post-content">
                  <?php the_excerpt(); ?>
                </section> <!-- end article section -->
            
                <footer class="article-footer">

                  <p class="tags"><?php the_tags('<span class="tags-title">Etiquetado en:</span> ', ', ', ''); ?></p>

                </footer> <!-- end article footer -->
          
              </article> <!-- end article -->
          
              <?php endwhile; ?>
              <nav class="wp-prev-next">
                <ul class="clearfix">
                  <li class="prev-link"><?php next_posts_link() ?></li>
                  <li class="next-link"><?php previous_posts_link() ?></li>
                </ul>
              </nav>
          
              <?php else : ?>
              
                  <article id="post-not-found" class="hentry">
                      <header class="article-header">
                        <h1><?php _e("Oops, Post Not Found!", "pleromatheme"); ?></h1>
                    </header>
                      <section class="post-content">
                        <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "pleromatheme"); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e("This is the error message in the index.php template.", "pleromatheme"); ?></p>
                    </footer>
                  </article>
          
              <?php endif; ?>
      
            </div> <!-- end #main -->
    
            <?php get_sidebar(1); // sidebar 1 ?>
            <?php get_sidebar(2); // sidebar 2 ?>
        
        <?php else: ?>
          <div id="main" role="main">

          <?php

            $manual = get_option('pleroma_home_manual');

            for ($c = 1; $c <= 3; $c++)
            {
            
            if ( $manual ) {
              $c_count = ($c - 1) * 3;
              $ids = array(
                      get_option('pleroma_home_featured_' . ($c_count + 1) ),
                      get_option('pleroma_home_featured_' . ($c_count + 2) ),
                      get_option('pleroma_home_featured_' . ($c_count + 3) ),
                    );
              
              $query = new wp_query(array(
                'post_type' => 'any',
                'post__in' => $ids,
                'orderby' => 'post__in'
              ));

              
            } else
            {
              $query = new wp_query(array(
                'cat' => get_option('pleroma_home_featured'),
                'posts_per_page' => 3,
                'offset' => ($c - 1) * 3
              ));
            }

        ?>
            
              <?php $i = 0; if ($query->have_posts()) : ?>
            <div class="wrap">
              <?php
                  while ($query->have_posts()) : $i++;

                    $query->the_post();

                    $first     = ( $i == 1 ) ? ' first' : '';
                    $last      = ( $i == 4 ) ? ' last' : '';
                    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'pleroma-220x90' );

              ?>
          
              <article id="post-<?php the_ID(); ?>" role="article" class="fourcol<?php print $first . $last ?>">
            
                <header class="article-header">
                  <figure>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                      <?php the_post_thumbnail('pleroma-220x90'); ?>
                    </a>
                  </figure>
                  <h1 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>    
                </header> <!-- end article header -->
          
                <section class="post-content">
                  <?php the_excerpt(); ?>
                </section> <!-- end article section -->
            
                <footer class="article-footer">
                </footer> <!-- end article footer -->
          
              </article> <!-- end article -->
          
              <?php endwhile; ?>
            </div>
              <?php endif;// have posts ?>

          <?php } ?>
        <?php endif; ?>
          </div>
        </div> <!-- end #inner-content -->
      </div> <!-- end #content -->
    </div>
  </div>
<?php get_footer(); ?>
