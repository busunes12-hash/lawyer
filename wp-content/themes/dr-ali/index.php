<?php
/**
 * The main template file
 *
 * @package DrAli
 */

get_header(); ?>

<main id="primary" class="site-main container py-10">
    <?php if ( have_posts() ) : ?>
        <header class="page-header mb-8">
            <h1 class="page-title text-3xl font-bold text-forest border-b-2 border-gold pb-2 inline-block">
                <?php
                if ( is_home() && ! is_front_page() ) {
                    single_post_title();
                } else {
                    the_archive_title();
                }
                ?>
            </h1>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 scroll-reveal-group">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 rounded-lg shadow-sm border border-light-grey hover:shadow-md transition duration-300 scroll-reveal-item'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail mb-4 rounded-md overflow-hidden aspect-video">
                            <?php the_post_thumbnail( 'medium', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <h2 class="entry-title text-xl font-bold mb-2 text-forest hover:text-gold transition">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div class="entry-meta text-xs text-grey mb-4">
                        <span><?php echo get_the_date(); ?></span>
                    </div>

                    <div class="entry-excerpt text-dark-grey text-sm mb-4">
                        <?php the_excerpt(); ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="text-gold font-bold hover:underline inline-flex items-center gap-1">
                        <?php esc_html_e( 'اقرأ المزيد', 'dr-ali' ); ?>
                        <span class="chevron-arrow">→</span>
                    </a>
                </article>
            <?php endwhile; ?>
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
        <section class="no-results not-found text-center py-20">
            <h1 class="page-title text-2xl font-bold mb-4 text-forest"><?php esc_html_e( 'لم يتم العثور على نتائج', 'dr-ali' ); ?></h1>
            <p class="text-dark-grey mb-6"><?php esc_html_e( 'يبدو أنه لم يتم العثور على أي محتوى هنا.', 'dr-ali' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary"><?php esc_html_e( 'العودة للرئيسية', 'dr-ali' ); ?></a>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
