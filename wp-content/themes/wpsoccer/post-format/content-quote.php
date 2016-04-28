<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( rwmb_meta( 'thm_qoute' ) ) { ?>
    <div class="featured-wrap">
        <div class="entry-qoute">
            <blockquote>
                <p><?php echo esc_html(rwmb_meta( 'thm_qoute' )); ?></p>
                <small><?php echo esc_html(rwmb_meta( 'thm_qoute_author' )); ?></small>
            </blockquote>
        </div>
        <div class="share-btn"><i class="fa fa-share"></i></div>
        <div class="share-btn-pop" style="display:none"><?php get_template_part( 'post-format/social-buttons' ); ?></div>          
    </div>
    <?php } ?>

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

</article> <!--/#post -->