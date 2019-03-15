<?php get_header(); ?>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?> <a href="https://github.com/rsilveira65/conceptainc"><img src="https://avatars0.githubusercontent.com/u/9919?s=280&v=4" height="50" width="50"></a></h1>
        <?php the_content(); ?>

        <?php endwhile; ?>

    <?php endif; ?>

<?php get_footer(); ?>
