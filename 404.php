<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap">
			
					<div id="main" class="twelvecol first" role="main">

						<article id="post-not-found" class="hentry clearfix">
						
							<header class="article-header">
							
								<h1><?php _e("Error 404 - Article Not Found", "pleromatheme"); ?></h1>
						
							</header> <!-- end article header -->
					
							<section class="post-content">
							
								<p><?php _e("The article you were looking for was not found, but maybe try looking again!", "pleromatheme"); ?></p>
					
							</section> <!-- end article section -->

							<section class="search">
				
							    <p><?php get_search_form(); ?></p>
				
							</section> <!-- end search section -->
						
							<footer class="article-header">
							
							</footer> <!-- end article footer -->
					
						</article> <!-- end article -->
			
					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
