
let typingTimeout; 

function changePerson(image) {
    var dynamicText = document.getElementById("dynamicText");
    var mainImage = document.getElementById("mainImage");

    var newName = image.getAttribute("data-title");

    mainImage.src = image.src; // دى بتغير الصوره الاصليه بالصوره الى بتضغط عليها

    // عشان يشيل الوقت المحدد بعد كل عمليه reload 
    clearTimeout(typingTimeout);

    dynamicText.innerHTML = '<span class="cursor">|</span>'; // ده عشان التهنيج اللى بيحصل فى ال cursor

    let i = 0;
    function typeEffect() {
        
        if (i < newName.length) {
            let currentText = newName.substring(0, i + 1); // أخذ الأحرف حتى الحالي
            dynamicText.innerHTML = currentText + '<span class="cursor">|</span>'; // إبقاء المؤشر في النهاية
            i++;
            typingTimeout = setTimeout(typeEffect, 150); // عشان يحفظ التايمر
        } else {
            document.querySelector(".cursor").remove(); // عشان المؤشر يتحذف بعد الانتهاء من الكتابه
        }
    }

    // بدء تنفيذ الكتابة مع إيقاف أي تنفيذ سابق
    typingTimeout = setTimeout(typeEffect, 200);
}

////////////////////////////////////////////////////////////////////////////////////
// ده عشان الانيميشن يحصل بعد ال reload

window.onload = function() {
    const paragraph = document.querySelector(".animated-text p");

    if (localStorage.getItem("pVisible") === "true") {
        paragraph.classList.add("visible");
    } else {
        paragraph.classList.remove("visible");
    }
    
    setTimeout(() => {
        paragraph.classList.add("visible");
        localStorage.setItem("pVisible", "true"); 
    }, 600);  
};

////////////////////////////////////////////////////////////////////////////////////////
// ده جزء ال swiper 
var swiper = new Swiper(".icon-slider", {
    spaceBetween: 20,
    grabCursor: true,
    loop: true,
    centeredSlides: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 4,
        },
        1400:{
            slidesPerView: 3,
        }, 
    },
    speed: 600, 
    slidesPerGroup: 1, 
    allowTouchMove: true, 
});
