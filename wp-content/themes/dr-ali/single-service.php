<?php
/**
 * The template for displaying single service pages
 *
 * @package DrAli
 */

get_header();

$is_en = ( get_locale() === 'en_US' );
$current_service_id = get_the_ID();

?>

<main id="primary" class="site-main">

    <!-- Hero Header -->
    <header class="service-hero bg-forest text-white py-16 relative overflow-hidden">
        <div class="container relative z-10">
            <h1 class="service-hero-title text-3.5xl font-bold mb-4"><?php the_title(); ?></h1>
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
    <section class="service-detail-section py-20 bg-white">
        <div class="container service-inner-layout">
            
            <!-- Main Content Area -->
            <article class="service-main-content reveal reveal-fade-right">
                <div class="entry-content">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    else :
                        // Mock service narrative if content is empty
                        ?>
                        <p class="lead font-bold text-lg text-forest mb-6">
                            <?php
                            echo $is_en
                                ? 'We provide high-end legal advisory and representation, customized for the specific commercial environment of Dubai.'
                                : 'نحن نقدم خدمات تمثيل واستشارات قانونية راقية، مصممة خصيصاً لتناسب البيئة التجارية المتميزة في دبي.';
                            ?>
                        </p>
                        <p>
                            <?php
                            echo $is_en
                                ? 'Our attorneys are recognized for their technical proficiency and commercial focus. We work closely with stakeholders to mitigate legal risks, ensure complete compliance, and protect our clients interests in any negotiation or court representation.'
                                : 'يحظى محامونا بتقدير واسع لمهارتهم الفنية وتركيزهم التجاري. نحن نعمل عن كثب مع أصحاب المصلحة للحد من المخاطر القانونية، وضمان الامتثال التام للأنظمة والقوانين، وحماية مصالح عملائنا في مختلف المفاوضات أو أمام المحاكم.';
                            ?>
                        </p>
                    <?php
                    endif;
                    ?>
                </div>

                <!-- Service specific FAQs -->
                <div class="service-faqs-section mt-12">
                    <h3 class="text-2xl font-bold mb-6 text-forest">
                        <?php echo $is_en ? 'Frequently Asked Questions' : 'الأسئلة الشائعة حول هذه الخدمة'; ?>
                    </h3>
                    
                    <div class="faq-accordion">
                        <?php
                        $faqs = function_exists('get_field') ? get_field('service_faqs') : null;
                        
                        if ( ! empty($faqs) ) {
                            $index = 0;
                            foreach ( $faqs as $faq ) {
                                $active_class = ($index === 0) ? 'active' : '';
                                $style = ($index === 0) ? 'style="max-height: 200px;"' : '';
                                ?>
                                <div class="accordion-item <?php echo $active_class; ?>">
                                    <button class="accordion-header">
                                        <span><?php echo esc_html($faq['question']); ?></span>
                                        <span class="accordion-icon">+</span>
                                    </button>
                                    <div class="accordion-content" <?php echo $style; ?>>
                                        <div class="accordion-content-inner">
                                            <p><?php echo esc_html($faq['answer']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $index++;
                            }
                        } else {
                            // Mock FAQs based on specific service types
                            $mock_faqs = array(
                                array(
                                    'q' => $is_en ? 'What is the standard timeframe for resolution?' : 'ما هو الإطار الزمني المتوقع لإنجاز هذه المعاملات؟',
                                    'a' => $is_en 
                                        ? 'Depending on the case structure, most advisory scopes are resolved within 2-4 weeks. Litigated filings vary by court schedule.' 
                                        : 'يعتمد ذلك على تعقيد الملف، ولكن أغلب الاستشارات وإعداد العقود ينجز في غضون أسبوعين إلى 4 أسابيع، بينما تخضع القضايا لجدول جلسات المحاكم.'
                                ),
                                array(
                                    'q' => $is_en ? 'Do you handle cross-border jurisdictions?' : 'هل تغطي خدماتكم القضايا خارج حدود الإمارات؟',
                                    'a' => $is_en 
                                        ? 'Yes, our counsel works in partnership with leading international law firms to offer legal representation across international borders.' 
                                        : 'نعم، يعمل مكتبنا بالتعاون مع شبكة من كبرى مكاتب المحاماة الدولية لتقديم خدمات الدفاع والاستشارات عبر الحدود والقوانين العابرة للدول.'
                                )
                            );

                            $index = 0;
                            foreach ( $mock_faqs as $mock ) {
                                $active_class = ($index === 0) ? 'active' : '';
                                $style = ($index === 0) ? 'style="max-height: 200px;"' : '';
                                ?>
                                <div class="accordion-item <?php echo $active_class; ?>">
                                    <button class="accordion-header">
                                        <span><?php echo esc_html($mock['q']); ?></span>
                                        <span class="accordion-icon">+</span>
                                    </button>
                                    <div class="accordion-content" <?php echo $style; ?>>
                                        <div class="accordion-content-inner">
                                            <p><?php echo esc_html($mock['a']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $index++;
                            }
                        }
                        ?>
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="service-sidebar reveal reveal-fade-left">
                <!-- Other Services List -->
                <div class="service-sidebar-nav">
                    <h3 class="sidebar-title"><?php echo $is_en ? 'Our Legal Services' : 'خدماتنا القانونية'; ?></h3>
                    <ul class="sidebar-services-list">
                        <?php
                        $all_services = dr_ali_get_services_list();
                        if ( ! empty($all_services) ) {
                            foreach ( $all_services as $service ) {
                                $active = ( $service->ID === $current_service_id ) ? 'active' : '';
                                echo '<li class="sidebar-service-item ' . $active . '"><a href="' . esc_url( get_permalink( $service->ID ) ) . '">' . esc_html( $service->post_title ) . '</a></li>';
                            }
                        } else {
                            // Fallback list
                            $mocks = $is_en 
                                ? array('Corporate & Commercial Law', 'Real Estate & Property', 'Civil & Commercial Litigation')
                                : array('قانون الشركات والتجارة', 'قانون العقارات والإنشاءات', 'التقاضي المدني والتجاري');
                            
                            foreach ($mocks as $m) {
                                echo '<li class="sidebar-service-item"><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html($m) . '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

                <!-- Call to Action widget -->
                <div class="sidebar-cta-box">
                    <h4><?php echo $is_en ? 'Need Legal Consultation?' : 'تبحث عن استشارة قانونية؟'; ?></h4>
                    <p>
                        <?php
                        echo $is_en
                            ? 'Our experienced corporate and litigation attorneys are standing by to evaluate your case.'
                            : 'نخبة من محامينا المتخصصين جاهزون لتقييم موضوعك وتقديم الحلول الفعالة.';
                        ?>
                    </p>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-gold w-full justify-center">
                        <?php echo $is_en ? 'Contact Our Experts' : 'تواصل مع خبرائنا'; ?>
                    </a>
                </div>
            </aside>

        </div>
    </section>

</main>

<?php
get_footer();
