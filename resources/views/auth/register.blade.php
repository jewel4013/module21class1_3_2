<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shwapno POS - Register</title>
    
    <!-- 🚀 অফিশিয়াল বুটস্ট্র্যাপ ৫.৩.৩ এবং টোস্টার সিএসএস সিডিএন (১০০% ওয়ার্কিং) -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    <style>
        .register-container {
            max-width: 650px;
            margin: 40px auto;
        }
        .form-control:focus, .form-select:focus {
            border-color: #198754 !important;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25) !important;
        }
    </style>
</head>
<body class="bg-dark min-vh-100 d-flex align-items-center justify-content-center py-5">

    <div class="container register-container">
        <!-- 🚫 কোনো HTML <form> ট্যাগ নেই, পিউর DIV কার্ড লেআউট -->
        <div class="card bg-secondary bg-opacity-10 border-secondary border-opacity-25 rounded-4 p-4 p-sm-5 text-white shadow-lg">
            
            <div class="text-center mb-4">
                <span class="fs-1">🛒</span>
                <h3 class="fw-bold text-success mt-2 mb-1">SHWAPNO POS</h3>
                <p class="text-white-50 small">Create store keeper & outlet account</p>
            </div>

            <!-- ২ কলামের রেসপনসিভ ইনপুট গ্রিড -->
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Full Name *</label>
                    <input type="text" id="name" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="John Doe">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Email Address *</label>
                    <input type="email" id="email" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="name@shwapno.com">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Outlet Location *</label>
                    <input type="text" id="outlate" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="Mirpur-10 Outlet">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Phone Number</label>
                    <input type="text" id="phone" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="017XXXXXXXX">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Password *</label>
                    <input type="password" id="password" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="••••••••">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Profile Photo (Avatar)</label>
                    <input type="file" id="avatar" class="form-control bg-dark border-secondary text-white rounded-3 py-2">
                </div>

                <div class="col-12">
                    <label class="form-label text-white-50 small fw-bold">Full Address</label>
                    <textarea id="address" rows="2" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="Outlet or Permanent Address..."></textarea>
                </div>
            </div>

            <!-- সাবমিট বোতাম (onClick ইভেন্ট চালিত) -->
            <div class="mt-4">
                <button type="button" onclick="handleRegister()" class="btn btn-success w-100 rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm">
                    Register Account 🔐
                </button>
            </div>

            <p class="text-center text-white-50 small mt-3 mb-0">
                Already have an account? <a href="/login" class="text-success text-decoration-none fw-semibold">Sign In</a>
            </p>

        </div>
    </div>
    <!-- 🚀 অফিশিয়াল জেকোয়েরি, টোস্টার, বুটস্ট্র্যাপ বান্ডেল এবং অ্যাক্সিওস সিডিএন স্ক্রিপ্টস -->
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js" integrity="sha512-yNbKY1y6hXLM4yLu5SLn2+l+Qaz2tO+7Z+j+0ELFl9p1z9+06fTma6j8T7RwOXf/uSJUT82/hwkIROY/3aNvzUg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.18.1/axios.min.js" integrity="sha512-l1tCs7ua0mpVzhqYBRTbxh05c4bT7cu1Ma5vSpcwT9yP75wEkbGhwIe1kxmowZRVXxwjTMCbogc3A7y4SUfT7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "3000" };

        function handleRegister() {
            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let outlate = document.getElementById('outlate').value.trim();
            let phone = document.getElementById('phone').value.trim();
            let password = document.getElementById('password').value;
            let address = document.getElementById('address').value.trim();
            let avatarInput = document.getElementById('avatar'); 
            let avatarFile = avatarInput.files[0]; // 🎯 ফিক্স: প্রথম ফাইল অবজেক্টটি নিখুঁতভাবে ধরা হলো

            // ফ্রন্টএন্ড কুইক ভ্যালিডেশন
            if (!name || !email || !outlate || !password) {
                toastr.error("Please fill up all required (*) fields!");
                return;
            }
            if (password.length < 6) {
                toastr.error("Password must be at least 6 characters long!");
                return;
            }

            // ইমেজ সহ ডাটা ট্রান্সফারের জন্য FormData তৈরি
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('outlate', outlate);
            formData.append('phone', phone);
            formData.append('password', password);
            formData.append('address', address);
            
            if (avatarFile) {
                formData.append('avatar', avatarFile);
            }

            toastr.info("Processing your registration...");
            
            // Axios পোস্ট রিকোয়েস্ট
            axios.post('/api/register', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function (response) {
                if (response.data.success === true) {
                    toastr.success(response.data.message);
                    setTimeout(function() {
                        window.location.href = '/login';
                    }, 2000);
                }
            })
            .catch(function (error) {
                if (error.response && error.response.data) {
                    toastr.error(error.response.data.message);
                } else {
                    toastr.error("Something went wrong. Please try again.");
                }
            });
        }
    </script>
</body>
</html>
