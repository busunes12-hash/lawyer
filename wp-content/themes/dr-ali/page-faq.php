<?php
/**
 * Template Name: FAQ Page
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
                <?php echo $is_en ? 'Frequently Asked Questions' : 'الأسئلة الشائعة والإرشادات'; ?>
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
    <section class="faq-page-content py-20 bg-white">
        <div class="container">
            
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'LEARN MORE' : 'المعرفة القانونية'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'Legal Clarifications' : 'إجابات على تساؤلاتكم القانونية'; ?></h2>
            </div>

            <?php
            // Fetch FAQ Categories
            $categories = get_terms( array(
                'taxonomy'   => 'faq_category',
                'hide_empty' => false,
            ) );

            $has_categories = ( ! empty( $categories ) && ! is_wp_error( $categories ) );
            ?>

            <!-- Category Tabs Selector -->
            <div class="faq-tabs reveal reveal-fade-up">
                <?php if ( $has_categories ) : ?>
                    <button class="faq-tab-btn active" data-target="faq-group-all">
                        <?php echo $is_en ? 'All FAQs' : 'جميع الأسئلة'; ?>
                    </button>
                    <?php foreach ( $categories as $cat ) : ?>
                        <button class="faq-tab-btn" data-target="faq-group-<?php echo esc_attr( $cat->slug ); ?>">
                            <?php echo esc_html( $cat->name ); ?>
                        </button>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Mock Tabs -->
                    <button class="faq-tab-btn active" data-target="faq-group-all">
                        <?php echo $is_en ? 'All FAQs' : 'جميع الأسئلة'; ?>
                    </button>
                    <button class="faq-tab-btn" data-target="faq-group-corporate">
                        <?php echo $is_en ? 'Corporate & Business' : 'تأسيس والشركات'; ?>
                    </button>
                    <button class="faq-tab-btn" data-target="faq-group-property">
                        <?php echo $is_en ? 'Real Estate' : 'العقارات والإنشاءات'; ?>
                    </button>
                    <button class="faq-tab-btn" data-target="faq-group-general">
                        <?php echo $is_en ? 'General Advisory' : 'استشارات عامة'; ?>
                    </button>
                <?php endif; ?>
            </div>

            <!-- FAQ Accordions Container -->
            <div class="faq-groups-wrapper max-w-4xl mx-auto reveal reveal-fade-up">
                
                <?php if ( $has_categories ) : ?>
                    
                    <!-- 1. All Group -->
                    <div id="faq-group-all" class="faq-group active">
                        <div class="faq-accordion">
                            <?php
                            $all_faq_query = new WP_Query( array(
                                'post_type'      => 'faq',
                                'posts_per_page' => -1,
                                'post_status'    => 'publish',
                            ) );
                            if ( $all_faq_query->have_posts() ) :
                                while ( $all_faq_query->have_posts() ) : $all_faq_query->the_post();
                                    ?>
                                    <div class="accordion-item">
                                        <button class="accordion-header">
                                            <span><?textdomain(); the_title(); ?></span>
                                            <span class="accordion-icon">+</span>
                                        </button>
                                        <div class="accordion-content">
                                            <div class="accordion-content-inner">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>

                    <!-- 2. Individual Category Groups -->
                    <?php foreach ( $categories as $cat ) : ?>
                        <div id="faq-group-<?php echo esc_attr( $cat->slug ); ?>" class="faq-group">
                            <div class="faq-accordion">
                                <?php
                                $cat_faq_query = new WP_Query( array(
                                    'post_type'      => 'faq',
                                    'posts_per_page' => -1,
                                    'post_status'    => 'publish',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'faq_category',
                                            'field'    => 'slug',
                                            'terms'    => $cat->slug,
                                        ),
                                    ),
                                ) );
                                if ( $cat_faq_query->have_posts() ) :
                                    while ( $cat_faq_query->have_posts() ) : $cat_faq_query->the_post();
                                        ?>
                                        <div class="accordion-item">
                                            <button class="accordion-header">
                                                <span><?the_title(); ?></span>
                                                <span class="accordion-icon">+</span>
                                            </button>
                                            <div class="accordion-content">
                                                <div class="accordion-content-inner">
                                                    <?php the_content(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else : ?>
                    <!-- Mock fallbacks if no database items exist yet -->
                    <?php
                    $mock_faqs = array(
                        'corporate' => array(
                            array(
                                'q' => $is_en ? 'Can a foreigner own 100% of an onshore business in Dubai?' : 'هل يمكن للمستثمر الأجنبي التملك الكامل بنسبة 100% للشركات داخل دبي؟',
                                'a' => $is_en 
                                    ? 'Yes, under the amended UAE Commercial Companies Law, foreign investors can now own 100% of onshore companies in various sectors without requiring a local Emirati partner.'
                                    : 'نعم، بموجب التعديلات الأخيرة على قانون الشركات التجارية الإماراتي، أصبح بإمكان المستثمرين الأجانب تملك الشركات التجارية بنسبة 100% في العديد من الأنشطة الاقتصادية دون الحاجة لشريك أو وكيل خدمات مواطن.'
                            ),
                            array(
                                'q' => $is_en ? 'What is the corporate tax rate in the UAE?' : 'ما هي نسبة ضريبة الشركات المطبقة حالياً في دولة الإمارات؟',
                                'a' => $is_en 
                                    ? 'A federal corporate tax rate of 9% is applicable on taxable business profits exceeding AED 375,000. Free zone companies may qualify for a 0% rate on qualifying income.'
                                    : 'تطبق ضريبة الشركات الاتحادية بنسبة 9% على الأرباح الخاضعة للضريبة التي تتجاوز 375,000 درهم إماراتي. بينما تستمر الشركات في المناطق الحرة بالاستفادة من نسبة 0% بشروط محددة.'
                            )
                        ),
                        'property' => array(
                            array(
                                'q' => $is_en ? 'How are landlord-tenant rental disputes resolved in Dubai?' : 'كيف يتم فض المنازعات الإيجارية بين المؤجر والمستأجر في دبي؟',
                                'a' => $is_en 
                                    ? 'Rental disputes are managed by the Rental Dispute Centre (RDC) under the Dubai Land Department. Filing a dispute case requires formal leases and Ejari registration.'
                                    : 'تتم إدارة وفض جميع النزاعات الإيجارية من خلال مركز فض المنازعات الإيجارية (RDC) التابع لدائرة الأراضي والأملاك بدبي، ويشترط لرفع الدعوى وجود عقد إيجار مسجل رسمياً في نظام (إيجاري).'
                            ),
                            array(
                                'q' => $is_en ? 'Can a developer cancel a property project arbitrarily?' : 'هل يحق للمطور العقاري إلغاء المشروع أو تأجيله دون سند قانوني؟',
                                'a' => $is_en 
                                    ? 'No. Projects can only be formally cancelled through RERA under strict legal guidelines. Investors are protected and entitled to refunds under trust account regulations.'
                                    : 'لا، يتم إلغاء المشاريع أو تجميدها فقط بقرار رسمي من مؤسسة التنظيم العقاري (RERA) ووفق ضوابط قانونية صارمة لضمان حماية أموال المستثمرين المودعة في حساب الضمان.'
                            )
                        ),
                        'general' => array(
                            array(
                                'q' => $is_en ? 'Does the firm represent clients in DIFC Courts?' : 'هل يمثل المكتب الموكلين أمام محاكم مركز دبي المالي العالمي (DIFC)؟',
                                'a' => $is_en 
                                    ? 'Yes. Our attorneys are fully registered and carry rights of audience before the common law courts of the DIFC, in addition to local civil courts.'
                                    : 'نعم، يحظى محامونا بالتسجيل الكامل ولهم حق الحضور والمرافعة أمام محاكم مركز دبي المالي العالمي (DIFC) التي تعمل بنظام القانون العام، بالإضافة إلى المحاكم المدنية المحلية.'
                            )
                        )
                    );
                    ?>

                    <!-- All Group Fallback -->
                    <div id="faq-group-all" class="faq-group active">
                        <div class="faq-accordion">
                            <?php 
                            $index = 0;
                            foreach ($mock_faqs as $group => $list) {
                                foreach ($list as $faq) {
                                    $active = ($index === 0) ? 'active' : '';
                                    $style = ($index === 0) ? 'style="max-height: 200px;"' : '';
                                    echo '<div class="accordion-item ' . $active . '">';
                                    echo '<button class="accordion-header"><span>' . esc_html($faq['q']) . '</span><span class="accordion-icon">+</span></button>';
                                    echo '<div class="accordion-content" ' . $style . '><div class="accordion-content-inner"><p>' . esc_html($faq['a']) . '</p></div></div>';
                                    echo '</div>';
                                    $index++;
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Categorized Groups Fallback -->
                    <?php foreach ($mock_faqs as $grp => $list) : ?>
                        <div id="faq-group-<?php echo esc_attr($grp); ?>" class="faq-group">
                            <div class="faq-accordion">
                                <?php 
                                $index = 0;
                                foreach ($list as $faq) {
                                    $active = ($index === 0) ? 'active' : '';
                                    $style = ($index === 0) ? 'style="max-height: 200px;"' : '';
                                    echo '<div class="accordion-item ' . $active . '">';
                                    echo '<button class="accordion-header"><span>' . esc_html($faq['q']) . '</span><span class="accordion-icon">+</span></button>';
                                    echo '<div class="accordion-content" ' . $style . '><div class="accordion-content-inner"><p>' . esc_html($faq['a']) . '</p></div></div>';
                                    echo '</div>';
                                    $index++;
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </div>
    </section>

</main>

<?php
get_footer();
