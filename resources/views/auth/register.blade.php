<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shwapno POS - Register</title>
    
    <!-- 🚀 আপনার নিজস্ব ও ওয়ার্কিং বুটস্ট্র্যাপ এবং টোস্টার সিএসএস সিডিএন লিংকসমূহ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    
    
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
                <!-- নাম -->
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Full Name *</label>
                    <input type="text" id="name" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="John Doe">
                    <div id="error-name" class="invalid-feedback"></div>
                </div>

                <!-- ইমেইল -->
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Email Address *</label>
                    <input type="email" id="email" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="name@shwapno.com">
                    <div id="error-email" class="invalid-feedback"></div>
                </div>

                <!-- আউটলেট ড্রপডাউন (Select Option) -->
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Select Outlet *</label>
                    <select id="outlet" class="form-select bg-dark border-secondary text-white rounded-3 py-2">
                        <option value="">-- Choose Outlet --</option>
                        <option value="Uttara">Uttara</option>
                        <option value="Banani">Banani</option>
                        <option value="Gulshan">Gulshan</option>
                        <option value="Mirpur">Mirpur</option>
                    </select>
                    <div id="error-outlet" class="invalid-feedback"></div>
                </div>

                <!-- প্রোফাইল ছবি (Avatar) -->
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Profile Photo (Avatar)</label>
                    <input type="file" id="avatar" class="form-control bg-dark border-secondary text-white rounded-3 py-2">
                    <div id="error-avatar" class="invalid-feedback"></div>
                </div>

                <!-- পাসওয়ার্ড -->
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Password *</label>
                    <input type="password" id="password" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="••••••••">
                    <div id="error-password" class="invalid-feedback"></div>
                </div>

                <!-- কনফার্মেশন পাসওয়ার্ড -->
                <div class="col-12 col-md-6">
                    <label class="form-label text-white-50 small fw-bold">Confirm Password *</label>
                    <input type="password" id="password_confirmation" class="form-control bg-dark border-secondary text-white rounded-3 py-2" placeholder="••••••••">
                    <div id="error-password_confirmation" class="invalid-feedback"></div>
                </div>
            </div>

            <!-- সাবমিট বোতাম (onClick ইভেন্ট চালিত) -->
            <div class="mt-4">
                <button type="button" onclick="handleRegister()" class="btn btn-success w-100 rounded-3 py-2.5 fw-bold text-uppercase tracking-wide shadow-sm" id="register">
                    Register Account 🔐
                </button>
            </div>

            <p class="text-center text-white-50 small mt-3 mb-0">
                Already have an account? <a href="/login" class="text-success text-decoration-none fw-semibold">Sign In</a>
            </p>

        </div>
    </div>
    <!-- 🚀 আপনার নিজস্ব ও শতভাগ ওয়ার্কিং জেএস, টোস্টার এবং অ্যাক্সিওস সিডিএন লিংকসমূহ -->
    <script src="{{asset('build/assets/js/config.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.18.1/dist/axios.min.js"></script>

    <script>
        async function handleRegister() {
            // ১. আইডি (ID) ধরে ইনপুট ডাটা রিড করা
            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let outlet = document.getElementById('outlet').value;
            let password = document.getElementById('password').value;
            let password_confirmation = document.getElementById('password_confirmation').value;
            let avatar = document.getElementById('avatar').files[0];
            let avatarFile = avatar; // প্রথম ফাইল অবজেক্টটি নেওয়া হলো

            if(name.length == 0){
                toastr.error("Name field is required!");
            }else if(email.length == 0){
                toastr.error("Email fild is required!");         
            }else if(password.length < 6){
                toastr.error("Password must be at least 6 characters long!");
            }else if(password !== password_confirmation){
                toastr.error("Password and Confirm Password do not match!");
            }else{
                let formData = new FormData();
                formData.append('name', name);
                formData.append('email', email);
                formData.append('outlet', outlet);
                formData.append('password', password);
                formData.append('password_confirmation', password_confirmation);
                if(avatarFile) {
                    formData.append('avatar', avatarFile);
                }
                try {
                    let response = await axios.post('/backend/register', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log(response);
                    if(response.status === 201 && response.data.success === true){
                        toastr.success(response.data.message);
                        setTimeout(function() {
                            window.location.href = '/login';
                        }, 1000);
                    }else if(response.response.status === 422){
                        let errors = response.response.data.errors;
                        for (let field in errors) {
                            if(errors.hasOwnProperty(field)){
                                toastr.error(errors[field][0]);
                            }
                        }
                    }else{
                        console.log(response.data);
                        toastr.error("Some error.");
                    }
                } catch (err) {
                    if(err.response){
                        let errors = err.response.data.errors;
                        if(Array.isArray(errors)){  
                            errors.forEach(msg => toastr.error(msg));
                        }else{
                            for (let field in errors) {
                                if(errors.hasOwnProperty(field)){
                                    toastr.error(errors[field][0]);
                                }
                            }
                        }                        
                    }else{
                        toastr.error("Something went wrong. Please try again.");
                    }
                }
            }
            
            
        }  
    </script>
</body>
</html>
