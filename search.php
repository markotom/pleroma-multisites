<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap">

					<?php get_sidebar(1); // sidebar 1 ?>
			
					<div id="main" class="sixcol" role="main">
				
						<h2 class="archive-title"><span><?php _e("Search Results for:", "pleromatheme"); ?></span> <?php echo esc_attr(get_search_query()); ?></h2>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
								<header class="article-header">
									<figure>
										<?php the_post_thumbnail(); ?>
									</figure>
									<h3 class="h4 search-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<!--
									<p class="meta"><?php _e("Posted", "pleromatheme"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F j, Y'); ?></time>
									<?php if ( get_the_category() ) : ?>
										<span class="amp">&</span> <?php _e("filed under", "pleromatheme"); ?> <?php the_category(', '); ?>
									<?php endif; ?>
									</p>
									-->
						
								</header> <!-- end article header -->
					
								<section class="post-content">
								    <?php the_excerpt('<span class="read-more">Read more &raquo;</span>'); ?>
					
								</section> <!-- end article section -->
						
								<footer class="article-footer">
							
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
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Sorry, No Results.", "pleromatheme"); ?></h1>
    					    	</header>
    					    	<section class="post-content">
    					    		<p><?php _e("Try your search again.", "pleromatheme"); ?></p>
    					    	</section>
    					    </article>
					
					    <?php endif; ?>
			
				    </div> <!-- end #main -->
    			
    			    <?php get_sidebar(2); // sidebar 2 ?>
    			
    			</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>