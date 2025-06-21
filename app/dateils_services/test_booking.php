<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Booking Modal</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .close-modal {
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Test Booking Modal</h1>
    <button onclick="openBookingModal()" class="btn btn-primary">Open Booking Modal</button>

    <!-- Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Book your service now</h2>
                <span class="close-modal" onclick="closeBookingModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="fullName" class="form-control" placeholder="Enter name..." required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email..." required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" id="phone" class="form-control" placeholder="Enter phone number..." required>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" id="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Car Type</label>
                        <select id="deliveryOption" class="form-control">
                            <option value="">Select car type</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Honda">Honda</option>
                            <option value="BMW">BMW</option>
                            <option value="Mercedes">Mercedes</option>
                        </select>
                    </div>
                    <div class="form-group" id="addressBox" style="display: none;">
                        <label>Delivery Address</label>
                        <input type="text" id="deliveryAddress" class="form-control" placeholder="Enter delivery address">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Confirm your reservation</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openBookingModal() {
            console.log('Opening modal...');
            document.getElementById('bookingModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeBookingModal() {
            console.log('Closing modal...');
            document.getElementById('bookingModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // إغلاق المودال عند النقر خارج المحتوى
        window.onclick = function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target == modal) {
                closeBookingModal();
            }
        }

        // التحكم في ظهور حقل العنوان
        document.getElementById('deliveryOption').addEventListener('change', function() {
            const addressBox = document.getElementById('addressBox');
            addressBox.style.display = this.value === 'delivery' ? 'block' : 'none';
        });

        // معالجة إرسال النموذج
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted!');

            const formData = {
                fullName: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                date: document.getElementById('date').value,
                deliveryOption: document.getElementById('deliveryOption').value,
                deliveryAddress: document.getElementById('deliveryAddress').value
            };

            console.log('Form data:', formData);
            alert('تم إرسال البيانات بنجاح!');
            closeBookingModal();
        });
    </script>
</body>

</html>