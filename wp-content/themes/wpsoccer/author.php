<?php get_header(); ?>

<section id="main">

   <?php get_template_part('lib/sub-header')?>
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-md-8" role="main">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                    <?php endwhile; ?>

                    <?php themeum_pagination(); ?>

                <?php else: ?>
                <?php get_template_part( 'post-format/content', 'none' ); ?>
            <?php endif; ?>

        </div> <!-- #content -->

        <?php get_sidebar(); ?>
        <!-- #sidebar -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section> 

<?php get_footer();