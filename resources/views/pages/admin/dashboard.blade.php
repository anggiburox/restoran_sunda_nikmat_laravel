@extends('layout.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Users</div>
                            <div class="stat-digit">{{ $users }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Produk</div>
                            <div class="stat-digit">{{ $produk }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Produk Masuk</div>
                            <div class="stat-digit">{{ $produk_masuk }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Transaksi</div>
                            <div class="stat-digit">{{ $transaksi }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /# column -->
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
                            <label class="text-dark"><b>Periode Akhir </b><label style='color:red;'>*</label></label>
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


        <div class="card">
            <div class="card-body">
                <h4>Grafik Laporan Pajak dan PB 1</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="form-row">
                        <div class="col form-group">
                            <label class="text-dark"><b>Periode Awal </b><label style='color:red;'>*</label></label>
                            <input type="date" class="form-control" name="periodegrafikawal" id="periodegrafikawal"
                                required>
                        </div>
                        <div class="col form-group">
                            <label class="text-dark"><b>Periode Akhir </b><label style='color:red;'>*</label></label>
                            <input type="date" class="form-control" name="periodegrafikakhir" id="periodegrafikakhir"
                                required>
                        </div>
                        <div class="col form-group">
                            <button type="button" class="btn btn-primary" style="margin-top: 40px;"
                                onclick="lihatgrafik()"><i class="fa fa-eye color-muted m-r-5"></i> Lihat
                                Grafik</button>
                        </div>
                    </div>

                </div>
                <canvas id="myChartpajakpb1"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        function lihatgrafik() {
            var awal = $('#periodegrafikawal').val();
            var akhir = $('#periodegrafikakhir').val();
            var dateArray = generateDateArray(awal, akhir);
            $.ajax({
                url: '/admin/grafik/pajak/',
                method: 'get',
                data: {
                    awal,
                    akhir
                },
                dataType: 'json',
                success: function(data) {
                    // var datagrafilk = data;

                    // var labels = Object.keys(data).map(date => moment(date).format('MMM DD'));
                    // var totalServiceData = Object.values(data).map(entry => entry.totalService);
                    // var totalPBData = Object.values(data).map(entry => entry.totalPB);

                    var labels = dateArray; // Use the generated date array as labels
                    var totalServiceData = dateArray.map(date => data[date]?.totalService || 0);
                    var totalPBData = dateArray.map(date => data[date]?.totalPB || 0);

                    var ctx = document.getElementById('myChartpajakpb1').getContext('2d');


                    if (window.myChart) {
                        window.myChart.destroy();
                    }
                    window.myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Biaya Service',
                                data: totalServiceData,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Adjust as needed
                                borderColor: 'rgba(75, 192, 192, 1)', // Adjust as needed
                                borderWidth: 1
                            }, {
                                label: 'Total PB 1',
                                data: totalPBData,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust as needed
                                borderColor: 'rgba(255, 99, 132, 1)', // Adjust as needed
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
                                    text: 'Chart.js Grafik Pajak dan PB 1'
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

                    if (window.myChart1) {
                        window.myChart1.destroy();
                    }
                    window.myChart1 = new Chart(ctx, {
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
