
function startCar() {
    let carImage = document.getElementById("carImage");
    let engineSound = document.getElementById("engineSound");
    let introScreen = document.getElementById("introScreen");
    let landing = document.getElementById("landing");
    let introText = document.getElementById("introText");

    carImage.classList.add("shaking"); // تشغيل الأنيميشن
    engineSound.play(); // تشغيل الصوت
    introText.innerHTML = "Loading the website..."; // تحديث النص عند الضغط

    setTimeout(() => {
        engineSound.pause(); // إيقاف الصوت بعد 6 ثواني
        engineSound.currentTime = 0; // إعادة الصوت للبداية
    }, 6000);

    setTimeout(() => {
        introScreen.style.display = "none"; // إخفاء شاشة البداية
        landing.style.opacity = "1"; // إظهار قسم Landing
        landing.style.display = "block"; // التأكد من عرض القسم

        // 🔥 إعادة تهيئة WOW.js بعد ظهور القسم
        new WOW().init();

        document.body.style.overflow = "auto"; // السماح بالتمرير
    }, 6000); // بعد 6 ثواني
}


let hoverSound = document.getElementById("hoverSound");
let carImage = document.getElementById("carImage");

carImage.addEventListener("mouseenter", () => {
    hoverSound.currentTime = 0; // إعادة تشغيل الصوت من البداية في كل مرة
    hoverSound.play();
});

carImage.addEventListener("mouseleave", () => {
    hoverSound.pause(); // إيقاف الصوت عند إخراج الماوس
    hoverSound.currentTime = 0; // إعادة الصوت للبداية حتى لا يستمر عند إعادة التمرير
});
