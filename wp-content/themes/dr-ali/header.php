<?php
/**
 * The header template file
 *
 * @package DrAli
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_rtl = is_rtl();
$current_lang = get_locale();
$is_en = ( $current_lang === 'en_US' );
$opposite_lang = $is_en ? 'ar' : 'en';
$opposite_lang_label = $is_en ? 'العربية' : 'English';

// Quick contacts
$phone_number = '+97145551234';
$phone_display = '+971 4 555 1234';
$email_address = 'info@dr-ali.ae';
$consultation_text = $is_en ? 'Book Consultation' : 'احجز استشارة';
$consultation_link = home_url( $is_en ? '/en/contact/' : '/contact/' ); // fallback to contact page or section

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo $is_rtl ? 'rtl' : 'ltr'; ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<!-- SEO Meta Tags -->
	<?php
	$seo_desc = '';
	if ( is_front_page() || is_home() ) {
		$seo_desc = $is_en 
			? 'Dr. Ali Law Firm in Dubai represents the pinnacle of legal excellence, providing high-end commercial and corporate counsel representing clients across UAE courts.'
			: 'مكتب الدكتور علي للمحاماة والاستشارات القانونية في دبي - نقدم استشارات وحلولاً قانونية متكاملة للشركات والأفراد، ونمثل عملائنا بنخبة من أفضل المحامين أمام جميع المحاكم الإماراتية.';
	} elseif ( is_singular() ) {
		$seo_desc = get_the_excerpt();
		if ( empty( $seo_desc ) ) {
			$seo_desc = wp_trim_words( strip_shortcodes( get_post()->post_content ), 25 );
		}
	}
	if ( ! empty( $seo_desc ) ) {
		echo '	<meta name="description" content="' . esc_attr( wp_strip_all_tags( $seo_desc ) ) . '">' . "\n";
	}
	?>

	<!-- Google Fonts Preload -->
	<?php if ( $is_rtl ) : ?>
		<link rel="preload" href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Tajawal:wght@400;500;700;800&display=swap" as="style">
	<?php else : ?>
		<link rel="preload" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Poppins:wght@400;500;600;700;800&display=swap" as="style">
	<?php endif; ?>

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php if ( $is_rtl ) : ?>
		<!-- Arabic Typography: Tajawal (Headings) and Cairo (Body) -->
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
	<?php else : ?>
		<!-- English Typography: Poppins (Headings) and Lato (Body) -->
		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<?php endif; ?>

	<!-- Local Business Schema (SEO Optimization) -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "LegalService",
		"name": "<?php echo $is_en ? 'Dr Ali Law Firm' : 'مكتب الدكتور علي للمحاماة'; ?>",
		"image": "<?php echo esc_url( get_template_directory_uri() . '/assets/images/founder.jpg' ); ?>",
		"telephone": "<?php echo esc_attr( $phone_number ); ?>",
		"email": "<?php echo esc_attr( $email_address ); ?>",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "<?php echo $is_en ? 'Business Bay, Executive Towers, Tower B, Level 15' : 'الخليج التجاري، أبراج إكزيكتيف، برج B، الطابق 15'; ?>",
			"addressLocality": "Dubai",
			"addressRegion": "Dubai",
			"postalCode": "00000",
			"addressCountry": "AE"
		},
		"geo": {
			"@type": "GeoCoordinates",
			"latitude": "25.1856",
			"longitude": "55.2708"
		},
		"url": "<?php echo esc_url( home_url( '/' ) ); ?>",
		"priceRange": "$$$",
		"openingHoursSpecification": {
			"@type": "OpeningHoursSpecification",
			"dayOfWeek": [
				"Monday",
				"Tuesday",
				"Wednesday",
				"Thursday",
				"Friday"
			],
			"opens": "09:00",
			"closes": "18:00"
		}
	}
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'تخطي إلى المحتوى', 'dr-ali' ); ?></a>

	<!-- Top Bar -->
	<div class="top-bar">
		<div class="container top-bar-inner">
			<div class="top-bar-contact">
				<a href="tel:<?php echo esc_attr( $phone_number ); ?>" class="contact-item">
					<span class="icon">📞</span>
					<span class="text"><?php echo esc_html( $phone_display ); ?></span>
				</a>
				<a href="mailto:<?php echo esc_attr( $email_address ); ?>" class="contact-item">
					<span class="icon">✉️</span>
					<span class="text"><?php echo esc_html( $email_address ); ?></span>
				</a>
				<span class="contact-item hidden-mobile">
					<span class="icon">📍</span>
					<span class="text"><?php echo $is_en ? 'Dubai, UAE' : 'دبي، الإمارات العربية المتحدة'; ?></span>
				</span>
			</div>
			
			<div class="top-bar-lang">
				<a href="<?php echo esc_url( add_query_arg( 'lang', $opposite_lang ) ); ?>" class="lang-switch-btn">
					🌐 <?php echo esc_html( $opposite_lang_label ); ?>
				</a>
			</div>
		</div>
	</div>

	<!-- Smart Hiding Sticky Header -->
	<header id="masthead" class="site-header">
		<div class="container header-inner">
			<!-- Logo -->
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
					<svg class="logo-emblem" viewBox="0 0 100 100" width="36" height="36">
						<path d="M50,15 L50,85 M35,85 L65,85 M45,20 L55,20" stroke="var(--color-gold)" stroke-width="4" stroke-linecap="round" fill="none" />
						<path d="M20,30 L80,30" stroke="var(--color-gold)" stroke-width="4" stroke-linecap="round" fill="none" />
						<path d="M20,30 L10,55 L30,55 Z" stroke="var(--color-gold)" stroke-width="2.5" stroke-linejoin="round" fill="none" />
						<path d="M10,55 C10,62 30,62 30,55" stroke="var(--color-gold)" stroke-width="2.5" fill="none" />
						<path d="M80,30 L70,55 L90,55 Z" stroke="var(--color-gold)" stroke-width="2.5" stroke-linejoin="round" fill="none" />
						<path d="M70,55 C70,62 90,62 90,55" stroke="var(--color-gold)" stroke-width="2.5" fill="none" />
					</svg>
					<div class="logo-text">
						<div class="logo-main">
							<span class="logo-gold">د. </span>
							<span class="logo-white">علي</span>
						</div>
						<span class="logo-sub"><?php echo $is_en ? 'LAW FIRM' : 'للمحاماة والاستشارات'; ?></span>
					</div>
				</a>
			</div>

			<!-- Desktop Navigation -->
			<nav id="site-navigation" class="main-navigation hidden-tablet">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'nav-menu',
					) );
				} else {
					// Fallback menu
					?>
					<ul class="nav-menu">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $is_en ? 'Home' : 'الرئيسية'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/#services' : '/#services' ) ); ?>"><?php echo $is_en ? 'Practice Areas' : 'مجالات الاختصاص'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/#about' : '/#about' ) ); ?>"><?php echo $is_en ? 'About Us' : 'من نحن'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/team/' : '/team/' ) ); ?>"><?php echo $is_en ? 'Our Team' : 'فريق العمل'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/faq/' : '/faq/' ) ); ?>"><?php echo $is_en ? 'FAQs' : 'الأسئلة الشائعة'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/careers/' : '/careers/' ) ); ?>"><?php echo $is_en ? 'Careers' : 'الوظائف'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/contact/' : '/contact/' ) ); ?>"><?php echo $is_en ? 'Contact' : 'اتصل بنا'; ?></a></li>
					</ul>
					<?php
				}
				?>
			</nav>

			<!-- Header CTA Actions -->
			<div class="header-actions">
				<a href="<?php echo esc_url( home_url( $is_en ? '/contact/' : '/contact/' ) ); ?>" class="btn-gold hidden-mobile">
					<?php echo esc_html( $consultation_text ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( $is_en ? '/contact/' : '/contact/' ) ); ?>" class="btn-gold-mobile hidden-desktop" aria-label="<?php echo esc_attr( $consultation_text ); ?>">
					<?php echo $is_en ? 'Book' : 'احجز'; ?>
				</a>
				
				<!-- Mobile Menu Toggle -->
				<button class="mobile-menu-toggle burger-btn" aria-controls="mobile-overlay" aria-expanded="false" aria-label="<?php esc_attr_e( 'القائمة', 'dr-ali' ); ?>">
					<span class="burger-line"></span>
					<span class="burger-line"></span>
					<span class="burger-line"></span>
				</button>
			</div>
		</div>
	</header>

	<!-- Fullscreen Overlay Mobile Menu -->
	<div id="mobile-overlay" class="mobile-menu-overlay">
		<div class="overlay-header">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
					<svg class="logo-emblem" viewBox="0 0 100 100" width="32" height="32">
						<path d="M50,15 L50,85 M35,85 L65,85 M45,20 L55,20" stroke="var(--color-gold)" stroke-width="4" stroke-linecap="round" fill="none" />
						<path d="M20,30 L80,30" stroke="var(--color-gold)" stroke-width="4" stroke-linecap="round" fill="none" />
						<path d="M20,30 L10,55 L30,55 Z" stroke="var(--color-gold)" stroke-width="2.5" stroke-linejoin="round" fill="none" />
						<path d="M10,55 C10,62 30,62 30,55" stroke="var(--color-gold)" stroke-width="2.5" fill="none" />
						<path d="M80,30 L70,55 L90,55 Z" stroke="var(--color-gold)" stroke-width="2.5" stroke-linejoin="round" fill="none" />
						<path d="M70,55 C70,62 90,62 90,55" stroke="var(--color-gold)" stroke-width="2.5" fill="none" />
					</svg>
					<div class="logo-text">
						<div class="logo-main">
							<span class="logo-gold">د. </span>
							<span class="logo-white">علي</span>
						</div>
					</div>
				</a>
			</div>
			<button class="mobile-menu-close close-btn" aria-label="<?php esc_attr_e( 'إغلاق', 'dr-ali' ); ?>">&times;</button>
		</div>
		<div class="overlay-content">
			<nav class="mobile-navigation">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'mobile-nav-menu',
					) );
				} else {
					?>
					<ul class="mobile-nav-menu">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $is_en ? 'Home' : 'الرئيسية'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/#services' : '/#services' ) ); ?>"><?php echo $is_en ? 'Practice Areas' : 'مجالات الاختصاص'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/#about' : '/#about' ) ); ?>"><?php echo $is_en ? 'About Us' : 'من نحن'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/team/' : '/team/' ) ); ?>"><?php echo $is_en ? 'Our Team' : 'فريق العمل'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/faq/' : '/faq/' ) ); ?>"><?php echo $is_en ? 'FAQs' : 'الأسئلة الشائعة'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/careers/' : '/careers/' ) ); ?>"><?php echo $is_en ? 'Careers' : 'الوظائف'; ?></a></li>
						<li><a href="<?php echo esc_url( home_url( $is_en ? '/contact/' : '/contact/' ) ); ?>"><?php echo $is_en ? 'Contact' : 'اتصل بنا'; ?></a></li>
					</ul>
					<?php
				}
				?>
			</nav>
			
			<div class="mobile-contact-info mt-10 text-center">
				<a href="tel:<?php echo esc_attr( $phone_number ); ?>" class="btn-outline-gold w-full mb-4 py-3 justify-center">
					📞 <?php echo esc_html( $phone_display ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( $is_en ? '/contact/' : '/contact/' ) ); ?>" class="btn-gold w-full py-3 justify-center">
					<?php echo esc_html( $consultation_text ); ?>
				</a>
			</div>
		</div>
	</div>
