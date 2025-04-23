    // العناصر المطلوبة
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    // وظيفة فتح/إغلاق السايدبار
    function toggleSidebar() {
        sidebar.classList.toggle('close');

        if (!sidebar.classList.contains('close')) {
            // إذا كان السايدبار مفتوحاً
            document.body.classList.add('sidebar-active');
            overlay.style.display = 'block';
        } else {
            // إذا كان السايدبار مغلقاً
            document.body.classList.remove('sidebar-active');
            overlay.style.display = 'none';
        }
    }   

    // النقر على زر التبديل
    sidebarToggle.addEventListener('click', toggleSidebar);

    // النقر خارج السايدبار لإغلاقه
    overlay.addEventListener('click', toggleSidebar);

    // إغلاق السايدبار عند تغيير حجم الشاشة (اختياري)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && !sidebar.classList.contains('close')) {
            toggleSidebar();
        }
    });