@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            @if (session('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-md-6" id="statistic-sale">
                            <div class="card info-card sales-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <div class="popup">
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>
                                            <li class="dropdown-item" style="cursor: pointer">Today</li>
                                            <li class="dropdown-item" style="cursor: pointer">This Month</li>
                                            <li class="dropdown-item" style="cursor: pointer">This Year</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Sales <span id="sale-type">| Today</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="sale-count"></h6>
                                            <span class="small pt-1 fw-bold" id="percent-difference"></span>
                                            <span class="text-muted small pt-2 ps-1" id="difference"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-md-6" id="statistic-revenue">
                            <div class="card info-card revenue-card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <div class="popup">
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>
                                            <li class="dropdown-item" style="cursor: pointer">Today</li>
                                            <li class="dropdown-item" style="cursor: pointer">This Month</li>
                                            <li class="dropdown-item" style="cursor: pointer">This Year</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span id="revenue-type">| This Month</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="revenue-price"></h6>
                                            <span class="small pt-1 fw-bold" id="percent-difference-revenue"></span>
                                            <span class="text-muted small pt-2 ps-1" id="difference-revenue"></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Line Chart -->
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Line Chart</h5>
                                    <!-- Line Chart -->
                                    <div id="lineChart"></div>
                                </div>
                            </div>
                        </div><!-- Line Chart -->

                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pie Chart</h5>
                                    <!-- Pie Chart -->
                                    <div id="pieChart"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentSale as $item)
                                                <tr>
                                                    <th scope="row"><a href="#">#{{ $item->id }}</a></th>
                                                    <td>{{ $item->receiver_name }}</td>
                                                    <td>${{ $item->total_price }}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif ($item->status == 2)
                                                            <span class="badge bg-primary">Sent</span>
                                                        @elseif ($item->status == 3)
                                                            <span class="badge bg-info">En Route</span>
                                                        @elseif ($item->status == 4)
                                                            <span class="badge bg-success">Arrived</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Preview</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sold</th>
                                                <th scope="col">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topSellingInMonth as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <img src="{{ route('watch.image.get', ['id' => $item->image_id]) }}"
                                                            alt="">
                                                    </th>
                                                    <td><a href="#"
                                                            class="text-primary fw-bold">{{ $item->model }}</a></td>
                                                    <td>${{ $item->selling_price }}</td>
                                                    <td class="fw-bold">{{ $item->sold }}</td>
                                                    <td>${{ $item->revenue }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Top Selling -->

                    </div>
                </div><!-- End Left side columns -->
            </div>
        </section>
    </main><!-- End #main -->
@endsection

@section('js')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
