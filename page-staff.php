<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			//Organize Staff content with Terms
			$taxonomy = 'school-staff-category';
			$terms = get_terms(
				array(
					'taxonomy'	=> $taxonomy,
				)
			);
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$args = array(
						'post_type'		=> 'school-staff',
						'posts_per_page'=> -1,
						'tax_query'		=> array(
							array(
								'taxonomy'	=> $taxonomy,
								'field'		=> 'slug',
								'terms'		=> $term->slug,
							),
						),
					);
					$query = new WP_Query( $args );
					if ( $query -> have_posts() ){ ?>

						<section class="staff-container">
						<h2><?php echo esc_html( $term->name ); ?></h2>

						<?php 
						while ( $query -> have_posts() ) {
							$query -> the_post(); ?>

							<article class="staff-item">
								<h3><?php echo esc_html( get_the_title() ); ?></h3>

							<?php
							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'staff_biography' ) ) {
									echo wp_kses_post( get_field( 'staff_biography' ) );
								}
								if ( get_field( 'list_of_courses' ) ) { ?>
									<p>Courses: <?php echo esc_html( get_field( 'list_of_courses' ) ) ?></p>
								<?php 
								}
								if ( get_field( 'instructors_website' ) ) { ?>
									<a href="<?php echo esc_url( get_field( 'instructors_website' ) ); ?>">Instructor Website</a>
								<?php
								}
							}?>
							</article>
						<?php 
						} ?>
						</section>
						<?php
						wp_reset_postdata();
					}
				}
			};

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
