@extends('layout.kasir')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">
            <h4>Form Perbaharui Produk</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        @foreach($pgw as $p)
                        <form action="/kasir/produk/update" method="POST" id='form-submit'
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>ID Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" name="id_produk" value='{{$p->ID_Produk}}'
                                        required readonly style='background:#e6e6fa;'>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Nama Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" name="nama_produk"
                                        value='{{$p->Nama_Produk}}' required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Stok Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="number" min='0' class="form-control" name="stok_produk"
                                        value='{{$p->Stok_Produk}}' required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Harga Satuan Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" id="rupiah" name="harga_satuan_produk"
                                        value='{{$p->Harga_Satuan_Produk}}' required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success text-white"
                                onclick="form_submit()">Simpan</button>
                            <a href="/kasir/produk" class="btn btn-secondary"><i class='bi bi-x-circle'></i>&nbsp;
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

var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
</script>

@endsection