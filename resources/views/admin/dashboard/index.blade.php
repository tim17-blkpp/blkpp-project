@extends('layouts.main')
@section('content')

<div>
    <div class="row mb-2">
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Tahun
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="tahunDropdown">

            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                @foreach($kategori as $data)
                    <li><a class="dropdown-item" href="#">{{ $data -> nama }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Pelatihan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                @foreach($pelatihan as $data)
                    <li><a class="dropdown-item" href="#">{{ $data -> judul }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Sesi Pelatihan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                @foreach($sesipelatihan as $data)
                    <li><a class="dropdown-item" href="#">{{ $data -> judul }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Angkatan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                @foreach($sesipelatihan as $data)
                    <li><a class="dropdown-item" href="#">{{ $data -> angkatan }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row mb-2">
        <div id="totalSiswa" class="col d-flex justify-content-center align-items-center recap-user"></div>
        <div id="countLaki" class="col d-flex justify-content-center align-items-center recap-user"></div>
        <div id="countPerempuan" class="col d-flex justify-content-center align-items-center recap-user"></div>
        <div id="avgUmur" class="col d-flex justify-content-center align-items-center recap-user"></div>
    </div>

    <div class="row mb-2">
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;" >
            <canvas id="barKelamin" style="max-width: 100%;"></canvas>
        </div>
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;">
            <canvas id="kompetensi" style=" max-width: 100%;"></canvas>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;">
            <canvas id="barAnggaran" style="max-width: 100%;"></canvas>
        </div>
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;">
            <canvas id="pendidikan" style=" max-width: 100%;"></canvas>
        </div>
    </div>

    <div>
        <table class="table table-light table-radius">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Tahun</th>
                    <th scope="col">Dukungan Anggaran</th>
                    <th scope="col">Angkatan</th>
                    <th scope="col">Kejuruan</th>
                    <th scope="col">Pelatihan</th>
                </tr>
            </thead>
            <tbody id='pelatihanTable'>
                <!-- Nanti data pelatihan masuk sini -->
            </tbody>
        </table>
    </div>
      <script>
        // Mendapatkan elemen dropdown tahun
        var tahunDropdown = document.getElementById("tahunDropdown");

        // Mendapatkan tahun ini
        var tahunSekarang = new Date().getFullYear();

        // Menambahkan opsi tahun ini dan 3 tahun kebelakang
        for (var i = 0; i < 4; i++) {
            var option = document.createElement("li");
            option.innerHTML = '<a class="dropdown-item" href="#">' + (tahunSekarang - i) + '</a>';
            tahunDropdown.appendChild(option);
        }

        // Variabel buat nampung query API
        var query_tahun = null;
        var query_anggaran = null;
        var query_pelatihan = null;
        var query_kejuruan = null;
        var query_angkatan = null;

        tahunDropdown.addEventListener('click', function (event) {
            // Mendapatkan nilai tahun yang dipilih
            var selectedYear = event.target.textContent;
            query_tahun = selectedYear;

            // Memanggil fungsi untuk mengubah chart berdasarkan tahun yang dipilih
            fetchStatistik();
            fetchDataPelatihan(query_tahun, query_anggaran, query_pelatihan, query_kejuruan, query_angkatan);
        });

        function fetchStatistik() {
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
                // console.log(data.data);
                updateChart(stats);
            })
            .catch(error => console.error('Error:', error));
        }

        function updateChart(stats) {
            const totalLaki = 19;
            const totalPerempuan = 11;
            const rataUmur = 35;
            var totalsiswa = document.getElementById("totalSiswa");
            totalsiswa.innerHTML = "Total Siswa " + stats.total_siswa;
            var countlaki = document.getElementById("countLaki");
            countlaki.innerHTML = "Total Laki " + stats.count_laki  ;
            var countperempuan = document.getElementById("countPerempuan");
            countperempuan.innerHTML = "Total Perempuan " + stats.count_perempuan;
            var averageumur = document.getElementById("avgUmur");
            averageumur.innerHTML = "Rata-rata Umur " + stats.avg_umur;

            const xValues = ["Desain Grafis", "Audio Video", "Electro", "Mechanical", "Cooking Cookies"];
            const yValues = [55, 49, 44, 24, 15];
            const barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
            ];

            new Chart("kompetensi", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Kompetensi",
                    fontSize: 18
                },
                legend: {
                    display: true,
                    position: 'bottom' // Set the legend position to 'bottom'
                }
            }
            });

            new Chart("pendidikan", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Pendidikan",
                    fontSize: 18
                },
                legend: {
                    display: true,
                    position: 'bottom' // Set the legend position to 'bottom'
                }
            }
            });

            const valueAnggaranX = ["2019", "2010", "2011", "2012"];
            const valueAnggaranY = [450, 1100, 1500, 1600];

            new Chart("barAnggaran", {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                datasets: [
                {
                    label: "APBN",
                    borderColor: "rgb(75, 192, 192)",
                    data: [10, 25, 30, 45, 50, 60],
                    fill: false,
                },
                {
                    label: "DPD",
                    borderColor: "rgb(255, 0, 0)",
                    data: [20, 35, 40, 55, 60, 70], // Ganti data ini sesuai kebutuhan Anda
                    fill: false,
                },
                {
                    label: "APBN",
                    borderColor: "rgb(255, 65, 0)",
                    data: [15, 30, 20, 35, 10, 50], // Ganti data ini sesuai kebutuhan Anda
                    fill: false,
                },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                x: {
                    type: 'category',
                    labels: {
                    rotate: 45,
                    }
                },
                y: {
                    beginAtZero: true
                }
                },
                title: {
                    display: true,
                    text: "Jenis Aggaran",
                    fontSize: 18
                },
            },
            });

            // Data for two datasets
            const dataset1 = [130, 145, 140, 135];
            const dataset2 = [120, 115, 145, 130];
            const labels = ["20", "35", "40", "45"];

            // Create the bar chart
            const ctx = document.getElementById("barKelamin").getContext("2d");
            const myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Laki-Laki",
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                            data: dataset1
                        },
                        {
                            label: "Perempuan",
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 1,
                            data: dataset2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true,               
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    title: {
                        display: true,
                        text: "Jenis Kelamin",
                        fontSize: 18
                    },
                    legend: {
                        display: true,
                        position: 'top' // Set the legend position to 'bottom'
                    }
                }
            });
        }

        function fetchDataPelatihan(tahun = null, anggaran = null, pelatihan = null, kejuruan = null, angkatan = null) {
            let token = "{{ Session::get('token') }}";

            // to do coming soon
            var apiUrl = '/api/data-pelatihan?';
            if (tahun != null) {
                apiUrl += 'tahun=' + tahun + '&';
            }

            // fetch data dari API
            fetch(apiUrl, {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            })
            .then(response => response.json())
            .then(data => {
                // Extract the data object
                var result = data.data;
                updatePelatihanTable(result);
            })
            .catch(error => console.error('Error:', error));
        }

        function updatePelatihanTable(data) {
            var table = document.getElementById("pelatihanTable");
            table.innerHTML = "";
            // console.log("menampilkan data pelatihan ke tabel");
            // console.log(data);
            for (var i = 0; i < data.length; i++) {
                var row = table.insertRow(i);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = data[i].tahun;
                var cell2 = row.insertCell(1);
                cell2.innerHTML = data[i].anggaran;
                var cell3 = row.insertCell(2);
                cell3.innerHTML = data[i].angkatan;
                var cell4 = row.insertCell(3);
                cell4.innerHTML = data[i].kejuruan;
                var cell5 = row.insertCell(4);
                cell5.innerHTML = data[i].pelatihan;
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            fetchStatistik();
            fetchDataPelatihan();
        });

      </script>

@endsection
