@extends('layout.admin')

@section('content')
<div class="container-fluid">


    <div class="card">
        <div class="card-body">
            <h4>Data Laporan PB1 & Biaya Service</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="/admin/laporan/cetak/laporan_penjualan_detail" target="_blank" class="btn btn-primary" ><i class="fa fa-print color-muted m-r-5"></i>
                            Print</a>
                    <div class="table-responsive mt-4">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pesanan</th>
                                    <th>Nama Produk</th>
                                    <th>QTY</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga Produk</th>
                                    <th>Tarif Biaya Service</th>
                                    <th>Biaya Service</th>
                                    <th>DPP</th>
                                    <th>Tarif PB1</th>
                                    <th>PB1</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;?>
                                @foreach($pgw as $p)
                                <?php 
                                    $tanggal = date("dmy", strtotime($p->Tanggal_Transaksi));
                                    $namaCustomer = strtoupper(str_replace(" ", "", $p->Nama_Customer));
                                    $nomorMeja = str_pad($p->No_Meja, 2, '0', STR_PAD_LEFT);
                                    $output = $tanggal . '-' . $namaCustomer . '-' . $nomorMeja;
                                    $no++ ;
                                ?>
                                <tr>
                                    <td class="text-dark">{{ $no }}</td>
                                    <td class="text-dark">{{ $output }}</td>
                                    <td class="text-dark">{{ $p->Nama_Produk }}</td>
                                    <td class="text-dark">{{ $p->QTY }}</td>
                                    <td class="text-dark">{{ $p->Harga_Satuan_Produk }}</td>
                                    <td class="text-dark">{{ $p->Sub_Total }}</td>
                                    <td class="text-dark">{{ $p->Tarif_Biaya_Service }} %</td>
                                    <td class="text-dark">{{ $p->Biaya_Service }}</td>
                                    <td class="text-dark">{{ $p->DPP }}</td>
                                    <td class="text-dark">{{ $p->BP }} %</td>
                                    <td class="text-dark">{{ $p->Biaya_BP }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" class="text-dark text-center">Jumlah : {{ $p->Total_Pembayaran }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection