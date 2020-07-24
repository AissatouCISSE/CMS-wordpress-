<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_consulting_before_slider' ); ?>

  <?php if( get_theme_mod( 'vw_consulting_slider_arrows') != '') { ?>

  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <?php $vw_consulting_pages = array();
        for ( $count = 1; $count <= 4; $count++ ) {
          $mod = intval( get_theme_mod( 'vw_consulting_slider_page' . $count ));
          if ( 'page-none-selected' != $mod ) {
            $vw_consulting_pages[] = $mod;
          }
        }
        if( !empty($vw_consulting_pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $vw_consulting_pages,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>     
      <div class="carousel-inner" role="listbox">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <h1><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_consulting_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_consulting_slider_excerpt_number','20')))); ?></p>
                <div class="more-btn">
                  <a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'READ MORE', 'vw-consulting' ); ?><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','vw-consulting' );?></span></a>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; endwhile; 
        wp_reset_postdata();?>
      </div>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
      endif;?>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Previous','vw-consulting' );?></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Next','vw-consulting' );?></span>
      </a>
    </div>
  </section>

  <?php } ?>

  <?php do_action( 'vw_consulting_after_slider' ); ?>

  <?php if( get_theme_mod('vw_consulting_topbar_hide_show') != ''){ ?>
    <section id="contact_info">
      <?php get_template_part('template-parts/header/lower-header'); ?>
    </section>
  <?php } ?>

  <?php do_action( 'vw_consulting_after_contact' ); ?>

  <section id="services_sec">
    <div class="container">
      <div class="heading">
        <?php if( get_theme_mod( 'vw_consulting_section_sub_title') != '') { ?>
          <p><?php echo esc_html( get_theme_mod('vw_consulting_section_sub_title','')); ?></p>
        <?php }?>
        <?php if( get_theme_mod( 'vw_consulting_section_title') != '') { ?>
          <h2><?php echo esc_html( get_theme_mod('vw_consulting_section_title','')); ?></h2>
        <?php }?>
      </div>
      <div class="row">
        <?php 
        $vw_consulting_catData=  get_theme_mod('vw_consulting_services');
          if($vw_consulting_catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html( $vw_consulting_catData ,'vw-consulting')));?>
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="col-lg-4 col-md-4">
                <div class="box-content">
                  <div class="row">
                    <div class="col-lg-4 col-md-12">
                      <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="new-text <?php if(has_post_thumbnail()) { ?>col-lg-68 col-md-8" <?php } else { ?>col-lg-12 col-md-12" <?php } ?>>
                      <h3><?php the_title();?></h3>
                      <hr>
                    </div>
                  </div>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_consulting_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_consulting_services_excerpt_number','20')))); ?></p>
                  <a href="<?php echo esc_url( get_permalink() );?>"><?php esc_html_e('Continue Reading...','vw-consulting'); ?><span class="screen-reader-text"><?php esc_html_e( 'Continue Reading...','vw-consulting' );?></span></a>
                </div>
              </div>
            <?php endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </section>

  <?php do_action( 'vw_consulting_after_services_section' ); ?>

  <div id="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>