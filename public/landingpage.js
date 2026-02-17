let scene, camera, renderer, sphere;
let scrollProgress = 0;
function initThree() {
const canvas = document.getElementById('threeCanvas');
const container = canvas.parentElement;
scene = new THREE.Scene();

camera = new THREE.PerspectiveCamera(
    75,
    container.offsetWidth / container.offsetHeight,
    0.1,
    1000
);
camera.position.z = 5;

renderer = new THREE.WebGLRenderer({ 
    canvas: canvas, 
    antialias: true, 
    alpha: true 
});
renderer.setSize(container.offsetWidth, container.offsetHeight);
renderer.setPixelRatio(window.devicePixelRatio);

const geometry = new THREE.SphereGeometry(2, 32, 32);

const material = new THREE.MeshPhongMaterial({
    color: 0x3b82f6,
    shininess: 100,
    specular: 0x89cff0,
    emissive: 0x1e40af,
    emissiveIntensity: 0.2
});

sphere = new THREE.Mesh(geometry, material);
scene.add(sphere);

const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
scene.add(ambientLight);

const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
directionalLight.position.set(5, 5, 5);
scene.add(directionalLight);

const pointLight = new THREE.PointLight(0x8b5cf6, 0.5);
pointLight.position.set(-5, -5, 5);
scene.add(pointLight);

animate();
}
function animate() {
requestAnimationFrame(animate);
sphere.rotation.y += 0.005;
sphere.rotation.x = scrollProgress * Math.PI * 2;
sphere.rotation.z = scrollProgress * Math.PI;

const time = Date.now() * 0.001;
sphere.position.y = Math.sin(time) * 0.1;

renderer.render(scene, camera);
}
function handleScroll() {
const heroSection = document.querySelector('.hero');
const heroRect = heroSection.getBoundingClientRect();
const heroHeight = heroRect.height;
if (heroRect.top < window.innerHeight && heroRect.bottom > 0) {
    scrollProgress = Math.max(0, Math.min(1, -heroRect.top / heroHeight));
}

const header = document.getElementById('header');
if (window.scrollY > 50) {
    header.classList.add('scrolled');
} else {
    header.classList.remove('scrolled');
}

handleStickyScroll();
}
function handleStickyScroll() {
const panels = document.querySelectorAll('.scroll-panel');
const circles = document.querySelectorAll('.journey-circle');
panels.forEach((panel, index) => {
    const rect = panel.getBoundingClientRect();
    const windowHeight = window.innerHeight;
    
    if (rect.top < windowHeight * 0.6 && rect.bottom > windowHeight * 0.4) {
        panel.classList.add('active');
        
        circles.forEach(circle => circle.classList.remove('active'));
        const activeCircle = document.querySelector(`.journey-circle[data-step="${index}"]`);
        if (activeCircle) {
            activeCircle.classList.add('active');
        }
    } else {
        panel.classList.remove('active');
    }
});
}
function handleResize() {
const canvas = document.getElementById('threeCanvas');
const container = canvas.parentElement;
camera.aspect = container.offsetWidth / container.offsetHeight;
camera.updateProjectionMatrix();
renderer.setSize(container.offsetWidth, container.offsetHeight);
}
class Carousel {
constructor() {
this.track = document.getElementById('carouselTrack');
this.prevBtn = document.getElementById('carouselPrev');
this.nextBtn = document.getElementById('carouselNext');
this.cards = this.track.querySelectorAll('.testimonial-card');
this.currentIndex = 0;
this.autoplayInterval = null;
this.touchStartX = 0;
this.touchEndX = 0;
    this.init();
}

init() {
    this.prevBtn.addEventListener('click', () => this.prev());
    this.nextBtn.addEventListener('click', () => this.next());
    
    this.track.addEventListener('touchstart', (e) => {
        this.touchStartX = e.changedTouches[0].screenX;
    });
    
    this.track.addEventListener('touchend', (e) => {
        this.touchEndX = e.changedTouches[0].screenX;
        this.handleSwipe();
    });
    
    this.startAutoplay();
    
    this.track.addEventListener('mouseenter', () => this.stopAutoplay());
    this.track.addEventListener('mouseleave', () => this.startAutoplay());
}

updatePosition() {
    const offset = -this.currentIndex * 100;
    this.track.style.transform = `translateX(${offset}%)`;
}

next() {
    this.currentIndex = (this.currentIndex + 1) % this.cards.length;
    this.updatePosition();
}

prev() {
    this.currentIndex = (this.currentIndex - 1 + this.cards.length) % this.cards.length;
    this.updatePosition();
}

handleSwipe() {
    if (this.touchStartX - this.touchEndX > 50) {
        this.next();
    }
    
    if (this.touchEndX - this.touchStartX > 50) {
        this.prev();
    }
}

startAutoplay() {
    this.autoplayInterval = setInterval(() => this.next(), 5000);
}

stopAutoplay() {
    if (this.autoplayInterval) {
        clearInterval(this.autoplayInterval);
    }
}
}
function initScrollAnimations() {
const observerOptions = {
threshold: 0.1,
rootMargin: '0px 0px -100px 0px'
};
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

const animatedElements = document.querySelectorAll('.highlight-card, .service-card, .timeline-item');
animatedElements.forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});
}
document.addEventListener('DOMContentLoaded', () => {
initThree();
new Carousel();
initScrollAnimations();
window.addEventListener('scroll', handleScroll);
window.addEventListener('resize', handleResize);

const appointmentForm = document.querySelector('.appointment-form');
appointmentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Thank you for booking an appointment! We will contact you soon.');
    appointmentForm.reset();
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

const mobileMenuBtn = document.getElementById('mobileMenuBtn');
mobileMenuBtn.addEventListener('click', () => {
    const nav = document.querySelector('.nav');
    nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
});
});