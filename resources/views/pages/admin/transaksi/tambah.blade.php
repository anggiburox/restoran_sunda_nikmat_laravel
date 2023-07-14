@extends('layout.admin')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-body">
            <h4>Form Tambah Transaksi</h4>
        </div>
    </div>
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        <form action="/admin/transaksi/store" method="POST" id='form-submit'
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Tanggal Transaksi </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="date" class="form-control" value="<?= date("Y-m-d")?>"
                                        name="tanggal_transaksi" required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Nama Customer </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" name="nama_customer" required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>No Meja </b><label style='color:red;'>*</label></label>
                                    <input type="number" min='0' class="form-control" name="no_meja" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark select2"><b>Nama Produk </b><label
                                            style='color:red;'>*</label></label>
                                    <select name='id_produk' class='form-control' id="single-select"
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
                                    <label class="text-dark"><b>Total Stok </b><label
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
                                    <label class="text-dark"><b>QTY </b><label style='color:red;'>*</label></label>
                                    <input type="number" min='0' class="form-control" id="qty" name="qty" required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Sub Total </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" id="total_sub_total" name="sub_total"
                                        required readonly style='background:#e6e6fa;'>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>PB 1 </b><label style='color:red;'>*</label></label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" value='10' id='pb1' name="pb1"
                                            required readonly style='background:#e6e6fa;'>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Biaya Service </b><label
                                            style='color:red;'>*</label></label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" value='2' id='biaya_service'
                                            name="biaya_service" required readonly style='background:#e6e6fa;'>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Total Pembayaran</b><label
                                            style='color:red;'>*</label></label>
                                    <input type="text" class="form-control" id="total_harga" name="total_pembayaran"
                                        required readonly style='background:#e6e6fa;'>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Jenis Pembayaran </b><label
                                            style='color:red;'>*</label></label>
                                    <select class="form-control" required name='jenis_pembayaran'
                                        onchange="showHidePaymentOptions()">
                                        <option value="">-- Pilih Jenis Pembayaran --</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cashless">Cashless</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <div id="paymentOptions" style="display:none;">
                                        <br>
                                        <br>
                                        <input type="radio" name="metode_pembayaran" value="BCA"> BCA
                                        <input type="radio" name="metode_pembayaran" value="Mandiri"> Mandiri
                                        <input type="radio" name="metode_pembayaran" value="QRIS"> QRIS
                                        <br>
                                    </div>
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
$(document).ready(function() {
    $('#single-select').on('change', function() {
        var hargaString = $(this).find(':selected').data('harga');
        if (!hargaString) {
            hargaString = "Rp.0";
        }
        var harga = parseInt(hargaString.replace("Rp.", "").replace(".", ""), 10);
        $('#total_harga').val("Rp.0");
        var hargasubtotal = parseInt(hargaString.replace("Rp.", "").replace(".", ""), 10);
        $('#total_sub_total').val("Rp.0");

        $('#qty, #pb1, #biaya_service').on('input', function() {
            var qty = parseFloat($('#qty').val()) || 0;
            // var pb1 = parseFloat($('#pb1').val()) || 0;
            // var biaya_service = parseFloat($('#biaya_service').val()) || 0;

            var subtotal = harga * qty;

            var total = subtotal * 0.12;

            var totalhasil = subtotal + total;
            
            $('#total_harga').val("Rp." + totalhasil.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                "."));
            $('#total_sub_total').val("Rp." + subtotal.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g,
                "."));
        });
    });
});


function showHidePaymentOptions() {
    var select = document.getElementsByName('jenis_pembayaran')[0];
    var div = document.getElementById('paymentOptions');
    if (select.value == 'Cashless') {
        div.style.display = 'block';
    } else {
        div.style.display = 'none';
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

function showdata() {
    var select = document.getElementById("single-select");
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