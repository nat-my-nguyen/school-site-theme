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

			if ( function_exists( 'get_field' ) && get_field( 'schedule_table' ) ) { ?>
				<table class="course-table">
					<caption>Weekly Course Schedule</caption>
					<thead>
						<tr>
							<?php
							$field = get_field_object( 'schedule_table' );
							$sub_fields = $field['sub_fields'];

							//Dynamically displays the sub field's label
							foreach ( $sub_fields as $sub_field ) { ?>
                                <th><?php echo esc_html( $sub_field['label'] ); ?></th>
                            <?php 
							} ?>
						</tr>
					</thead>
					<tbody>
						<?php
						if ( have_rows( 'schedule_table' ) ) {
							while ( have_rows( 'schedule_table' ) ) {
								the_row(); ?>
								<tr>
									<td><?php echo esc_html( get_sub_field( 'date' ) ); ?></td>
									<td><?php echo esc_html( get_sub_field( 'course' ) ); ?></td>
									<td>
										<?php
										$instructor = get_sub_field( 'instructor' );
										if ( $instructor ) {
											echo esc_html( $instructor->post_title );
										} ?>
									</td>
								</tr>
							<?php
							}
						} ?>
					</tbody>
				</table>
				<?php
			}

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
