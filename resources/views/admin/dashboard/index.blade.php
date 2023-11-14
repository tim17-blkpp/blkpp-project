@extends('layouts.main')
@section('content')

<div>
    <div class="row mb-2">
        <div id="totalSiswa" style="background-color: white; margin: 10px; height: 110px; border-radius: 10px; font-size: 25px" class="col d-flex justify-content-center align-items-center"></div>
        <div id="countLaki" style="background-color: white; margin: 10px; height: 110px; border-radius: 10px; font-size: 25px" class="col d-flex justify-content-center align-items-center"></div>
        <div id="countPerempuan" style="background-color: white; margin: 10px; height: 110px; border-radius: 10px; font-size: 25px" class="col d-flex justify-content-center align-items-center"></div>
        <div id="avgUmur" style="background-color: white; margin: 10px; height: 110px; border-radius: 10px; font-size: 25px" class="col d-flex justify-content-center align-items-center"></div>
    </div>
    
    <div class="row mb-2">
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;" >
            <canvas id="barKelamin" style="max-width: 100%;"></canvas>
        </div>
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;">
            <canvas id="kompetensi" style=" max-width: 100%;"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;">
            <canvas id="barAnggaran" style="max-width: 100%;"></canvas>
        </div>
        <div class="col" style="background-color: white; text-align: center; margin: 10px; border-radius: 10px;">
            <canvas id="pendidikan" style=" max-width: 100%;"></canvas>
        </div>
    </div>

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
            
            const totalLaki = 19;
            const totalPerempuan = 11;
            const rataUmur = 35;
            var totalsiswa = document.getElementById("totalSiswa");
            totalsiswa.innerHTML = "Total Siswa " + (stats.total_siswa + 29);
            var countlaki = document.getElementById("countLaki");
            countlaki.innerHTML = "Total Laki " + totalLaki;
            var countperempuan = document.getElementById("countPerempuan");
            countperempuan.innerHTML = "Total Perempuan " + totalPerempuan;
            var averageumur = document.getElementById("avgUmur");
            averageumur.innerHTML = "Rata-rata Umur " + rataUmur;

            const xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
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
                data: valueAnggaranY
                }]
            },
            options: {
                title: {
                display: true,
                text: "Total Anggaran per Tahun",
                fontSize: 18
                }
            }
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
                            label: "Dataset 1",
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                            data: dataset1
                        },
                        {
                            label: "Dataset 2",
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
                        },
                    },
                }
            });
        })

        
        .catch(error => console.error('Error:', error));

        
      </script>

@endsection
