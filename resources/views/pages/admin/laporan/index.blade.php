@extends('layout.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4>Data Laporan</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <!-- <a href="/admin/laporan/laporan_data_transaksi" class="btn btn-success text-white ml-4"> Laporan
                        Data Transaksi
                    </a> -->
                    <a href="/admin/laporan/laporan_penjualan_detail" class="btn btn-success text-white ml-4"> Laporan
                        Penjualan Detail </a>
                    <a href="/admin/laporan/laporan_pb1_dan_biaya_service" class="btn btn-success text-white ml-4"> Laporan
                        Pajak Restoran & Biaya Service</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection