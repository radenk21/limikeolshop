@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            @if(session('message'))
                <h2>{{ session('message') }}</h2>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Keuntungan</h5>
                        </div>
                        <div>
                            <select class="form-select">
                            <option value="1">March 2023</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                    @push('js')
                        <script>
                            $(function () {
                                // =====================================
                                // Profit
                                // =====================================
                                var chart = {
                                series: [
                                    { name: "Earnings this month:", data: [
                                        @foreach ($ReportKeuntungan as $reportKeuntungan)
                                            {{ $reportKeuntungan->keuntungan }},
                                        @endforeach
                                    ] },
                                    { name: "Expense this month:", data: [280, 250, 325, 215, 250, 310, 280, 250] },
                                ],

                                chart: {
                                    type: "bar",
                                    height: 345,
                                    offsetX: -15,
                                    toolbar: { show: true },
                                    foreColor: "#adb0bb",
                                    fontFamily: 'inherit',
                                    sparkline: { enabled: false },
                                },


                                colors: ["#5D87FF", "#49BEFF"],


                                plotOptions: {
                                    bar: {
                                    horizontal: false,
                                    columnWidth: "35%",
                                    borderRadius: [6],
                                    borderRadiusApplication: 'end',
                                    borderRadiusWhenStacked: 'all'
                                    },
                                },
                                markers: { size: 0 },

                                dataLabels: {
                                    enabled: false,
                                },


                                legend: {
                                    show: false,
                                },


                                grid: {
                                    borderColor: "rgba(0,0,0,0.1)",
                                    strokeDashArray: 3,
                                    xaxis: {
                                    lines: {
                                        show: false,
                                    },
                                    },
                                },

                                xaxis: {
                                    type: "category",
                                    categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"],
                                    labels: {
                                    style: { cssClass: "grey--text lighten-2--text fill-color" },
                                    },
                                },
                                yaxis: {
                                    show: true,
                                    min: {{ $reportWithLowestProfit }},
                                    max: {{ $reportWithHighestProfit }},
                                    tickAmount: 4,
                                    labels: {
                                    style: {
                                        cssClass: "grey--text lighten-2--text fill-color",
                                    },
                                    },
                                },
                                stroke: {
                                    show: true,
                                    width: 3,
                                    lineCap: "butt",
                                    colors: ["transparent"],
                                },


                                tooltip: { theme: "light" },

                                responsive: [
                                    {
                                    breakpoint: 600,
                                    options: {
                                        plotOptions: {
                                        bar: {
                                            borderRadius: 3,
                                        }
                                        },
                                    }
                                    }
                                ]


                                };

                                var chart = new ApexCharts(document.querySelector("#chart"), chart);
                                chart.render();


                                // =====================================
                                // Breakup
                                // =====================================
                                // var breakup = {
                                // color: "#adb5bd",
                                // series: [38, 40, 25],
                                // labels: ["2022", "2021", "2020"],
                                // chart: {
                                //     width: 180,
                                //     type: "donut",
                                //     fontFamily: "Plus Jakarta Sans', sans-serif",
                                //     foreColor: "#adb0bb",
                                // },
                                // plotOptions: {
                                //     pie: {
                                //     startAngle: 0,
                                //     endAngle: 360,
                                //     donut: {
                                //         size: '75%',
                                //     },
                                //     },
                                // },
                                // stroke: {
                                //     show: false,
                                // },

                                // dataLabels: {
                                //     enabled: false,
                                // },

                                // legend: {
                                //     show: false,
                                // },
                                // colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

                                // responsive: [
                                //     {
                                //     breakpoint: 991,
                                //     options: {
                                //         chart: {
                                //         width: 150,
                                //         },
                                //     },
                                //     },
                                // ],
                                // tooltip: {
                                //     theme: "dark",
                                //     fillSeriesColor: false,
                                // },
                                // };

                                // var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
                                // chart.render();



                                // =====================================
                                // Earning
                                // =====================================
                                // var earning = {
                                // chart: {
                                //     id: "sparkline3",
                                //     type: "area",
                                //     height: 60,
                                //     sparkline: {
                                //     enabled: true,
                                //     },
                                //     group: "sparklines",
                                //     fontFamily: "Plus Jakarta Sans', sans-serif",
                                //     foreColor: "#adb0bb",
                                // },
                                // series: [
                                //     {
                                //     name: "Earnings",
                                //     color: "#49BEFF",
                                //     data: [25, 66, 20, 40, 12, 58, 20],
                                //     },
                                // ],
                                // stroke: {
                                //     curve: "smooth",
                                //     width: 2,
                                // },
                                // fill: {
                                //     colors: ["#f3feff"],
                                //     type: "solid",
                                //     opacity: 0.05,
                                // },

                                // markers: {
                                //     size: 0,
                                // },
                                // tooltip: {
                                //     theme: "dark",
                                //     fixed: {
                                //     enabled: true,
                                //     position: "right",
                                //     },
                                //     x: {
                                //     show: false,
                                //     },
                                // },
                                // };
                                // new ApexCharts(document.querySelector("#earning"), earning).render();
                                })
                        </script>
                    @endpush
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
            <div class="col-lg-12">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Penjualan tahun ini</h5>
                    <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="fw-semibold mb-3">Rp {{ $total_pendapatan_per_tahun }}</h4>
                        <div class="d-flex align-items-center mb-3">
                            {{-- <span
                                class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-arrow-up-left text-success"></i>
                            </span>
                            <p class="text-dark me-1 fs-3 mb-0">
                                @if ($persentase_perubahan < 0)
                                    {{ $persentase_perubahan }} 
                                @elseif ($persentase_perubahan > 0)
                                    + {{ $persentase_perubahan }} 
                                @else
                                    0 
                                @endif
                            </p>
                            <p class="fs-3 mb-0">last year</p>
                            </div> --}}
                            <div class="d-flex align-items-center">
                            <div class="me-4">
                                <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                <span class="fs-2">{{ now()->year }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Monthly Earnings -->
                <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold"> Penjualan per bulan </h5>
                        <h4 class="fw-semibold mb-3">Rp {{ $total_pendapatan_per_bulan }}</h4>
                        <div class="d-flex align-items-center pb-1">
                        <span
                            class="me-2 rounded-circle bg-light round-20 d-flex align-items-center justify-content-center">
                            @if ($persentase_perubahan < 0)
                                <i class="ti ti-arrow-down-right text-danger"></i>
                            @elseif ($persentase_perubahan > 0)
                                <i class="ti ti-arrow-up-left text-success"></i>
                            @else
                                
                            @endif
                        </span>
                        <p class="text-dark me-1 fs-3 mb-0">
                            @if ($persentase_perubahan < 0)
                                {{ $persentase_perubahan }} %
                            @elseif ($persentase_perubahan > 0)
                                + {{ $persentase_perubahan }} %
                            @else
                                0 %
                            @endif
                        </p>
                        <p class="fs-3 mb-0"> Bulan lalu <br> (Rp {{ $total_perubahan }})</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                        <div
                            class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                            <i class="ti ti-currency-dollar fs-6"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="earning"></div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Recent Transactions</h5>
                    </div>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            @forelse ($orders as $order)
                                @php
                                    $badgeClass = '';
                                    switch($order->status_message) {
                                        case 'batal':
                                            $badgeClass = 'border-danger';
                                            break;
                                        case 'gagal':
                                            $badgeClass = 'border-danger';
                                            break;
                                        case 'dalam proses':
                                            $badgeClass = 'border-warning';
                                            break;
                                        case 'pending':
                                            $badgeClass = 'border-warning';
                                            break;
                                        case 'belum di verifikasi':
                                            $badgeClass = 'border-warning';
                                            break;
                                        case 'selesai':
                                            $badgeClass = 'border-success';
                                            break;
                                        case 'terverifikasi':
                                            $badgeClass = 'border-success';
                                            break;
                                        default:
                                            $badgeClass = 'border-primary';
                                    }
                                @endphp
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    <div class="timeline-time text-dark flex-shrink-0 text-end">{{ $order->updated_at->format('H:i') }}</div>
                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                        
                                    <span class="timeline-badge border-2 border {{ $badgeClass }}  flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                    </div>
                                    <div class="timeline-desc fs-3 text-dark mt-n1">
                                        Pesanan {{ $order->user->name }} {{ $order->status_message }} seharga Rp {{ number_format($order->total_harga, 0, '.', '.') }}
                                    </div>
                                </li>
                            @empty
                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                    Belum ada Pesanan
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                    <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Order Tracking No.</h6>
                            </th>
                            <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Status</h6>
                            </th>
                            <th class="border-bottom-0 text-center">
                            <h6 class="fw-semibold mb-0">Method</h6>
                            </th>
                            <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Budget</h6>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                @php
                                    $badgeClass = '';
                                    switch($order->status_message) {
                                        case 'batal':
                                            $badgeClass = 'bg-danger';
                                            break;
                                        case 'gagal':
                                            $badgeClass = 'bg-danger';
                                            break;
                                        case 'dalam proses':
                                            $badgeClass = 'bg-warning';
                                            break;
                                        case 'pending':
                                            $badgeClass = 'bg-warning';
                                            break;
                                        case 'belum di verifikasi':
                                            $badgeClass = 'bg-warning';
                                            break;
                                        case 'selesai':
                                            $badgeClass = 'bg-success';
                                            break;
                                        case 'terverifikasi':
                                            $badgeClass = 'bg-success';
                                            break;
                                        default:
                                            $badgeClass = 'bg-primary';
                                    }
                                @endphp
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">
                                            {{ $loop->index + 1 }}
                                        </h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">
                                            {{ $order->user->name }}
                                        </h6>                        
                                    </td>
                                    <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $order->no_tracking }}</p>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                    <p class="mb-0 fw-normal">{{ $order->payment_mode }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge {{ $badgeClass }} rounded-3 fw-semibold">{{ $order->status_message }}</span>
                                    </div>
                                    </td>
                                    <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0 fs-4">Rp {{ number_format($order->total_harga, 0 , '.', '.') }}</h6>
                                    </td>
                                </tr>           
                            @empty
                                <tr>
                                    <td colspan="5">
                                        Belum Ada Pesan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s4.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Boat Headphone</h6>
                <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0">$50 <span class="ms-2 fw-normal text-muted fs-3"><del>$65</del></span></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s5.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">MacBook Air Pro</h6>
                <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0">$650 <span class="ms-2 fw-normal text-muted fs-3"><del>$900</del></span></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s7.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Red Valvet Dress</h6>
                <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0">$150 <span class="ms-2 fw-normal text-muted fs-3"><del>$200</del></span></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
            <div class="position-relative">
                <a href="javascript:void(0)"><img src="../assets/images/products/s11.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>                      </div>
            <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Cute Soft Teddybear</h6>
                <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0">$285 <span class="ms-2 fw-normal text-muted fs-3"><del>$345</del></span></h6>
                <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div> --}}
    {{-- End Row --}}
@endsection