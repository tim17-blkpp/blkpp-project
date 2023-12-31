@extends('layouts.main')
@section('content')
<style>
    .long-text {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    /* style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;" */
    .recap-chart {
        background-color: white;
        text-align: center;
        margin: 10px;
        border-radius: 10px;
    }
</style>
<div>
    <div class="row mb-2">
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="tahunDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Tahun
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="tahunDropdownMenu">
                <li><a class="dropdown-item long-text" href="#">Semua Tahun</a></li>

            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="anggaranDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Anggaran
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="anggaranDropdownMenu">
                <li><a class="dropdown-item long-text" href="#">Semua Anggaran</a></li>
                <li><a class="dropdown-item long-text" href="#">APBN</a></li>
                <li><a class="dropdown-item long-text" href="#">APBD</a></li>
                <li><a class="dropdown-item long-text" href="#">APBN Covid</a></li>
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="kategoriDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Semua Kategori
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink" id="kategoriDropdownMenu">
                <li><a class="dropdown-item long-text" href="#">Semua Kategori</a></li>
                @foreach($kategori as $data)
                    <li><a class="dropdown-item long-text" href="#">{{ $data->nama}}</a></li>
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
                    <li><a class="dropdown-item long-text" href="#">{{ $data->judul}}</a></li>
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
                    <li><a class="dropdown-item long-text" href="#">Angkatan {{ $data }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row mb-2">
        <div id="totalSiswa" class="text-center col d-flex justify-content-center align-items-center recap-user"></div>
        <div id="countLaki" class="text-center col d-flex justify-content-center align-items-center recap-user"></div>
        <div id="countPerempuan" class="text-center col d-flex justify-content-center align-items-center recap-user"></div>
        <div id="avgUmur" class="text-center col d-flex justify-content-center align-items-center recap-user"></div>
    </div>

    <div class="row mb-2">
        <div class="col recap-chart">
            <canvas id="barKelamin" style="max-width: 100%;"></canvas>
        </div>
        <div class="col recap-chart">
            <canvas id="kompetensi" style=" max-width: 100%;"></canvas>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col recap-chart">
            <canvas id="barAnggaran" style="max-width: 100%;"></canvas>
        </div>
        <div class="col recap-chart">
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
                apiUrl += 'angkatan=' + angkatan.replace("Angkatan ", "") + '&';
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

        let myPieChart, myBarChart, myDoughnutChart, myLineChart;

        function updateChart(stats) {
            var totalsiswa = document.getElementById("totalSiswa");
            totalsiswa.innerHTML = "Total Siswa <br>" + stats.non_chart.total_siswa;
            var countlaki = document.getElementById("countLaki");
            countlaki.innerHTML = "Total Laki <br>" + stats.non_chart.count_laki  ;
            var countperempuan = document.getElementById("countPerempuan");
            countperempuan.innerHTML = "Total Perempuan <br>" + stats.non_chart.count_perempuan;
            var averageumur = document.getElementById("avgUmur");
            averageumur.innerHTML = "Rata-rata Umur <br>" + stats.non_chart.avg_umur;


            //pie chart bar update
            if (myPieChart) {
                myPieChart.destroy();
            }

            // require('chartjs-plugin-datalabels');
            // Chart.register(ChartDataLabels);

            // Create new pie chart
            const ctxPie = document.getElementById("kompetensi").getContext("2d");

            myPieChart = new Chart(ctxPie, {
                type: "pie",
                data: {
                    labels: Object.keys(stats.chart.kompetensi),
                    datasets: [{
                        backgroundColor: ["#FA93B2", "#FBBB16", "#220FFF"],
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
                                let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);

                                // Check if the value is not zero before displaying the percentage
                                if (value !== 0) {
                                    let percentage = ((value * 100) / sum).toFixed(2) + "%";
                                    return percentage;
                                } else {
                                    return ''; // Return an empty string to hide the label
                                }
                            },
                            color: '#fff', // Text color
                            offset: -10
                        },
                    },
                },
                plugins: [ChartDataLabels],
            });


            //pie chart bar update
            if (myDoughnutChart) {
                myDoughnutChart.destroy();
            }
            const ctxDoughnut = document.getElementById("pendidikan").getContext("2d");

            myDoughnutChart = new Chart("pendidikan", {
                type: "doughnut",
                data: {
                    labels: Object.keys(stats.chart.pendidikan),
                    datasets: [{
                    backgroundColor: ["#FA93B2", "#FBBB16", "#220FFF","#7BCBCA", "#D580FF", "#A3F414"],
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
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);

                                // Check if the value is not zero before displaying the percentage
                                if (value !== 0) {
                                    let percentage = ((value * 100) / sum).toFixed(2) + "%";
                                    return percentage;
                                } else {
                                    return ''; // Return an empty string to hide the label
                                }
                            },
                            color: '#fff', // Text color
                            offset: -10
                        },
                    },
                },
                plugins: [ChartDataLabels],
            });


            //pie chart bar update
            if (myLineChart) {
                myLineChart.destroy();
            }
            const ctxLine = document.getElementById("barAnggaran").getContext("2d");

            const anggaranData = stats.chart.anggaran;
            // Extract available years from the data
            const years = Object.keys(anggaranData);

            // Generate datasets dynamically for each year
            const lineChartData = {
            labels: years,
            datasets: ["APBN", "APBD", "APBN Covid"].map((type, index) => ({
                label: type,
                borderColor: getLineColor(index), // Use predefined colors based on index
                data: years.map((year) => anggaranData[year][type]),
                fill: false,
                })),
            };

            function getLineColor(index) {
                const predefinedColors = ["#FF0000", "#FFB800", "#0094FF"]; // Add more colors as needed
                return predefinedColors[index % predefinedColors.length];
            }

            myLineChart = new Chart("barAnggaran", {
                type: "line",
                data: lineChartData,
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

            if (myBarChart) {
                myBarChart.destroy();
            }

            const umurData = Object.values(stats.chart.umur);
            const ageGroups = Object.keys(umurData[0]).filter(key => key.includes('_lk')); // Assuming '_lk' is present in all Laki-Laki keys

            // Filter out undefined values and get only numeric values
            const datasetLK = ageGroups
            .map(key => umurData.map(entry => entry[key]).filter(value => typeof value === 'number'))
            .flat();

            // Adjust the suffix to '_pr' for Perempuan keys
            const datasetPR = ageGroups
            .map(key => umurData.map(entry => entry[key.replace('_lk', '_pr')]).filter(value => typeof value === 'number'))
            .flat();

            // Create the bar chart
            const ctxBar = document.getElementById("barKelamin").getContext("2d");
            // Assuming stats.chart.umur is an object with properties, including 'total'
            console.log('LK Data:');
            umurData.forEach(entry => {
                console.log('Entry:', entry);
            });

            myBarChart = new Chart("barKelamin", {
                type: "bar",
                data: {
                    labels: ["17-20", "21-30", "31-40", "41-50", "51-60", "61-70"],
                    datasets: [
                        {
                            label: "Laki-Laki",
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                            data: datasetLK
                        },
                        {
                            label: "Perempuan",
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 1,
                            data: datasetPR
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
                apiUrl += 'angkatan=' + angkatan.replace("Angkatan ", "") + '&';
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

        document.addEventListener('DOMContentLoaded', function () {
    function setDropdownText(dropdown, selectedText) {
        var maxLength = 15; // Adjust the maximum length as needed
        var trimmedText = selectedText.length > maxLength ? selectedText.substring(0, maxLength) + '...' : selectedText;
        dropdown.textContent = trimmedText;
    }

    function initializeDropdown(dropdownId, menuId) {
        var dropdown = new bootstrap.Dropdown(document.getElementById(dropdownId));
        var items = document.querySelectorAll('#' + menuId + ' a.dropdown-item');

        items.forEach(function (item) {
            item.addEventListener('click', function () {
                var selectedText = this.textContent.trim();
                setDropdownText(document.getElementById(dropdownId), selectedText);
            });
        });
    }

    initializeDropdown('kategoriDropdown', 'kategoriDropdownMenu');
    initializeDropdown('tahunDropdown', 'tahunDropdownMenu');
    initializeDropdown('pelatihanDropdown', 'pelatihanDropdownMenu');
    initializeDropdown('anggaranDropdown', 'anggaranDropdownMenu');
    initializeDropdown('angkatanDropdown', 'angkatanDropdownMenu');
});

      </script>

@endsection
