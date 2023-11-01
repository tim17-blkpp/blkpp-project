<!DOCTYPE html>
<html lang="en">

<head>
    <title>CV {{ $all_data->name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body onload="window.print();">

    <div class="container mt-4 mb-3">
        <div class="row">
            <div class="col-12 text-center">
                <strong>
                    <h3>CURRICULUM VITAE</h3>
                </strong>
                <strong><u>{{ $all_data->name }}</u></strong>
                <br><br>
                <img src="{{ asset($all_data->profil->avatar) }}" alt="" height="200">
                <br><br>
            </div>

            <div class="col-12 p-2 bg-warning text-center border"><strong>DATA DIRI</strong></div>
            <table class="table border">
                <tbody>
                    <tr>
                        <td><strong>Nama Lengkap</strong></td>
                        <td><strong>:</strong> {{ $all_data->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat Email</strong></td>
                        <td><strong>:</strong> {{ $all_data->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nomor HP.</strong></td>
                        <td><strong>:</strong> {{ $all_data->profil->nomor_hp }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tempat, Tanggal Lahir</strong></td>
                        <td><strong>:</strong> {{ $all_data->profil->tempat_lahir .', '. $all_data->profil->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td><strong>NIK / No. KTP</strong></td>
                        <td><strong>:</strong> {{ $all_data->profil->nik }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat Domisili</strong></td>
                        <td><strong>:</strong> {{ $all_data->profil->alamat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pendidikan</strong></td>
                        <td><strong>:</strong> {{ $all_data->profil->pendidikan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun</strong></td>
                        <td><strong>:</strong> {{ $all_data->profil->tahun_pendidikan }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="col-12 p-2 bg-warning text-center border"><strong>DOKUMEN IDENTITAS</strong></div>
            <div class="col-12 text-center border p-2">
                <br><br>
                <img src="{{ asset($all_data->profil->ktp) }}" alt="" height="240">
                <br><br>
                <img src="{{ asset($all_data->profil->ijazah) }}" alt="" height="800">
            </div>
        </div>
    </div>

</body>

</html>