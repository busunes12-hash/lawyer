<?php
/**
 * The template for displaying archive pages
 *
 * @package DrAli
 */

get_header();

$is_en = ( get_locale() === 'en_US' );

?>

<main id="primary" class="site-main">

    <!-- Hero Header -->
    <header class="service-hero bg-forest text-white py-16 relative overflow-hidden">
        <div class="container relative z-10">
            <h1 class="service-hero-title text-3.5xl font-bold mb-4">
                <?php the_archive_title(); ?>
            </h1>
        </div>
        <div class="service-hero-overlay absolute inset-0 bg-black opacity-30 pointer-events-none"></div>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs-bar">
        <div class="container">
            <?php dr_ali_breadcrumbs(); ?>
        </div>
    </div>

    <!-- Main Content -->
    <section class="archive-section py-20 bg-white">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 scroll-reveal-group">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card reveal reveal-fade-up'); ?>>
                            <div class="blog-thumbnail-wrapper">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                <?php else : ?>
                                    <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&q=80&w=400" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="blog-content">
                                <span class="blog-meta-date"><?php echo get_the_date(); ?></span>
                                <h3 class="blog-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="blog-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="text-gold font-bold hover:underline inline-flex items-center gap-1 mt-auto">
                                    <?php echo $is_en ? 'Read Article' : 'اقرأ المقال'; ?> <span class="chevron-arrow">→</span>
                                </a>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    ?>
                </div>

                <div class="pagination mt-12 flex justify-center gap-2">
                    <?php
                    echo paginate_links( array(
                        'prev_text' => '«',
                        'next_text' => '»',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="text-center py-20">
                    <h2 class="text-xl font-bold mb-4 text-forest"><?php esc_html_e( 'لا توجد مقالات هنا بعد', 'dr-ali' ); ?></h2>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php
get_footer();
