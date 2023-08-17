@extends('layout.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Data Laporan Penjualan Detail</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form method="GET" action="/admin/laporan/laporan_penjualan_detail">
                                @csrf
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label class="text-dark"><b>Periode Awal </b><label
                                                style='color:red;'>*</label></label>
                                        <input type="date" class="form-control" name="periodeawal" required>
                                    </div>
                                    <div class="col form-group">
                                        <label class="text-dark"><b>Periode Akhir </b><label
                                                style='color:red;'>*</label></label>
                                        <input type="date" class="form-control" name="periodeakhir" required>
                                    </div>
                                    <div class="col form-group">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 40px;"><i
                                                class="fa fa-search color-muted m-r-5"></i>
                                            Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            @if (isset($start_date))
                                <form action="/admin/laporan/cetak/laporan_penjualan_detail" target="_blank">
                                    <div class="col">
                                        <input type="hidden" name="cetakperiodeawal" value="{{ $start_date }}"
                                            id="">
                                        <input type="hidden" name="cetakperiodeakhir" value="{{ $end_date }}"
                                            id="">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-print color-muted m-r-5"></i>
                                            Print</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                        {{-- <div class="row">
                            <div class="col">
                              
                            </div>
                            <div class="col">
                                <a href="/admin/laporan/cetak/laporan_penjualan_detail" target="_blank" class="btn btn-primary"><i
                                    class="fa fa-print color-muted m-r-5"></i>
                                    Print</a>
                                </div>
                                
                            </div>
                        </form> --}}
                        <div class="table-responsive mt-4">
                            <table id="example" class="table table-striped table-bordered table-hover nowrap"
                                style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Pesanan</th>
                                        <th>Nama Produk</th>
                                        <th>QTY</th>
                                        <th>Harga Satuan Produk</th>
                                        <th>Total Harga Produk</th>
                                        <th>TARIF BIAYA SERVICE</th>
                                        <th>BIAYA SERVICE</th>
                                        <th>DPP</th>
                                        <th>Tarif PB1</th>
                                        <th>PB1</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    $sumTotal = 0; ?>
                                    @foreach ($pgw as $p)
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
                                        // dd($detailIDProdukArray)
                                        // $sumTotal += intval(str_replace(['Rp. ', '.'], '', $p->detail_Total));
                                        $no++;
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
                                            <td class="text-dark">
                                                @foreach ($detail_Total as $val)
                                                    <?php
                                                    $sumTotal += intval(str_replace(['Rp. ', '.'], '', $val));
                                                    
                                                    ?>
                                                    {{ $val }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="">
                                        <th style="background-color: #f5d443;" colspan="11" class="text-dark text-left">
                                            Total : </th>
                                        <th style="background-color: #f5d443;" colspan="" class="text-dark text-left">
                                            Rp. {{ number_format($sumTotal, 0, ',', '.') }}</th>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4>Grafik Laporan Penjualan Detail</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="form-row">
                                <div class="col form-group">
                                    <label class="text-dark"><b>Periode Awal </b><label style='color:red;'>*</label></label>
                                    <input type="date" class="form-control" name="periodegrafikawalpenjualan"
                                        id="periodegrafikawalpenjualan" required>
                                </div>
                                <div class="col form-group">
                                    <label class="text-dark"><b>Periode Akhir </b><label
                                            style='color:red;'>*</label></label>
                                    <input type="date" class="form-control" name="periodegrafikakhirpenjualan"
                                        id="periodegrafikakhirpenjualan" required>
                                </div>
                                <div class="col form-group">
                                    <button type="button" class="btn btn-primary" style="margin-top: 40px;"
                                        onclick="lihatgrafikpenjualan()"><i class="fa fa-eye color-muted m-r-5"></i> Lihat
                                        Grafik</button>
                                </div>
                            </div>

                        </div>
                        <canvas id="myChartpenjualan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        function lihatgrafikpenjualan() {
            var awal = $('#periodegrafikawalpenjualan').val();
            var akhir = $('#periodegrafikakhirpenjualan').val();
            var dateArray = generateDateArray(awal, akhir);
            $.ajax({
                url: '/admin/grafik/penjualan/',
                method: 'get',
                data: {
                    awal,
                    akhir
                },
                dataType: 'json',
                success: function(data) {
                    // var datagrafilk = data;
                    console.log(data);


                    // var labels = Object.keys(data);
                    // var values = Object.values(data);
                    var labels = dateArray; // Use the generated date array as labels
                    var values = dateArray.map(date => data[date] || 0);

                    var ctx = document.getElementById('myChartpenjualan').getContext('2d');

                    if (window.myChart) {
                        window.myChart.destroy();
                    }
                    window.myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Penjualan',
                                data: values,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Adjust as needed
                                borderColor: 'rgba(75, 192, 192, 1)', // Adjust as needed
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Chart.js Grafik Penjualan'
                                }
                            },
                            scales: {
                                x: {
                                    type: 'category', // Use 'category' scale for non-numeric data
                                },
                                y: {
                                    beginAtZero: true
                                }
                            },
                        }
                    });

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }

        function generateDateArray(startDate, endDate) {
            var dateArray = [];
            var currentDate = new Date(startDate);
            endDate = new Date(endDate);

            while (currentDate <= endDate) {
                dateArray.push(currentDate.toISOString().slice(0, 10));
                currentDate.setDate(currentDate.getDate() + 1);
            }

            return dateArray;
        }
    </script>
@endsection
