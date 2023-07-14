@extends('layout.admin')

@section('content')
<div class="container-fluid">


    <div class="card">
        <div class="card-body">
            <h4>Data Produk Masuk</h4>
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
                        <a href="/admin/produk_masuk/tambah" class="btn btn-success text-white ml-4"> <i
                                class="fa-solid fa-plus"></i> &nbsp; Tambah Produk Masuk</a>
                    </div>
                    <div class="table-responsive mt-4">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Produk Masuk</th>
                                    <th>Tanggal Produk Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;?>
                                @foreach($pgw as $p)
                                <?php $no++ ;?>
                                <tr>
                                    <td class="text-dark">{{ $no }}</td>
                                    <td class="text-dark">{{ $p->ID_Produk }}</td>
                                    <td class="text-dark">{{ $p->Nama_Produk }}</td>
                                    <td class="text-dark">{{ $p->Jumlah_Produk_Masuk }}</td>
                                    <td class="text-dark">{{ date("d F Y", strtotime($p->Tanggal_Produk_Masuk)) }}</td>
                                    <td>
                                        <a href="produk_masuk/hapus/{{ $p->ID_Produk_Masuk }}"
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