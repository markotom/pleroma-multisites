<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap">
				
						<?php get_sidebar(1); // sidebar 1 ?>

				    <div id="main" class="sixcol" role="main">
				
					    <?php if (is_category()) { ?>
						    <h1 class="archive-title h2">
							    <span><?php _e("Posts Categorized:", "pleromatheme"); ?></span> <?php single_cat_title(); ?>
					    	</h1>
					    
					    <?php } elseif (is_tag()) { ?> 
						    <h1 class="archive-title h2">
							    <span><?php _e("Posts Tagged:", "pleromatheme"); ?></span> <?php single_tag_title(); ?>
						    </h1>
					    
					    <?php } elseif (is_author()) { ?>
						    <h1 class="archive-title h2">
						    	<span><?php _e("Posts By:", "pleromatheme"); ?></span> <?php get_the_author_meta('display_name'); ?>
						    </h1>
					    
					    <?php } elseif (is_day()) { ?>
						    <h1 class="archive-title h2">
	    						<span><?php _e("Daily Archives:", "pleromatheme"); ?></span> <?php the_time('l, F j, Y'); ?>
						    </h1>
		
		    			<?php } elseif (is_month()) { ?>
			    		    <h1 class="archive-title h2">
				    	    	<span><?php _e("Monthly Archives:", "pleromatheme"); ?></span> <?php the_time('F Y'); ?>
					        </h1>
					
					    <?php } elseif (is_year()) { ?>
					        <h1 class="archive-title h2">
					    	    <span><?php _e("Yearly Archives:", "pleromatheme"); ?></span> <?php the_time('Y'); ?>
					        </h1>
					    <?php } ?>

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" role="article">
						
						    <header class="article-header">
						    	<figure>
										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail('thumbnail') ?>
										</a>
									</figure>
									<div class="meta">
										<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
											<span class="month"><?php print strtoupper(get_the_time('M')); ?></span>
											<span class="day"><?php the_time('j'); ?></span>
											<span class="year"><?php the_time('Y'); ?></span>
										</time>
									</div>
									<h3 class="h3">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
						    </header> <!-- end article header -->
					
						    <section class="post-content">
							    <?php the_excerpt(); ?>
						    </section> <!-- end article section -->
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>	
						        <nav class="wp-prev-next">
							        <ul>
								        <li class="prev-link"><?php next_posts_link() ?></li>
								        <li class="next-link"><?php previous_posts_link() ?></li>
							        </ul>
					    	    </nav>
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    						    <header class="article-header">
    							    <h1><?php _e("Oops, Post Not Found!", "pleromatheme"); ?></h1>
    					    	</header>
    						    <section class="post-content">
    							    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "pleromatheme"); ?></p>
        						</section>
    	    					<footer class="article-footer">
    		    				    <p><?php _e("This is the error message in the archive.php template.", "pleromatheme"); ?></p>
    			    			</footer>
    				    	</article>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
	    			<?php get_sidebar(2); // sidebar 2 ?>
                
                </div> <!-- end #inner-content -->
                
			</div> <!-- end #content -->

<?php get_footer(); ?>