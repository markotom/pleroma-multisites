      <a name="bottom"></a>
      <div class="wrap bottom">
        <div class="inner-bottom">
          <?php

            if ( is_active_sidebar( 'bottom' ) )
            {

              $cols    = array(
                                'one',
                                'two',
                                'three',
                                'four',
                                'five',
                                'six',
                                'seven',
                                'eight',
                                'nine',
                                'ten',
                                'eleven',
                                'twelve'
                              );

              $i              = 0;
              $widgets        = wp_get_sidebars_widgets( 'bottom' );
              $widgets_bottom = $widgets['bottom'];
              $count_widgets  = count($widgets_bottom);
              $col            = $cols[(12 / $count_widgets) - 1] . "col";

              register_sidebar(array(
                  'id'            => 'bottom',
                  'before_widget' => '<div id="%1$s" class="widget %2$s '.$col.'">',
                  'after_widget'  => '</div>',
              ));

              dynamic_sidebar( 'bottom' );

            }

          ?>
        </div>
      </div>
      <footer class="footer" role="contentinfo">
      
        <div id="inner-footer" class="wrap clearfix">
          
          <div class="twocol first">
            <nav role="navigation">
                <?php pleroma_footer_links(); ?>
            </nav>
          </div>

          <div class="twocol">
            <nav role="navigation">
                <?php pleroma_footer_links_2(); ?>
            </nav>
          </div>

          <div class="fivecol">
            <div class="widget widget_ubicacion">
              <a class="mapa" href="http://www.filos.unam.mx/visitantes/" title="Visita la Facultad">
                <span>Mapa de la Facultad</span>
              </a>
              <div class="direccion">
                <h4 class="h2 widgettitle">Visita la Facultad</h4>
                Circuito Interior.<br>
                Ciudad Universitaria, s/n. C.P. 04510. México, DF.
              </div>
            </div>
            <?php dynamic_sidebar( 'footer1' ); ?>
          </div>
          <div class="threecol last">
            <?php dynamic_sidebar( 'footer2' ); ?>
          </div>

          <p class="attribution" style="clear: both">&copy; <?php echo date('Y'); ?> Facultad de Filosofía y Letras, UNAM.</p>
        
        </div> <!-- end #inner-footer -->
        
      </footer> <!-- end footer -->
    
    </div> <!-- end #container -->
    
    <?php wp_footer(); // js scripts are inserted using this function ?>

  </body>

</html> <!-- end page. what a ride! -->