document.addEventListener('DOMContentLoaded', function() {
    // تأثير الكتابة الآلية
    const dynamicText = document.getElementById('dynamicText');
    const roles = ["Shadows Team",  "Interface Expert", "technology lover","Web Developer"];
    let roleIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 100;
    
    function type() {
        const currentRole = roles[roleIndex];
        
        if (isDeleting) {
            dynamicText.textContent = currentRole.substring(0, charIndex - 1);
            charIndex--;
            typingSpeed = 50;
        } else {
            dynamicText.textContent = currentRole.substring(0, charIndex + 1);
            charIndex++;
            typingSpeed = 100;
        }
        
        if (!isDeleting && charIndex === currentRole.length) {
            typingSpeed = 1500;
            isDeleting = true;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
            typingSpeed = 500;
        }
        
        setTimeout(type, typingSpeed);
    }
    
    // بدء تأثير الكتابة بعد تأخير قصير
    setTimeout(type, 1000);
    
    // تهيئة سلايدر الفريق
    const teamSwiper = new Swiper('.team-slider', {

        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },   1400: {
                slidesPerView: 5,
            }
        }
    });
    
  // تغيير العضو البارز عند النقر على الصور
const teamMembers = document.querySelectorAll('.team-member img');
const mainImage = document.getElementById('mainImage');
const memberName = document.querySelector('.member-name1 #text_name');


teamMembers.forEach(member => {
    member.addEventListener('click', function() {
        // الحصول على العناصر المرتبطة بالعضو المنقور عليه
        const memberCard = this.closest('.team-member');
        const memberTitle = memberCard.querySelector('h3').textContent;
        
        // تغيير الصورة الرئيسية
        mainImage.src = this.src;
        mainImage.alt = this.alt;
        
        // تأثير التغيير
        mainImage.style.opacity = 0;
        setTimeout(() => {
            mainImage.style.opacity = 1;
        }, 300);
        
        // تحديث المعلومات النصية
        memberName.textContent = memberTitle;
        
        
    });
});
    
    // تأثير عد الإحصائيات
    const statNumbers = document.querySelectorAll('.stat-number');
    const statsSection = document.querySelector('.stats-section');
    
    function animateStats() {
        const sectionPosition = statsSection.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.3;
        
        if (sectionPosition < screenPosition) {
            statNumbers.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                
                const counter = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        clearInterval(counter);
                        stat.textContent = target;
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 16);
            });
            
            // إزالة المستمع بعد التنفيذ لتفادي التكرار
            window.removeEventListener('scroll', animateStats);
        }
    }
    
    window.addEventListener('scroll', animateStats);
    
    // تحريك الصفحة عند النقر على مؤشر التمرير
    const scrollIndicator = document.querySelector('.scroll-indicator');
    
    scrollIndicator.addEventListener('click', function() {
        window.scrollBy({
            top: window.innerHeight - 400,
            behavior: 'smooth'
        });
    });
});