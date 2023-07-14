@extends('layout.auth')

@section('content')
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-12">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <form action="login" method="post" id="login-form">
                            <div class="login-title">
                                <h2 class="text-center text-primary" style="color: #3a1d01 !important;">Login
                            <p>Restoran Sunda Nikmat</h2>
                            </div>
                        @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                            @csrf
                            <div class="input-group custom">
                                <input type="email" class="form-control form-control-lg" placeholder="Email" required
                                    name="email_users">
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********"
                                    required name="password">
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-lg btn-block"
                                            style="color: #f5d443;background-color: #3a1d01;">Sign In</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a class="text-primary" href="#" id="forgot-link">Forgot Password </a>
                            </div>
                        </form>

                        <form action="auth/loginforgot/updatelupapassword" method="post" id="forgot-form"
                            style="display: none;">
                            <div class="login-title">
                                <h2 class="text-center text-primary" style="color: #3a1d01 !important;">Forgot Password
                                <p>Restoran Sunda Nikmat</h2>
                            </div>
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <div class='alert alert-warning alert-dismissible fade show'>
                                Email harus terdaftar terlebih dahulu
                            </div>
                            @csrf
                            <div class="input-group custom">
                                <input type="email" class="form-control form-control-lg" placeholder="Email Lama" required
                                    name="email_users">
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="Password Baru"
                                    required name="password">
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="button" class="btn btn-lg btn-block"
                                            style="color: #f5d443;background-color: #3a1d01;"
                                            onclick="form_submit()">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p>Already have an account? <a class="text-primary" href="#" id="login-link">Sign
                                        in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    // Ambil elemen-elemen yang diperlukan
    const loginForm = document.getElementById('login-form');
    const forgotForm = document.getElementById('forgot-form');
    const loginLink = document.getElementById('login-link');
    const signupLink = document.getElementById('forgot-link');

    // Atur tindakan ketika tombol "Sign in" diklik
    loginLink.addEventListener('click', function(event) {
        event.preventDefault();
        loginForm.style.display = 'block';
        forgotForm.style.display = 'none';
    });

    // Atur tindakan ketika tombol "Sign up" diklik
    signupLink.addEventListener('click', function(event) {
        event.preventDefault();
        loginForm.style.display = 'none';
        forgotForm.style.display = 'block';
    });

    function form_submit() {
        // Menjalankan validasi form sebelum menampilkan konfirmasi
        if (document.getElementById('forgot-form').checkValidity()) {
            swal({
                title: "Konfirmasi",
                text: "Apakah Anda yakin memperbaharui data ini?",
                icon: "warning",
                buttons: ["Batal", "Ya"],
                dangerMode: true,
            }).then((confirm) => {
                if (confirm) {
                    document.getElementById('forgot-form').submit();
                }
            });
        } else {
            // Menampilkan pesan error jika validasi form gagal
            swal({
                icon: 'error',
                title: 'Oops...',
                text: 'Harap lengkapi semua kolom yang diperlukan!',
            });
        }
    }
    </script>

@endsection