@extends('admin.layout.layout')
@Section('title', 'Dashboard')
@Section('content')
    <div class="container-fluid">

        <h3 class="title-page cssTitle">
            Bảng điều khiển
        </h3>
        <div class="row dash_row my-3 pb-3">
            <div class="col-md-3 ">
                <div class="dash_product">
                    <div class="dash_product_header">
                        <span>Sản phẩm</span>
                    </div>
                    <div class="dash_product_main">
                        <div class="dash_product_content">
                            <span>Danh mục</span>
                            <p>{{ $countCategory }}</p>
                            <a href="{{ route('category') }}">Chi tiết</a>
                        </div>
                        <div class="dash_product_content">
                            <span>Sản phẩm</span>
                            <p>{{ $countProduct }}</p>
                            <a href="{{ route('product') }}">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="dash_article">
                    <div class="dash_article_header">
                        <span>Bài viết</span>
                    </div>
                    <div class="dash_article_main">
                        <div class="dash_article_content">
                            <span>Danh mục</span>
                            <p>{{ $countCategoryArticle }}</p>
                            <a href="{{ route('categoryArticle') }}">Chi tiết</a>
                        </div>
                        <div class="dash_article_content">
                            <span>Bài viết</span>
                            <p>{{ $countArticle }}</p>
                            <a href="{{ route('article') }}">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="dash_user">
                    <div class="dash_user_header">
                        <span>Khách hàng</span>
                    </div>
                    <div class="dash_user_main">
                        <div class="dash_user_content">
                            <span>Nhóm khách hàng</span>
                            <p>{{ $countUserGroup }}</p>
                            <a href="{{ route('userGroup') }}">Chi tiết</a>
                        </div>
                        <div class="dash_user_content">
                            <span>Khách hàng</span>
                            <p>{{ $countUser }}</p>
                            <a href="{{ route('userAdmin') }}">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="dash_admin">
                    <div class="dash_admin_header">
                        <span>Người dùng</span>
                    </div>
                    <div class="dash_admin_main">
                        <div class="dash_admin_content">
                            <span>Nhóm người dùng</span>
                            <p>{{ $countAdministrationGroup }}</p>
                            <a href="{{ route('adminstrationGroup') }}">Chi tiết</a>
                        </div>
                        <div class="dash_admin_content">
                            <span>Người dùng</span>
                            <p>{{ $countAdministration }}</p>
                            <a href="{{ route('adminstration') }}">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <h4>Tổng doanh thu</h4>

                <div class="row mb-3 cardTwoDashboard">
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background: rgb(255, 226, 230)">
                            <h6 class="text-black">
                                Tổng đơn hàng
                            </h6>
                            <h3>{{ $countOrderDash }} đơn hàng</h3>
                            <div class="iconCardDash">
                                <span><i class="fa-solid fa-cart-plus" style="color: #ffffff;"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background: rgb(220, 252, 231)">
                            <h6 class="text-black">
                                Tổng doanh thu
                            </h6>
                            <h3>{{ number_format($salesTotal, 0, ',', '.') . 'đ' }}</h3>
                            <div class="iconCardDash">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="cardTwoDashboardItem" style="background: rgb(255, 244, 222)">
                            <h6 class="text-black">
                                Doanh thu hôm nay
                            </h6>
                            <h3> {{ number_format($salesTotalByDay, 0, ',', '.') . 'đ' }}</h3>
                            <div class="iconCardDash">
                                <span>$</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>


        <div class="row bg_row_dash">
            <div class="col-md-12">
                <div id="revenueChart"></div>
            </div>
        </div>


        <div class="row bg_row_dash mt-4">
            <div class="col-md-6">
                <canvas id="ordersByStatusChart"></canvas>

            </div>
            <div class="col-md-6">
                <canvas id="ordersByPaymentChart"></canvas>
            </div>
        </div>


        <div class="row mt-5 bg_row_dash">
            <div class="col-md-6 " style="text-align: center;">
                <span class="mb-3" style="font-weight:600; font-size:12px;">Thống kê sản phẩm bán chạy</span>
                <div id="countProductSoldoutChart"></div>
            </div>
            <div class="col-md-6">
                <div class="dashFavorite10_main">
                    <ul>
                        @foreach ($countProductSoldoutOrder as $item)
                            <li>
                                <a href="{{ route('detail', $item->product->slug) }}">
                                    <div class="dashFavorite10">
                                        <div class="dashFavorite10_img">
                                            <img src="{{ asset('img/' . $item->product->image) }}" alt="">
                                        </div>
                                        <div class="dashFavorite10_content">
                                            <span>{{ $item->product->name }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <div class="row mt-5 bg_row_dash ">
            <div class="col-md-6">
                <canvas id="cartChart" width="400" height="290"></canvas>
            </div>
            <div class="col-md-6 ">
                <div class="dashFavorite10_main">
                    <ul>
                        @foreach ($cartStatistical as $item)
                            <li>
                                <a href="{{ route('detail', $item->product->slug) }}">
                                    <div class="dashFavorite10">
                                        <div class="dashFavorite10_img">
                                            <img src="{{ asset('img/' . $item->product->image) }}" alt="">
                                        </div>
                                        <div class="dashFavorite10_content">
                                            <span>{{ $item->product->name }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


        <div class="row mt-5 bg_row_dash">

            <div class="col-md-6 ">
                <div id="favouriteChart"></div>

                {{-- <canvas id="favouriteChart" width="400" height="290"></canvas> --}}
            </div>
            <div class="col-md-6">
                <div class="dashFavorite10_main">
                    <ul>
                        @foreach ($favouriteStatistical as $item)
                            <li>
                                <a href="{{ route('detail', $item->product->slug) }}">
                                    <div class="dashFavorite10">
                                        <div class="dashFavorite10_img">
                                            <img src="{{ asset('img/' . $item->product->image) }}" alt="">
                                        </div>
                                        <div class="dashFavorite10_content">
                                            <span>{{ $item->product->name }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5 bg_row_dash">
            <div class="col-md-6">
                <canvas id="countUserChart" width="350" height="220"></canvas>
            </div>
            <div class="col-md-6">
                <div class="dashFavorite10_main">
                    <ul>
                        @foreach ($countUserPotential as $item)
                            <li>
                                <a href="">
                                    <div class="dashFavorite10">
                                        <div class="dashFavorite10_img">
                                            <img src="{{ asset('img/' . $item->user->image) }}" alt="">
                                        </div>
                                        <div class="dashFavorite10_content">
                                            <span>{{ $item->user->fullname }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('dashboardAdminScript')
    <script>
        function formatCurrency(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + 'đ';
        }

        // Khởi tạo biểu đồ Doanh thu
        const initRevenueChart = () => {
            // Dữ liệu doanh thu từ server (giả sử đã được chuyển đổi sang JSON)
            const revenueData = {!! json_encode($revenue) !!}; // Dữ liệu doanh thu từ server

            // Hàm định dạng giá trị doanh thu
            function formatCurrency(value) {
                return value.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
            }

            // Cấu hình biểu đồ ApexCharts
            var options = {
                series: [{
                    name: 'Doanh thu',
                    type: 'line',
                    data: revenueData // Sử dụng dữ liệu từ Chart.js
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false,
                },
                stroke: {
                    width: [5],
                    curve: 'smooth'
                },
                xaxis: {
                    categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                        'September', 'October', 'November', 'December'
                    ]
                },
                yaxis: {
                    title: {
                        text: 'Doanh thu',
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return formatCurrency(value); // Định dạng giá trị doanh thu
                        }
                    }
                }
            };

            // Khởi tạo và hiển thị biểu đồ
            var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        };

        // Khởi tạo các biểu đồ Yêu thích
        const initFavouriteCharts = () => {

            const productLabels = {!! json_encode($favouriteStatistical->pluck('product_name')) !!};
            const favouriteCounts = {!! json_encode($favouriteStatistical->pluck('favourite_count')) !!};

            // Cấu hình biểu đồ ApexCharts
            var options = {
                series: [{
                    name: 'Tổng yêu thích',
                    data: favouriteCounts // Sử dụng dữ liệu từ Chart.js
                }],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    curve: 'stepline',
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: productLabels, // Sử dụng nhãn từ Chart.js
                },
                yaxis: {
                    title: {
                        text: 'Số lượng yêu thích',
                    },
                    labels: {
                        formatter: function(value) {
                            return Math.round(value); // Làm tròn số
                        }
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(value) {
                            return value + " yêu thích";
                        }
                    }
                }
            };

            // Khởi tạo và hiển thị biểu đồ ApexCharts
            var chart = new ApexCharts(document.querySelector("#favouriteChart"), options);
            chart.render();

        };

        // Khởi tạo các biểu đồ Gio hàng
        const initCartCharts = () => {
            const cartChart = document.getElementById('cartChart').getContext('2d');
            const cartChartFunction = new Chart(cartChart, {
                type: 'radar',
                data: {

                    labels: {!! json_encode($cartStatistical->pluck('product_name')) !!},
                    datasets: [{
                        label: 'Tổng sản phẩm trong giỏ hàng',
                        data: {!! json_encode($cartStatistical->pluck('cart_count')) !!},
                        backgroundColor: 'rgba(0, 0, 0, 0.2)', // Màu nền
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Báo cáo top 8 sản phẩm được thêm vào giỏ hàng nhiều nhất"
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        },
                        gridLines: {
                            color: '#e0e0e0' // Màu lưới
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                const productName = data.labels[tooltipItem.index]; // Tên sản phẩm
                                const count = tooltipItem.yLabel; // Số lượng sản phẩm
                                return productName + ': ' + count; // Hiển thị tên và số lượng
                            }
                        }
                    }
                }
            });
        };


        // Khởi tạo các biểu đồ thanh toán
        const initPaymentCharts = () => {
            const ordersByPaymentCtx = document.getElementById('ordersByPaymentChart').getContext('2d');
            const ordersByPaymentChart = new Chart(ordersByPaymentCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($namePayment) !!},
                    datasets: [{
                        label: 'Số lượng đơn hàng',
                        data: {!! json_encode($dataPayment) !!},
                        backgroundColor: ['#ffc506', '#D82D8B', '#007ACC'],
                    }]
                },
                options: {

                    legend: {
                        display: false // Hiển thị legend
                    },
                    title: {
                        display: true,
                        text: "Báo cáo tổng quát về thanh toán người dùng"
                    },

                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            }
                        }]
                    }
                }
            });
        }


        // Khởi tạo các biểu đồ trạng thái
        const initStatusCharts = () => {
            const ordersByStatusCtx = document.getElementById('ordersByStatusChart').getContext('2d');
            const ordersByStatusChart = new Chart(ordersByStatusCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($nameStatus) !!}, // Các nhãn cho trục x
                    datasets: [{
                        data: {!! json_encode($dataStatus) !!}, // Số liệu tương ứng với từng trạng thái
                        backgroundColor: ['#2bc500', '#00bcd4', '#007ACC', '#fbc000', '#ff0000'],
                    }]
                },
                options: {

                    legend: {
                        display: false // Hiển thị legend
                    },
                    title: {
                        display: true,
                        text: "Báo cáo tổng quát về trạng thái đơn hàng trong hệ thống"
                    },
                }
            });
        }


        // Khởi tạo các biểu đồ bán chạy
        const initSoldoutCharts = () => {
            // Lấy dữ liệu từ PHP
            const productLabels = {!! json_encode($countProductSoldoutOrder->pluck('product_name')) !!}; // Nhãn sản phẩm
            const productQuantities = {!! json_encode($countProductSoldoutOrder->pluck('total_quantity')) !!}; // Số lượng sản phẩm

            var options = {
                series: productQuantities,
                chart: {
                    type: 'polarArea',
                },
                stroke: {
                    colors: ['#fff']
                },
                fill: {
                    opacity: 0.8
                },
                labels: productLabels,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            // Khởi tạo và hiển thị biểu đồ ApexCharts
            var chart = new ApexCharts(document.querySelector("#countProductSoldoutChart"), options);
            chart.render();
        };



        const initUserCharts = () => {
            const countUserChartCtx = document.getElementById('countUserChart').getContext('2d');
            const countUserChart = new Chart(countUserChartCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($countUserPotential->pluck('name_user')) !!}, // Các nhãn cho trục x
                    datasets: [{
                        data: {!! json_encode($countUserPotential->pluck('count_user')) !!}, // Số liệu tương ứng với từng trạng thái
                        backgroundColor: ['rgb(254, 99, 131)', 'rgb(54, 162, 235)', 'rgb(255, 204, 85)',
                            'rgb(74, 192, 192)'
                        ],
                    }]
                },
                options: {

                    legend: {
                        display: true // Hiển thị legend
                    },
                    title: {
                        display: true,
                        text: "Thống kê về khách hàng mua nhiều"
                    },

                }
            });
        }


        window.onload = function() {
            initRevenueChart();
            initFavouriteCharts();
            initCartCharts();
            initPaymentCharts();
            initStatusCharts();
            initSoldoutCharts();
            initUserCharts();
        };
    </script>
    {{-- backgroundColor: ['#2bc500', '#00bcd4', '#007ACC', '#fbc000', '#ff0000'], --}}

@endsection
