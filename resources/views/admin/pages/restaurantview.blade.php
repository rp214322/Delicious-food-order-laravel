@extends("admin.admin_app")

@section("content")

<div id="main">
    <div class="page-header">
        <h2>{{ $restaurant->restaurant_name }} Overview</h2>
        <a href="{{ URL::to('admin/restaurants') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> Back</a>
    </div>

    <div class="row">
        @if(Auth::user()->usertype == 'Admin')
            <a href="{{ URL::to('admin/restaurants/view/'.$restaurant->id.'/categories') }}">
                <div class="col-sm-6 col-md-3">
                    <div class="panel panel-orange panel-shadow">
                        <div class="media">
                            <div class="media-left">
                                <div class="panel-body">
                                    <div class="width-100">
                                        <h5 class="margin-none" id="graphWeek-y">Categories</h5>
                                        <h2 class="margin-none" id="graphWeek-a">{{ $categories_count }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="pull-right width-150">
                                    <i class="fa fa-folder fa-4x" style="margin: 8px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endif

        <a href="{{ URL::to('admin/restaurants/view/'.$restaurant->id.'/menu') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-green panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Menu</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $menu_count }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-coffee fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ URL::to('admin/restaurants/view/'.$restaurant->id.'/orderlist') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-grey panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Order</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $order_count }}</h5>
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

        <a href="{{ URL::to('admin/restaurants/view/'.$restaurant->id.'/review') }}">
            <div class="col-sm-6 col-md-3">
                <div class="panel panel-primary panel-shadow">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">Review</h5>
                                    <h2 class="margin-none" id="graphWeek-a">{{ $review_count }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="pull-right width-150">
                                <i class="fa fa-star-half-o fa-4x" style="margin: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-shadow">
                <div class="panel-heading">
                    <h5>Monthly Orders and Reviews</h5>
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
    var reviewsPerMonth = @json(array_values($reviewsPerMonth));

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
            }, {
                label: 'Reviews',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: reviewsPerMonth
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
