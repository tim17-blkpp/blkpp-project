@extends('layouts.main')
@section('content')

<div class="row">
      <div id="myChart"></div>

      <script>
        // mendapatkan token API yang sudah dibuat saat login
        let token = "{{ Session::get('token') }}";

        // fetch data dari API
        fetch('/api/get-statistik', {
        headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        })
        .then(response => response.json())
        .then(data => {
        // Extract the data object
        var stats = data.data;
        console.log(data.message);

        // Create an array of labels and values
        var chartData = [
            { label: 'Total Siswa', value: stats.total_siswa },
            { label: 'Count Laki', value: stats.count_laki },
            { label: 'Count Perempuan', value: stats.count_perempuan },
            { label: 'Average Umur', value: stats.avg_umur }
        ];

        new Morris.Bar({
            element: 'myChart', // ID element dimana grafik ditempatkan
            data: chartData,
            xkey: 'label',
            ykeys: ['value'],
            labels: ['Value']
        });
        })
        .catch(error => console.error('Error:', error));
      </script>

@endsection
