<?php
/**
 * The footer template file
 *
 * @package DrAli
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_rtl = is_rtl();
$is_en = ( get_locale() === 'en_US' );

$phone_number = '+97145551234';
$phone_display = '+971 4 555 1234';
$email_address = 'info@dr-ali.ae';
$whatsapp_number = '971555123456'; // Dubai number format
$whatsapp_message = rawurlencode( $is_en ? 'Hello Dr Ali Law Firm, I would like to inquire about your legal services.' : 'مرحباً مكتب الدكتور علي للمحاماة، أود الاستفسار عن الخدمات القانونية.' );

?>
	<footer id="colophon" class="site-footer bg-forest text-white pt-16 pb-8">
		<div class="container footer-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 border-b border-light-forest pb-12">
			<!-- Column 1: About Firm -->
			<div class="footer-col about-widget">
				<div class="footer-logo mb-6">
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
				<p class="text-light-grey text-sm leading-relaxed mb-6">
					<?php 
					echo $is_en 
						? 'Dr. Ali Law Firm in Dubai represents the pinnacle of legal excellence, providing high-end commercial and corporate counsel.' 
						: 'يمثل مكتب الدكتور علي للمحاماة والاستشارات القانونية في دبي قمة التميز القانوني، حيث نقدم حلولاً واستشارات مبتكرة للشركات والأفراد.';
					?>
				</p>
				<!-- Social Buttons Row -->
				<div class="footer-social-icons flex gap-4 mt-6">
					<a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="<?php esc_attr_e( 'لينكد إن', 'dr-ali' ); ?>">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
					</a>
					<a href="https://x.com" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="<?php esc_attr_e( 'إكس', 'dr-ali' ); ?>">
						<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
					</a>
				</div>
			</div>

			<!-- Column 2: Quick Links -->
			<div class="footer-col">
				<h4 class="footer-title text-gold text-lg font-bold mb-6 pb-2 relative inline-block">
					<?php echo $is_en ? 'Quick Links' : 'روابط سريعة'; ?>
				</h4>
				<ul class="footer-links text-sm text-light-grey space-y-3">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $is_en ? 'Home' : 'الرئيسية'; ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>"><?php echo $is_en ? 'Practice Areas' : 'مجالات الاختصاص'; ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php echo $is_en ? 'About Us' : 'من نحن'; ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/team/' ) ); ?>"><?php echo $is_en ? 'Our Team' : 'فريق العمل'; ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/careers/' ) ); ?>"><?php echo $is_en ? 'Careers' : 'الوظائف الشاغرة'; ?></a></li>
				</ul>
			</div>

			<!-- Column 3: Legal Services -->
			<div class="footer-col">
				<h4 class="footer-title text-gold text-lg font-bold mb-6 pb-2 relative inline-block">
					<?php echo $is_en ? 'Practice Areas' : 'الخدمات القانونية'; ?>
				</h4>
				<ul class="footer-links text-sm text-light-grey space-y-3">
					<?php
					$services = dr_ali_get_services_list();
					if ( ! empty( $services ) ) {
						// Output actual registered services
						$count = 0;
						foreach ( $services as $service ) {
							if ( $count >= 5 ) break;
							echo '<li><a href="' . esc_url( get_permalink( $service->ID ) ) . '">' . esc_html( $service->post_title ) . '</a></li>';
							$count++;
						}
					} else {
						// Mock services fallbacks
						if ( $is_en ) {
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Corporate Law</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Real Estate & Property</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Commercial Litigation</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Arbitration & Dispute Resolution</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Intellectual Property</a></li>';
						} else {
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">قانون الشركات والأعمال</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">قانون العقارات والإنشاءات</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">التقاضي التجاري والمدني</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">التحكيم وفض المنازعات</a></li>';
							echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">حماية الملكية الفكرية</a></li>';
						}
					}
					?>
				</ul>
			</div>

			<!-- Column 4: Contact Us -->
			<div class="footer-col">
				<h4 class="footer-title text-gold text-lg font-bold mb-6 pb-2 relative inline-block">
					<?php echo $is_en ? 'Contact Us' : 'اتصل بنا'; ?>
				</h4>
				<ul class="footer-contact-details text-sm text-light-grey space-y-4">
					<li class="flex items-start gap-3">
						<span class="icon mt-1">
							<svg class="footer-contact-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--color-gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
						</span>
						<a href="https://maps.google.com/?q=Business+Bay,+Executive+Towers,+Dubai" target="_blank" rel="noopener noreferrer" class="hover:text-gold">
							<?php 
							echo $is_en 
								? 'Business Bay, Executive Towers, Tower B, Level 15, Dubai, UAE' 
								: 'الخليج التجاري، أبراج إكزيكتيف، برج B، الطابق 15، دبي، الإمارات العربية المتحدة'; 
							?>
						</a>
					</li>
					<li class="flex items-center gap-3">
						<span class="icon">
							<svg class="footer-contact-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--color-gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
						</span>
						<a href="tel:<?php echo esc_attr( $phone_number ); ?>" class="hover:text-gold"><?php echo esc_html( $phone_display ); ?></a>
					</li>
					<li class="flex items-center gap-3">
						<span class="icon">
							<svg class="footer-contact-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--color-gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
						</span>
						<a href="mailto:<?php echo esc_attr( $email_address ); ?>" class="hover:text-gold"><?php echo esc_html( $email_address ); ?></a>
					</li>
					<li class="mt-6 border-t border-light-forest pt-4 text-xs text-light-grey opacity-75">
						<svg class="footer-license-icon inline-block align-middle me-2" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--color-gold)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-inline-end: 0.5rem;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
						<?php echo $is_en 
							? 'Licensed by the Dubai Legal Affairs Department. Registration No. 1024/2026.' 
							: 'مرخص من دائرة الشؤون القانونية لحكومة دبي. رقم القيد 1024/2026.'; ?>
					</li>
				</ul>
			</div>
		</div>

		<!-- Bottom Footer -->
		<div class="container footer-bottom pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-light-grey">
			<div class="copyright mb-4 md:mb-0">
				&copy; <?php echo date( 'Y' ); ?> <?php echo $is_en ? 'Dr Ali Law Firm. All rights reserved.' : 'مكتب الدكتور علي للمحاماة. جميع الحقوق محفوظة.'; ?>
			</div>
			<div class="footer-meta-links flex gap-6">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-gold"><?php echo $is_en ? 'Privacy Policy' : 'سياسة الخصوصية'; ?></a>
				<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>" class="hover:text-gold"><?php echo $is_en ? 'Terms of Service' : 'شروط الاستخدام'; ?></a>
			</div>
		</div>
	</footer>

	<!-- Floating WhatsApp Widget -->
	<a href="https://wa.me/<?php echo esc_attr( $whatsapp_number ); ?>?text=<?php echo $whatsapp_message; ?>" class="whatsapp-floating-widget" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'تواصل معنا عبر واتساب', 'dr-ali' ); ?>">
		<span class="whatsapp-icon">
			<svg viewBox="0 0 24 24" width="30" height="30" fill="currentColor">
				<path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 0 0 1.335 4.978L2 22l5.197-1.36a9.944 9.944 0 0 0 4.814 1.238h.005c5.504 0 9.99-4.478 9.99-9.988 0-2.67-1.037-5.178-2.92-7.062C17.185 3.044 14.68 2.001 12.012 2zm5.727 14.06c-.313.877-1.536 1.612-2.108 1.72-.572.108-1.283.154-3.642-.817-2.834-1.17-4.607-4.048-4.75-4.237-.14-.19-1.143-1.52-1.143-2.903 0-1.383.725-2.062 1.01-2.347.287-.285.63-.356.84-.356.21 0 .421.002.603.01.192.009.45-.072.705.539.262.628.895 2.19.972 2.347.078.158.13.342.024.548-.106.206-.158.342-.314.52-.156.18-.328.4-.47.54-.157.158-.323.33-.14.646.183.315.815 1.346 1.747 2.174.93.829 1.713 1.085 2.032 1.24.318.156.505.13.69-.082.185-.213.793-.923.998-1.242.206-.318.412-.266.696-.16.282.106 1.796.848 2.107.997.311.15.518.225.594.356.076.13.076.756-.237 1.633z"/>
			</svg>
		</span>
	</a>

</div><!-- #page -->

<!-- Tawk.to Live Chat Script Integration (Lazy Loaded) -->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
	window.addEventListener('load', function() {
		setTimeout(function() {
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/648a9010cc26a871b0227fd1/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
		}, 3000);
	});
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
