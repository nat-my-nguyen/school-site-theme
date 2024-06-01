<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Site
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-branding">
			<?php the_custom_logo(); ?>
		</div>
		<div class="site-info">
			<h3>Credits</h3>
			<p>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'school-site' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'school-site' ), 'WordPress' );
					?>
				</a>
			</p>
			<p>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-site' ), 'school-site', '<a href="https://carolc.sgedu.site/school-site">Natalia Nguyen and Carol Chan</a>' );
				?>
			</p>
		</div><!-- .site-info -->
		<div class="footer-menu">
			<h3>Links</h3>
			<nav>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-right',) ); ?>
			</nav>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<!-- AOS feature by https://github.com/michalsnik/aos -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<?php wp_footer(); ?>

</body>
</html>
