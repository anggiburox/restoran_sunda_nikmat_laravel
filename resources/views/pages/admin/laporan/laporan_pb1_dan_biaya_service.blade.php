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
                    <a href="/admin/laporan/cetak/laporan_pb1_dan_biaya_service" target="_blank" class="btn btn-primary" ><i class="fa fa-print color-muted m-r-5"></i>
                            Print</a>
                    <div class="table-responsive mt-4">
                        <table id="example" class="table table-striped table-bordered table-hover nowrap" style="min-width: 845px">
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
                                <?php $no = 0;
                                $sumBiayaService = 0;
                                $sumBiayaPB = 0;?>
                                @foreach($pgw as $p)
                                <?php 
                                  $tanggal = date('dmy', strtotime($p->Tanggal_Transaksi));
                                        $namaCustomer = strtoupper(str_replace(' ', '', $p->Nama_Customer));
                                        $nomorMeja = str_pad($p->No_Meja, 2, '0', STR_PAD_LEFT);
                                        $output = $tanggal . '-' . $namaCustomer . '-' . $nomorMeja;
                                        $namaproduk = explode(',', $p->produk_names);
                                        $qtyproduk = explode(',', $p->detail_QTY);
                                        $hargaroduk = explode(',', $p->produk_harga);
                                        $detailsubtotal = explode(',', $p->detail_Sub_Total);
                                        $detailTarifBiayaService = explode(',', $p->detail_Tarif_Biaya_Service);
                                        $detail_Biaya_Service = explode(',', $p->detail_Biaya_Service);
                                        $detail_DPP = explode(',', $p->detail_DPP);
                                        $detail_BP = explode(',', $p->detail_BP);
                                        $detail_Biaya_BP = explode(',', $p->detail_Biaya_BP);
                                        $detail_Total = explode(',', $p->detail_Total);
                                    $no++ ;
                                    $sumBiayaService += intval(str_replace(["Rp. ", "."], "", $p->detail_Biaya_Service));
                                    $sumBiayaPB += intval(str_replace(["Rp. ", "."], "", $p->detail_Biaya_BP));


                                ?>
                                <tr>
                                    <td class="text-dark">{{ $no }}</td>
                                    <td class="text-dark">{{ $output }}</td>
                                            <td class="text-dark">
                                                @foreach ($namaproduk as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark text-center">
                                                @foreach ($qtyproduk as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark">
                                                @foreach ($hargaroduk as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark">
                                                @foreach ($detailsubtotal as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark text-center">
                                                @foreach ($detailTarifBiayaService as $val)
                                                    {{ $val }}% <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark">
                                                @foreach ($detail_Biaya_Service as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark">
                                                @foreach ($detail_DPP as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark text-center">
                                                @foreach ($detail_BP as $val)
                                                    {{ $val }}% <br>
                                                @endforeach
                                            </td>
                                            <td class="text-dark">
                                                @foreach ($detail_Biaya_BP as $val)
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th  style="background-color: #f5d443;" colspan="7" class="text-dark text-left">Total :</th>
                                    <th  style="background-color: #f5d443;" colspan="" class="text-dark text-center">Rp. {{ number_format($sumBiayaService, 0, ',', '.') }}</th>
                                    <th  style="background-color: #f5d443;" colspan="" class="text-dark text-center"></th>
                                    <th  style="background-color: #f5d443;" colspan="" class="text-dark text-center"></th>
                                    <th  style="background-color: #f5d443;" colspan="" class="text-dark text-center">Rp. {{ number_format($sumBiayaPB, 0, ',', '.') }}</th>
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