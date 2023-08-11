<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body style="font-size: 8px;">
    <table style="width: 100%; text-align:center; margin-bottom:5px;">
        <tr>
            <td style="font-size: 14px; font-weight:bold;">
                Laporan PB1 & Biaya Service

            </td>
        </tr>
    </table>



    <table style="width:100%" border="1" cellpadding="0" cellspacing="0">
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
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            $sumBiayaService = 0;
                                $sumBiayaPB = 0; ?>
            
            @foreach ($data as $p)
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
                $no++;
                $sumBiayaService += intval(str_replace(["Rp. ", "."], "", $p->detail_Biaya_Service));
                                    $sumBiayaPB += intval(str_replace(["Rp. ", "."], "", $p->detail_Biaya_BP));
                ?>
                <tr>
                    <td style="text-align: center;">{{ $no }}</td>
                    <td style="padding-left: 2px;">{{ $output }}</td>
                    <td style="padding-left: 2px;">
                        @foreach ($namaproduk as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                    <td style="text-align: center;">
                        @foreach ($qtyproduk as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                    <td style="padding-left: 2px;">
                        @foreach ($hargaroduk as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                    <td style="padding-left: 2px;">
                        @foreach ($detailsubtotal as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                    <td style="text-align: center;">
                        @foreach ($detailTarifBiayaService as $val)
                            {{ $val }}% <br>
                        @endforeach
                    </td>
                    <td style="padding-left: 2px;">
                        @foreach ($detail_Biaya_Service as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                    <td style="padding-left: 2px;">
                        @foreach ($detail_DPP as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                    <td style="text-align: center;">
                        @foreach ($detail_BP as $val)
                            {{ $val }}% <br>
                        @endforeach
                    </td>
                    <td style="padding-left: 2px;">
                        @foreach ($detail_Biaya_BP as $val)
                            {{ $val }} <br>
                        @endforeach
                    </td>
                 
                </tr>
            @endforeach
            <tr>
                <th  style="background-color: #f5d443;" colspan="7" style="padding-left: 2px;">Total :</th>
                <th  style="background-color: #f5d443;" colspan="" style="text-align: center;">Rp. {{ number_format($sumBiayaService, 0, ',', '.') }}</th>
                <th  style="background-color: #f5d443;" colspan="" style="text-align: center;"></th>
                <th  style="background-color: #f5d443;" colspan="" style="text-align: center;"></th>
                <th  style="background-color: #f5d443;" colspan="" style="text-align: center;">Rp. {{ number_format($sumBiayaPB, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
