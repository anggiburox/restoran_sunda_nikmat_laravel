@extends('layout.admin')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">
            <h4>Form Tambah Users</h4>
        </div>
    </div>


    @if(Session::has('errors'))
    <div class="alert alert-danger">
        {{Session::get('errors')}}
    </div>
    @endif

    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        <form action="/admin/users/store" method="POST" id='form-submit' enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Nama Users </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" name="nama_users" required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Email Users </b><label
                                            style='color:red;'>*</label></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="email" class="form-control" name="email_users" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Password Users </b><label
                                            style='color:red;'>*</label></label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" name="password_users" id="password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" onclick="showPassword()">Show Password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Roles </b><label style='color:red;'>*</label></label>
                                    <select name='id_user_role' class='form-control' id="single-select"
                                        onchange="showdata()" required>
                                        <option value="">-- Pilih Roles --</option>
                                        @foreach($usersrole as $pr)
                                        <option value="{{ $pr->ID_User_Roles }}">
                                            {{ $pr->Role}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success text-white"
                                onclick="form_submit()">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function form_submit() {
    // Menjalankan validasi form sebelum menampilkan konfirmasi
    if (document.getElementById('form-submit').checkValidity()) {
        swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin mengisi data ini?",
            icon: "warning",
            buttons: ["Batal", "Ya"],
            dangerMode: true,
        }).then((confirm) => {
            if (confirm) {
                document.getElementById('form-submit').submit();
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