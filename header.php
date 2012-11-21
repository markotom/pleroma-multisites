<!DOCTYPE html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  
  <head>
    <meta charset="utf-8">
    
    <title><?php

      global $page, $paged;

      // Añadir el número de la página si es necesario
      if ( $paged > 1 || $page > 1 )
        $page_title = '» ' . sprintf( __( 'Page %s', 'pleromatheme' ), max( $paged, $page ) ) . ' |';

      // Añadir el título de la página
      wp_title( $page_title ? $page_title : '|', true, 'right' );

      // Añadir el nombre del sitio web
      bloginfo( 'name' );

    ?> - Facultad de Filosofía y Letras, UNAM</title>
    
    <!-- Google Chrome Frame for IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <!-- mobile meta (hooray!) -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    
    <!-- wordpress head functions -->
    <?php wp_head(); ?>
    <!-- end of wordpress head -->

    <?php
      $google_analytics = get_option('pleroma_google_analytics');
      if ($google_analytics) :
    ?>
    <!-- Google Analytics -->
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php print $google_analytics ?>']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <?php endif; ?>
  </head>
  
  <body <?php body_class(); ?>>
  
    <div id="container">
      <div class="top">
        <div id="inner-top" class="wrap">
          <nav class="sec-nav">
            <h3>Información</h3>
            <ul id="menu-informacion">
              <li class="menu-item"><a href="http://www.filos.unam.mx/estudiantes/">Estudiantes</a></li>
              <li class="menu-item"><a href="http://www.filos.unam.mx/docentes/">Docentes</a></li>
              <li class="menu-item"><a href="http://www.personal.unam.mx/">Personal administrativo</a></li>
              <li class="menu-item"><a href="http://www.pve.unam.mx/">Exalumnos</a></li>
              <li class="menu-item"><a href="http://www.filos.unam.mx/visitantes/">Visitantes</a></li>
            </ul>
          </nav>
        </div>
      </div>
      <header class="header" id="branding" role="banner">
        <div id="inner-header" class="wrap">

          <hgroup>

            <h2 class="logounam first fivecol" rel="external nofollow">
              <a href="http://www.unam.mx" title="Universidad Nacional Autónoma de México">
                <span>Universidad Nacional Autónoma de México</span>
              </a>
            </h2>

            <?php
              // Añadir logo
              $logo = get_option("pleroma_logo");
              if($logo) :
            ?>
            <h1 class="threecol">
              <a href="<?php print home_url() ?>" title="<?php print bloginfo( 'name' ) ?>">
                <img src="<?php print $logo ?>" alt="" style="max-width: 220px">
              </a>
            </h1>
            <?php endif; ?>

            <h3 class="logoffyl fourcol last">
              <a href="http://www.filos.unam.mx" title="Facultad de Filosofía y Letras" rel="external">
                <span>Facultad de Filosofía y Letras</span>
              </a>
            </h3>
          </hgroup>
        
          <div class="toggle_nav">
            <a href="#" title="Navegación">
              <img src="<?php print get_template_directory_uri(); ?>/library/images/x.gif" alt="Navegación"> Menú
            </a>
          </div>

        </div> <!-- end #inner-header -->
      
      </header> <!-- end header -->

      <div class="navigation">
        <div id="inner-navigation" class="wrap">
          <nav role="navigation">
            <?php the_widget( 'WP_Widget_Search' ); ?>
            <div class="widget widget_nav_menu ">
              <div class="menu-principal-container">
                <ul id="menu-principal" class="menu">
                  <li class="menu-item"><a href="http://www.filos.unam.mx/sobre/">Sobre la Facultad</a></li>
                  <li class="menu-item"><a href="http://www.filos.unam.mx/academia/">Academia</a></li>
                  <li class="menu-item"><a href="http://www.filos.unam.mx/investigacion/">Investigación</a></li>
                  <li class="menu-item"><a href="http://ec.filos.unam.mx/">Educación Continua</a></li>
                  <li class="menu-item"><a href="http://www.filos.unam.mx/cat/boletin/">Boletín</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>

      <div class="breadcrumb">
        <div id="inner-breadcrumb" class="wrap">
          <?php the_breadcrumb(); ?>
        </div>
      </div>
      <div class="wrap">
        <h1 id="site-title" class="ninecol last">
          <a href="<?php print home_url() ?>"><?php print bloginfo( 'name' ) ?></a>
        </h1>
      </div>
