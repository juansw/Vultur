<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $themeum_options;
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no">
	<?php 
	if(isset($themeum_options['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo esc_url($themeum_options['favicon']['url']); ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri().'/images/plus.png'); ?>" type="image/x-icon"/>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65593413-2', 'auto');
  ga('send', 'pageview');

</script>
	<?php wp_head(); ?>
</head>

 <?php 

     if ( isset($themeum_options['boxfull-en']) ) {
      $layout = esc_attr($themeum_options['boxfull-en']);
     }else{
        $layout = 'fullwidth';
     }
 ?>

<body <?php body_class( $layout.'-bg' ); ?>>
	<div id="page" class="hfeed site <?php echo esc_attr($layout); ?>">
		<header id="masthead" class="site-header header" role="banner">
			<div id="header-container">
				<div id="navigation" class="container">
                    <div class="row">
                        <div class="col-sm-3">
        					<div class="navbar-header">
        						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        						</button>
                                <div class="logo-wrapper">
        	                       <a class="navbar-brand" href="<?php echo site_url(); ?>">
        		                    	<?php
        									if (isset($themeum_options['logo']))
        								   {
        								   		
        										if($themeum_options['logo-text-en']) { ?>
        											<h1> <?php echo esc_html($themeum_options['logo-text']); ?> </h1>
        										<?php }
        										else
        										{
        											if(!empty($themeum_options['logo'])) {
        											?>
        												<img class="enter-logo img-responsive" src="<?php echo esc_url($themeum_options['logo']['url']); ?>" alt="" title="">
        											<?php
        											}else{
        												echo esc_html(get_bloginfo('name'));
        											}
        										}
        								   }
        									else
        								   {
        								    	echo esc_html(get_bloginfo('name'));
        								   }
        								?>
        		                     </a>
                                </div>     
        					</div>    
                        </div>

                        <div class="col-sm-9 woo-menu-item-add">
                            <?php 
                                global $woocommerce;
                                if($woocommerce) { ?>
                                    <span id="themeum-woo-cart" class="woo-cart" style="display:none;">
                                        
                                            <?php
                                                $has_products = '';
                                                //if($woocommerce->cart->cart_contents_count) {
                                                $has_products = 'cart-has-products';
                                                //}
                                            ?>
                                            <span class="woo-cart-items">
                                                <span class="<?php echo $has_products; ?>"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                                            </span>
                                            <i class="fa fa-shopping-cart"></i>
                                        
                                        <?php the_widget( 'WC_Widget_Cart', 'title= ' ); ?>
                                    </span>
                                <?php } ?> 
                            <div id="main-menu" class="hidden-xs">

                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '', 
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 3,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    ); 
                                }
                                //$output .= '<div class="col-md-3 home-search hidden-xs hidden-sm pull-right">';
								//$output .= get_search_form(); 
                        		//$output .= '</div>';
                                ?>

                            </div><!--/#main-menu--> 
                        </div>
                        
                        

                        <div id="mobile-menu" class="visible-xs">
                            <div class="collapse navbar-collapse">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'      => 'primary',
                                        'container'           => false,
                                        'menu_class'          => 'nav navbar-nav',
                                        'fallback_cb'         => 'wp_page_menu',
                                        'depth'               => 3,
                                        'walker'              => new wp_bootstrap_mobile_navwalker()
                                        )
                                    ); 
                                }
                                ?>
                            </div>
                        </div><!--/.#mobile-menu-->
                    </div><!--/.row--> 
				</div><!--/.container--> 
			</div>

		</header><!--/#header-->

        <?php
        if ( has_nav_menu( 'secondary_nav' ) )
        { ?>
        <div id="secondary-menu">
            <div class="secondary-menu-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="secondary-menu">
                                <div class="navbar">

                                    <?php    $default = array( 'theme_location'  => 'secondary_nav',
                                                          'container'       => '', 
                                                          'menu_class'      => 'nav navbar-nav',
                                                          'menu_id'         => 'menu-secondary-menu',
                                                          'fallback_cb'     => 'wp_page_menu',
                                                          'depth'           => 1,
                                                          'walker'          => new wp_bootstrap_mobile_navwalker()
                                            );
                                        wp_nav_menu($default);

                                    ?>
                                </div><!--/.navbar--> 
                            </div><!--/.secondary-menu-->
                        </div><!--/.col-md-9-->
                        <div class="col-md-3 home-search hidden-xs hidden-sm colorSearch">
                            <?php echo get_search_form();?>
                        </div><!--/.container-->
                    </div><!--/.row-->
                </div><!--/.container-->
            </div> <!--/secondary-menu-wrap-->
        </div> <!--/#secondary-menu-->
        <?php }?>




        <!-- sign in form -->
        <div id="sign-form">
             <div id="sign-in" class="modal fade">
                <div class="modal-dialog modal-md">
                     <div class="modal-content">
                         <div class="modal-header">
                             <i class="fa fa-close close" data-dismiss="modal"></i>
                         </div>
                         <div class="modal-body text-center">
                             <h3><?php _e('Welcome','themeum'); ?></h3>
                             <form id="login" action="login" method="post">
                                <div class="login-error alert alert-info" role="alert"></div>
                                <input type="text"  id="username" name="username" class="form-control" placeholder="<?php _e('User Name','themeum'); ?>">
                                <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e('Password','themeum'); ?>">
                                <input type="submit" class="btn btn-default btn-block submit_button"  value="Login" name="submit">
                                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><strong><?php _e('Forgot password?','themeum'); ?></strong></a>
                                <p><?php _e('Not a member?','themeum'); ?> <a href="<?php echo esc_url(get_permalink(get_option('register_page_id'))); ?>"><strong><?php _e('Join today','themeum'); ?></strong></a></p>
                                <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                             </form>
                         </div>
                     </div>
                 </div> 
             </div>
        </div> <!-- end sign-in form -->
        <div id="logout-url" class="hidden"><?php echo esc_url(wp_logout_url( home_url() )); ?></div>
