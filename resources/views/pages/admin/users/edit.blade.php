@extends('layout.admin')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">
            <h4>Form Perbaharui Users</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        @foreach($pgw as $p)
                        <form action="/admin/users/update" method="POST" id='form-submit' enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type='hidden' name='id_users' value='{{$p->ID_User}}'>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Nama Users </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" name="nama_users" value='{{$p->Nama_Users}}'
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Email Users </b><label
                                            style='color:red;'>*</label></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="email" class="form-control" value='{{$p->Email_Users}}'
                                            name="email_users" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Password Users </b><label
                                            style='color:red;'>*</label></label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" value='{{$p->Password_Users}}'
                                            name="password_users" id="password">
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
                            <a href="/admin/users" class="btn btn-secondary"><i class='bi bi-x-circle'></i>&nbsp;
                                Kembali</a>'
                        </form>
                        @endforeach
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