<?php
/**
 * Template part for displaying company content in page-company.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foolishtest
 */
?>
<div class="fool-md-8">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


        <?php
        /*
         * Recommended Articles
         */
        // if it is not the first page lets hide this part
        if (!is_paged()) :
            // Get all the Company tags we added as categories
            $categories = get_the_terms($post->ID, 'company_tag');


            if (!empty($categories)) :
                // Loop through all the returned terms even that I know it will only return one
                foreach ($categories as $category):

                    // set up a new query for each category, pulling in related posts.
                    $company_query = new WP_Query(
                            array(
                        'post_type' => 'fool_stocks',
                        'showposts' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'company_tag',
                                'terms' => array($category->slug),
                                'field' => 'slug'
                            )
                        ),
                        'order' => 'DESC', // 'ASC'
                        'orderby' => 'date' // modified | title | name | ID | rand
                            )
                    );

                    if ($company_query->have_posts()) {
                        ?>

                        <h3>Recommendations</h3>
                        <ul>
                            <?php while ($company_query->have_posts()) : $company_query->the_post(); ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; ?>
                        </ul>

                        <?php
                    }
                    // Reset things, for good measure
                    $company_query = null;
                    wp_reset_postdata();

                    // end the loop
                endforeach;
            //end condition	
            endif;
        //end condition	
        endif;
        ?>


        <?php
        /*
         *  News Articles section
         */
        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) { // 'page' is used instead of 'paged' on Static Front Page
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $custom_query_args = array(
            'post_type' => 'post',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => $paged,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'order' => 'DESC', // 'ASC'
            'orderby' => 'date' // modified | title | name | ID | rand
        );
        $custom_query = new WP_Query($custom_query_args);

        if ($custom_query->have_posts()) :
            echo '<h3>Other Coverage</h3>';
            echo '<ul>';
            while ($custom_query->have_posts()) : $custom_query->the_post();
                ?>

                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                <?php
            endwhile;
            echo '</ul>';
            ?>

            <?php if ($custom_query->max_num_pages > 1) : // custom pagination  ?>
                <?php
                $orig_query = $wp_query; // fix for pagination to work
                $wp_query = $custom_query;
                ?>
                <nav class="prev-next-posts">
                    <div class="prev-posts-link">
                        <?php echo get_next_posts_link('Older Entries', $custom_query->max_num_pages); ?>
                    </div>
                    <div class="next-posts-link">
                        <?php echo get_previous_posts_link('Newer Entries'); ?>
                    </div>
                </nav>
                <?php
                $wp_query = $orig_query; // fix for pagination to work
                ?>
            <?php endif; ?>

            <?php
            wp_reset_postdata(); // reset the query 
        else:
            echo '<p>' . __('Sorry, no posts matched your criteria.') . '</p>';
        endif;
        ?>



        <header class="entry-header">
            <?php
            the_title('<h1 class="entry-title">', '</h1>');
            if (( 'fool_company' === get_post_type() ) || ( 'fool_stocks' === get_post_type() )) :
                ?>
                <div class="entry-meta">
                    <?php
                    foolishtest_posted_on();
                    foolishtest_posted_by();
                    ?>
                </div><!-- .entry-meta -->
<?php endif; ?>
        </header><!-- .entry-header -->



        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'foolishtest'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

            <?php if (get_edit_post_link()) : ?>
            <footer class="entry-footer">
                <?php
                edit_post_link(
                        sprintf(
                                wp_kses(
                                        /* translators: %s: Name of current post. Only visible to screen readers */
                                        __('Edit <span class="screen-reader-text">%s</span>', 'foolishtest'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                ),
                                get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                );
                ?>
            </footer><!-- .entry-footer -->
<?php endif; ?>
    </article><!-- #post-<?php the_ID(); ?> -->
</div>
<div class="fool-md-4">
    <?php
    /*
     * The Data pulled from the company profile API
     */
    $slug_tag = get_the_terms($post->ID, 'company_tag');

    if ($slug_tag) :
        foreach ($slug_tag as $term) :
            $term_tag = $term->name;
            $slugcaps = strtoupper($term_tag);

            // Fucntion that pulls the data and shows it on screen
            MQ_Utilities::fool_api_company($slugcaps);
        endforeach;
    endif;
    ?>
</div><!-- .Side api -->



