<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		//get_queried_object() to get the current category object. 
		$current_category = get_queried_object();
		
		$tax_query = array(
			array(
				'taxonomy' => 'school-student-category',
				'field'    => 'slug',
				// Use the current category's slug
				'terms'    => array( $current_category->slug ),
			),
		);
	
		$query_args = array(
			'post_type'      => 'school-student',
			'posts_per_page' => -1,
			'tax_query'      => $tax_query,
		);
	
		$the_query = new WP_Query($query_args);

		if ($the_query->have_posts()) :
		?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ($the_query->have_posts()) :
				$the_query->the_post();
				?>
				<article>
					<a href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
						<?php the_post_thumbnail('custom-size'); ?>
					</a>
					<?php the_content(); ?>
				</article>
			<?php
			endwhile;

			wp_reset_postdata();

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #primary -->

<?php

get_footer();
?>
