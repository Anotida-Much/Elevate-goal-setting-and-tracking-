<?php
// Check if user is logged in
require_once '../config/auth.php';
require_once '../views/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Elevate: Your ultimate goal setting and tracking web app to help you achieve your aspirations and maximum potential.">
    <meta name="keywords"
        content="goal setting, goal analysis, goal tracking, productivity, personal development, Elevate">
    <meta name="author" content="Anotida Muchinhairi">

    <link rel="shortcut icon" href="../assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" />
    <!-- AOS CSS -->
    <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
    <!-- Quill CSS -->
    <link rel="stylesheet" href="../node_modules/quill/dist/quill.snow.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <title>Elevate - Analysis and Insights</title>
</head>

<body>


    <!-- Main Content -->
    <div class="main-content">
        <div class="m-4">
            <div class="container container border border-1 shadow-sm rounded-4 p-2 mb-3 bg-white">
                <div class="row">
                    <div class="col-sm-12 col-md-4 mx-auto my-3 order-sm-2 order-md-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Goals Status Analysis</h5>
                                <!-- Pie Chart -->
                                <canvas id="pieChart" class="mh-md-200"></canvas>
                                <script>
                                    const fetchDataAndUpdateChart = () => {
                                        fetch("../config/analysis/pie-chart.php", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                            },
                                        })
                                            .then((response) => {
                                                return response.json()
                                            })
                                            .then((data) => {
                                                if (data.status !== 'error') {
                                                    const labels = ['Completed', 'In Progress', 'On Hold', 'Missed'];
                                                    const counts = [data.COMPLETED, data.IN_PROGRESS, data.ON_HOLD, data.MISSED];
                                                    const ctx = document.querySelector('#pieChart').getContext('2d');
                                                    new Chart(ctx, {
                                                        type: 'pie',
                                                        data: {
                                                            labels: labels,
                                                            datasets: [{
                                                                data: counts,
                                                                backgroundColor: [
                                                                    'rgb(0,128,0)',
                                                                    'rgb(0,123,255)',
                                                                    'rgb(255,193,7)',
                                                                    'rgb(255,0,0)'
                                                                ],
                                                                hoverOffset: 4
                                                            }]
                                                        }
                                                    });
                                                } else {
                                                    console.error("Error fetching data");
                                                }
                                            })
                                            .catch((error) => console.error("Error:", error));
                                    };

                                    document.addEventListener("DOMContentLoaded", () => {
                                        fetchDataAndUpdateChart();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-8 mx-auto my-3 order-sm-1 order-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Top 5 Goals</h5>

                                <canvas id="top-goals" style="max-height: auto;"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        fetch("../config/analysis/top-goals.php")
                                            .then(response => response.json())
                                            .then(data => {
                                                const labels = data.map(item => item.goal_name);
                                                const progressPercentages = data.map(item => item.progress_percentage);

                                                new Chart(document.querySelector('#top-goals'), {
                                                    type: 'bar',
                                                    data: {
                                                        labels: labels,
                                                        datasets: [{
                                                            label: 'Progress Percentage',
                                                            data: progressPercentages,
                                                            backgroundColor: [
                                                                'rgba(125,125,255)',
                                                            ],
                                                            borderColor: [
                                                                'rgb(0,123,255)',
                                                            ],
                                                            borderWidth: 1
                                                        }]
                                                    },
                                                    options: {
                                                        indexAxis: 'y',
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true
                                                            }
                                                        }
                                                    }
                                                });
                                            });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 mx-auto my-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Progress Over Time</h5>
                                <canvas id="progress-over-time" style="max-height: auto;"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        fetch("../config/analysis/timeline.php")
                                            .then(response => response.json())
                                            .then(data => {
                                                const dates = data.map(item => item.updated_at);
                                                const progressPercentages = data.map(item => item.progress_percentage);

                                                new Chart(document.querySelector('#progress-over-time'), {
                                                    type: 'line',
                                                    data: {
                                                        labels: dates,
                                                        datasets: [{
                                                            label: 'Progress Over Time',
                                                            data: progressPercentages,
                                                            backgroundColor: [
                                                                'rgba(125,125,255)',
                                                            ],
                                                            borderColor: [
                                                                'rgb(0,123,255)',
                                                            ],
                                                            borderWidth: 1
                                                        }]
                                                    },
                                                    options: {
                                                        scales: {
                                                            y: {
                                                                beginAtZero: true
                                                            }
                                                        }
                                                    }
                                                });
                                            });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 mx-auto my-3 order-xl-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Goal Category Analysis</h5>

                                <canvas id="categories" max-width="auto"></canvas>
                                <script>
                                    const categories = [
                                        'Work and Career',
                                        'Health and Wellness',
                                        'Love and Relationship',
                                        'Money and Finance',
                                        'Family and Friends',
                                        'Spirituality and Faith',
                                        'Recreation and Lifestyle',
                                        'Personal Growth',
                                        'Other'
                                    ];

                                    const colors = [
                                        '#3498db', // blue
                                        '#f1c40f', // yellow
                                        '#2ecc71', // green
                                        '#9b59b6', // purple
                                        '#e67e73', // red
                                        '#1abc9c', // teal
                                        '#8e44ad', // lavender
                                        '#16a085', // mint
                                        '#f39c12' // orange
                                    ];

                                    fetch('../config/analysis/categories.php')
                                        .then(response => response.json())
                                        .then(data => {
                                            const chartData = {
                                                labels: categories,
                                                datasets: [{
                                                    label: 'Goal Categories',
                                                    data: categories.map(category => {
                                                        const found = data.find(item => item.goal_category === category);
                                                        return found ? found.category_count : 0;
                                                    }),
                                                    backgroundColor: categories.map((category, index) => {
                                                        return colors[index % colors.length];
                                                    }),
                                                    borderColor: categories.map((category, index) => {
                                                        return colors[index % colors.length];
                                                    }),
                                                    borderWidth: 1
                                                }]
                                            };

                                            const options = {
                                                type: 'doughnut',
                                                data: chartData,
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'bottom'
                                                        },
                                                        doughnutlabel: {
                                                            labels: [{
                                                                text: (chartData.datasets[0].data.reduce((a, b) => a + b, 0) / chartData.datasets[0].data.length * 100).toFixed(2) + '%',
                                                                font: {
                                                                    size: 24
                                                                }
                                                            }]
                                                        }
                                                    },
                                                    cutout: '55%'
                                                }
                                            };

                                            const ctx = document.getElementById('categories').getContext('2d');
                                            const myChart = new Chart(ctx, options);
                                        });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Vendor Scripts -->
            <script src="/Elevate/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="/Elevate/node_modules/aos/dist/aos.js"></script>
            <script src="/Elevate/node_modules/chart.js/dist/chart.umd.js"></script>
            <script src="/Elevate/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

        </div>
        <!-- Footer -->
        <?php include "footer.php" ?>
    </div>

</body>

</html>