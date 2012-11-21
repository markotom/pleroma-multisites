<?php get_header(); ?>
      
      <div id="content">

        <div id="inner-content" class="wrap">
      
          <?php get_sidebar(1); // sidebar 1 ?>

          <div id="main" class="sixcol" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <article id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            
                <header class="article-header">
              
                  <h2 class="single-title" itemprop="headline">
                    <?php if(get_post_type() == 'event') { echo "Evento: "; } ?>
                    <?php the_title(); ?>
                  </h2>
                  <?php if(get_post_type() == 'event') : ?>
                    <h3 class="h4 meta">
                      <?php

                        if( eo_is_all_day() )
                        {
                          echo "Inicia: " . eo_get_the_start('l j \d\e F, Y');
                          echo " (todo el día)";
                        } else
                        {
                          echo "Inicia: " . eo_get_the_start('l j \d\e F, Y h:i:s A');
                          echo "<br>Termina: " . eo_get_the_end('l j \d\e F, Y h:i:s A');
                        }

                      ?>
                    </h3>
                  <?php else : ?>
                  <p class="meta"><?php _e("Posted", "pleromatheme"); ?>
                    <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>  <?php the_time('F j, Y'); ?></time>
                              <?php if ( get_the_category() ) : ?>
                              <span class="amp">&</span> <?php _e("filed under", "pleromatheme"); ?> <?php the_category(', '); ?>
                              <?php endif; ?>
                            </p>
                  <?php endif; ?>
                </header> <!-- end article header -->
          
                <section class="post-content" itemprop="articleBody">
                  <?php the_content(); ?>
                  <?php

                    if(get_post_type() == 'event')
                    {
                      $url = eo_get_the_GoogleLink();
                      echo '<p><a href="'.esc_url($url).'" title="Añadir a Google Calendar"> <strong>Añadir a Google Calendar</strong> </a></p>';
                      echo "<p>" . do_shortcode('[eo_venue_map]') . "</p>";
                    }
                      
                  ?>
                </section> <!-- end article section -->
            
                <footer class="article-footer">
      
                  <?php the_tags('<p class="tags"><span class="tags-title">Etiquetado con:</span> ', ', ', '</p>'); ?>
                  
              
                </footer> <!-- end article footer -->
          
                <?php comments_template(); // comments should go inside the article element ?>
          
              </article> <!-- end article -->
          
            <?php endwhile; ?>      
          
            <?php else : ?>
          
              <article id="post-not-found" class="hentry">
                  <header class="article-header">
                    <h1><?php _e("Oops, Post Not Found!", "pleromatheme"); ?></h1>
                  </header>
                  <section class="post-content">
                    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "pleromatheme"); ?></p>
                  </section>
                  <footer class="article-footer">
                      <p><?php _e("This is the error message in the single.php template.", "pleromatheme"); ?></p>
                  </footer>
              </article>
          
            <?php endif; ?>
      
          </div> <!-- end #main -->
    
          
          <?php get_sidebar(2); // sidebar 1 ?>

        </div> <!-- end #inner-content -->
    
      </div> <!-- end #content -->

<?php get_footer(); ?>