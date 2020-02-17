<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foolishtest
 */
?>
<div class="fool-md-8">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

        <?php foolishtest_post_thumbnail(); ?>

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
    $slug_tag = get_the_terms($post->ID, array('company_tag'));
    if ($slug_tag) :
        foreach ($slug_tag as $term) :
            $term_tag = $term->name;
            $slugcaps = strtoupper($term_tag);
            // Lets call the API
            MQ_Utilities::fool_api_recommend($slugcaps);
        endforeach;
    endif;
    ?>
</div><!-- .Side api -->



