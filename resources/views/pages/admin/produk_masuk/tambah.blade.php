@extends('layout.admin')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">
            <h4>Form Tambah Produk Masuk</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        <form action="/admin/produk_masuk/store" method="POST" id='form-submit'
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark select2"><b>Nama Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <select name='id_produk' class='form-control' id="myselect" 
                                        onchange="showdata()" required>
                                        <option value="">-- Pilih Data Nama Produk --</option>
                                        @foreach($produk as $pr)
                                        <option value="{{ $pr->ID_Produk }}" data-stokproduk='{{$pr->Stok_Produk}}'
                                            data-harga='{{$pr->Harga_Satuan_Produk}}'>
                                            {{ $pr->Nama_Produk}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Stok Masuk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="number" min='0' class="form-control" name="" id='stok_produk' required
                                        readonly style='background:#e6e6fa;'>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Harga Satuan Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" name="" id='harga_satuan_produk' required
                                        readonly style='background:#e6e6fa;'>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Jumlah Produk Masuk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="number" min='0' class="form-control" name="jumlah_produk_masuk"
                                        required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Tanggal Produk Masuk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="date" class="form-control" value="<?php date("Y-m-d")?>"
                                        name="tanggal_produk_masuk" required>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
// $(document).ready(function() {
//     $('#myselect').select2();
// });

$('#myselect').select2({});

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

function showdata() {
    var select = document.getElementById("myselect");
    var selectedOption = select.options[select.selectedIndex];
    var stok_ = selectedOption.getAttribute("data-stokproduk");
    var harga_satuan = selectedOption.getAttribute("data-harga");
    if (stok_ && harga_satuan) {
        document.getElementById("stok_produk").value = stok_;
        document.getElementById("harga_satuan_produk").value = harga_satuan;
    } else {
        document.getElementById("stok_produk").value = "";
        document.getElementById("harga_satuan_produk").value = "";
    }
}
</script>

@endsection