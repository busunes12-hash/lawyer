<?php
/**
 * Template Name: Team Grid
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
                <?php echo $is_en ? 'Our Legal Team' : 'فريق المحامين والمستشارين'; ?>
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

    <!-- Main Section -->
    <section class="team-grid-section py-20 bg-white">
        <div class="container">
            
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'EXPERTS' : 'الخبرات'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'Dedicated Legal Experts' : 'نخبة من المستشارين في خدمتكم'; ?></h2>
            </div>

            <div class="team-grid-container scroll-reveal-group">
                <?php
                $team_query = new WP_Query( array(
                    'post_type'      => 'team',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                ) );

                if ( $team_query->have_posts() ) :
                    while ( $team_query->have_posts() ) : $team_query->the_post();
                        $role_ar = function_exists('get_field') ? get_field('team_role') : '';
                        $role_en = function_exists('get_field') ? get_field('team_role_en') : '';
                        $role = $is_en ? ($role_en ?: $role_ar) : ($role_ar ?: $role_en);
                        $phone = function_exists('get_field') ? get_field('team_phone') : '';
                        $email = function_exists('get_field') ? get_field('team_email') : '';
                        ?>
                        <article class="team-card reveal reveal-fade-up">
                            <div class="team-image-box">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large' ); ?>
                                <?php else : ?>
                                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=400" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="team-info">
                                <h3 class="team-name"><?the_title(); ?></h3>
                                <span class="team-title"><?php echo esc_html( $role ); ?></span>
                                <div class="team-bio text-dark-grey">
                                    <?php echo wp_trim_words( get_the_content(), 15 ); ?>
                                </div>
                                <div class="team-contact">
                                    <?php if ( $phone ) : ?>
                                        <a href="tel:<?php echo esc_attr($phone); ?>" title="<?php esc_attr_e( 'اتصال هاتفي', 'dr-ali' ); ?>">📞 <?php echo esc_html($phone); ?></a>
                                    <?php endif; ?>
                                    <?php if ( $email ) : ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>" title="<?php esc_attr_e( 'بريد إلكتروني', 'dr-ali' ); ?>">✉️ <?php echo esc_html($email); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback Mock data
                    $mock_members = array(
                        array(
                            'name'  => $is_en ? 'Dr Ali Al-Mansoor' : 'د. علي المنصوري',
                            'role'  => $is_en ? 'Founder & Senior Partner' : 'المؤسس والشريك الرئيسي',
                            'bio'   => $is_en 
                                ? 'Dr Ali holds a PhD in Commercial Law with over 15 years advising corporate entities in Morocco and the North Africa region.'
                                : 'يحمل الدكتور علي دكتوراه في القانون التجاري وله خبرة تزيد عن 15 عاماً في تقديم الاستشارات لكبرى الشركات في المغرب ومنطقة شمال إفريقيا.',
                            'phone' => '+212 5 22 555 123',
                            'email' => 'ali@dr-ali.ma',
                            'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=400'
                        ),
                        array(
                            'name'  => $is_en ? 'Fatima Zahra Bennani' : 'فاطمة الزهراء بناني',
                            'role'  => $is_en ? 'Partner - Real Estate & Arbitration' : 'شريك - قضايا العقارات والتحكيم',
                            'bio'   => $is_en 
                                ? 'Fatima specializes in complex property development law and represents institutional investors before CIMAC and Moroccan courts.'
                                : 'تتخصص فاطمة في قوانين التطوير العقاري المعقدة وتمثل كبار المطورين والمستثمرين أمام المركز الدولي للوساطة والتحكيم بالدار البيضاء (CIMAC) والمحاكم المغربية.',
                            'phone' => '+212 5 22 555 124',
                            'email' => 'fatima@dr-ali.ma',
                            'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=400'
                        ),
                        array(
                            'name'  => $is_en ? 'Marcus Vance' : 'ماركوس فانس',
                            'role'  => $is_en ? 'Senior Associate - Corporate Finance' : 'مستشار أول - تمويل وقوانين الشركات',
                            'bio'   => $is_en 
                                ? 'Marcus advises tech startups and multi-national corporations on licensing, venture capital, and compliance within Casablanca Finance City (CFC).'
                                : 'يقدم ماركوس المشورة القانونية للشركات التكنولوجية والشركات متعددة الجنسيات حول التراخيص والاستثمار الجريء والامتثال داخل القطب المالي للدار البيضاء (CFC).',
                            'phone' => '+212 5 22 555 125',
                            'email' => 'marcus@dr-ali.ma',
                            'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=400'
                        )
                    );

                    foreach ( $mock_members as $member ) :
                        ?>
                        <article class="team-card reveal reveal-fade-up">
                            <div class="team-image-box">
                                <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_html($member['name']); ?>">
                            </div>
                            <div class="team-info">
                                <h3 class="team-name"><?php echo esc_html($member['name']); ?></h3>
                                <span class="team-title"><?php echo esc_html($member['role']); ?></span>
                                <p class="team-bio text-dark-grey"><?php echo esc_html($member['bio']); ?></p>
                                <div class="team-contact">
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', $member['phone'])); ?>">📞 <?php echo esc_html($member['phone']); ?></a>
                                    <a href="mailto:<?php echo esc_attr($member['email']); ?>">✉️ <?php echo esc_html($member['email']); ?></a>
                                </div>
                            </div>
                        </article>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
