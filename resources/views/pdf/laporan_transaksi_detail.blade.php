<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body style="font-size: 8px;">
    <table style="width: 100%; text-align:center; margin-bottom:5px;">
        <tr>
            <td style="font-size: 14px; font-weight:bold;">
                Laporan Detail Penjualan

            </td>
        </tr>
    </table>



            <table style="width:100%" border="1" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Customer</th>
                        <th>No Meja</th>
                        <th>Nama Produk</th>
                        <th>QTY</th>
                        <th>Sub Total</th>
                        <th>Tarif Biaya Service</th>
                        <th>Biaya Service</th>
                        <th>PB 1</th>
                        <th>Tarif PB 1</th>
                        <th>Total</th>
                        <th>Jenis Pembaaran</th>
                        <th>Metode Pembaaran</th>
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
                    @foreach ($data as $p)
                    <?php 
                    $no++; 
                    $totalQty += $p->QTY; 
                    $sumBiayaService += intval(str_replace(["Rp. ", "."], "", $p->Biaya_Service));
                    $sumSubTotal += intval(str_replace(["Rp. ", "."], "", $p->Sub_Total));
                    $sumBiayaPB += intval(str_replace(["Rp. ", "."], "", $p->Biaya_BP));
                    $sumTotal += intval(str_replace(["Rp. ", "."], "", $p->Total));
                    ?>
                        <tr>
                            <td style="text-align: center;">{{ $no }}</td>
                            <td style="text-align: center;">{{ $p->ID_Transaksi }}</td>
                            <td style="padding-left: 2px;">{{ date('d F Y', strtotime($p->Tanggal_Transaksi)) }}</td>
                            <td style="padding-left: 2px;">{{ $p->Nama_Customer }}</td>
                            <td style="text-align: center;">{{ $p->No_Meja }}</td>
                            <td style="padding-left: 2px;">{{ $p->Nama_Produk }}</td>
                            <td style="text-align: center;">{{ $p->QTY }}</td>
                            <td style="padding-left: 2px;">{{ $p->Sub_Total }}</td>
                            <td style="text-align: center;">{{ $p->Tarif_Biaya_Service }} %</td>
                            <td style="padding-left: 2px;">{{ $p->Biaya_Service }} </td>
                            <td style="padding-left: 2px;">{{ $p->BP }} %</td>
                            <td style="padding-left: 2px;">{{ $p->Biaya_BP }}</td>
                            <td style="padding-left: 2px;">{{ $p->Total }}</td>
                            <td style="padding-left: 2px;">{{ $p->Jenis_Pembayaran }}</td>
                            <td style="padding-left: 2px;">{{ $p->Metode_Pembayaran }}</td>

                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" class="text-dark text-center">Transaksi : {{ $count }}</th>
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

</body>

</html>