<?php
// Get the current post object
$current_post = get_post();

// Get the terms (categories) associated with the current post
$terms = wp_get_post_terms( $current_post->ID, 'school-student-category' );

if ( $terms && ! is_wp_error($terms) ) : ?>
    <section>  
        <?php foreach ( $terms as $term ) : ?>
            <h2><?php esc_html_e( 'Meet Other ', 'school-site' ); ?><span><?php echo esc_html( $term->name ); ?></span></h2>
                <?php
                // Get other students in the same category
                $students = get_posts( array(
                    'post_type' => 'school-student', // Assuming 'school-student' is the custom post type for students
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'school-student-category',
                            'field'    => 'term_id',
                            'terms'    => $term->term_id,
                        ),
                    ),
                    'posts_per_page' => -1, // Retrieve all students in the category
                    'exclude' => $current_post->ID, // Exclude the current post from the list
                ) );
                ?>
                <?php if ( $students ) : ?>
                    <ul>
                        <?php foreach ( $students as $student ) : ?>
                            <li><a href="<?php echo esc_url( get_permalink( $student->ID ) ); ?>"><?php echo esc_html( $student->post_title ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
        <?php endforeach; ?>
        
    </section>
<?php endif; ?>
