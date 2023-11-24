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
                <!-- Opsi dropdown -->
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Jenis Anggaran
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Pelatihan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Kejuruan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
        <div class="dropdown col d-flex">
            <a class="btn btn-secondary dropdown-toggle w-100 dropdown-filter d-flex align-items-center justify-content-between" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Angkatan
            </a>
            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
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
            <tbody>
                <?php for ($i = 0; $i < 10; $i++) { ?>
                    <tr>
                        <td>2021</td>
                        <td>APBD</td>
                        <td>1</td>
                        <td>Desain Grafis</td>
                        <td>MTU</td>
                    </tr>
                <?php } ?>
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

        tahunDropdown.addEventListener('click', function (event) {
            // Mendapatkan nilai tahun yang dipilih
            var selectedYear = event.target.textContent;

            // Memanggil fungsi untuk mengubah chart berdasarkan tahun yang dipilih
            updateChart(selectedYear);
        });

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
            console.log(data.data);

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
                    text: "Anggaran",
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
            type: "bar",
            data: {
                labels: valueAnggaranX,
                datasets: [{
                backgroundColor: "#FBC816",
                data: valueAnggaranY,
                label: "Anggaran"
                }]
            },
            options: {
                title: {
                display: true,
                text: "Total Anggaran per Tahun",
                fontSize: 18
                }
            },
            });

            // Data for two datasets
            const dataset1 = [30, 45, 40, 35];
            const dataset2 = [20, 25, 45, 30];
            const labels = ["100", "200", "300", "400"];

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
                            stacked: true // If you want bars to be stacked horizontally
                        },
                        y: {
                            stacked: true // If you want bars to be stacked vertically
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                }
            });
        })


        .catch(error => console.error('Error:', error));


      </script>

@endsection
