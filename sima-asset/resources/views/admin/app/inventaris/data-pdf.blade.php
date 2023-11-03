<!DOCTYPE html>
<html>

<head>
    <title>Laporan Inventaris</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h3>Detail Inventaris {{$inventaris->kode_inventaris}}</h3>

    <table class="table table-striped mt-4">
        <tbody>
            <tr>
                <th scope="row">Aset</th>
                <td>{{$aset->nama}} - {{$aset->kode_barang}}</td>
            </tr>
            <tr>
                <th scope="row">Ruangan</th>
                <td>{{$ruangan->nama}} - {{$ruangan->kode_ruangan}}</td>
            </tr>
            <tr>
                <th scope="row">Kode Inventaris</th>
                <td>{{$inventaris->kode_inventaris}}</td>
            </tr>
            <tr>
                <th scope="row">Tahun</th>
                <td>{{($aset->tahun)? $aset->tahun:'--'}}</td>
            </tr>
            <tr>
                <th scope="row">Harga</th>
                <td>Rp. {{number_format($aset->harga_satuan, 2)}} / {{$aset->satuan}}</td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td>{{$aset->kondisi == 1?'Terpelihara':'Tidak Terpelihara'}}</td>
            </tr>
            <tr>
                <th scope="row">Kondisi</th>
                @if($inventaris->kondisi == 0)
                <td>
                    <h5><span class="badge badge-success">Baik</span></h5>
                </td>
                @elseif($inventaris->kondisi == 1)
                <td>
                    <h5><span class="badge badge-warning">Rusak Ringan</span></h5>
                </td>
                @elseif($inventaris->kondisi == 2)
                <td>
                    <h5><span class="badge badge-danger">Rusak Berat</span></h5>
                </td>
                @endif
            </tr>
        </tbody>
    </table>

</body>

</html>