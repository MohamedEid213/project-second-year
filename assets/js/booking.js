// عرض/إخفاء حقل العنوان بناءً على اختيار طريقة الاستلام
document.getElementById('deliveryOption').addEventListener('change', function() {
    var addressBox = document.getElementById('addressBox');
    if (this.value === 'delivery') {
      addressBox.style.display = 'block';
    } else {
      addressBox.style.display = 'none';
    }
  });
  
  document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var isValid = true;
    
    // التحقق من صحة الاسم الكامل
    var fullName = document.getElementById('fullName');
    if (!/^[\p{L}\s]+$/u.test(fullName.value.trim())) {
      isValid = false;
      fullName.classList.add('is-invalid');
    } else {
      fullName.classList.remove('is-invalid');
    }
    
    // التحقق من صحة البريد الإلكتروني
    var email = document.getElementById('email');
    if (!email.value.trim()) {
      isValid = false;
      email.classList.add('is-invalid');
    } else {
      email.classList.remove('is-invalid');
    }
    
    // التحقق من صحة رقم الهاتف
    var phone = document.getElementById('phone');
    if (!/^\d{11,}$/.test(phone.value.trim())) {
      isValid = false;
      phone.classList.add('is-invalid');
    } else {
      phone.classList.remove('is-invalid');
    }
    
    // التحقق من صحة التاريخ
    var date = document.getElementById('date');
    if (!date.value.trim()) {
      isValid = false;
      date.classList.add('is-invalid');
    } else {
      date.classList.remove('is-invalid');
    }
    
    // التحقق من صحة عنوان التوصيل إذا كان خيار التوصيل مختار
    var deliveryOption = document.getElementById('deliveryOption');
    if (deliveryOption.value === 'delivery') {
      var deliveryAddress = document.getElementById('deliveryAddress');
      if (!deliveryAddress.value.trim()) {
        isValid = false;
        deliveryAddress.classList.add('is-invalid');
      } else {
        deliveryAddress.classList.remove('is-invalid');
      }
    }
    
    if (isValid) {
      // إخفاء نموذج الحجز وعرض شريط التحميل مع رسالة إعادة التوجيه
      document.getElementById('bookingFormContainer').style.display = 'none';
      document.getElementById('loading').style.display = 'block';
      // تأخير لمدة ثانيتين قبل الانتقال إلى صفحة الدفع
      setTimeout(function() {
        window.location.href = 'payment.html';
      }, 2000);
    }
  });
  