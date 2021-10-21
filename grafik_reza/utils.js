'use strict';

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

				var barChartData = {
                	labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],

                    datasets: [{
                        label: 'Nilai Edit',
                        backgroundColor: window.chartColors.red,
                        data: [
                            0.4,5.6,2.1,9.0,2.5,4.1,4.3,2.1,5.6,2.5,4.1,4.3
                        ]
                    }, {
                        label: 'Nilai Transaksi',
                        backgroundColor: window.chartColors.blue,
                        data: [
                            3.4,5.6,2.1,5.6,1.4,4.1,4.3,2.1,5.6,2.5,4.1,4.3
                        ]
                    }]

                };

                window.onload = function() {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'Grafik Kinerja 2018'
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: true
                            },
                        }
                    });
                  };
