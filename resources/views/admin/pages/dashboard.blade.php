@extends("admin.admin_app")

@section("content")

<div id="main">
    <div class="page-header">
        <h2>Overview</h2>
    </div>
    
    <div class="row">
        <!-- Existing panels here -->
        <a href="{{ URL::to('admin/types') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-orange panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Types</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $types }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-tags fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ URL::to('admin/restaurants') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-green panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Restaurants</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $restaurants_count }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-cutlery fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ URL::to('admin/allorder') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-grey panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Orders</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $order }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-cart-plus fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ URL::to('admin/users') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-primary panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Users</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $users }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-users fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Monthly Orders Chart -->
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow">
                <div class="panel-heading">
                    <h5>Monthly Orders</h5>
                </div>
                <div class="panel-body">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('ordersChart').getContext('2d');
    var ordersPerMonth = @json(array_values($ordersPerMonth));

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Orders',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: ordersPerMonth
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
</script>
@endsection
