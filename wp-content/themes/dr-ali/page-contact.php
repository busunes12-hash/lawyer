<?php
/**
 * Template Name: Contact Page
 *
 * @package DrAli
 */

get_header();

$is_en = ( get_locale() === 'en_US' );

$phone_number = '+212522555123';
$phone_display = '+212 5 22 555 123';
$email_address = 'info@dr-ali.ma';

?>

<main id="primary" class="site-main">

    <!-- Hero Header -->
    <header class="service-hero bg-forest text-white py-16 relative overflow-hidden">
        <div class="container relative z-10">
            <h1 class="service-hero-title text-3.5xl font-bold mb-4">
                <?php echo $is_en ? 'Contact Dr Ali Law Firm' : 'اتصل بمكتب الدكتور علي للمحاماة'; ?>
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

    <!-- Main Content Grid -->
    <section class="contact-page-details py-20 bg-white">
        <div class="container contact-cta-grid">
            
            <!-- Left Contact Info Details -->
            <div class="contact-info-panel reveal reveal-fade-right">
                <span class="sub-title text-gold-dark text-sm font-bold block mb-2"><?php echo $is_en ? 'OFFICE DETAILED INFO' : 'تفاصيل العناوين والاتصال'; ?></span>
                <h2 class="text-forest text-3xl font-bold mb-6"><?php echo $is_en ? 'Visit Our Casablanca Headquarters' : 'تفضل بزيارة مكتبنا الرئيسي في الدار البيضاء'; ?></h2>
                
                <p class="text-dark-grey leading-relaxed mb-8">
                    <?php
                    echo $is_en
                        ? 'Our main offices are located in the heart of Casablancas financial district in Casablanca Marina. We offer secure, private meeting coordinates for corporate clients and individuals seeking discrete advisory consultations.'
                        : 'يقع مقر مكتبنا الرئيسي في قلب المركز المالي النابض للدار البيضاء بمنطقة كازابلانكا مارينا. نحن نوفر مساحة خاصة وآمنة لعقد الاجتماعات والمشاورات القانونية مع عملائنا من الشركات والأفراد.';
                    ?>
                </p>

                <div class="contact-methods">
                    <div class="method-card">
                        <div class="method-icon">📍</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Address Coordinates' : 'العنوان الجغرافي للمكتب'; ?></h4>
                            <p><?php echo $is_en ? 'Casablanca Marina, Crystal Building 1, Floor 6, Office 602, Casablanca, Morocco' : 'كازابلانكا مارينا، مبنى الكريستال 1، الطابق 6، مكتب رقم 602، الدار البيضاء، المغرب'; ?></p>
                        </div>
                    </div>
                    <div class="method-card">
                        <div class="method-icon">📞</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Telephone' : 'الهاتف الرئيسي'; ?></h4>
                            <a href="tel:<?php echo esc_attr($phone_number); ?>"><?php echo esc_html($phone_display); ?></a>
                        </div>
                    </div>
                    <div class="method-card">
                        <div class="method-icon">✉️</div>
                        <div class="method-details">
                            <h4><?php echo $is_en ? 'Secure Mailbox' : 'البريد الإلكتروني الآمن'; ?></h4>
                            <a href="mailto:<?php echo esc_attr($email_address); ?>"><?php echo esc_html($email_address); ?></a>
                        </div>
                    </div>
                </div>

                <!-- Open Hours -->
                <div class="open-hours-box mt-10 p-6 bg-light-grey rounded-md border border-medium-grey">
                    <h4 class="font-bold text-forest mb-3">🕒 <?php echo $is_en ? 'Working Hours' : 'ساعات العمل الرسمية'; ?></h4>
                    <p class="text-sm text-dark-grey mb-1">
                        <strong><?php echo $is_en ? 'Monday - Friday:' : 'من الإثنين إلى الجمعة:'; ?></strong> 
                        <?php echo $is_en ? '9:00 AM - 6:00 PM' : '9:00 صباحاً - 6:00 مساءً'; ?>
                    </p>
                    <p class="text-sm text-dark-grey">
                        <strong><?php echo $is_en ? 'Saturday - Sunday:' : 'السبت والأحد:'; ?></strong> 
                        <?php echo $is_en ? 'Closed (Available for Emergency Retainers)' : 'مغلق (متاح للعملاء المتعاقدين في حالات الطوارئ)'; ?>
                    </p>
                </div>
            </div>

            <!-- Right Interactive Form Card -->
            <div class="form-card reveal reveal-fade-left">
                <h2 class="text-2xl font-bold mb-6 text-white border-b border-light-forest pb-3">
                    <?php echo $is_en ? 'Send Secure Case Request' : 'طلب استشارة سرية وسريعة'; ?>
                </h2>
                <form id="dr-ali-contact-form">
                    <div class="form-group-row">
                        <div class="form-field-wrapper">
                            <label for="contact_name" class="form-label"><?php echo $is_en ? 'Full Name *' : 'الاسم الكامل *'; ?></label>
                            <input type="text" id="contact_name" name="contact_name" class="form-input" required>
                        </div>
                        <div class="form-field-wrapper">
                            <label for="contact_email" class="form-label"><?php echo $is_en ? 'Email Address *' : 'البريد الإلكتروني *'; ?></label>
                            <input type="email" id="contact_email" name="contact_email" class="form-input" required>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <div class="form-field-wrapper">
                            <label for="contact_phone" class="form-label"><?php echo $is_en ? 'Phone Number *' : 'رقم الهاتف *'; ?></label>
                            <input type="tel" id="contact_phone" name="contact_phone" class="form-input" required>
                        </div>
                        <div class="form-field-wrapper">
                            <label for="contact_service" class="form-label"><?php echo $is_en ? 'Service Area' : 'الخدمة القانونية المطلوبة'; ?></label>
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
                        <label for="contact_message" class="form-label"><?php echo $is_en ? 'Message & Case Details *' : 'شرح تفاصيل القضية والموضوع *'; ?></label>
                        <textarea id="contact_message" name="contact_message" class="form-textarea" required></textarea>
                    </div>

                    <button type="submit" class="btn-gold w-full mt-4"><?php echo $is_en ? 'Send Message Securely' : 'إرسال طلب الاستشارة بأمان'; ?></button>
                    <div class="form-response-message"></div>
                </form>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
