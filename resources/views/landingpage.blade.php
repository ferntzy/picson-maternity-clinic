<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Picson Maternity Clinic - Caring for Mothers. Caring for Life.
    </title>
    <link rel="stylesheet" href="landingpage.css" />
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">Picson Maternity Clinic</div>
                <nav class="nav">
                    <a href="#home">Home</a>
                    <a href="#services">Services</a>
                    <a href="#highlights">Highlights</a>
                    <a href="#appointment">Appointment</a>
                    <a href="#contact">Contact</a>
                </nav>
                <a href="{{ url('/login') }}">
                    <button class="signin-btn">Sign In</button>
                </a>

                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-3d">
                    <canvas id="threeCanvas"></canvas>
                    <div class="floating-badge badge-1">24/7 Care</div>
                    <div class="floating-badge badge-2">Expert Team</div>
                </div>
                <div class="hero-text">
                    <h1>
                        Caring for Mothers.
                        <span class="gradient-text">Caring for Life.</span>
                    </h1>
                    <p>
                        Experience exceptional maternity care with our dedicated team of
                        professionals. We're here to support you through every step of
                        your journey.
                    </p>
                    <a href='#appointment'>
                        <button class="cta-btn">Book Appointment</button>
                    </a>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-number">5000+</div>
                            <div class="stat-label">Happy Mothers</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15+</div>
                            <div class="stat-label">Years Experience</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">98%</div>
                            <div class="stat-label">Satisfaction</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>
    <section id="highlights" class="highlights">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <div class="highlights-grid">
                <div class="highlight-card">
                    <div class="highlight-icon">👨‍⚕️</div>
                    <h3>Experienced Doctors</h3>
                    <p>
                        Our team of certified obstetricians and gynecologists bring years
                        of expertise.
                    </p>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">🏥</div>
                    <h3>24/7 Care</h3>
                    <p>
                        Round-the-clock medical attention and emergency services always
                        available.
                    </p>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">💻</div>
                    <h3>Modern Equipment</h3>
                    <p>
                        State-of-the-art facilities with the latest medical technology.
                    </p>
                </div>
                <div class="highlight-card">
                    <div class="highlight-icon">🛏️</div>
                    <h3>Safe & Comfortable</h3>
                    <p>Private rooms designed for your comfort and peace of mind.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="sticky-scroll-section">
        <div class="sticky-container">
            <div class="sticky-content">
                <h2 class="section-title">Our Comprehensive Care Journey</h2>
                <div class="journey-visual">
                    <div class="journey-circle active" data-step="0"></div>
                    <div class="journey-circle" data-step="1"></div>
                    <div class="journey-circle" data-step="2"></div>
                    <div class="journey-circle" data-step="3"></div>
                    <div class="journey-line"></div>
                </div>
            </div>
        </div>
        <div class="scroll-panels">
            <div class="scroll-panel" data-step="0">
                <div class="panel-content">
                    <div ata-aos="zoom-in" class="panel-number">01</div>
                    <h3>Initial Consultation</h3>
                    <p>
                        Your journey begins with a comprehensive consultation where we
                        understand your unique needs and medical history.
                    </p>
                    <ul class="panel-features">
                        <li>Complete health assessment</li>
                        <li>Personalized care plan</li>
                        <li>Nutritional guidance</li>
                    </ul>
                </div>
            </div>
            <div class="scroll-panel" data-step="1">
                <div class="panel-content">
                    <div class="panel-number">02</div>
                    <h3>Prenatal Monitoring</h3>
                    <p>
                        Regular check-ups and advanced monitoring ensure the health and
                        development of both mother and baby.
                    </p>
                    <ul class="panel-features">
                        <li>Weekly health tracking</li>
                        <li>Advanced ultrasounds</li>
                        <li>Specialist consultations</li>
                    </ul>
                </div>
            </div>
            <div class="scroll-panel" data-step="2">
                <div class="panel-content">
                    <div class="panel-number">03</div>
                    <h3>Delivery & Care</h3>
                    <p>
                        Our expert team provides compassionate support during delivery in
                        our modern, comfortable facilities.
                    </p>
                    <ul class="panel-features">
                        <li>Private delivery suites</li>
                        <li>24/7 medical support</li>
                        <li>Pain management options</li>
                    </ul>
                </div>
            </div>
            <div class="scroll-panel" data-step="3">
                <div class="panel-content">
                    <div class="panel-number">04</div>
                    <h3>Postnatal Support</h3>
                    <p>
                        Comprehensive care continues after birth with lactation support,
                        recovery monitoring, and pediatric care.
                    </p>
                    <ul class="panel-features">
                        <li>Breastfeeding support</li>
                        <li>Newborn care training</li>
                        <li>Recovery monitoring</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Meet Our Caring Team</h2>
            <p class="section-subtitle">
                Dedicated professionals committed to your wellbeing
            </p>
            <div class="team-grid">
                <div class="team-card-3d">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-image">
                                <img src="https://picsum.photos/400/500?random=10" alt="Dr. Sarah Mitchell" />
                                <div class="card-overlay">
                                    <div class="card-badge">Chief Obstetrician</div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3>Dr. Sarah Mitchell</h3>
                                <p>MD, OBGYN</p>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Dr. Sarah Mitchell</h3>
                            <p class="card-title">Chief Obstetrician</p>
                            <p class="card-bio">
                                15+ years of experience in high-risk pregnancies and maternal
                                care. Harvard Medical School graduate.
                            </p>
                            <div class="card-specialties">
                                <span>High-Risk Pregnancy</span>
                                <span>Prenatal Care</span>
                                <span>Maternal Medicine</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-card-3d">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-image">
                                <img src="https://picsum.photos/400/500?random=11" alt="Nurse Emma Johnson" />
                                <div class="card-overlay">
                                    <div class="card-badge">Senior Midwife</div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3>Emma Johnson</h3>
                                <p>RN, CNM</p>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Emma Johnson</h3>
                            <p class="card-title">Senior Midwife</p>
                            <p class="card-bio">
                                Certified nurse midwife with a passion for natural birth and
                                maternal empowerment. 1000+ deliveries.
                            </p>
                            <div class="card-specialties">
                                <span>Natural Birth</span>
                                <span>Labor Support</span>
                                <span>Lactation</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-card-3d">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-image">
                                <img src="https://picsum.photos/400/500?random=12" alt="Dr. Michael Chen" />
                                <div class="card-overlay">
                                    <div class="card-badge">Pediatrician</div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3>Dr. Michael Chen</h3>
                                <p>MD, Pediatrics</p>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Dr. Michael Chen</h3>
                            <p class="card-title">Pediatrician</p>
                            <p class="card-bio">
                                Specializing in newborn care and early childhood development.
                                Johns Hopkins trained.
                            </p>
                            <div class="card-specialties">
                                <span>Newborn Care</span>
                                <span>Vaccination</span>
                                <span>Development</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-card-3d">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-image">
                                <img src="https://picsum.photos/400/500?random=13" alt="Nurse Lisa Rodriguez" />
                                <div class="card-overlay">
                                    <div class="card-badge">NICU Specialist</div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3>Lisa Rodriguez</h3>
                                <p>RN, NNP</p>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Lisa Rodriguez</h3>
                            <p class="card-title">NICU Specialist</p>
                            <p class="card-bio">
                                Neonatal nurse practitioner dedicated to providing critical
                                care for premature and ill newborns.
                            </p>
                            <div class="card-specialties">
                                <span>NICU Care</span>
                                <span>Premature Babies</span>
                                <span>Critical Care</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-card-3d">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-image">
                                <img src="https://picsum.photos/400/500?random=14" alt="Dr. Amelia Thompson" />
                                <div class="card-overlay">
                                    <div class="card-badge">Ultrasound Specialist</div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3>Dr. Amelia Thompson</h3>
                                <p>MD, Radiology</p>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Dr. Amelia Thompson</h3>
                            <p class="card-title">Ultrasound Specialist</p>
                            <p class="card-bio">
                                Expert in prenatal imaging and fetal medicine with advanced 4D
                                ultrasound expertise.
                            </p>
                            <div class="card-specialties">
                                <span>3D/4D Imaging</span>
                                <span>Diagnostics</span>
                                <span>Fetal Medicine</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-card-3d">
                    <div class="card-inner">
                        <div class="card-front">
                            <div class="card-image">
                                <img src="https://picsum.photos/400/500?random=15" alt="Nurse Rachel Kim" />
                                <div class="card-overlay">
                                    <div class="card-badge">Lactation Consultant</div>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3>Rachel Kim</h3>
                                <p>RN, IBCLC</p>
                            </div>
                        </div>
                        <div class="card-back">
                            <h3>Rachel Kim</h3>
                            <p class="card-title">Lactation Consultant</p>
                            <p class="card-bio">
                                International board certified lactation consultant helping
                                mothers achieve successful breastfeeding.
                            </p>
                            <div class="card-specialties">
                                <span>Breastfeeding</span>
                                <span>Nutrition</span>
                                <span>Support Groups</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="how-we-work">
        <div class="container">
            <h2 class="section-title">How We Work</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-number">1</div>
                    <div class="timeline-content">
                        <h3>Book Appointment</h3>
                        <p>Schedule your visit online or call us directly.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-number">2</div>
                    <div class="timeline-content">
                        <h3>Consultation</h3>
                        <p>Meet with our specialists for personalized care.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-number">3</div>
                    <div class="timeline-content">
                        <h3>Treatment</h3>
                        <p>Receive comprehensive care tailored to your needs.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-number">4</div>
                    <div class="timeline-content">
                        <h3>Follow-up</h3>
                        <p>Continuous support throughout your journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="appointment" class="appointment">
        <div class="container">
            <h2 class="section-title">Book Your Appointment</h2>
            <form class="appointment-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" required />
                    </div>
                    <div class="form-group">
                        <label for="date">Preferred Date</label>
                        <input type="date" id="date" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" rows="4"></textarea>
                </div>
                <button type="submit" class="submit-btn">Submit Appointment</button>
            </form>
        </div>
    </section>
    <section id="services" class="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🤰</div>
                    <h3>Prenatal Care</h3>
                    <p>Comprehensive monitoring and care throughout your pregnancy.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">👶</div>
                    <h3>Delivery Services</h3>
                    <p>Safe and comfortable delivery with expert medical support.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📱</div>
                    <h3>Ultrasound</h3>
                    <p>Advanced imaging technology for detailed prenatal screening.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">💝</div>
                    <h3>Postnatal Care</h3>
                    <p>Complete care for mother and baby after delivery.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">💉</div>
                    <h3>Vaccination</h3>
                    <p>Essential immunizations for mother and child.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🍼</div>
                    <h3>Lactation Support</h3>
                    <p>Expert guidance for successful breastfeeding.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="schedule">
        <div class="container">
            <h2 class="section-title">Clinic Schedule</h2>
            <div class="schedule-table-wrapper">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Opening Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Monday</td>
                            <td>8:00 AM - 8:00 PM</td>
                        </tr>
                        <tr>
                            <td>Tuesday</td>
                            <td>8:00 AM - 8:00 PM</td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td>8:00 AM - 8:00 PM</td>
                        </tr>
                        <tr>
                            <td>Thursday</td>
                            <td>8:00 AM - 8:00 PM</td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td>8:00 AM - 8:00 PM</td>
                        </tr>
                        <tr>
                            <td>Saturday</td>
                            <td>9:00 AM - 5:00 PM</td>
                        </tr>
                        <tr>
                            <td>Sunday</td>
                            <td>Emergency Only</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Patients Say</h2>
            <div class="carousel-container">
                <button class="carousel-btn carousel-prev" id="carouselPrev">
                    ‹
                </button>
                <div class="carousel-wrapper">
                    <div class="carousel-track" id="carouselTrack">
                        <div class="testimonial-card">
                            <img src="https://picsum.photos/100/100?random=1" alt="Patient" />
                            <h4>Sarah Johnson</h4>
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p>
                                "I love Oten eived was exceptional. The staff made me feel
                                comfortable and supported throughout my entire pregnancy
                                journey."
                            </p>
                        </div>
                        <div class="testimonial-card">
                            <img src="https://picsum.photos/100/100?random=2" alt="Patient" />
                            <h4>Emily Davis</h4>
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p>
                                "Professional, caring, and knowledgeable. I couldn't have
                                asked for a better team to guide me through motherhood."
                            </p>
                        </div>
                        <div class="testimonial-card">
                            <img src="https://picsum.photos/100/100?random=3" alt="Patient" />
                            <h4>Maria Garcia</h4>
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p>
                                "The facilities are modern and clean. Every doctor and nurse
                                showed genuine care and compassion."
                            </p>
                        </div>
                        <div class="testimonial-card">
                            <img src="https://picsum.photos/100/100?random=4" alt="Patient" />
                            <h4>Jessica Lee</h4>
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p>
                                "From prenatal to postnatal care, everything was handled with
                                such professionalism. Highly recommend!"
                            </p>
                        </div>
                        <div class="testimonial-card">
                            <img src="https://picsum.photos/100/100?random=5" alt="Patient" />
                            <h4>Amanda Wilson</h4>
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p>
                                "The 24/7 support gave me peace of mind. I always felt safe
                                and well cared for during my stay."
                            </p>
                        </div>
                    </div>
                </div>
                <button class="carousel-btn carousel-next" id="carouselNext">
                    ›
                </button>
            </div>
        </div>
    </section>
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Picson Maternity Clinic</h3>
                    <p>
                        Dedicated to providing exceptional maternity care with compassion
                        and expertise.
                    </p>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <p>📍 123 Healthcare Avenue, Medical District</p>
                    <p>📞 +1 (555) 123-4567</p>
                    <p>✉️ info@picsonmaternity.com</p>
                </div>
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#">Facebook</a>
                        <a href="#">Instagram</a>
                        <a href="#">Twitter</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Picson Maternity Clinic. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="landingpage.js"></script>
</body>

</html>
