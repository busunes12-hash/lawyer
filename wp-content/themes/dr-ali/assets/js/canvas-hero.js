/**
 * Canvas Hero Animation: Dr Ali Law Firm (Casablanca)
 * Renders a slow, elegant particle network of golden nodes and thin connection lines
 */

(function() {
    // Disable canvas animation on mobile to save CPU and battery
    if (window.innerWidth <= 768) {
        const canvas = document.getElementById('hero-canvas');
        if (canvas) canvas.style.display = 'none';
        return;
    }

    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let animationFrameId;
    let particles = [];
    
    // Config
    const particleCount = 45;
    const maxDistance = 120;
    const speedFactor = 0.25; // extremely slow movement for elegance
    const particleColor = 'rgba(229, 180, 114, 0.45)'; // Gold with opacity
    const lineColor = 'rgba(229, 180, 114, 0.08)'; // Very subtle gold connections

    // Resize Handler
    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;
    }

    // Particle Class
    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.vx = (Math.random() - 0.5) * speedFactor;
            this.vy = (Math.random() - 0.5) * speedFactor;
            this.radius = Math.random() * 2 + 1; // 1px to 3px size
        }

        update() {
            this.x += this.vx;
            this.y += this.vy;

            // Bounce off boundaries
            if (this.x < 0 || this.x > canvas.width) this.vx = -this.vx;
            if (this.y < 0 || this.y > canvas.height) this.vy = -this.vy;
            
            // Constrain
            if (this.x < 0) this.x = 0;
            if (this.x > canvas.width) this.x = canvas.width;
            if (this.y < 0) this.y = 0;
            if (this.y > canvas.height) this.y = canvas.height;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = particleColor;
            ctx.fill();
        }
    }

    // Initialize Particles
    function init() {
        resizeCanvas();
        particles = [];
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }

    // Animation Loop
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Update and draw particles
        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
            particles[i].draw();

            // Draw connection lines
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < maxDistance) {
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = lineColor;
                    ctx.lineWidth = 0.5;
                    ctx.stroke();
                }
            }
        }

        animationFrameId = requestAnimationFrame(animate);
    }

    // Bind events
    window.addEventListener('resize', () => {
        resizeCanvas();
    });

    // Start
    init();
    animate();
})();
