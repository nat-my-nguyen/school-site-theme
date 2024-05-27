<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
				//to render designers category
				$args = array(
					'post_type' => 'school-student',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'school-student-category',
							'field' => 'slug',
							'terms' => 'designers'
						)
					)
				);
				//while loop will run through all Students posts
				$query = new WP_Query($args);
				if($query->have_posts()){
					echo '<section class="design-section"><h2>'.esc_html__('Designers') . '</h2>';
					while($query -> have_posts()){
						$query -> the_post();
						?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<h2><?php the_title();?></h2>
								<?php the_post_thumbnail('large'); ?>
							</a>
							<?php the_excerpt(); ?>
						</article>
						<?php
					}
					wp_reset_postdata();
					echo '</section>';
				}
				//to render developers category
				$args = array(
					'post_type' => 'school-student',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'school-student-category',
							'field' => 'slug',
							'terms' => 'developers'
						)
					)
				);
				//while loop will run through all Student posts
				$query = new WP_Query($args);
				if($query->have_posts()){
					echo '<section class="dev-section"><h2>Developers</h2>';
					while($query -> have_posts()){
						$query -> the_post();
						?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<h2><?php the_title();?></h2>
								<?php the_post_thumbnail('large'); ?>
							</a>
							<?php the_excerpt(); ?>
						</article>
						<?php
					}
					wp_reset_postdata();
					echo '</section>';
				}
			
			?>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
