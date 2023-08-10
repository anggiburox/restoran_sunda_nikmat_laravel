@extends('layout.admin')

@section('content')
    <style>
        @media print {
            #printable-table {
                width: 100%;
            }

            #printable-table th,
            #printable-table td {
                width: auto;
                white-space: nowrap;
            }
        }
    </style>
    <div class="container-fluid">


        <div class="card">
            <div class="card-body">
                <h4>Data Laporan Transaksi</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="/admin/laporan/cetak/laporan_penjualan_transaksi" target="_blank" class="btn btn-primary" ><i class="fa fa-print color-muted m-r-5"></i>
                            Print</a>
                        <div class="table-responsive mt-4">
                            <table id="example" class="table table-striped table-bordered table-hover nowrap"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Customer</th>
                                        <th>No Meja</th>
                                        <th>Nama Produk</th>
                                        <th>QTY</th>
                                        <th>Sub Total</th>
                                        <th>Tarif Biaya Service</th>
                                        <th>Biaya Service</th>
                                        <th>PB 1</th>
                                        <th>Biaya PB 1</th>
                                        <th>Total</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Metode Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0; 
                                        $totalQty = 0;
                                        $sumBiayaService = 0;
                                        $sumSubTotal = 0;
                                        $sumBiayaPB = 0;
                                        $sumTotal = 0;
                                    ?> 
                                    @foreach ($pgw as $p)
                                        <?php 
                                        $no++; 
                                        $totalQty += $p->QTY; 
                                        $sumBiayaService += intval(str_replace(["Rp. ", "."], "", $p->Biaya_Service));
                                        $sumSubTotal += intval(str_replace(["Rp. ", "."], "", $p->Sub_Total));
                                        $sumBiayaPB += intval(str_replace(["Rp. ", "."], "", $p->Biaya_BP));
                                        $sumTotal += intval(str_replace(["Rp. ", "."], "", $p->Total));
                                        ?>
                                        <tr>
                                            <td class="text-dark">{{ $no }}</td>
                                            <td class="text-dark">{{ date('d F Y', strtotime($p->Tanggal_Transaksi)) }}</td>
                                            <td class="text-dark">{{ $p->Nama_Customer }}</td>
                                            <td class="text-dark">{{ $p->No_Meja }}</td>
                                            <td class="text-dark">{{ $p->Nama_Produk }}</td>
                                            <td class="text-dark">{{ $p->QTY }}</td>
                                            <td class="text-dark">{{ $p->Sub_Total }}</td>
                                            <td class="text-dark">{{ $p->Tarif_Biaya_Service }} %</td>
                                            <td class="text-dark">{{ $p->Biaya_Service }} </td>
                                            <td class="text-dark">{{ $p->BP }} %</td>
                                            <td class="text-dark">{{ $p->Biaya_BP }}</td>
                                            <td class="text-dark">{{ $p->Total }}</td>
                                            <td class="text-dark">{{ $p->Jenis_Pembayaran }}</td>
                                            <td class="text-dark">{{ $p->Metode_Pembayaran }}</td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="2" class="text-dark text-center">Transaksi : {{ $count }}</th>
                                        <th colspan="3" class="text-dark text-center">Total</th>
                                        <th class="text-dark">{{ $totalQty }}</th> <!-- Display the sum here -->
                                        <th class="text-dark">Rp. {{ number_format($sumSubTotal, 0, ',', '.') }}</th> <!-- Display the sum here -->
                                        {{-- <th class="text-dark">{{ $sumSubTotal }}</th> <!-- Display the sum here --> --}}
                                        <th colspan="2" class="text-dark text-center">Rp. {{ number_format($sumBiayaService, 0, ',', '.') }}</th> <!-- Display the sum here -->
                                        <th colspan="2" class="text-dark text-center">Rp. {{ number_format($sumBiayaPB, 0, ',', '.') }}</th> <!-- Display the sum here -->
                                        <th class="text-dark text-center">Rp. {{ number_format($sumTotal, 0, ',', '.') }}</th> <!-- Display the sum here -->
                                        <th colspan="2"></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printTable() {
            var printContents = document.getElementById("example").outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = '<div id="printable-table">' + printContents + '</div>';
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
