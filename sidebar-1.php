        <div id="sidebar-1" class="sidebar threecol first" role="complementary">
		      <div class="widget widget_nav_menu">
			      <nav role="navigation">
			      <?php

			          if ( is_active_sidebar( 'navigation' ) )
			          {

			            dynamic_sidebar( 'navigation' );

			          } else {

			          	pleroma_main_nav();
			          
			          }

			      ?>
			      </nav>
		    	</div>
          <?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

            <?php dynamic_sidebar( 'sidebar1' ); ?>

          <?php else : ?>

          <?php endif; ?>

        </div>