<?php
/**
 * The template for displaying the front page
 *
 * @package DrAli
 */

get_header();

$is_en = ( get_locale() === 'en_US' );

// 1. HERO FIELDS WITH FALLBACKS
$hero_subtitle = function_exists('get_field') ? get_field('hero_subtitle') : '';
if ( empty($hero_subtitle) ) {
    $hero_subtitle = $is_en ? 'LEGAL EXCELLENCE & DISCRETION' : 'تميز قانوني يرتكز على الثقة والسرية المطلقة';
}

$hero_title = function_exists('get_field') ? get_field('hero_title') : '';
if ( empty($hero_title) ) {
    $hero_title = $is_en ? 'Safeguarding Commercial Assets & Structuring Corporate Growth' : 'حماية أصولك التجارية وتأمين مصالحك الاستثمارية في المغرب';
}

$hero_desc = function_exists('get_field') ? get_field('hero_description') : '';
if ( empty($hero_desc) ) {
    $hero_desc = $is_en 
        ? 'We deliver premium, high-value corporate advisory, dispute resolution, and litigation defense representing clients with distinction across Morocco.'
        : 'نقدم نخبة الاستشارات والتمثيل القضائي وحل النزاعات للشركات والأفراد، ونحمي استثماراتكم أمام جميع المحاكم التجارية المغربية ومحكمة النقض بالرباط.';
}

$hero_cta1_text = $is_en ? 'Schedule Confidential Evaluation' : 'احجز جلسة تقييم سرية';
$hero_cta2_text = $is_en ? 'Sectors We Protect' : 'القطاعات التي نحميها';

?>

<main id="primary" class="site-main">

    <!-- ==========================================
         SECTION 1: HERO SECTION (OPTIMIZED COLUMN)
         ========================================== -->
    <section class="hero-section">
        <canvas id="hero-canvas"></canvas>
        <div class="container hero-inner hero-center-layout">
            <div class="hero-content reveal reveal-fade-up text-center">
                <span class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></span>
                <h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
                <p class="hero-description mx-auto"><?php echo esc_html( $hero_desc ); ?></p>
                <div class="hero-actions-row justify-center">
                    <a href="#contact" class="btn-gold"><?php echo esc_html( $hero_cta1_text ); ?></a>
                    <a href="#services" class="btn-outline-gold"><?php echo esc_html( $hero_cta2_text ); ?></a>
                </div>

                <!-- Grayscale Regulatory Trust Bar -->
                <div class="regulatory-trust-bar mt-12">
                    <span class="trust-bar-title"><?php echo $is_en ? 'RECOGNIZED JURISDICTIONS & REGULATORS:' : 'جهات وسلطات التقاضي والاعتماد:'; ?></span>
                    <div class="trust-logos">
                        <div class="trust-logo-item" title="Commercial Court of Casablanca">
                            <span>CASABLANCA COMMERCIAL COURT | المحكمة التجارية بالدار البيضاء</span>
                        </div>
                        <div class="trust-logo-item" title="Court of Cassation">
                            <span>COURT OF CASSATION | محكمة النقض</span>
                        </div>
                        <div class="trust-logo-item" title="CIMAC">
                            <span>CIMAC | مركز التحكيم الدولي بالدار البيضاء</span>
                        </div>
                        <div class="trust-logo-item" title="ANCFCC">
                            <span>ANCFCC | المحافظة العقارية</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 1.5: STATS TRANSITION STRIP (NEW)
         ========================================== -->
    <section class="stats-transition-strip py-10 bg-forest text-white">
        <div class="container stats-inner grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="stat-card-horizontal">
                <span class="stat-number" data-target="15">0</span>
                <span class="stat-label"><?php echo $is_en ? 'Years of Experience' : 'عاماً من الخبرة'; ?></span>
            </div>
            <div class="stat-card-horizontal">
                <span class="stat-number" data-target="98">0</span>
                <span class="stat-label"><?php echo $is_en ? 'Success Rate (%)' : 'نسبة النجاح (%)'; ?></span>
            </div>
            <div class="stat-card-horizontal">
                <span class="stat-number" data-target="500">0</span>
                <span class="stat-label"><?php echo $is_en ? 'Consultations Handled' : 'استشارة قانونية'; ?></span>
            </div>
            <div class="stat-card-horizontal">
                <span class="stat-number" data-target="45">0</span>
                <span class="stat-label"><?php echo $is_en ? 'Corporate Retainers' : 'شركة تحت رعاية مكتبنا'; ?></span>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 2: PRACTICE AREAS (SERVICES)
         ========================================== -->
    <section id="services" class="practice-areas-section py-20 bg-white">
        <div class="container">
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'WHAT WE PROTECT' : 'القطاعات التي نحميها ونطورها'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'Sectors We Protect & Grow' : 'خدماتنا القانونية المتخصصة'; ?></h2>
            </div>

            <div class="services-grid scroll-reveal-group">
                <?php
                $services_query = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                ) );

                if ( $services_query->have_posts() ) :
                    while ( $services_query->have_posts() ) : $services_query->the_post();
                        $icon_svg = function_exists('get_field') ? get_field('service_icon_svg') : '';
                        if ( empty($icon_svg) ) {
                            $icon_svg = '<svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>';
                        }
                        ?>
                        <article class="service-card reveal reveal-fade-up">
                            <div class="service-icon-wrapper">
                                <?php echo $icon_svg; ?>
                            </div>
                            <h3 class="service-title"><?php the_title(); ?></h3>
                            <p class="service-desc"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                            <a href="<?php the_permalink(); ?>" class="service-link">
                                <?php echo $is_en ? 'Read More' : 'اقرأ المزيد'; ?> <span class="chevron-arrow">→</span>
                            </a>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Mock fallback service data for presentation
                    $mock_services = array(
                        array(
                            'title' => $is_en ? 'Corporate & Commercial Law' : 'قانون الشركات والتجارة',
                            'desc'  => $is_en ? 'Comprehensive setup, structural advice, commercial contracts drafting, mergers and acquisitions in Morocco and offshore.' : 'استشارات تأسيس الشركات، صياغة العقود التجارية، صفقات الاستحواذ والاندماج، وحوكمة الشركات التجارية داخل المغرب وخارجها.',
                            'icon'  => '<svg viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>'
                        ),
                        array(
                            'title' => $is_en ? 'Real Estate & Property Disputes' : 'قانون العقارات والمنازعات الإنشائية',
                            'desc'  => $is_en ? 'Bespoke counsel in property development, landlord-tenant disputes, ANCFCC land registry representation, and legal titles auditing.' : 'مرافعة وحل نزاعات التطوير العقاري والمقاولات، النزاعات الإيجارية والمدنية، وتمثيل الملاك والمطورين وإجراءات التسجيل والتحفيظ العقاري (ANCFCC).',
                            'icon'  => '<svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>'
                        ),
                        array(
                            'title' => $is_en ? 'Civil & Commercial Litigation' : 'التقاضي المدني والتجاري',
                            'desc'  => $is_en ? 'Defense counsel across Casablanca Commercial Court, Court of Cassation, and arbitration forums handling complex contract disputes.' : 'الدفاع والترافع أمام المحاكم التجارية بالدار البيضاء، محكمة النقض بالرباط، وهيئات التحكيم (مثل CIMAC) في القضايا المالية والمطالبات المعقدة.',
                            'icon'  => '<svg viewBox="0 0 24 24"><path d="M14.43 10L14 2H2v18h20V10h-7.57zM8 18H6v-2h2v2zm0-4H6v-2h2v2zm0-4H6V8h2v2zm0-4H6V4h2v2zm12 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>'
                        )
                    );

                    foreach ( $mock_services as $mock ) :
                        ?>
                        <article class="service-card reveal reveal-fade-up">
                            <div class="service-icon-wrapper">
                                <?php echo $mock['icon']; ?>
                            </div>
                            <h3 class="service-title"><?php echo esc_html( $mock['title'] ); ?></h3>
                            <p class="service-desc"><?php echo esc_html( $mock['desc'] ); ?></p>
                            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="service-link">
                                <?php echo $is_en ? 'Request Inquiry' : 'طلب استفسار'; ?> <span class="chevron-arrow">→</span>
                            </a>
                        </article>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 3: ABOUT US
         ========================================== -->
    <section id="about" class="about-section py-20 bg-light-grey">
        <div class="container about-grid">
            <div class="about-narrative reveal reveal-fade-right">
                <span class="sub-title text-gold-dark text-sm font-bold block mb-2"><?php echo $is_en ? 'OUR LEADERSHIP' : 'ريادتنا وأهدافنا'; ?></span>
                <h2 class="text-3xl font-bold mb-6 text-forest"><?php echo $is_en ? 'A Decade of Safeguarding Commercial Interests in Morocco' : 'عقد من حماية المصالح التجارية في المغرب'; ?></h2>
                <p class="text-dark-grey leading-relaxed mb-6">
                    <?php
                    echo $is_en
                        ? 'For over a decade, Dr Ali Law Firm has set a benchmark for legal advisory services in Morocco. We advise domestic, international corporate structures and high-profile individuals with an unwavering focus on precision and commercial viability.'
                        : 'لأكثر من عقد من الزمان، صاغ مكتب الدكتور علي معياراً متميزاً للمحاماة والاستشارات القانونية في المغرب. نحن نعمل مع الشركات المحلية والعالمية والأفراد ذوي الملاءة المالية، مع التركيز الكامل على دقة التحليل والجدوى التجارية.';
                    ?>
                </p>
                <p class="text-dark-grey leading-relaxed mb-6">
                    <?php
                    echo $is_en
                        ? 'Our attorneys combine technical excellence with practical business acumen. This holistic perspective ensures our clients are equipped to navigate regulatory landscapes inside Morocco confidently.'
                        : 'يجمع فريق المحامين لدينا بين التميز التقني والفطنة التجارية العملية. هذا المنظور المتكامل يضمن لعملائنا القدرة الكاملة على التنقل والنمو ضمن البيئات التشريعية والتنظيمية في المغرب بثقة تامة.';
                    ?>
                </p>

                <div class="about-features-list">
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span><?php echo $is_en ? 'Programmatic Legal Audits' : 'تدقيق وتدابير قانونية منهجية'; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span><?php echo $is_en ? '24/7 Crisis Advisory' : 'استجابة وإرشاد للطوارئ 24/7'; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span><?php echo $is_en ? 'Cassation & Commercial Courts Rights' : 'حق الترافع أمام محكمة النقض والمحاكم التجارية'; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-check">✓</span>
                        <span><?php echo $is_en ? 'Arbitration Board Members' : 'أعضاء مسجلون في مجالس التحكيم'; ?></span>
                    </div>
                </div>
            </div>

            <!-- Image frame with premium alignment lines -->
            <div class="about-image-frame reveal reveal-fade-left">
                <!-- Using placeholder images styled like commercial photos via generated design -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/founder.jpg" alt="<?php echo $is_en ? 'Dr Ali Founder' : 'الدكتور علي المؤسس'; ?>" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600'">
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 4: WHY CHOOSE US
         ========================================== -->
    <section class="why-choose-section py-20 bg-white">
        <div class="container">
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'OUR ADVANTAGES' : 'لماذا يختارنا العملاء'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'Strategic Advantages' : 'ميزتنا الاستراتيجية في السوق'; ?></h2>
            </div>

            <div class="why-grid">
                <div class="why-card reveal reveal-fade-up">
                    <div class="why-number">01</div>
                    <h3 class="why-title"><?php echo $is_en ? 'Unmatched Local Expertise' : 'خبرة محلية راسخة'; ?></h3>
                    <p class="why-desc text-dark-grey">
                        <?php echo $is_en 
                            ? 'Our profound integration with local Moroccan courts and regulatory departments permits streamlined procedural resolutions.' 
                            : 'علاقاتنا وفهمنا العميق لإجراءات المحاكم المحلية والدوائر الحكومية تتيح لنا إنجاز المعاملات والقضايا بسلاسة وفعالية.'; ?>
                    </p>
                </div>
                <div class="why-card reveal reveal-fade-up" style="transition-delay: 0.1s;">
                    <div class="why-number">02</div>
                    <h3 class="why-title"><?php echo $is_en ? 'Commercial Perspective' : 'نهج تجاري ووقائي'; ?></h3>
                    <p class="why-desc text-dark-grey">
                        <?php echo $is_en 
                            ? 'We do not just evaluate legal clauses; we analyze the underlying business impact to protect your commercial viability.' 
                            : 'نحن لا نقيّم النصوص القانونية مجردة، بل نحلل الأثر المالي والتشغيلي لضمان حماية أرباحك وتنمية استثماراتك.'; ?>
                    </p>
                </div>
                <div class="why-card reveal reveal-fade-up" style="transition-delay: 0.2s;">
                    <div class="why-number">03</div>
                    <h3 class="why-title"><?php echo $is_en ? 'Transparent Reporting' : 'شفافية وتقارير دورية'; ?></h3>
                    <p class="why-desc text-dark-grey">
                        <?php echo $is_en 
                            ? 'Gain peace of mind with routine, structured updates and dynamic legal metrics reports on all outstanding files.' 
                            : 'نشارك عملائنا تقارير دورية منظمة وتحديثات فورية حول سير القضايا والملفات القانونية بكل شفافية.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 4.5: SUCCESSFUL CASES (JUDGMENTS)
         ========================================== -->
    <section id="judgments" class="judgments-section py-20 bg-light-grey">
        <div class="container">
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'OUR VICTORIES' : 'سجل النجاح والأحكام'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'Successful Cases & Judgments' : 'أحكام قضائية وقضايا ناجحة'; ?></h2>
            </div>

            <div class="judgments-grid scroll-reveal-group">
                <?php
                $judgments_query = new WP_Query( array(
                    'post_type'      => 'judgment',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                ) );

                if ( $judgments_query->have_posts() ) :
                    while ( $judgments_query->have_posts() ) : $judgments_query->the_post();
                        $practice_area = function_exists('get_field') ? get_field('judgment_practice_area') : '';
                        $year          = function_exists('get_field') ? get_field('judgment_year') : '';
                        $outcome       = function_exists('get_field') ? get_field('judgment_result') : '';
                        ?>
                        <article class="judgment-card reveal reveal-fade-up">
                            <div class="judgment-meta">
                                <span class="judgment-practice"><?php echo esc_html( $practice_area ); ?></span>
                                <span class="judgment-date"><?php echo esc_html( $year ); ?></span>
                            </div>
                            <h3 class="judgment-title"><?php the_title(); ?></h3>
                            <div class="judgment-desc text-dark-grey text-sm mb-6">
                                <?php echo wp_trim_words( get_the_content(), 20 ); ?>
                            </div>
                            <?php if ( $outcome ) : ?>
                                <div class="judgment-outcome">
                                    <span class="outcome-icon">🏆</span>
                                    <span><?php echo esc_html( $outcome ); ?></span>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Mock data fallbacks
                    $mock_judgments = array(
                        array(
                            'title' => $is_en ? 'Acquittal in Major Corporate Restructuring Fraud Allegation' : 'حكم براءة في قضية احتيال مالي وإعادة هيكلة شركات',
                            'area'  => $is_en ? 'Corporate Disputes' : 'قوانين الشركات',
                            'year'  => '2025',
                            'desc'  => $is_en 
                                ? 'Successfully defended a multi-national director against allegations of asset diversion, securing a complete dismissal.'
                                : 'الدفاع بنجاح عن رئيس مجلس إدارة شركة متعددة الجنسيات ضد مزاعم تحويل أصول، مما أسفر عن البراءة الكاملة.',
                            'result'=> $is_en ? 'Complete Acquittal & Dismissal' : 'براءة كاملة ورد كافة الادعاءات'
                        ),
                        array(
                            'title' => $is_en ? 'Acquisition Dispute Resolution in Real Estate Arbitration' : 'تسوية نزاع استحواذ عقاري معقد عبر التحكيم الدولي',
                            'area'  => $is_en ? 'Real Estate Arbitration' : 'نزاعات العقارات',
                            'year'  => '2026',
                            'desc'  => $is_en 
                                ? 'Represented a prominent institutional investor in CIMAC arbitration, recovering 45M MAD in escrow funds.'
                                : 'تمثيل مستثمر مؤسسي بارز أمام مركز التحكيم الدولي بالدار البيضاء (CIMAC)، واسترداد 45 مليون درهم مغربي من حساب ضمان محجوز.',
                            'result'=> $is_en ? 'Recovered 45,000,000 MAD' : 'استرداد 45,000,000 درهم مغربي'
                        ),
                        array(
                            'title' => $is_en ? 'Victory in Casablanca Commercial Court for Agreement Breach' : 'حكم تجاري لصالح موكلنا بالمحكمة التجارية بالدار البيضاء لخرق شروط تعاقدية',
                            'area'  => $is_en ? 'Commercial Courts' : 'المحاكم التجارية',
                            'year'  => '2026',
                            'desc'  => $is_en 
                                ? 'Secured key judicial damages enforcement under Moroccan Commercial Code for breach of distribution covenants.'
                                : 'حكم قضائي بالتعويض لخرق بنود حصرية التوزيع والتسويق التجاري وفقاً لمقتضيات القانون التجاري المغربي.',
                            'result'=> $is_en ? 'Enforced damages execution' : 'حكم تعويض ونفاذ معجل للأحكام'
                        )
                    );

                    foreach ( $mock_judgments as $mock ) :
                        ?>
                        <article class="judgment-card reveal reveal-fade-up">
                            <div class="judgment-meta">
                                <span class="judgment-practice"><?php echo esc_html( $mock['area'] ); ?></span>
                                <span class="judgment-date"><?php echo esc_html( $mock['year'] ); ?></span>
                            </div>
                            <h3 class="judgment-title"><?php echo esc_html( $mock['title'] ); ?></h3>
                            <div class="judgment-desc text-dark-grey text-sm mb-6">
                                <?php echo esc_html( $mock['desc'] ); ?>
                            </div>
                            <div class="judgment-outcome">
                                <span class="outcome-icon">🏆</span>
                                <span><?php echo esc_html( $mock['result'] ); ?></span>
                            </div>
                        </article>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 5: TESTIMONIALS SLIDER
         ========================================== -->
    <section class="testimonials-section py-20 bg-light-grey">
        <div class="container">
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'REVIEWS' : 'آراء عملائنا'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'What Clients Say' : 'ثقة عملائنا في كلماتهم'; ?></h2>
            </div>

            <!-- Custom Swipe-Enabled Slider -->
            <div class="slider-container reveal reveal-fade-up">
                <div class="slider-track">
                    <?php
                    $testimonials_query = new WP_Query( array(
                        'post_type'      => 'testimonial',
                        'posts_per_page' => 6,
                        'post_status'    => 'publish',
                    ) );

                    if ( $testimonials_query->have_posts() ) :
                        while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
                            $author_role = function_exists('get_field') ? get_field('author_role') : '';
                            ?>
                            <div class="slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-stars">★★★★★</div>
                                    <div class="testimonial-text">"<?php echo strip_tags( get_the_content() ); ?>"</div>
                                    <div class="testimonial-meta">
                                        <div class="testimonial-avatar" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode(get_the_title()); ?>&background=052A23&color=E5B472')"></div>
                                        <div>
                                            <span class="testimonial-author-name"><?php the_title(); ?></span>
                                            <?php if ( $author_role ) : ?>
                                                <span class="testimonial-author-role"><?php echo esc_html( $author_role ); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Mock reviews
                        $mock_reviews = array(
                            array(
                                'name' => $is_en ? 'Tariq Bennani' : 'طارق بناني',
                                'role' => $is_en ? 'CEO, Bennani Group' : 'الرئيس التنفيذي، مجموعة بناني',
                                'text' => $is_en ? 'Dr Ali and his team provided exceptional legal counsel during our restructuring. They are responsive and commercial.' : 'قدم الدكتور علي وفريقه استشارات متميزة خلال عملية إعادة هيكلة شركتنا. يتمتعون باستجابة عالية وحرص تجاري لافت.'
                            ),
                            array(
                                'name' => $is_en ? 'Sarah Jenkins' : 'سارة جينكينز',
                                'role' => $is_en ? 'Director, Atlas Properties' : 'مديرة شركة أطلس للعقارات',
                                'text' => $is_en ? 'A masterclass in real estate law. They handled a complex ANCFCC property dispute case for us and won a complete victory.' : 'أفضل ما رأيت في قضايا العقارات بالمغرب. لقد أداروا قضية نزاع عقاري معقدة أمام المحافظة العقارية (ANCFCC) وحققوا لنا نصراً كاملاً.'
                            ),
                            array(
                                'name' => $is_en ? 'Faisal El Amrani' : 'فيصل العمراني',
                                'role' => $is_en ? 'Founder, TechVentures' : 'مؤسس شركة تيك فنتشرز',
                                'text' => $is_en ? 'Exceptional intellectual property and licensing counsel. Their legal audits saved us from massive liabilities.' : 'استشارات استثنائية في قضايا الملكية الفكرية والترخيص. تدقيقاتهم القانونية المبكرة حمت شركتنا من التزامات طائلة.'
                            )
                        );

                        foreach ( $mock_reviews as $mock ) :
                            ?>
                            <div class="slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-stars">★★★★★</div>
                                    <div class="testimonial-text">"<?php echo esc_html( $mock['text'] ); ?>"</div>
                                    <div class="testimonial-meta">
                                        <div class="testimonial-avatar" style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode($mock['name']); ?>&background=052A23&color=E5B472')"></div>
                                        <div>
                                            <span class="testimonial-author-name"><?php echo esc_html( $mock['name'] ); ?></span>
                                            <span class="testimonial-author-role"><?php echo esc_html( $mock['role'] ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <!-- Slider Controls -->
            <div class="slider-nav reveal reveal-fade-up">
                <button class="slider-arrow slider-prev" aria-label="<?php esc_attr_e( 'السابق', 'dr-ali' ); ?>">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <div class="slider-dots"></div>
                <button class="slider-arrow slider-next" aria-label="<?php esc_attr_e( 'التالي', 'dr-ali' ); ?>">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 6: LATEST BLOG INSIGHTS
         ========================================== -->
    <section class="blog-insights-section py-20 bg-white">
        <div class="container">
            <div class="section-header reveal reveal-fade-up">
                <span class="sub-title"><?php echo $is_en ? 'LEGAL CORNER' : 'ثقافة قانونية'; ?></span>
                <h2 class="section-title"><?php echo $is_en ? 'Latest Legal Insights' : 'آخر المقالات والتحليلات القانونية'; ?></h2>
            </div>

            <div class="blog-grid scroll-reveal-group">
                <?php
                $blog_query = new WP_Query( array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                ) );

                if ( $blog_query->have_posts() ) :
                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
                        ?>
                        <article class="blog-card reveal reveal-fade-up">
                            <div class="blog-thumbnail-wrapper">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
                                <?php else : ?>
                                    <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&q=80&w=400" alt="<?php the_title(); ?>" loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div class="blog-content">
                                <span class="blog-meta-date"><?php echo get_the_date(); ?></span>
                                <h3 class="blog-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="blog-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="text-gold-dark font-bold hover:underline inline-flex items-center gap-1 mt-auto">
                                    <?php echo $is_en ? 'Read Article' : 'اقرأ المقال'; ?> <span class="chevron-arrow">→</span>
                                </a>
                            </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Mock blog posts
                    $mock_posts = array(
                        array(
                            'title' => $is_en ? 'Navigating the Commercial Companies Regulations in Morocco' : 'قراءة في قانون الشركات التجارية الجديد بالمغرب',
                            'date'  => $is_en ? 'June 18, 2026' : '18 يونيو 2026',
                            'excerpt' => $is_en ? 'Understand the critical changes in corporate liability and foreign ownership regulations under the Office des Changes.' : 'تفصيل للتعديلات الجوهرية الخاصة بنسبة التملك الأجنبي ومسؤوليات أعضاء مجلس الإدارة ومسيري الشركات بالمغرب.',
                            'image' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&q=80&w=400'
                        ),
                        array(
                            'title' => $is_en ? 'Protecting Intellectual Property in the Digital Era' : 'سبل حماية حقوق الملكية الفكرية وبراءات الاختراع رقمياً',
                            'date'  => $is_en ? 'June 10, 2026' : '10 يونيو 2026',
                            'excerpt' => $is_en ? 'A structured overview of trademark registrations, copyright filings, and proactive anti-piracy litigation inside Morocco.' : 'دليل تفصيلي حول آليات تسجيل العلامات التجارية وحقوق المؤلف وسبل ملاحقة الاعتداء على الملكية الفكرية محلياً.',
                            'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400'
                        ),
                        array(
                            'title' => $is_en ? 'ANCFCC Property Registration: A Practical Guide' : 'التحفيظ والتسجيل العقاري أمام المحافظة العقارية بالمغرب',
                            'date'  => $is_en ? 'May 28, 2026' : '28 مايو 2026',
                            'excerpt' => $is_en ? 'Discover how the property land registry works and key considerations under the VEFA law for real estate developers.' : 'شرح مبسط لإجراءات التحفيظ العقاري ومطابقة الرسوم العقارية بموجب القوانين المغربية.',
                            'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&q=80&w=400'
                        )
                    );

                    foreach ( $mock_posts as $mock ) :
                        ?>
                        <article class="blog-card reveal reveal-fade-up">
                            <div class="blog-thumbnail-wrapper">
                                <img src="<?php echo esc_url($mock['image']); ?>" alt="<?php echo esc_html($mock['title']); ?>" loading="lazy">
                            </div>
                            <div class="blog-content">
                                <span class="blog-meta-date"><?php echo esc_html($mock['date']); ?></span>
                                <h3 class="blog-card-title"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo esc_html($mock['title']); ?></a></h3>
                                <p class="blog-card-excerpt"><?php echo esc_html($mock['excerpt']); ?></p>
                                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-gold-dark font-bold hover:underline inline-flex items-center gap-1 mt-auto">
                                    <?php echo $is_en ? 'Read Article' : 'اقرأ المقال'; ?> <span class="chevron-arrow">→</span>
                                </a>
                            </div>
                        </article>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SECTION 7: CONTACT CTA (CONVERSION FORM)
         ========================================== -->
    <section id="contact" class="contact-cta-section py-20 bg-forest text-white">
        <div class="container contact-cta-grid">
            <div class="contact-info-panel reveal reveal-fade-right">
                <span class="sub-title text-gold text-sm font-bold block mb-2"><?php echo $is_en ? 'CONSULTATION' : 'طلب استشارة'; ?></span>
                <h2><?php echo $is_en ? 'Schedule a Private Legal Evaluation' : 'احجز جلسة استشارة سرية وتقييم لقضيتك'; ?></h2>
                <p>
                    <?php
                    echo $is_en
                        ? 'Submit your case details securely. Our senior attorneys will analyze your request and follow up within 24 business hours.'
                        : 'أرسل تفاصيل قضيتك وسؤالك القانوني بسرية تامة. سيقوم المحامون المختصون بمراجعة طلبك والتواصل معك خلال 24 ساعة.';
                    ?>
                </p>

                <div class="contact-methods">
                    <div class="method-card">
                        <div class="method-icon">📞</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Direct Hotline' : 'الخط الساخن المباشر'; ?></h4>
                            <a href="tel:+212522555123">+212 5 22 555 123</a>
                        </div>
                    </div>
                    <div class="method-card">
                        <div class="method-icon">✉️</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Secure Case Email' : 'البريد الإلكتروني للقضايا'; ?></h4>
                            <a href="mailto:info@dr-ali.ma">info@dr-ali.ma</a>
                        </div>
                    </div>
                    <div class="method-card">
                        <div class="method-icon">📍</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Casablanca Office' : 'مقر المكتب في الدار البيضاء'; ?></h4>
                            <p><?php echo $is_en ? 'Casablanca Marina, Crystal Building 1, Floor 6, Office 602' : 'مارينا الدار البيضاء، مبنى كريستال 1، الطابق 6، مكتب 602'; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="form-card reveal reveal-fade-left">
                <form id="dr-ali-contact-form">
                    <div class="form-group-row">
                        <div class="form-field-wrapper">
                            <label for="contact_name" class="form-label"><?php echo $is_en ? 'Full Name *' : 'الاسم الكامل *'; ?></label>
                            <input type="text" id="contact_name" name="contact_name" class="form-input" placeholder="<?php echo $is_en ? 'e.g., John Doe' : 'مثال: محمد علي'; ?>" required>
                        </div>
                        <div class="form-field-wrapper">
                            <label for="contact_email" class="form-label"><?php echo $is_en ? 'Email Address *' : 'البريد الإلكتروني *'; ?></label>
                            <input type="email" id="contact_email" name="contact_email" class="form-input" placeholder="<?php echo $is_en ? 'name@company.com' : 'name@company.com'; ?>" required>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <div class="form-field-wrapper">
                            <label for="contact_phone" class="form-label"><?php echo $is_en ? 'Phone Number *' : 'رقم الهاتف *'; ?></label>
                            <input type="tel" id="contact_phone" name="contact_phone" class="form-input" placeholder="<?php echo $is_en ? 'e.g., +212 5 22 555 123' : 'مثال: +212 5 22 555 123'; ?>" required>
                        </div>
                        <div class="form-field-wrapper">
                            <label for="contact_service" class="form-label"><?php echo $is_en ? 'Practice Area' : 'مجال الخدمة المطلوبة'; ?></label>
                            <select id="contact_service" name="contact_service" class="form-select">
                                <option value="Corporate"><?php echo $is_en ? 'Corporate & Commercial' : 'تأسيس وقضايا الشركات'; ?></option>
                                <option value="Real Estate"><?php echo $is_en ? 'Real Estate Disputes' : 'المنازعات العقارية والإنشاءات'; ?></option>
                                <option value="Litigation"><?php echo $is_en ? 'Commercial Litigation' : 'التقاضي والتمثيل القضائي'; ?></option>
                                <option value="Arbitration"><?php echo $is_en ? 'Arbitration & Cassation' : 'التحكيم ومحكمة النقض'; ?></option>
                                <option value="Other"><?php echo $is_en ? 'Other Legal Consultation' : 'استشارة قانونية أخرى'; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-field-wrapper">
                        <label for="contact_message" class="form-label"><?php echo $is_en ? 'Message & Case Outline *' : 'تفاصيل الموضوع والاستشارة *'; ?></label>
                        <textarea id="contact_message" name="contact_message" class="form-textarea" placeholder="<?php echo $is_en ? 'Briefly outline your case or query...' : 'يرجى تقديم تفاصيل الاستشارة القانونية المطلوبة باختصار...'; ?>" required></textarea>
                    </div>

                    <button type="submit" class="btn-gold w-full mt-4"><?php echo $is_en ? 'Schedule Confidential Evaluation' : 'إرسال طلب الاستشارة بأمان'; ?></button>
                    <div class="confidentiality-notice mt-4 flex items-center justify-center gap-2 text-xs text-medium-grey opacity-80">
                        <span class="lock-icon">🔒</span>
                        <span><?php echo $is_en ? 'Encrypted submission bound by attorney-client privilege.' : 'إرسال آمن ومشفر يخضع لسرية المهنة والمحاماة.'; ?></span>
                    </div>
                    <div class="form-response-message"></div>
                </form>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
