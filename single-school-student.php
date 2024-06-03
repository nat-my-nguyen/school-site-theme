<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Site
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article>

            <!-- Link to the single post -->
            <a href="<?php the_permalink(); ?>">

                <!-- Post title -->
                <h2><?php the_title(); ?></h2>

                <!-- Post thumbnail (featured image) -->
                <?php the_post_thumbnail('custom-size', array('class'=>'alignleft')); ?>

            </a>

            <!-- Post excerpt -->
            <?php the_content(); ?>

        </article>
		<?php get_template_part('template-parts/meet-others'); ?>
    <?php endwhile; // End of the loop. ?>
	
</main><!-- #main -->

<?php
get_footer();
?>
