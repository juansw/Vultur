<?php
if ( ! defined( 'ABSPATH' ) )
  exit; // Exit if accessed directly
  get_header(); 
?>

  <section id="main">

 <?php
  $league_id = '';
  $queried_object = get_queried_object();
  $league_id[] = $queried_object;
  ?>
          <?php
          if(is_array($league_id)):
              if(isset($league_id[0]->slug)): //slug
          ?>

          <!-- ********************************** Banner Start ************************************ -->    
                    <?php 
                      $d = date("Y-m-d h:i");
                      $args = array(
                                  'post_type'     => 'fixture_result',
                                  'posts_per_page'  => 1,
                                  'tax_query' => array(
                                            array(
                                              'taxonomy' => 'league',
                                              'field'    => 'slug', //slug
                                              'terms'    => $league_id[0]->slug,
                                             )
                                          ),
                                  'meta_query' => array(
                                            array(
                                                'key' => 'themeum_datetime',
                                                'value' => $d,
                                                'type' => 'date',
                                                'compare' => '>'
                                            )
                                    ),
                                  'meta_key'          => 'themeum_datetime',
                                  'orderby'           => 'meta_value',
                                  'order'             => 'ASC'
                                );
                      $posts = get_posts($args);

                      $club1 = $club2 = $date1 = $date2 = $date3 = $gmt = '';
                      foreach ($posts as $post){
                          setup_postdata( $post );
                          $date1 = rwmb_meta('themeum_datetime');
                          $team1 = rwmb_meta('team_1_group');
                          $team2 = rwmb_meta('team_2_group');
                          $gmt = rwmb_meta('themeum_gmt');

                          $club1 = $team1['themeum_club_name1'];
                          $club2 = $team2['themeum_club_name2'];

                          }
                      wp_reset_postdata();

                      if($date1 != ''){
                        $date1 = date_format(date_create($date1), 'd M Y h:i A');
                        $date2 = date_format(date_create($date1), 'h:i A');
                        $date3 = date_format(date_create($date1), 'Y');
                      }

                      
                      
                    ?>

          <div class="match-banner league-banner sub-title" style="background-image:url(<?php echo esc_url($themeum_options['league-banner']['url']); ?>);background-size: cover;background-position: 50% 50%;padding:100px 0 50px">
              <div class="container">

                  <div class="text-center">
                  <?php if(count($posts) >= 1): ?>
                      <h2 class="match-detail-league-title"><?php _e('Next Match','themeum-soccer'); ?> - <?php if( $date1 != '' ){ echo esc_attr($date1).' '.esc_attr($gmt); } ?></h2>
                  <?php else: ?>
                      <h2 class="match-detail-league-title"><?php single_term_title(); ?></h2>
                  <?php endif; ?>

                  </div>
                  <div class="row">
                      <div class="col-xs-12 col-sm-5">
                          <div class="matech-team pull-right">
                              <div class="icon-left">
                                  <?php if( $club1 != '' ): ?><img width="61" src="<?php echo esc_url(themeum_logo_url_by_id($club1)); ?>" alt="<?php echo esc_attr(themeum_get_title_by_id($club1)); ?>"><?php endif; ?>
                              </div>
                              <div class="title">
                                  <?php if( $club1 != '' ): ?><h4><?php echo esc_attr(themeum_get_title_by_id($club1)); ?></h4><?php endif; ?>
                              </div>
                          </div>
                      </div>
                      
                      <?php if(count($posts) >= 1): ?>
                      <div class="col-xs-12 col-sm-2 score league">
                          <span> VS </span>
                          <span class="time"><?php if( $date2 != '' ){ echo esc_attr($date2).' '.esc_attr($gmt); } ?></span>
                      </div>
                      <?php endif; ?>

                      <div class="col-xs-12 col-sm-5">
                          <div class="matech-team pull-left">
                              <div class="title">
                                  <?php if( $club2 != '' ): ?><h4 class="title"><?php echo esc_attr(themeum_get_title_by_id($club2)); ?></h4><?php endif; ?>
                              </div>
                              <div class="icon-right">
                                  <?php if( $club2 != '' ): ?><img width="61" src="<?php if( $club2 != '' ){ echo esc_url(themeum_logo_url_by_id($club2)); } ?>" alt="<?php echo esc_attr(themeum_get_title_by_id($club2)); ?>"><?php endif; ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div> <!--container-->
          </div> <!--match-banner-->
          <!-- ********************************** Banner Stop ************************************ -->



          <div class="match-details">
                <div class="container">
                    <div class="match-details-inner">
                        <div class="match-details-tab" role="tabpanel">
                            <!-- Nav tabs -->
                            <div class="fixture-middles text-center">
                                <h3><?php echo single_term_title(); ?><?php if( $date3!= '' ){  echo ' - '.esc_attr($date3); } ?></h3>
                            </div>
                            <ul class="nav nav-tabs match-details-tab-nav" role="tablist">
                                <li role="presentation" class="active"><a href="#fixtures" aria-controls="fixtures" role="tab" data-toggle="tab"><?php _e('Fixtures','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#results" aria-controls="results" role="tab" data-toggle="tab"><?php _e('Results','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#standings" aria-controls="standings" role="tab" data-toggle="tab"><?php _e('Standings','themeum-soccer');?></a></li>
                                <li role="presentation"><a href="#teams" aria-controls="teams" role="tab" data-toggle="tab"><?php _e('Teams','themeum-soccer');?></a></li>
                            </ul>



                            <!-- Tab panes -->
                            <div class="tab-content match-details-tab-content">




                                <!-- ********************************** Fixture ************************************ -->
                                <div role="tabpanel" class="tab-pane fade in active" id="fixtures">
                                    <?php 
                                    if(is_array($league_id)){

                                        if(isset($league_id[0]->slug)){
                                          //echo $league_id[0]->term_id;
                                              $args = array(
                                                      'post_type'     => 'fixture_result',
                                                      'posts_per_page'  => -1,
                                                      'tax_query' => array(
                                                                array(
                                                                  'taxonomy' => 'league',
                                                                  'field'    => 'slug',
                                                                  'terms'    => $league_id[0]->slug,
                                                                ),
                                                              ),
                                                      'meta_key'          => 'themeum_datetime',
                                                      'orderby'           => 'meta_value',
                                                      'order'             => 'DESC'
                                                    );
                                                $posts = get_posts($args);
                                                $output = '';

                                                $output = '<div class="fixture-teams">';
                                                  $output .= '<div class="fixture-teams-list">';
                                                      $output .= '<div class="row">';
                                                          $output .= '<h3 class="fixture-title">'.__('Fixture','themeum-soccer').'</h3>';
                                                      $output .= '</div>';



                                                      foreach ($posts as $post){
                                                        setup_postdata( $post );
                                                        $team_1_group    = rwmb_meta('team_1_group');
                                                        $team_2_group    = rwmb_meta('team_2_group');
                                                        $home_ground     = rwmb_meta('themeum_home_ground');
                                                        $datetime      = rwmb_meta('themeum_datetime');
                                                        $gmt         = rwmb_meta('themeum_gmt');

                                                                
                                                                  $output .= '<div class="row fixture-team-inner clearfix">';
                                                                      $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
                                                                        if($team_1_group['themeum_club_name1'] != ''){
                                                                            $output .= '<img width="40" class="pull-left" src="'.esc_url(themeum_logo_url_by_id($team_1_group['themeum_club_name1'])).'" alt="'.esc_attr(themeum_get_title_by_id($team_1_group['themeum_club_name1'])).'">';
                                                                          }
                                                                          if($team_1_group['themeum_club_name1'] != ''){
                                                                            $output .= '<h4>'.esc_attr(themeum_get_title_by_id($team_1_group['themeum_club_name1'])).'</h4>';
                                                                          } 
                                                                      $output .= '</div>';
                                                                      $output .= '<div class="col-xs-4 col-sm-4 status text-center"> '.date_format(date_create($datetime), 'Y-M-d h:i A');
                                                                        if($home_ground != '' ){
                                                                          $output .= '<span>'.esc_attr(themeum_get_title_by_id($home_ground)).'</span>';
                                                                        }
                                                                      $output .= '</div>';
                                                                      $output .= '<div class="col-xs-4 col-sm-4 text-right">';
                                                                          if($team_2_group['themeum_club_name2'] != ''){
                                                                            $output .= '<img width="40" class="pull-right" src="'.esc_url(themeum_logo_url_by_id($team_2_group['themeum_club_name2'])).'" alt="'.esc_attr(themeum_get_title_by_id($team_2_group['themeum_club_name2'])).'"> ';
                                                                          }
                                                                          if($team_2_group['themeum_club_name2'] != ''){
                                                                            $output .= '<h4>'.esc_attr(themeum_get_title_by_id($team_2_group['themeum_club_name2'])).'</h4>';
                                                                          }
                                                                      $output .= '</div>';
                                                                  $output .= '</div>';
                                                              }
                                                      wp_reset_postdata();


                                                    $output .= '</div>';
                                                $output .= '</div>';

                                                echo $output;

                                        }
                                    }

                                    ?>
                                </div>
                                <!-- ********************************** Fixture ************************************ -->




                                <!-- ********************************** Results ************************************ -->
                                <div role="tabpanel" class="tab-pane fade in" id="results">
                                    <?php
                                        if(is_array($league_id)){

                                        if(isset($league_id[0]->slug)){

                                          $args = array(
                                                          'post_type'     => 'fixture_result',
                                                          'posts_per_page'  => -1,
                                                          'tax_query' => array(
                                                                    array(
                                                                      'taxonomy' => 'league',
                                                                      'field'    => 'slug',
                                                                      'terms'    => $league_id[0]->slug,
                                                                    )
                                                                  ),
                                                          'meta_key'          => 'themeum_datetime',
                                                          'orderby'           => 'meta_value',
                                                          'order'             => 'DESC'
                                                        );
                                        $posts = get_posts($args);
                                        $output = '';



                                        $output .= '<div class="fixture-teams">';
                                          $output .= '<div class="fixture-teams-list result-list">';

                                              $output .= '<div class="row">';
                                                  $output .= '<h3 class="fixture-title">'.__('Results','themeum-soccer').'</h3>';
                                              $output .= '</div>';

                                              foreach ($posts as $post){
                                                    setup_postdata( $post );
                                                    
                                                    $match_result    = rwmb_meta('themeum_goal_count');

                                                    $team_1    = rwmb_meta('team_1_group');
                                                    $team_2    = rwmb_meta('team_2_group');

                                                    //$output .= print_r($team_2,true);

                                                    if( $match_result != '' ){
                                                    $output .= '<a href='.get_permalink().'><div class="row fixture-team-inner clearfix">';
                                                      $output .= '<div class="col-xs-4 col-sm-4 paddingleft">';
                                                          $output .= '<img width="40" class="pull-left" src="'.esc_url(themeum_logo_url_by_id($team_1["themeum_club_name1"])).'" alt="'.esc_attr(themeum_get_title_by_id($team_1["themeum_club_name1"])).'"> ';
                                                          $output .= '<h4>'.esc_attr(themeum_get_title_by_id($team_1["themeum_club_name1"])).'</h4>';
                                                      $output .= '</div>';
                                                      
                                                      $gmt = rwmb_meta('themeum_gmt');
                                                      $sports_date = date_format(date_create(rwmb_meta("themeum_datetime")), 'd M Y h:i A').' '.esc_attr($gmt);
                                                      
                                                      $output .= '<div class="col-xs-4 col-sm-4 status text-center"> '.esc_attr($match_result).' <span class="match-date">'.$sports_date.'</span></div> ';
                                                      $output .= '<div class="col-xs-4 col-sm-4 text-right">';
                                                          $output .= '<img width="40" class="pull-right" src="'.esc_url(themeum_logo_url_by_id($team_2["themeum_club_name2"])).'" alt="'.esc_attr(themeum_get_title_by_id($team_2["themeum_club_name2"])).'">';
                                                          $output .= '<h4>'.esc_attr(themeum_get_title_by_id($team_2["themeum_club_name2"])).'</h4>                                           ';
                                                      $output .= '</div>                                            ';
                                                    $output .= '</div></a>';
                                                    } 
                                                }
                                              wp_reset_postdata();

                                          $output .= '</div>';
                                        $output .= '</div>';

                                        echo $output;
                                      }
                                    }
                                    ?>
                                </div>
                                <!-- ********************************** Results ************************************ -->



                                <!-- ********************************** Standing ************************************ -->
                                <div role="tabpanel" class="tab-pane fade in" id="standings">
                                    <?php
                                      if(is_array($league_id)){
                                          if(isset($league_id[0]->slug)){

                                                $args = array(
                                                          'post_type'     => 'point_table',
                                                          'posts_per_page'  => -1,
                                                          'tax_query' => array(
                                                                    array(
                                                                      'taxonomy' => 'league',
                                                                      'field'    => 'slug',
                                                                      'terms'    => $league_id[0]->slug,
                                                                    )
                                                                  )
                                                        );
                                                $posts = get_posts($args);
                                                $output = '';


                                                $output = '<div class="fixture-teams"><div class="point-table table-responsive">';
                                                $output .= '<table class="table table-striped">';
                                                
                                                foreach ($posts as $post){
                                                  setup_postdata( $post );

                                                  $point_table    = rwmb_meta('point_table_group');
                                                  usort($point_table, 'sort_by_points');
                                                  $i=1;
                                                  $output .= '<thead class="point-table-head"><tr><th class="text-left">No</th><th class="text-left">TEAM</th><th>P</th><th>W</th><th>D</th><th>L</th><th>GS</th><th>GA</th><th>+/-</th><th>PTS</th></tr></thead>';
                                                  $output .= '<tbody>';
                                                  foreach ($point_table as  $value) {
                                                    if ( $value['themeum_club_name'] ) {
                                                      $output .= '<tr>';
                                                      $output .= '<td class="text-left">'.$i.'</td>';
                                                      $output .= '<td class="text-left"><img class="point-table-image" src="'.esc_url(themeum_logo_url_by_id($value['themeum_club_name'])).'" alt="'.get_the_title($value['themeum_club_name']).'"><span>'.get_the_title($value['themeum_club_name']).'</span></td>';
                                                      $output .= '<td>'.$value['themeum_games_played'].'</td>';
                                                      $output .= '<td>'.$value['themeum_games_won'].'</td>';
                                                      $output .= '<td>'.$value['themeum_games_drown'].'</td>';
                                                      $output .= '<td>'.$value['themeum_games_lost'].'</td>';
                                                      $output .= '<td>'.$value['themeum_goals_scored'].'</td>';
                                                      $output .= '<td>'.$value['themeum_goals_against'].'</td>';
                                                      $output .= '<td>'.$value['themeum_goals_difference'].'</td>';
                                                      $output .= '<td>'.$value['themeum_points'].'</td>';
                                                      $output .= '</tr>';

                                                    $i++; 
                                                    }
                                                  }
                                                  $output .= '</tbody>';
                                                }
                                                wp_reset_postdata();
                                                $output .= '</table>';
                                                $output .= '</div></div>';

                                                echo $output;
                                          }
                                      }
                                    ?>
                                </div>
                                <!-- ********************************** Standing ************************************ -->




                                <!-- ********************************** Team Start ********************************** -->
                                <div role="tabpanel" class="tab-pane fade in" id="teams">
                                    <?php
                                    if(is_array($league_id)){
                                          if(isset($league_id[0]->slug)){

                                                  $args = array(
                                                          'post_type'     => 'fixture_result',
                                                          'posts_per_page'  => -1,
                                                          'tax_query' => array(
                                                                    array(
                                                                      'taxonomy' => 'league',
                                                                      'field'    => 'slug',
                                                                      'terms'    => $league_id[0]->slug,
                                                                    )
                                                                  )
                                                        );
                                                  $posts = get_posts($args);


                                                  $team_id_list = array();
                                                  foreach ($posts as $post){
                                                        setup_postdata( $post );
                                                        $team_1    = rwmb_meta('team_1_group');
                                                        $team_2    = rwmb_meta('team_2_group');
                                                        $team_id_list[] = $team_1["themeum_club_name1"];
                                                        $team_id_list[] = $team_2["themeum_club_name2"];
                                                  }
                                                  wp_reset_postdata();
                                                  $team_id_list = array_unique($team_id_list);

                                                  $args2 = array();
                                                  if(is_array($team_id_list)){
                                                    $args2 = array(
                                                    'post_type'     => 'club',
                                                    'post__in'      => $team_id_list,
                                                    'posts_per_page'  => -1,
                                                  );  
                                                  }
                                                  $posts2 = get_posts($args2);
                                                  $count = count($posts2);
                                                  $output = '';

                                                  //print_r($posts2);



                                                  $output .= '<div class="fixture-teams">';
                                                        $output .= '<div class="fixture-teams-list result-list">';
                                                            
                                                            $output .= '<div class="row">';
                                                                $output .= '<h3 class="fixture-title">'.__('Team List','themeum-soccer').'</h3>';
                                                            $output .= '</div>';

                                                            $i=0;
                                                            $count = count($posts2); 

                                                            foreach ($posts2 as $post){
                                                              setup_postdata( $post );
                                                              $club_logo = rwmb_meta('themeum_club_logo');
                                                              
                                                              $club_logo = get_post_thumbnail_id( get_the_ID() );

                                                                if($i%2==0){
                                                                    $output .= '<div class="row fixture-team-inner clearfix">';
                                                                  }

                                                                $output .= '<div class="col-sm-6 paddingleft">';
                                                                    $output .= '<img width="40" class="pull-left" src="'.esc_url(wp_get_attachment_image_src($club_logo,'full', true)[0]).'" alt="'.esc_attr(themeum_get_title_by_id($club1)).'"> ';
                                                                    $output .= '<h4>'.get_the_title().'</h4>';
                                                                $output .= '</div>';

                                                                $i++;
                                                                if( $i%2==0 || $count == $i ){
                                                                  $output .= '</div>';
                                                                }
                                                                
                                                            }
                                                            wp_reset_postdata();      

                                                        $output .= '</div>';
                                                    $output .= '</div>';


                                                    echo $output;
                                          }
                                      }
                                    ?>
                                </div>
                                <!-- ********************************** Team Start ********************************** -->



                            </div>


                        </div>
                    </div>
                </div>
          </div>
        <?php 
        endif;
        endif;
        ?>


  </section> <!--/#main-->
<?php get_footer();