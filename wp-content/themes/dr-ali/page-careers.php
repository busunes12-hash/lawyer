<?php
/**
 * Template Name: Careers Page
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
                <?php echo $is_en ? 'Careers at Dr Ali Law Firm' : 'الفرص المهنية والتوظيف'; ?>
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
    <section class="careers-content-section py-20 bg-white">
        <div class="container contact-cta-grid">
            
            <!-- Left Info Panel -->
            <div class="contact-info-panel reveal reveal-fade-right">
                <span class="sub-title text-gold-dark text-sm font-bold block mb-2"><?php echo $is_en ? 'JOIN OUR TEAM' : 'انضم إلينا'; ?></span>
                <h2 class="text-forest text-3xl font-bold mb-6"><?php echo $is_en ? 'Build a Distinguished Legal Career' : 'ابنِ مسيرتك المهنية مع نخبة القانون'; ?></h2>
                
                <p class="text-dark-grey leading-relaxed mb-6">
                    <?php
                    echo $is_en
                        ? 'At Dr Ali Law Firm, we believe our people are our strongest assets. We offer a high-performance, collaborative working environment that fosters professional growth and awards meritocracy.'
                        : 'في مكتب الدكتور علي، نؤمن بأن رأس مالنا الحقيقي هو الكفاءات البشرية. نحن نوفر بيئة عمل محفزة وتشاركية تدفع بالنمو المهني وتكافئ التميز الفردي والعمل الجماعي.';
                    ?>
                </p>

                <p class="text-dark-grey leading-relaxed mb-8">
                    <?php
                    echo $is_en
                        ? 'We are continuously seeking qualified bilingual legal practitioners, researchers, paralegals, and legal consultants to join our offices in Business Bay, Dubai.'
                        : 'نحن نبحث باستمرار عن الكوادر المؤهلة والنشطة من المحامين، الباحثين القانونيين، والمستشارين ثنائيي اللغة (العربية والإنجليزية) للانضمام لمكتبنا في الخليج التجاري بدبي.';
                    ?>
                </p>

                <div class="contact-methods">
                    <div class="method-card">
                        <div class="method-icon">🤝</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Equal Opportunity Employer' : 'تكافؤ الفرص والتنوع'; ?></h4>
                            <p><?php echo $is_en ? 'We welcome diverse applicants regardless of background.' : 'نحن نرحب بجميع المتقدمين المؤهلين على أساس الجدارة والكفاءة.'; ?></p>
                        </div>
                    </div>
                    <div class="method-card">
                        <div class="method-icon">💡</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Professional Mentorship' : 'توجيه مهني مستمر'; ?></h4>
                            <p><?php echo $is_en ? 'Train and learn directly alongside registered arbitrators and senior consultants.' : 'تعلّم واكتسب الخبرات مباشرة تحت إشراف نخبة من المحكمين المعتمدين والمستشارين الكبار.'; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="form-card reveal reveal-fade-left">
                <form id="dr-ali-career-form" enctype="multipart/form-data">
                    <div class="form-field-wrapper">
                        <label for="career_name" class="form-label"><?php echo $is_en ? 'Full Name *' : 'الاسم الكامل *'; ?></label>
                        <input type="text" id="career_name" name="career_name" class="form-input" required>
                    </div>

                    <div class="form-group-row">
                        <div class="form-field-wrapper">
                            <label for="career_email" class="form-label"><?php echo $is_en ? 'Email Address *' : 'البريد الإلكتروني *'; ?></label>
                            <input type="email" id="career_email" name="career_email" class="form-input" required>
                        </div>
                        <div class="form-field-wrapper">
                            <label for="career_phone" class="form-label"><?php echo $is_en ? 'Phone Number *' : 'رقم الهاتف *'; ?></label>
                            <input type="tel" id="career_phone" name="career_phone" class="form-input" required>
                        </div>
                    </div>

                    <div class="form-field-wrapper">
                        <label for="career_position" class="form-label"><?php echo $is_en ? 'Target Position *' : 'الوظيفة المستهدفة *'; ?></label>
                        <select id="career_position" name="career_position" class="form-select">
                            <option value="Senior Associate"><?php echo $is_en ? 'Senior Associate / Advocate' : 'محامٍ ممارس / مستشار أول'; ?></option>
                            <option value="Legal Consultant"><?php echo $is_en ? 'Legal Consultant' : 'مستشار قانوني'; ?></option>
                            <option value="Paralegal"><?php echo $is_en ? 'Legal Researcher / Paralegal' : 'باحث قانوني / مساعد محامٍ'; ?></option>
                            <option value="Internship"><?php echo $is_en ? 'Legal Intern' : 'متدرب قانوني'; ?></option>
                            <option value="Other"><?php echo $is_en ? 'Other Administrative Staff' : 'وظائف إدارية أخرى'; ?></option>
                        </select>
                    </div>

                    <!-- Custom styled file upload element -->
                    <div class="form-field-wrapper">
                        <label class="form-label"><?php echo $is_en ? 'Upload CV (PDF/DOCX max 5MB) *' : 'تحميل السيرة الذاتية (ملف PDF/Word بحد أقصى 5MB) *'; ?></label>
                        <div class="file-upload-container">
                            <input type="file" id="career_cv" name="career_cv" class="file-upload-input" accept=".pdf,.doc,.docx" required>
                            <div class="file-upload-label">
                                <span class="upload-icon">📄</span>
                                <span class="upload-text"><?php echo $is_en ? 'Drag & Drop or Click to Select File' : 'اسحب الملف هنا أو انقر للاختيار'; ?></span>
                            </div>
                        </div>
                        <div class="uploaded-file-name"></div>
                    </div>

                    <div class="form-field-wrapper">
                        <label for="career_cover" class="form-label"><?php echo $is_en ? 'Cover Letter (Optional)' : 'خطاب التغطية (اختياري)'; ?></label>
                        <textarea id="career_cover" name="career_cover" class="form-textarea"></textarea>
                    </div>

                    <button type="submit" class="btn-gold w-full mt-4"><?php echo $is_en ? 'Submit Application' : 'إرسال طلب التوظيف'; ?></button>
                    <div class="form-response-message"></div>
                </form>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
