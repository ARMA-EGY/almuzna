@extends('layouts.admin')

@section('content')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7 text-right">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('home')}}">لوحة التحكم</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الرئيسية</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!-- Card stats -->
            <div class="row justify-content-center">

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">اجمالي الزيارات</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($traffic)}}</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                          <i class="ni ni-sound-wave"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">المنتجات</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($products_count)}}</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                          <i class="fa fa-cubes"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">اجمالي الطلبات</h5>
                        <span class="h2 font-weight-bold mb-0">0</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                          <i class="ni ni-cart"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">العروض</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($offers_count)}}</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="fas fa-bullhorn"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">العملاء</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($customers_count)}}</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-gray text-white rounded-circle shadow">
                          <i class="fas fa-user-tie"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">السائقين</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($drivers_count)}}</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                          <i class="fas fa-user-astronaut"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">الرسائل</h5>
                        <span class="h2 font-weight-bold mb-0">{{number_format($messages_count)}}</span>
                      </div>
                      <div class="col-auto order-1">
                        <div class="icon icon-shape bg-gradient-pink text-white rounded-circle shadow">
                          <i class="ni ni-email-83"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                    </p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">

        <!-- First Half -->
        <div class="col-xl-6">

            <!-- No.Posts in each category -->
            <div class="card bg-default shadow">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Products</h6>
                    <h5 class="h3 mb-0 text-white">Number of Sale for each product</h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <canvas id="chart-pie" class="chart-canvas"></canvas>
                </div>
              </div>
            </div>

        </div>

        <!-- Second Half -->
        <div class="col-xl-6">

            <!-- No.Posts for each author -->
            <div class="card bg-default shadow">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Products</h6>
                    <h5 class="h3 mb-0 text-white">Total revenue for each product</h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas"></canvas>
                </div>
              </div>
            </div>

        </div>

        

      </div>
      
      
      <!-- Footer -->
      <footer class="footer pt-0">
      </footer>
    </div>

@endsection


@section('script')
    
<script>

  // Bars chart
  var BarsChart = (function() {

    var $chart = $('#chart-bars');

    // Init chart
    function initChart($chart) {

      // Create chart
      var ordersChart = new Chart($chart, {
        type: 'bar',
        data: {
          labels: {!! json_encode($author_name)!!},
          datasets: [{
            label: 'Revenue',
            data: {!! json_encode($author_posts)!!}
          }]
        }
      });

      // Save to jQuery object
      $chart.data('chart', ordersChart);
    }

    // Init chart
    if ($chart.length) {
      initChart($chart);
    }
  })();

  // Pie chart
  PieChart = function(){
    var e,a,t,n = $("#chart-pie");
    n.length&&(e=n, a = function(){return Math.round(100*Math.random())},
    t = new Chart(e,{
      type:"pie",
      data: {
        labels:{!! json_encode($category_name)!!},
        datasets:[{
            data:{!! json_encode($category_posts)!!},
            backgroundColor:[Charts.colors.theme.danger,Charts.colors.theme.warning,Charts.colors.theme.success,Charts.colors.theme.primary,Charts.colors.theme.info]
            ,label:"Dataset 1"
            }]
            },
        options:{responsive:!0,legend:{position:"top"},
        animation:{animateScale:!0,animateRotate:!0}}}),
        e.data("chart",t)
        )
  }();

</script>

@endsection