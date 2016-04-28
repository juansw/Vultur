<?php
/**
 * Display Single Player
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Soccer
 * @version     1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header();
?>

<?php if ( have_posts() ) : the_post(); ?>

<section id="main" class="clearfix">
    
    <?php 
      $banner_src_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
      if ( has_post_thumbnail() && ! post_password_required() ) { ?>
      <div class="player-profile-banner sub-title" style="background-image:url(<?php echo esc_url($banner_src_image[0]);?>);background-size: cover;background-position: 50% 50%;padding:150px 0 90px">
          <div class="container">
              <h2 class="player-profile-title"><?php the_title(); ?></h2>
              <h4 class="player-profile-sub"><?php the_field('subtitulo'); ?></h4>
          </div> <!--container-->   
      </div><!--player-profile-banner-->
      <?php } else { ?>
        <div class="player-profile-banner" style="background-color:#444;padding:150px 0 90px">
          <div class="container">
              <h2 class="player-profile-title"><?php the_title(); ?></h2>
              <h4 class="player-profile-sub"><?php the_field('subtitulo'); ?></h4>
          </div> <!--container-->   
      </div><!--player-profile-banner-->
      <?php } ?>


    <div class="player-profile">      
        <div class="container">   
            <div class="player-profile-inner">    
                <div class="row"> 
                <?php
                  $full_name        = rwmb_meta('themeum_full_name');
                  $position         = rwmb_meta('themeum_position');
                  $match_played     = rwmb_meta('themeum_match_played');

                  $personal_info    = rwmb_meta('personal_info_group');
                  $personal_statistics     = rwmb_meta('personal_statistics_group');
                  $playerimg = get_post_meta($post->ID,'themeum_player_image', true);
                  $src_playerimg  = wp_get_attachment_image_src($playerimg, 'full');

                  //social share
                  $facebook     = rwmb_meta('themeum_facebook');
                  $twitter      = rwmb_meta('themeum_twitter');
                  $googleplus   = rwmb_meta('themeum_google_plus');
                  $instagram    = rwmb_meta('themeum_instagram');
                  $youtube      = rwmb_meta('themeum_youtube');
                  $vimeo        = rwmb_meta('themeum_vimeo');

                  $img = get_post_meta($post->ID,'themeum_club_logo', true);
                  $src_image   = wp_get_attachment_image_src($img, 'full');

                ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                      <div class="col-sm-4"> 
                          <div class="player-profile-leftside"> 
                            <?php if(isset($src_playerimg) && !empty($src_playerimg)){ ?>
                                <img class="img-responsive" src="<?php echo esc_url($src_playerimg[0]); ?>" alt="<?php the_title();?>">
                            <?php }?>    
                            <?php if ($full_name) {?><h3><?php echo esc_html($full_name); ?></h3><?php }?>
                              <?php if ($position){?><span><?php echo esc_html($position); ?></span><?php }?>
                              
                              <?php 
                              foreach ($personal_info as $value) {
                                if ( $value['themeum_information_level'] ) { ?>
                                  <h4><?php echo esc_html($value['themeum_information_level']); ?></h4>
                                  <span><?php echo esc_html($value['themeum_information_data']); ?></span>
                               <?php }
                              }
                              if ( $facebook || $twitter || $googleplus || $instagram || $youtube || $vimeo ) { ?>
                                <div class="player-share">
                                    <ul>
                                      <?php if ($facebook) { ?>
                                        <li><a class="facebook" href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
                                       <?php  } ?>
                                        <?php if ($twitter) { ?>
                                        <li><a class="twitter" href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($googleplus) { ?>
                                        <li><a class="google-plus" href="<?php echo esc_url($googleplus);?>"><i class="fa fa-google-plus"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($instagram) { ?>
                                        <li><a class="instagram" href="<?php echo esc_url($instagram);?>"><i class="fa fa-instagram"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($youtube) { ?>
                                        <li><a class="youtube" href="<?php echo esc_url($youtube);?>"><i class="fa fa-youtube"></i></a></li>
                                        <?php  } ?>
                                        <?php if ($vimeo) { ?>
                                        <li><a class="vimeo" href="<?php echo esc_url($vimeo);?>"><i class="fa fa-vimeo-square"></i></a></li>
                                        <?php  } ?>
                                    </ul>
                                </div>
                              <?php } ?>
                          </div> <!--player-profile-leftside-->
                      </div> <!--col-sm-4-->

                      <div class="col-sm-8"> 
                         <div class="player-profile-rightside">
                           <div class="media"> 
                               <div class="pull-right">
                                  <?php if(isset($src_image) && !empty($src_image)){ ?>
                                  <img src="<?php echo esc_url($src_image[0]); ?>" alt="<?php the_title();?>">
                                  <?php }?>
                                  <?php if ($match_played) { ?>
                                   <h3><?php echo esc_html($match_played);?></h3>
                                  <?php }?>
                                  <!--<span><?php echo __('Matched Played', 'themeum-soccer'); ?></span>-->
                                   
                               </div>
                               <div class="media-body player-career">
                                   <h3><?php echo __('Trayectoria', 'themeum-soccer'); ?></h3>
                                    <ul>
                                      <?php  foreach ($personal_statistics as $key => $value) {
                                        if ( $personal_statistics[$key]['themeum_statistics_level'] && $personal_statistics[$key]['themeum_statistics_data'] ) { ?>
                                          <li class="clearfix"><span><?php echo esc_html($personal_statistics[$key]['themeum_statistics_level']); ?></span>
                                          <span class=""><?php echo esc_html($personal_statistics[$key]['themeum_statistics_data']); ?></span></li>
                                       <?php }
                                      }?>
                                    </ul>  
                               </div>
                            </div>

                             <h3><?php echo __('Descripción', 'themeum-soccer'); ?></h3> 
                             <?php the_content();?>
                        </div> <!--player-profile-rightside-->
                      </div> <!--col-sm-8-->

                     </div><!--/#post-->

                </div> <!--row-->
            </div> <!--player-profile-inner-->
        </div> <!--container-->
    </div> <!--player-profile-->
</section>

<?php endif; ?>

<?php get_footer();

