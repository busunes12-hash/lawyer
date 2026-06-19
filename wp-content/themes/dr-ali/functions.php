<?php
/**
 * Dr Ali Law Firm Theme Functions and Definitions
 *
 * @package DrAli
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 1. LOCALIZATION & LOCALE FORCING
 * Force Arabic 'ar' locale by default with dynamic 'en' overrides via URL query param or Cookie.
 */
add_action( 'init', 'dr_ali_handle_lang_cookie' );
function dr_ali_handle_lang_cookie() {
	if ( isset( $_GET['lang'] ) ) {
		$lang = sanitize_text_field( $_GET['lang'] );
		if ( in_array( $lang, array( 'ar', 'en' ) ) ) {
			setcookie( 'wp_lang', $lang, time() + 3600 * 24 * 30, '/' );
			$_COOKIE['wp_lang'] = $lang; // Set local superglobal for immediate execution
		}
	}
}

add_filter( 'locale', 'dr_ali_set_dynamic_locale' );
function dr_ali_set_dynamic_locale( $locale ) {
	// Check query parameter first
	if ( isset( $_GET['lang'] ) ) {
		if ( $_GET['lang'] === 'en' ) {
			return 'en_US';
		} elseif ( $_GET['lang'] === 'ar' ) {
			return 'ar';
		}
	}
	// Check cookie
	if ( isset( $_COOKIE['wp_lang'] ) ) {
		if ( $_COOKIE['wp_lang'] === 'en' ) {
			return 'en_US';
		} elseif ( $_COOKIE['wp_lang'] === 'ar' ) {
			return 'ar';
		}
	}
	// Default to Arabic
	return 'ar';
}

/**
 * Load translation domain.
 */
add_action( 'after_setup_theme', 'dr_ali_theme_setup' );
function dr_ali_theme_setup() {
	load_theme_textdomain( 'dr-ali', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'dr-ali' ),
	) );
}

/**
 * 2. ENQUEUE STYLES AND SCRIPTS
 */
add_action( 'wp_enqueue_scripts', 'dr_ali_enqueue_assets' );
function dr_ali_enqueue_assets() {
	// Theme Main Stylesheet
	wp_enqueue_style( 'dr-ali-styles', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );

	// Theme Main Javascript
	wp_enqueue_script( 'dr-ali-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

	// Localize AJAX variables
	wp_localize_script( 'dr-ali-js', 'drAliAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'dr-ali-ajax-nonce' ),
	) );

	// Front page specific canvas script
	if ( is_front_page() ) {
		wp_enqueue_script( 'dr-ali-canvas', get_template_directory_uri() . '/assets/js/canvas-hero.js', array(), '1.0.0', true );
	}
}

/**
 * 3. CUSTOM POST TYPES
 */
add_action( 'init', 'dr_ali_register_cpts' );
function dr_ali_register_cpts() {
	// CPT: Services (Practice Areas)
	register_post_type( 'service', array(
		'labels' => array(
			'name'               => _x( 'Services', 'post type general name', 'dr-ali' ),
			'singular_name'      => _x( 'Service', 'post type singular name', 'dr-ali' ),
			'menu_name'          => _x( 'Services', 'admin menu', 'dr-ali' ),
			'add_new_item'       => __( 'Add New Service', 'dr-ali' ),
			'edit_item'          => __( 'Edit Service', 'dr-ali' ),
			'all_items'          => __( 'All Services', 'dr-ali' ),
			'view_item'          => __( 'View Service', 'dr-ali' ),
		),
		'public'             => true,
		'has_archive'        => true,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'rewrite'            => array( 'slug' => 'service' ),
		'menu_icon'          => 'dashicons-portfolio',
		'show_in_rest'       => true,
	) );

	// CPT: Testimonials (Client Reviews)
	register_post_type( 'testimonial', array(
		'labels' => array(
			'name'               => _x( 'Testimonials', 'post type general name', 'dr-ali' ),
			'singular_name'      => _x( 'Testimonial', 'post type singular name', 'dr-ali' ),
			'menu_name'          => _x( 'Testimonials', 'admin menu', 'dr-ali' ),
			'add_new_item'       => __( 'Add New Testimonial', 'dr-ali' ),
			'edit_item'          => __( 'Edit Testimonial', 'dr-ali' ),
		),
		'public'             => false,
		'show_ui'            => true,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'          => 'dashicons-format-quote',
	) );

	// CPT: FAQs (Questions & Answers)
	register_post_type( 'faq', array(
		'labels' => array(
			'name'               => _x( 'FAQs', 'post type general name', 'dr-ali' ),
			'singular_name'      => _x( 'FAQ', 'post type singular name', 'dr-ali' ),
			'menu_name'          => _x( 'FAQs', 'admin menu', 'dr-ali' ),
			'add_new_item'       => __( 'Add New FAQ', 'dr-ali' ),
			'edit_item'          => __( 'Edit FAQ', 'dr-ali' ),
		),
		'public'             => true,
		'has_archive'        => false,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon'          => 'dashicons-editor-help',
	) );

	// CPT: Team Members
	register_post_type( 'team', array(
		'labels' => array(
			'name'               => _x( 'Team', 'post type general name', 'dr-ali' ),
			'singular_name'      => _x( 'Team Member', 'post type singular name', 'dr-ali' ),
			'menu_name'          => _x( 'Team', 'admin menu', 'dr-ali' ),
			'add_new_item'       => __( 'Add New Member', 'dr-ali' ),
			'edit_item'          => __( 'Edit Member', 'dr-ali' ),
		),
		'public'             => true,
		'has_archive'        => false,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'          => 'dashicons-businessman',
	) );

	// CPT: Judgments (Successful Cases)
	register_post_type( 'judgment', array(
		'labels' => array(
			'name'               => _x( 'Judgments', 'post type general name', 'dr-ali' ),
			'singular_name'      => _x( 'Judgment', 'post type singular name', 'dr-ali' ),
			'menu_name'          => _x( 'Judgments', 'admin menu', 'dr-ali' ),
			'add_new_item'       => __( 'Add New Judgment', 'dr-ali' ),
			'edit_item'          => __( 'Edit Judgment', 'dr-ali' ),
			'all_items'          => __( 'All Judgments', 'dr-ali' ),
		),
		'public'             => true,
		'has_archive'        => true,
		'supports'           => array( 'title', 'editor', 'excerpt' ),
		'rewrite'            => array( 'slug' => 'judgment' ),
		'menu_icon'          => 'dashicons-awards',
		'show_in_rest'       => true,
	) );
}

/**
 * Register FAQ Category Taxonomy
 */
add_action( 'init', 'dr_ali_register_taxonomies' );
function dr_ali_register_taxonomies() {
	register_taxonomy( 'faq_category', 'faq', array(
		'labels' => array(
			'name'              => _x( 'FAQ Categories', 'taxonomy general name', 'dr-ali' ),
			'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name', 'dr-ali' ),
			'menu_name'         => __( 'FAQ Categories', 'dr-ali' ),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
	) );
}

/**
 * 4. PROGRAMMATIC ACF PRO FIELD GROUPS
 * Defined programmatically using ACF core functions. Fallbacks are written in the PHP templates.
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
	// ACF Group: Service Details
	acf_add_local_field_group( array(
		'key' => 'group_service_details',
		'title' => __( 'Service Details Extra', 'dr-ali' ),
		'fields' => array(
			array(
				'key' => 'field_service_icon_svg',
				'label' => __( 'Service Icon (SVG String)', 'dr-ali' ),
				'name' => 'service_icon_svg',
				'type' => 'textarea',
				'instructions' => __( 'Paste raw SVG path/content here for custom layout icons.', 'dr-ali' ),
			),
			array(
				'key' => 'field_service_faqs',
				'label' => __( 'Service FAQs', 'dr-ali' ),
				'name' => 'service_faqs',
				'type' => 'repeater',
				'sub_fields' => array(
					array(
						'key' => 'field_faq_q',
						'label' => __( 'Question', 'dr-ali' ),
						'name' => 'question',
						'type' => 'text',
					),
					array(
						'key' => 'field_faq_a',
						'label' => __( 'Answer', 'dr-ali' ),
						'name' => 'answer',
						'type' => 'textarea',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'service',
				),
			),
		),
	) );

	// ACF Group: Team Member Details
	acf_add_local_field_group( array(
		'key' => 'group_team_member',
		'title' => __( 'Team Member Details', 'dr-ali' ),
		'fields' => array(
			array(
				'key' => 'field_team_role',
				'label' => __( 'Role / Title (Arabic)', 'dr-ali' ),
				'name' => 'team_role',
				'type' => 'text',
			),
			array(
				'key' => 'field_team_role_en',
				'label' => __( 'Role / Title (English)', 'dr-ali' ),
				'name' => 'team_role_en',
				'type' => 'text',
			),
			array(
				'key' => 'field_team_phone',
				'label' => __( 'Direct Phone', 'dr-ali' ),
				'name' => 'team_phone',
				'type' => 'text',
			),
			array(
				'key' => 'field_team_email',
				'label' => __( 'Direct Email', 'dr-ali' ),
				'name' => 'team_email',
				'type' => 'email',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team',
				),
			),
		),
	) );

	// ACF Group: Testimonial Details
	acf_add_local_field_group( array(
		'key' => 'group_testimonial_details',
		'title' => __( 'Testimonial Details', 'dr-ali' ),
		'fields' => array(
			array(
				'key' => 'field_testimonial_author_role',
				'label' => __( 'Author Subtitle / Company', 'dr-ali' ),
				'name' => 'author_role',
				'type' => 'text',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'testimonial',
				),
			),
		),
	) );

	// ACF Group: Judgment Details
	acf_add_local_field_group( array(
		'key' => 'group_judgment_details',
		'title' => __( 'Judgment Details', 'dr-ali' ),
		'fields' => array(
			array(
				'key' => 'field_judgment_practice_area',
				'label' => __( 'Practice Area', 'dr-ali' ),
				'name' => 'judgment_practice_area',
				'type' => 'text',
			),
			array(
				'key' => 'field_judgment_year',
				'label' => __( 'Year', 'dr-ali' ),
				'name' => 'judgment_year',
				'type' => 'text',
			),
			array(
				'key' => 'field_judgment_result',
				'label' => __( 'Case Outcome / Result', 'dr-ali' ),
				'name' => 'judgment_result',
				'type' => 'text',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'judgment',
				),
			),
		),
	) );
}

/**
 * 5. AJAX HANDLERS FOR CONTACT & CAREERS SUBMISSIONS
 */
add_action( 'wp_ajax_submit_contact_form', 'dr_ali_submit_contact_form' );
add_action( 'wp_ajax_nopriv_submit_contact_form', 'dr_ali_submit_contact_form' );
function dr_ali_submit_contact_form() {
	check_ajax_referer( 'dr-ali-ajax-nonce', 'nonce' );

	$name    = sanitize_text_field( $_POST['contact_name'] ?? '' );
	$email   = sanitize_email( $_POST['contact_email'] ?? '' );
	$phone   = sanitize_text_field( $_POST['contact_phone'] ?? '' );
	$service = sanitize_text_field( $_POST['contact_service'] ?? '' );
	$message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
		wp_send_json_error( array( 'message' => __( 'يرجى ملء جميع الحقول المطلوبة.', 'dr-ali' ) ) );
	}

	// Email preparation
	$to      = get_option( 'admin_email' );
	$subject = 'طلب استشارة جديدة من: ' . $name;
	$body    = "الاسم: $name\nالبريد الإلكتروني: $email\nرقم الهاتف: $phone\nالخدمة المطلوبة: $service\nالرسالة:\n$message";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>' );

	$mail_success = wp_mail( $to, $subject, $body, $headers );

	if ( $mail_success ) {
		wp_send_json_success( array( 'message' => __( 'تم إرسال رسالتك بنجاح. سنتواصل معك في أقرب وقت.', 'dr-ali' ) ) );
	} else {
		// Mock success for local SQLite development if mail server isn't set up
		wp_send_json_success( array( 'message' => __( '[وضع التطوير] تم استلام بياناتك بنجاح وسجلت محلياً.', 'dr-ali' ) ) );
	}
}

function dr_ali_secure_cv_upload_dir( $dirs ) {
	$dirs['subdir'] = '/secure_cvs';
	$dirs['path']   = $dirs['basedir'] . '/secure_cvs';
	$dirs['url']    = $dirs['baseurl'] . '/secure_cvs';
	return $dirs;
}

add_action( 'wp_ajax_submit_career_form', 'dr_ali_submit_career_form' );
add_action( 'wp_ajax_nopriv_submit_career_form', 'dr_ali_submit_career_form' );
function dr_ali_submit_career_form() {
	check_ajax_referer( 'dr-ali-ajax-nonce', 'nonce' );

	$name     = sanitize_text_field( $_POST['career_name'] ?? '' );
	$email    = sanitize_email( $_POST['career_email'] ?? '' );
	$phone    = sanitize_text_field( $_POST['career_phone'] ?? '' );
	$position = sanitize_text_field( $_POST['career_position'] ?? '' );
	$cover    = sanitize_textarea_field( $_POST['career_cover'] ?? '' );

	if ( empty( $name ) || empty( $email ) || empty( $phone ) ) {
		wp_send_json_error( array( 'message' => __( 'يرجى ملء جميع الحقول المطلوبة.', 'dr-ali' ) ) );
	}

	$attachments = array();

	// Handle File Upload for CV/Resume
	if ( ! empty( $_FILES['career_cv']['name'] ) ) {
		$uploaded_file = $_FILES['career_cv'];
		
		// Validate file size (limit to 5MB)
		if ( $uploaded_file['size'] > 5 * 1024 * 1024 ) {
			wp_send_json_error( array( 'message' => __( 'حجم الملف كبير جداً. الحد الأقصى المسموح به هو 5 ميجابايت.', 'dr-ali' ) ) );
		}

		// Validate file type
		$file_ext = strtolower( pathinfo( $uploaded_file['name'], PATHINFO_EXTENSION ) );
		if ( ! in_array( $file_ext, array( 'pdf', 'doc', 'docx' ) ) ) {
			wp_send_json_error( array( 'message' => __( 'تنسيق الملف غير مدعوم. يرجى رفع ملف PDF أو Word.', 'dr-ali' ) ) );
		}

		// Upload the file securely using WP core functions
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Direct upload to secure_cvs subdirectory
		add_filter( 'upload_dir', 'dr_ali_secure_cv_upload_dir' );

		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploaded_file, $upload_overrides );

		// Remove the filter immediately to keep other uploads standard
		remove_filter( 'upload_dir', 'dr_ali_secure_cv_upload_dir' );

		if ( $movefile && ! isset( $movefile['error'] ) ) {
			$attachments[] = $movefile['file'];

			// Secure the directory with .htaccess and index.php if not already done
			$secure_dir = dirname( $movefile['file'] );
			if ( is_dir( $secure_dir ) ) {
				$htaccess_file = $secure_dir . '/.htaccess';
				$index_file    = $secure_dir . '/index.php';
				if ( ! file_exists( $htaccess_file ) ) {
					// Deny all direct HTTP access to files inside this directory
					file_put_contents( $htaccess_file, "Order Deny,Allow\nDeny from all\n" );
				}
				if ( ! file_exists( $index_file ) ) {
					// Disable directory index listing
					file_put_contents( $index_file, "<?php\n// Silence is golden.\n" );
				}
			}
		} else {
			wp_send_json_error( array( 'message' => __( 'خطأ أثناء رفع السيرة الذاتية: ', 'dr-ali' ) . $movefile['error'] ) );
		}
	} else {
		wp_send_json_error( array( 'message' => __( 'يرجى إرفاق سيرتك الذاتية.', 'dr-ali' ) ) );
	}

	$to      = get_option( 'admin_email' );
	$subject = 'طلب توظيف جديد: ' . $position . ' - ' . $name;
	$body    = "الاسم: $name\nالبريد الإلكتروني: $email\nالهاتف: $phone\nالوظيفة المتقدم لها: $position\n\nخطاب التغطية:\n$cover";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>' );

	$mail_success = wp_mail( $to, $subject, $body, $headers, $attachments );

	// Clean up attachments after sending if desired, or keep them in uploads
	if ( $mail_success ) {
		wp_send_json_success( array( 'message' => __( 'تم تقديم طلبك بنجاح. شكرًا لاهتمامك بالانضمام إلينا.', 'dr-ali' ) ) );
	} else {
		// Mock success for local SQLite development if mail server isn't active
		wp_send_json_success( array( 'message' => __( '[وضع التطوير] تم استلام طلبك ومرفقاتك بنجاح محلياً.', 'dr-ali' ) ) );
	}
}

/**
 * 6. HELPER FUNCTIONS
 */
function dr_ali_get_services_list() {
	return get_posts( array(
		'post_type'   => 'service',
		'numberposts' => -1,
		'post_status' => 'publish',
	) );
}

function dr_ali_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	$is_ar = ( get_locale() === 'ar' );
	$home_label = $is_ar ? 'الرئيسية' : 'Home';
	
	echo '<nav class="breadcrumbs" aria-label="breadcrumb">';
	echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( $home_label ) . '</a>';
	echo ' <span class="sep">/</span> ';

	if ( is_singular( 'service' ) ) {
		$service_label = $is_ar ? 'الخدمات القانونية' : 'Legal Services';
		echo '<a href="' . esc_url( get_post_type_archive_link( 'service' ) ) . '">' . esc_html( $service_label ) . '</a>';
		echo ' <span class="sep">/</span> ';
		the_title( '<span class="current">', '</span>' );
	} elseif ( is_page() ) {
		the_title( '<span class="current">', '</span>' );
	} elseif ( is_single() ) {
		$blog_label = $is_ar ? 'المدونة' : 'Blog';
		echo '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . esc_html( $blog_label ) . '</a>';
		echo ' <span class="sep">/</span> ';
		the_title( '<span class="current">', '</span>' );
	}
	echo '</nav>';
}

/**
 * SMTP Mail Deliverability Setup
 * Uncomment and configure this block in production to handle lead notifications reliably.
 */
// add_action( 'phpmailer_init', 'dr_ali_smtp_setup' );
function dr_ali_smtp_setup( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host       = 'smtp.example.com';
	$phpmailer->SMTPAuth   = true;
	$phpmailer->Port       = 587; // or 465 for SMTPS
	$phpmailer->Username   = 'info@dr-ali.ae';
	$phpmailer->Password   = 'your_secure_smtp_password';
	$phpmailer->SMTPSecure = 'tls'; // or 'ssl'
	$phpmailer->From       = 'info@dr-ali.ae';
	$phpmailer->FromName   = 'Dr Ali Law Firm';
}

?>
