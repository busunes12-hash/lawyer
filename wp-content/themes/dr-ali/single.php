<?php
/**
 * The template for displaying all single posts
 *
 * @package DrAli
 */

get_header();

$is_en = ( get_locale() === 'en_US' );

?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <!-- Hero Header -->
        <header class="service-hero bg-forest text-white py-16 relative overflow-hidden">
            <div class="container relative z-10">
                <div class="post-meta-tags mb-3 text-xs uppercase tracking-wider text-gold font-bold">
                    <span><?php echo get_the_date(); ?></span>
                    <span class="mx-2">|</span>
                    <span><?php echo get_the_author(); ?></span>
                </div>
                <h1 class="service-hero-title text-3.5xl font-bold mb-4"><?php the_title(); ?></h1>
            </div>
            <div class="service-hero-overlay absolute inset-0 bg-black opacity-45 pointer-events-none"></div>
        </header>

        <!-- Breadcrumbs -->
        <div class="breadcrumbs-bar">
            <div class="container">
                <?php dr_ali_breadcrumbs(); ?>
            </div>
        </div>

        <!-- Article Section -->
        <section class="post-detail-section py-20 bg-white">
            <div class="container max-w-3xl">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-featured-image mb-10 rounded-lg overflow-hidden shadow-sm aspect-video">
                            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content service-main-content leading-relaxed text-lg text-dark-grey">
                        <?php
                        the_content();
                        ?>
                    </div>

                    <!-- Post Footer -->
                    <footer class="entry-footer mt-12 pt-6 border-t border-medium-grey flex justify-between items-center text-sm">
                        <div class="post-tags">
                            <?php the_tags( '<span class="tags-label font-bold text-forest">' . ( $is_en ? 'Tags: ' : 'الوسوم: ' ) . '</span>', ', ' ); ?>
                        </div>
                        <div class="post-navigation-links flex gap-4">
                            <span class="nav-prev"><?php previous_post_link( '%link', '« ' . ( $is_en ? 'Previous' : 'السابق' ) ); ?></span>
                            <span class="nav-next"><?php next_post_link( '%link', ( $is_en ? 'Next' : 'التالي' ) . ' »' ); ?></span>
                        </div>
                    </footer>
                </article>
            </div>
        </section>
    <?php
    endwhile;
    ?>

</main>

<?php
get_footer();
