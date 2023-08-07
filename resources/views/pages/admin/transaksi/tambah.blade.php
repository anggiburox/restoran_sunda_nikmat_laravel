@extends('layout.admin')

@section('content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <h4>Form Tambah Transaksi</h4>
            </div>
        </div>
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
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
                                        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>"
                                            name="tanggal_transaksi" required>
                                    </div>
                                    <div class="col form-group">
                                        <label class="text-dark"><b>Nama Customer </b><label
                                                style='color:red;'>*</label></label>
                                        <input type="text" class="form-control" name="nama_customer" id="nama_customer"
                                            required>
                                    </div>
                                    <div class="col form-group">
                                        <label class="text-dark"><b>No Meja </b><label style='color:red;'>*</label></label>
                                        <input type="number" min='0' class="form-control" name="no_meja" required>
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col form-group">
                                        <label class="text-dark select2"><b>Nama Produk </b><label
                                                style='color:red;'>*</label></label>
                                        <select name='id_produk' class='form-control' id="single-select"
                                            onchange="showdata()" required>
                                            <option value="">-- Pilih Data Nama Produk --</option>
                                            @foreach ($produk as $pr)
                                                <option value="{{ $pr->ID_Produk }}"
                                                    data-stokproduk='{{ $pr->Stok_Produk }}'
                                                    data-harga='{{ $pr->Harga_Satuan_Produk }}'>
                                                    {{ $pr->Nama_Produk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label class="text-dark"><b>Total Stok </b><label
                                                style='color:red;'>*</label></label>
                                        <input type="number" min='0' class="form-control" name=""
                                            id='stok_produk' required readonly style='background:#e6e6fa;'>
                                    </div>
                                    <div class="col form-group">
                                        <label class="text-dark"><b>Harga Satuan Produk </b><label
                                                style='color:red;'>*</label></label>
                                        <input type="text" class="form-control" name="" id='harga_satuan_produk'
                                            required readonly style='background:#e6e6fa;'>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <table class="table table-sm" id="dataTransaksi">
                                        <thead class="text-center">
                                            <tr>
                                                <th>
                                                    Nama Produk
                                                </th>
                                                <th>
                                                    QTY
                                                </th>
                                                <th>
                                                    Tarif Biaya Service
                                                </th>
                                                <th>
                                                    DPP
                                                </th>
                                                <th>
                                                    Tarif PB 1
                                                </th>
                                                <th>
                                                    Total
                                                </th>
                                                <th>
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

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
            let rowCounter = 0;
            $('#single-select').on('change', function() {

                const selectedValue = $("#single-select option:selected").text();
                console.log(selectedValue);
                const hrg = $("#single-select option:selected").attr('data-harga');
                const stok = $("#single-select option:selected").attr('data-stokproduk');
                if ($(`#dataTransaksi tbody tr:contains('${selectedValue}')`).length === 0) {
                    rowCounter++;
                    const uniqueId = `${rowCounter}`;
                    const newRow = `
                <tr>
                    <td>
                        ${selectedValue}
                        <input type="hidden" class="form-control form-control-sm" id="hrg${rowCounter}" name="hrg${hrg}" value="${hrg}" required>
                    </td>
                    <td> 
                        <input type="number" min="0" max="${stok}" class="form-control form-control-sm qtyInput" oninput="calculateDpp(${rowCounter})" id="qty${rowCounter}" name="qty${rowCounter}" required>
                        <input type="hidden" class="form-control form-control-sm"  id="totsub${rowCounter}" name="totsub${rowCounter}" value="Rp. 0" required>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="number" min='0' class="form-control form-control-sm tarifInput" oninput="calculateDpp(${rowCounter})" id="tarif_biaya_service${rowCounter}" name="tarif_biaya_service${rowCounter}" value="0" required>
                            <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                        </div>
                        <input type="hidden" class="form-control form-control-sm" id="ser${rowCounter}" name="ser${rowCounter}" value="Rp. 0" required>

                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="dpp${rowCounter}" name="dpp${rowCounter}" required readonly>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="number" min='0' class="form-control pbInput" id='pb${rowCounter}' oninput="calculateDpp(${rowCounter})" name="pb${rowCounter}" value="0" required>
                            <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                        </div>
                        <input type="hidden" class="form-control form-control-sm" id="totbp${rowCounter}" name="totbp${rowCounter}" value="Rp. 0" required>

                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm total_sub_total" id="total_sub_total${rowCounter}" name="total_sub_total${rowCounter}" required readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm deleteBtn">Delete</button>
                    </td>
                </tr>`;

                    $("#dataTransaksi tbody").append(newRow);
                }
            });

            $("#dataTransaksi").on("click", ".deleteBtn", function() {
                $(this).closest("tr").remove();

                totalAllSubTotal = 0;
                $(".total_sub_total").each(function() {
                    totalAllSubTotal += parseFloat($(this).val().replace("Rp.", "").replace(".",
                        ""));
                });

                // Update total in an element with ID "total_harga"
                $("#total_harga").val("Rp. " + totalAllSubTotal.toLocaleString("id-ID"));
            });



        });

        function calculateDpp(rowNumber) {
            console.log(rowNumber);
            let qty = parseFloat($(`#qty${rowNumber}`).val());
            let tarif_biaya_service = parseFloat($(`#tarif_biaya_service${rowNumber}`).val());
            let hrg = parseFloat($(`#hrg${rowNumber}`).val().replace("Rp.", "").replace(".", ""));
            let pb = parseFloat($(`#pb${rowNumber}`).val());
            let totsub = qty * hrg;
            let ser = totsub * (tarif_biaya_service / 100);
            let dpp = totsub + ser;
            let totbp = dpp * (pb / 100);
            let total = dpp + totbp;
            $(`#dpp${rowNumber}`).val("Rp. " + dpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $(`#totsub${rowNumber}`).val("Rp. " + totsub.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $(`#ser${rowNumber}`).val("Rp. " + ser.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $(`#totbp${rowNumber}`).val("Rp. " + totbp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $(`#total_sub_total${rowNumber}`).val("Rp. " + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

            // Lakukan perhitungan lainnya di sini, jika diperlukan
            let totalAllSubTotal = 0;
            $(".total_sub_total").each(function() {
                totalAllSubTotal += parseFloat($(this).val().replace("Rp.", "").replace(".", ""));
            });

            // Update total di suatu elemen tertentu, misalnya elemen dengan ID "totalAll"
            $("#total_harga").val("Rp. " + totalAllSubTotal.toLocaleString("id-ID"));
        }

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
