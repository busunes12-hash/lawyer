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
                                'q' => $is_en ? 'Can a foreigner own 100% of a business in Morocco?' : 'هل يمكن للمستثمر الأجنبي التملك الكامل بنسبة 100% للشركات في المغرب؟',
                                'a' => $is_en 
                                    ? 'Yes, under Moroccan corporate law, foreign investors can own 100% of companies in almost all sectors without requiring a local partner. Exchange controls are regulated by the Office des Changes.'
                                    : 'نعم، بموجب القانون التجاري المغربي، يمكن للمستثمرين الأجانب تملك الشركات بالكامل بنسبة 100% في أغلب القطاعات دون الحاجة لشريك مغربي، وتخضع المعاملات المالية لضوابط مكتب الصرف.'
                            ),
                            array(
                                'q' => $is_en ? 'What is the corporate tax rate in Morocco?' : 'ما هي نسبة ضريبة الشركات المطبقة في المغرب؟',
                                'a' => $is_en 
                                    ? 'Morocco applies a progressive corporate tax scale ranging from 10% to 31%. Companies operating in zones like Casablanca Finance City (CFC) enjoy specific tax exemptions.'
                                    : 'تطبق في المغرب ضريبة تصاعدية على الشركات تتراوح نسبتها بين 10% و31%. بينما تستفيد الشركات الحاصلة على صفة القطب المالي للدار البيضاء (CFC) من إعفاءات ضريبية خاصة بشروط محددة.'
                            )
                        ),
                        'property' => array(
                            array(
                                'q' => $is_en ? 'How are landlord-tenant rental disputes resolved in Morocco?' : 'كيف يتم فض المنازعات الإيجارية بين المالك والمستأجر في المغرب؟',
                                'a' => $is_en 
                                    ? 'Rental disputes are handled by the Ordinary Courts (Civil Chamber). Filing a dispute requires a written lease agreement and registration with local municipal authorities.'
                                    : 'يتم فض النزاعات الإيجارية أمام المحاكم الابتدائية (الغرفة المدنية)، ويشترط لرفع الدعوى وجود عقد كراء مكتوب ومصادق عليه لدى السلطات الجماعية المحلية.'
                            ),
                            array(
                                'q' => $is_en ? 'Can a developer cancel a property project arbitrarily?' : 'هل يحق للمنعش العقاري إلغاء المشروع أو تأجيله دون سند قانوني؟',
                                'a' => $is_en 
                                    ? 'No. Property developments are protected under Law 44-00 on Sales Before Completion (VEFA). Funds must be placed in a bank guarantee, and project modifications require municipal approval.'
                                    : 'لا، مشاريع التطوير العقاري محمية بموجب قانون بيع العقار في طور الإنجاز (VEFA) رقم 44-00، حيث يلتزم المنعش العقاري بتقديم ضمانة بنكية أو تأمين، ولا يصح تعديل المشروع دون موافقة الجهات المختصة.'
                            )
                        ),
                        'general' => array(
                            array(
                                'q' => $is_en ? 'Does the firm represent clients in the Court of Cassation?' : 'هل يمثل المكتب الموكلين أمام محكمة النقض بالرباط؟',
                                'a' => $is_en 
                                    ? 'Yes. Our senior attorneys are fully admitted and carry rights of audience before the Court of Cassation in Rabat (the highest court in Morocco), in addition to local Commercial and Appeal courts.'
                                    : 'نعم، يحظى محامونا المقيدون بالحق في الترافع والمرافعة أمام محكمة النقض بالرباط (أعلى سلطة قضائية بالمغرب)، بالإضافة إلى المحاكم التجارية ومحاكم الاستئناف بمختلف المدن.'
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
