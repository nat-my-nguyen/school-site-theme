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

			get_template_part( 'template-parts/content', 'page' ); ?>

			<section class="recent-news">
				<h2><?php esc_html_e( 'Recent News', 'school-site' ); ?></h2>
				<?php
				$args = array(
					'post_type'			=> 'post',
					'posts_per_page'	=> 3
				);

				$news_query = new WP_Query( $args );

				if ( $news_query -> have_posts() ) {
					while ( $news_query -> have_posts() ) {
						$news_query -> the_post();
						?>
						<article id="post-<?php the_ID(); ?>">
							<a href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>
						</article>
						<?php
					}
					wp_reset_postdata();
				} ?>
				<p>
					<a href="<?php echo esc_url( get_permalink( get_option('page_for_posts') ) ); ?>">
						Read more News
					</a>
				</p>
			</section>
		<?php
		endwhile; // End of the loop.
		?>
		
	</main><!-- #main -->

<?php
get_footer();
