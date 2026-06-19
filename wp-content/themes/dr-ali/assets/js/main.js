/**
 * Main Interaction Javascript: Dr Ali Law Firm (Dubai)
 * Pure vanilla JavaScript (jQuery-Free)
 */

document.addEventListener('DOMContentLoaded', () => {
    initStickyHeader();
    initMobileMenu();
    initScrollReveal();
    initStatsCounter();
    initTestimonialSlider();
    initFaqAccordion();
    initFaqTabs();
    initAjaxForms();
});

/**
 * 1. Sticky Smart Header
 * Hides on scroll down, reveals on scroll up
 */
function initStickyHeader() {
    const header = document.getElementById('masthead');
    if (!header) return;

    let lastScroll = 0;
    const scrollThreshold = 100;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        // At the very top
        if (currentScroll <= scrollThreshold) {
            header.classList.remove('header-hidden');
            return;
        }

        // Scrolling down
        if (currentScroll > lastScroll && !header.classList.contains('header-hidden')) {
            header.classList.add('header-hidden');
        } 
        // Scrolling up
        else if (currentScroll < lastScroll && header.classList.contains('header-hidden')) {
            header.classList.remove('header-hidden');
        }

        lastScroll = currentScroll;
    }, { passive: true });
}

/**
 * 2. Fullscreen Mobile Menu Overlay
 */
function initMobileMenu() {
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const closeBtn = document.querySelector('.mobile-menu-close');
    const overlay = document.getElementById('mobile-overlay');
    const menuLinks = document.querySelectorAll('.mobile-nav-menu a');

    if (!overlay || !toggleBtn || !closeBtn) return;

    const openMenu = () => {
        overlay.classList.add('active');
        toggleBtn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden'; // prevent scrolling behind
    };

    const closeMenu = () => {
        overlay.classList.remove('active');
        toggleBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    };

    toggleBtn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);

    // Close when clicking any nav link
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close on ESC key press
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('active')) {
            closeMenu();
        }
    });
}

/**
 * 3. Scroll Reveal Observer
 */
function initScrollReveal() {
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length === 0) return;

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                // Optional: unobserve after animating
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    revealElements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * 4. Animated Stats Counter
 */
function initStatsCounter() {
    const statsSection = document.querySelector('.stats-transition-strip');
    const numbers = document.querySelectorAll('.stat-number');
    if (!statsSection || numbers.length === 0) return;

    let started = false;

    const startCounting = () => {
        numbers.forEach(num => {
            const target = parseInt(num.getAttribute('data-target'), 10);
            const duration = 2000; // 2 seconds
            const stepTime = Math.max(Math.floor(duration / target), 15);
            let current = 0;

            const timer = setInterval(() => {
                current += Math.ceil(target / (duration / stepTime));
                if (current >= target) {
                    num.textContent = target + '+';
                    clearInterval(timer);
                } else {
                    num.textContent = current + '+';
                }
            }, stepTime);
        });
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !started) {
                started = true;
                startCounting();
            }
        });
    }, { threshold: 0.5 });

    observer.observe(statsSection);
}

/**
 * 5. Touch-Swipe Testimonials Slider (jQuery-Free & Swiper-Free)
 */
function initTestimonialSlider() {
    const container = document.querySelector('.slider-container');
    const track = document.querySelector('.slider-track');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const dotsContainer = document.querySelector('.slider-dots');

    if (!container || !track || slides.length === 0) return;

    let currentIndex = 0;
    let startX = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let isDragging = false;
    let animationID = 0;

    // Get number of visible slides based on viewport width
    const getVisibleSlidesCount = () => {
        const width = window.innerWidth;
        if (width >= 1024) return 3;
        if (width >= 768) return 2;
        return 1;
    };

    const getMaxIndex = () => {
        return Math.max(0, slides.length - getVisibleSlidesCount());
    };

    // Generate dots
    if (dotsContainer) {
        dotsContainer.innerHTML = '';
        const visibleSlides = getVisibleSlidesCount();
        const maxIndex = getMaxIndex();
        
        // Only show dots if there's content to scroll to
        if (maxIndex > 0) {
            for (let i = 0; i <= maxIndex; i++) {
                const dot = document.createElement('button');
                dot.classList.add('dot');
                dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
                if (i === 0) dot.classList.add('active');
                
                dot.addEventListener('click', () => {
                    slideTo(i);
                });
                dotsContainer.appendChild(dot);
            }
        }
    }

    const updateSliderPosition = () => {
        const slideWidth = slides[0].getBoundingClientRect().width;
        // Direction multiplier for RTL
        const isRtl = document.documentElement.getAttribute('dir') === 'rtl';
        const rtlMultiplier = isRtl ? 1 : -1;
        
        currentTranslate = currentIndex * slideWidth * rtlMultiplier;
        prevTranslate = currentTranslate;
        track.style.transform = `translateX(${currentTranslate}px)`;
    };

    const updateDots = () => {
        if (dotsContainer) {
            const dots = dotsContainer.querySelectorAll('.dot');
            dots.forEach((dot, idx) => {
                if (idx === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
    };

    const slideTo = (index) => {
        const maxIndex = getMaxIndex();
        currentIndex = Math.max(0, Math.min(index, maxIndex));
        updateSliderPosition();
        updateDots();
    };

    // Resize handler
    window.addEventListener('resize', () => {
        slideTo(currentIndex);
        // Regenerate dots if viewport size threshold changes slides count
        if (dotsContainer) {
            const maxIndex = getMaxIndex();
            dotsContainer.innerHTML = '';
            if (maxIndex > 0) {
                for (let i = 0; i <= maxIndex; i++) {
                    const dot = document.createElement('button');
                    dot.classList.add('dot');
                    dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
                    if (i === currentIndex) dot.classList.add('active');
                    
                    dot.addEventListener('click', () => {
                        slideTo(i);
                    });
                    dotsContainer.appendChild(dot);
                }
            }
        }
    });

    // Arrow Controls
    if (prevBtn && nextBtn) {
        const isRtl = document.documentElement.getAttribute('dir') === 'rtl';
        
        nextBtn.addEventListener('click', () => {
            if (isRtl) {
                slideTo(currentIndex - 1);
            } else {
                slideTo(currentIndex + 1);
            }
        });

        prevBtn.addEventListener('click', () => {
            if (isRtl) {
                slideTo(currentIndex + 1);
            } else {
                slideTo(currentIndex - 1);
            }
        });
    }

    // Touch & Pointer Events
    const getPositionX = (event) => {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    };

    const animation = () => {
        track.style.transform = `translateX(${currentTranslate}px)`;
        if (isDragging) requestAnimationFrame(animation);
    };

    const touchStart = (index) => {
        return function (event) {
            isDragging = true;
            startX = getPositionX(event);
            animationID = requestAnimationFrame(animation);
            track.style.transition = 'none';
        };
    };

    const touchMove = (event) => {
        if (!isDragging) return;
        const currentX = getPositionX(event);
        const diff = currentX - startX;
        
        // Calculate translation based on drag diff
        currentTranslate = prevTranslate + diff;
    };

    const touchEnd = () => {
        isDragging = false;
        cancelAnimationFrame(animationID);
        track.style.transition = 'transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1)';

        const movedBy = currentTranslate - prevTranslate;
        const slideWidth = slides[0].getBoundingClientRect().width;
        const isRtl = document.documentElement.getAttribute('dir') === 'rtl';
        
        // Determine if swiped enough to change slide
        const threshold = slideWidth * 0.2; // 20% of slide width
        
        if (isRtl) {
            if (movedBy < -threshold) {
                slideTo(currentIndex + 1);
            } else if (movedBy > threshold) {
                slideTo(currentIndex - 1);
            } else {
                slideTo(currentIndex);
            }
        } else {
            if (movedBy < -threshold) {
                slideTo(currentIndex + 1);
            } else if (movedBy > threshold) {
                slideTo(currentIndex - 1);
            } else {
                slideTo(currentIndex);
            }
        }
    };

    // Bind event listeners
    slides.forEach((slide, index) => {
        // Touch events
        slide.addEventListener('touchstart', touchStart(index), { passive: true });
        slide.addEventListener('touchend', touchEnd);
        slide.addEventListener('touchmove', touchMove, { passive: true });

        // Mouse events
        slide.addEventListener('mousedown', touchStart(index));
        slide.addEventListener('mouseup', touchEnd);
        slide.addEventListener('mouseleave', () => {
            if (isDragging) touchEnd();
        });
        slide.addEventListener('mousemove', touchMove);
    });

    // Initial positioning
    slideTo(0);
}

/**
 * 6. FAQ Accordion Toggles
 */
function initFaqAccordion() {
    const headers = document.querySelectorAll('.accordion-header');
    
    headers.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const content = header.nextElementSibling;
            
            // Toggle active class
            const isActive = item.classList.contains('active');
            
            // Close other accordions in the same list
            const siblings = item.parentElement.querySelectorAll('.accordion-item');
            siblings.forEach(sib => {
                sib.classList.remove('active');
                sib.querySelector('.accordion-content').style.maxHeight = null;
            });
            
            if (!isActive) {
                item.classList.add('active');
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });
}

/**
 * 7. FAQ Page Category Tabs
 */
function initFaqTabs() {
    const tabs = document.querySelectorAll('.faq-tab-btn');
    const groups = document.querySelectorAll('.faq-group');
    
    if (tabs.length === 0 || groups.length === 0) return;
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active classes
            tabs.forEach(t => t.classList.remove('active'));
            groups.forEach(g => g.classList.remove('active'));
            
            // Set current active
            tab.classList.add('active');
            const targetId = tab.getAttribute('data-target');
            const targetGroup = document.getElementById(targetId);
            if (targetGroup) {
                targetGroup.classList.add('active');
                
                // Recalculate any open accordions within this group
                const openContent = targetGroup.querySelector('.accordion-item.active .accordion-content');
                if (openContent) {
                    openContent.style.maxHeight = openContent.scrollHeight + 'px';
                }
            }
        });
    });
}

/**
 * 8. AJAX Form Handling
 */
function initAjaxForms() {
    // 8.1 Contact Form
    const contactForm = document.getElementById('dr-ali-contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const responseDiv = contactForm.querySelector('.form-response-message');
            
            // Disable button
            submitBtn.disabled = true;
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = document.documentElement.getAttribute('dir') === 'rtl' ? 'جاري الإرسال...' : 'Sending...';
            
            const formData = new FormData(contactForm);
            formData.append('action', 'submit_contact_form');
            formData.append('nonce', drAliAjax.nonce);
            
            fetch(drAliAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                responseDiv.textContent = data.data.message;
                responseDiv.className = 'form-response-message'; // reset
                
                if (data.success) {
                    responseDiv.classList.add('success');
                    contactForm.reset();
                } else {
                    responseDiv.classList.add('error');
                }
            })
            .catch(() => {
                responseDiv.textContent = document.documentElement.getAttribute('dir') === 'rtl' 
                    ? 'حدث خطأ في النظام. يرجى المحاولة لاحقاً.' 
                    : 'System error. Please try again later.';
                responseDiv.className = 'form-response-message error';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            });
        });
    }

    // 8.2 Career Application Form
    const careerForm = document.getElementById('dr-ali-career-form');
    const fileInput = document.getElementById('career_cv');
    const fileNameDiv = document.querySelector('.uploaded-file-name');

    if (fileInput && fileNameDiv) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                fileNameDiv.textContent = e.target.files[0].name;
            } else {
                fileNameDiv.textContent = '';
            }
        });
    }

    if (careerForm) {
        careerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const submitBtn = careerForm.querySelector('button[type="submit"]');
            const responseDiv = careerForm.querySelector('.form-response-message');
            
            submitBtn.disabled = true;
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = document.documentElement.getAttribute('dir') === 'rtl' ? 'جاري رفع الملف وتقديم الطلب...' : 'Uploading and submitting...';
            
            const formData = new FormData(careerForm);
            formData.append('action', 'submit_career_form');
            formData.append('nonce', drAliAjax.nonce);
            
            fetch(drAliAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                responseDiv.textContent = data.data.message;
                responseDiv.className = 'form-response-message'; // reset
                
                if (data.success) {
                    responseDiv.classList.add('success');
                    careerForm.reset();
                    if (fileNameDiv) fileNameDiv.textContent = '';
                } else {
                    responseDiv.classList.add('error');
                }
            })
            .catch(() => {
                responseDiv.textContent = document.documentElement.getAttribute('dir') === 'rtl' 
                    ? 'حدث خطأ أثناء إرسال ملفاتك. يرجى المحاولة لاحقاً.' 
                    : 'Error uploading files. Please try again.';
                responseDiv.className = 'form-response-message error';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            });
        });
    }
}
