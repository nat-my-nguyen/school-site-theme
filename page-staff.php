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

					if ( $query -> have_posts() ){
						//Output term name
						echo '<h2>' . esc_html( $term->name ) . '</h2>';
						//Output content
						while ( $query -> have_posts() ) {
							$query -> the_post();
			
							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'staff_biography' ) ) {
									the_field( 'staff_biography' );
								}

								if ( get_field( 'list_of_courses' ) ) {
									
									the_field( 'list_of_courses' );
								}
								
								if ( get_field( 'instructors_website' ) ) {
									the_field( 'instructors_website' );
								}
							}
						}
						wp_reset_postdata();
					}
				}
			};

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
