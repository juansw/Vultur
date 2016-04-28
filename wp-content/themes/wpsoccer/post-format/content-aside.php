<?php global $themeum_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="featured-wrap"><a href="<?php the_permalink(); ?>" rel="bookmark">
            <?php       
                the_post_thumbnail('blog-medium', array('class' => 'img-responsive'));
            ?>
            </a><div class="share-btn"><i class="fa fa-share"></i></div>
            <div class="share-btn-pop" style="display:none"><?php get_template_part( 'post-format/social-buttons' ); ?></div>
        </div>
    <?php } ?>

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

</article> <!--/#post-->