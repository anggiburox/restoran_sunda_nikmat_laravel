@extends('layout.admin')

@section('content')
    <div class="container-fluid">


        <div class="card">
            <div class="card-body">
                <h4>Data Transaksi</h4>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('danger'))
            <div class="alert alert-danger">
                {{ Session::get('danger') }}
            </div>
        @endif


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form custom_file_input">
                            <a href="/admin/transaksi/tambah" class="btn btn-success text-white ml-4"> <i
                                    class="fa-solid fa-plus"></i> &nbsp; Tambah Transaksi</a>
                        </div>
                        <div class="table-responsive mt-4">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Customer</th>
                                        <th>No Meja</th>
                                        <th>Total Pembayaran</th>
                                        <th>Jenis Pembaaran</th>
                                        <th>Metode Pembaaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    @foreach ($pgw as $p)
                                        <?php $no++; ?>
                                        <tr>
                                            <td class="text-dark">{{ $no }}</td>
                                            <td class="text-dark">{{ date('d F Y', strtotime($p->Tanggal_Transaksi)) }}</td>
                                            <td class="text-dark">{{ $p->Nama_Customer }}</td>
                                            <td class="text-dark">{{ $p->No_Meja }}</td>
                                            <td class="text-dark">{{ $p->Total_Pembayaran }}</td>
                                            <td class="text-dark">{{ $p->Jenis_Pembayaran }}</td>
                                            <td class="text-dark">{{ $p->Metode_Pembayaran }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button class="detail btn mb-1 btn-info" onclick="detailTransaksi()"
                                                            data-toggle="tooltip" data-placement="top" title="Detail"
                                                            type="button"><i
                                                                class="fa fa-list color-muted m-r-5"></i></button>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="transaksi/hapus/{{ $p->ID_Transaksi }}"
                                                            class="delete btn mb-1 btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                            data-toggle="tooltip" data-placement="top" title="Hapus"
                                                            type="button"><i class="fa fa-trash color-muted m-r-5"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailtransaksi" tabindex="`-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title" id="detailtransaksi">Detail Transaksi</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive mt-4">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>QTY</th>
                                <th>Biaya Service</th>

                                <th>DPP</th>
                                <th>Jenis Pembaaran</th>
                                <th>Metode Pembaaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function largeimage(a) {

            $('#imagepreview').attr('src', $('#imageresource' + a).attr(
                'src')); // here asign the image to the modal when the user click the enlarge link
            $('#imagemodal').modal('show');
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
        function detailTransaksi(){
            $('#detailtransaksi').modal('show');

        }
    </script>
@endsection
