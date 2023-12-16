@extends('layouts.main')
@section('content')

<div>
    <div class="row mb-2">
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="tahunDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Tahun
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="tahunDropdownMenu">
                <li><a class="dropdown-item" href="#">Semua Tahun</a></li>

            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="anggaranDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Anggaran
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="anggaranDropdownMenu">
                <li><a class="dropdown-item" href="#">Semua Anggaran</a></li>
                <li><a class="dropdown-item" href="#">APBN</a></li>
                <li><a class="dropdown-item" href="#">APBD</a></li>
                <li><a class="dropdown-item" href="#">APBN Covid</a></li>
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="kategoriDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Kategori
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="kategoriDropdownMenu">
                <li><a class="dropdown-item" href="#">Semua Kategori</a></li>
                @foreach($kategori as $data)
                    <li><a class="dropdown-item" href="#">{{ $data->nama}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="pelatihanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Pelatihan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="pelatihanDropdownMenu">
                <li><a class="dropdown-item" href="#">Semua Pelatihan</a></li>
                @foreach($pelatihan as $data)
                    <li><a class="dropdown-item" href="#">{{ $data->judul}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="angkatanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Angkatan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="angkatanDropdownMenu">
                <li><a class="dropdown-item" href="#">Semua Angkatan</a></li>
                @foreach($angkatan as $data)
                    <li><a class="dropdown-item" href="#">Angkatan {{ $data->angkatan }}</a></li>
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
                    <th scope="col">Kategori</th>
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
        var tahunDropdown = document.getElementById("tahunDropdownMenu");
        var anggaranDropdown = document.getElementById("anggaranDropdownMenu");
        var kategoriDropdown = document.getElementById("kategoriDropdownMenu");
        var pelatihanDropdown = document.getElementById("pelatihanDropdownMenu");
        var angkatanDropdown = document.getElementById("angkatanDropdownMenu");

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
        var query_kategori = null;
        var query_pelatihan = null;
        var query_angkatan = null;

        tahunDropdown.addEventListener('click', function (event) {
            // Mendapatkan nilai tahun yang dipilih
            var selectedYear = event.target.textContent;
            query_tahun = selectedYear;

            // Memanggil fungsi untuk mengubah chart berdasarkan tahun yang dipilih
            fetchStatistik(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
            fetchDataPelatihan(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
        });
        anggaranDropdown.addEventListener('click', function (event) {
            var selectedAnggaran = event.target.textContent;
            query_anggaran = selectedAnggaran;

            // console.log(query_anggaran);

            fetchStatistik(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
            fetchDataPelatihan(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
        });
        kategoriDropdown.addEventListener('click', function (event) {
            var selectedKategori = event.target.textContent;
            query_kategori = selectedKategori;

            fetchStatistik(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
            fetchDataPelatihan(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
        });
        pelatihanDropdown.addEventListener('click', function (event) {
            var selectedPelatihan = event.target.textContent;
            query_pelatihan = selectedPelatihan;

            fetchStatistik(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
            fetchDataPelatihan(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
        });
        angkatanDropdown.addEventListener('click', function (event) {
            var selectedAngkatan = event.target.textContent;
            query_angkatan = selectedAngkatan;

            fetchStatistik(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
            fetchDataPelatihan(query_tahun, query_anggaran, query_kategori, query_pelatihan, query_angkatan);
        });

        function fetchStatistik(tahun = null, anggaran = null, kategori = null, pelatihan = null, angkatan = null) {
            // mendapatkan token API yang sudah dibuat saat login
            let token = "{{ Session::get('token') }}";

            // tambah query filtering ke url
            var apiUrl = '/api/data-statistik?';
            if (tahun != null && tahun != "Semua Tahun") {
                apiUrl += 'tahun=' + tahun + '&';
            }
            if (anggaran != null && anggaran != "Semua Anggaran") {
                apiUrl += 'anggaran=' + anggaran + '&';
            }
            if (kategori != null && kategori != "Semua Kategori") {
                apiUrl += 'kategori=' + kategori + '&';
            }
            if (pelatihan != null && pelatihan != "Semua Pelatihan") {
                apiUrl += 'pelatihan=' + pelatihan + '&';
            }
            if (angkatan != null && angkatan != "Semua Angkatan") {
                apiUrl += 'angkatan=' + angkatan + '&';
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
                var stats = data.data;
                // console.log(stats.chart.kompetensi);
                updateChart(stats);
            })
            .catch(error => console.error('Error:', error));
        }

        let myPieChart, myBarChart;

        function updateChart(stats) {
            var totalsiswa = document.getElementById("totalSiswa");
            totalsiswa.innerHTML = "Total Siswa " + stats.non_chart.total_siswa;
            var countlaki = document.getElementById("countLaki");
            countlaki.innerHTML = "Total Laki " + stats.non_chart.count_laki  ;
            var countperempuan = document.getElementById("countPerempuan");
            countperempuan.innerHTML = "Total Perempuan " + stats.non_chart.count_perempuan;
            var averageumur = document.getElementById("avgUmur");
            averageumur.innerHTML = "Rata-rata Umur " + stats.non_chart.avg_umur;

            const barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
            ];

            //pie chart bar update
            if (myPieChart) {
                myPieChart.destroy();
            }

            // Create new pie chart
            const ctxPie = document.getElementById("kompetensi").getContext("2d");
            myPieChart = new Chart(ctxPie, {
                type: "pie",
                data: {
                    labels: Object.keys(stats.chart.kompetensi),
                    datasets: [{
                        backgroundColor: barColors,
                        data: Object.values(stats.chart.kompetensi)
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
                        position: 'bottom'
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = ((value * 100) / sum).toFixed(0) + "%";
                                return percentage;
                            },
                            color: '#fff', // Text color
                            anchor: 'end',
                            align: 'start',
                            offset: -10
                        }
                    },
                    // tooltips: {
                    //     callbacks: {
                    //         label: function (tooltipItem, data) {
                    //             var dataset = data.datasets[tooltipItem.datasetIndex];
                    //             var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                    //                 return previousValue + currentValue;
                    //             });
                    //             var currentValue = dataset.data[tooltipItem.index];
                    //             var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                    //             return percentage + "%";
                    //         }
                    //     }
                    // }
                }
            });

            new Chart("pendidikan", {
            type: "doughnut",
            data: {
                labels: Object.keys(stats.chart.pendidikan),
                datasets: [{
                backgroundColor: barColors,
                data: Object.values(stats.chart.pendidikan)
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



            new Chart("barAnggaran", {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                datasets: [
                {
                    label: Object.keys(stats.chart.anggaran)[0],
                    borderColor: "rgb(75, 192, 192)",
                    data: [10, 25, 30, 45, 50, 60],
                    fill: false,
                },
                {
                    label: Object.keys(stats.chart.anggaran)[1],
                    borderColor: "rgb(255, 0, 0)",
                    data: [20, 35, 40, 55, 60, 70], // Ganti data ini sesuai kebutuhan Anda
                    fill: false,
                },
                {
                    label: Object.keys(stats.chart.anggaran)[2],
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
                    text: "Jenis Anggaran",
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

        function fetchDataPelatihan(tahun = null, anggaran = null, kategori = null, pelatihan = null, angkatan = null) {
            let token = "{{ Session::get('token') }}";

            // tambah query filtering ke url
            var apiUrl = '/api/data-pelatihan?';
            if (tahun != null && tahun != "Semua Tahun") {
                apiUrl += 'tahun=' + tahun + '&';
            }
            if (anggaran != null && anggaran != "Semua Anggaran") {
                apiUrl += 'anggaran=' + anggaran + '&';
            }
            if (kategori != null && kategori != "Semua Kategori") {
                apiUrl += 'kategori=' + kategori + '&';
            }
            if (pelatihan != null && pelatihan != "Semua Pelatihan") {
                apiUrl += 'pelatihan=' + pelatihan + '&';
            }
            if (angkatan != null && angkatan != "Semua Angkatan") {
                apiUrl += 'angkatan=' + angkatan + '&';
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
                cell4.innerHTML = data[i].kategori;
                var cell5 = row.insertCell(4);
                cell5.innerHTML = data[i].pelatihan;
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            fetchStatistik();
            fetchDataPelatihan();
        });

        document.addEventListener('DOMContentLoaded', function () {
            var kategoriDropdown = new bootstrap.Dropdown(document.getElementById('kategoriDropdown'));
            var kategoriItems = document.querySelectorAll('#kategoriDropdownMenu a.dropdown-item');

            kategoriItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    var selectedText = this.textContent.trim();
                    document.getElementById('kategoriDropdown').textContent = selectedText;
                });
            });

            var tahunDropdown = new bootstrap.Dropdown(document.getElementById('tahunDropdown'));
            var tahunItems = document.querySelectorAll('#tahunDropdownMenu a.dropdown-item');

            tahunItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    var selectedText = this.textContent.trim();
                    document.getElementById('tahunDropdown').textContent = selectedText;
                });
            });

            var pelatihanDropdown = new bootstrap.Dropdown(document.getElementById('pelatihanDropdown'));
            var pelatihanItems = document.querySelectorAll('#pelatihanDropdownMenu a.dropdown-item');

            pelatihanItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    var selectedText = this.textContent.trim();
                    document.getElementById('pelatihanDropdown').textContent = selectedText;
                });
            });

            var anggaranDropdown = new bootstrap.Dropdown(document.getElementById('anggaranDropdown'));
            var anggaranItems = document.querySelectorAll('#anggaranDropdownMenu a.dropdown-item');

            anggaranItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    var selectedText = this.textContent.trim();
                    document.getElementById('anggaranDropdown').textContent = selectedText;
                });
            });

            var angkatanDropdown = new bootstrap.Dropdown(document.getElementById('angkatanDropdown'));
            var angkatanItems = document.querySelectorAll('#angkatanDropdownMenu a.dropdown-item');

            angkatanItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    var selectedText = this.textContent.trim();
                    document.getElementById('angkatanDropdown').textContent = selectedText;
                });
            });
        });

      </script>

@endsection
