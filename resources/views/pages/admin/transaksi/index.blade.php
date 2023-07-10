@extends('layout.admin')

@section('content')
<div class="container-fluid">


    <div class="card">
        <div class="card-body">
            <h4>Data Transaksi</h4>
        </div>
    </div>

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('danger'))
    <div class="alert alert-danger">
        {{Session::get('danger')}}
    </div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form custom_file_input">
                        <a href="/admin/transaksi/tambah" class="btn btn-success text-white ml-4"> <i
                                class="fa-solid fa-plus"></i> &nbsp; Tambah Produk</a>
                    </div>
                    <div class="table-responsive mt-4">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Customer</th>
                                    <th>No Meja</th>
                                    <th>Nama Produk</th>
                                    <th>Sub Total</th>
                                    <th>PB1</th>
                                    <th>Biaya Service</th>
                                    <th>Total Pembayaran</th>
                                    <th>Jenis Pembaaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;?>
                                @foreach($pgw as $p)
                                <?php $no++ ;?>
                                <tr>
                                    <td class="text-dark">{{ $no }}</td>
                                    <td class="text-dark">{{ date("d F Y", strtotime($p->Tanggal_Transaksi)) }}</td>
                                    <td class="text-dark">{{ $p->Nama_Customer }}</td>
                                    <td class="text-dark">{{ $p->No_Meja }}</td>
                                    <td class="text-dark">{{ $p->Nama_Produk }}</td>
                                    <td class="text-dark">{{ $p->Sub_Total }}</td>
                                    <td class="text-dark">{{ $p->PB1 }} %</td>
                                    <td class="text-dark">{{ $p->Biaya_Service }} %</td>
                                    <td class="text-dark">{{ $p->Total_Pembayaran }}</td>
                                    <td class="text-dark">{{ $p->Jenis_Pembayaran }}</td>
                                    <td>
                                        <a href="transaksi/hapus/{{ $p->ID_Transaksi }}"
                                            class="delete btn mb-1 btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                            data-toggle="tooltip" data-placement="top" title="Hapus" type="button"><i
                                                class="fa fa-trash color-muted m-r-5"></i></a>
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
</script>

@endsection