@extends('/layouts/master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/css/plugins/charts/chart-apex.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('backend/app-assets/vendors/css/charts/apexcharts.css')}}">

@stop

@section('title')
    <title>Dashboard</title>
@stop
@section('body')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section id="apexchart">
                <div class="row">
                    <!-- Line Chart Starts -->
                     <div class="col-6">
                        <div class="card">
                            <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <h4 class="card-title mb-25">Sales {{date('Y')}}</h4>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div id="whole-line-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Line Chart Ends -->
                     <!-- Line Chart Starts -->
                     <div class="col-6">
                        <div class="card">
                            <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                                <div>
                                    <h4 class="card-title mb-25">Sales {{date('F-Y')}}</h4>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div id="line-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Line Chart Ends -->
                </div>
            </section>

            <div class="row match-height">
                <!-- Revenue Report Card -->
                <div class="col-lg-6 col-12">
                    <div class="card card-revenue-budget">
                        <div class="row mx-0">
                            <div class="col-md-12 col-12 revenue-report-wrapper">
                                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-50 mb-sm-0">Orders Count</h4>
                                </div>
                                <div id="revenue-report-chart"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--/ Revenue Report Card -->

                <!-- Revenue Report Card -->
                <div class="col-lg-6 col-12">
                    <div class="card card-revenue-budget">
                        <div class="row mx-0">
                            <div class="col-md-12 col-12 revenue-report-wrapper">
                                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-50 mb-sm-0">Orders Amount</h4>
                                </div>
                                <div id="revenue-amount-chart"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--/ Revenue Report Card -->
            </div>

            <div class="row match-height">
                <div class="col-lg-12 col-12">
                    <div class="card card-revenue-budget">
                        <div class="row mx-0">
                            <div class="col-md-12 col-12 revenue-report-wrapper">
                                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-50 mb-sm-0">Top 10 Wishlist Products</h4>
                                </div>
                                <div class="table-responsive">
                                    <table id="table-user" class="table table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Title</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($top10wishlistdata as $wishlist)
                                                <tr>
                                                    <td>{{ $wishlist['protitle'] }}</td>
                                                    <td>{{ $wishlist['count'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src="{{url('backend/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>

<script>
    var orderstatustitles = <?php echo json_encode($orderstatus->pluck('title')->toArray()); ?>;
    var ordercounts = <?php echo json_encode($ordercount); ?>;

    var thisweekcount = [];
    var lastweekcount = [];
    var lasttwoweekcount = [];

    orderstatustitles.forEach(function(title) {
        thisweekcount.push(ordercounts[title]['thisweekorderscount']);
        lastweekcount.push(ordercounts[title]['lastweekorderscount']);
        lasttwoweekcount.push(ordercounts[title]['lasttwoweeksorderscount']);
    });

    var $revenueReportChart = document.querySelector('#revenue-report-chart');
    var $textMutedColor = '#b9b9c3';

    var revenueReportChartOptions = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '20%',
                endingShape: 'rounded'
            }
        },
        colors: ['#3f51b5', '#ff9800', '#4caf50'],
        series: [{
                name: 'This Week',
                data: thisweekcount
            },
            {
                name: 'Last Week',
                data: lastweekcount
            },
            {
                name: 'Last Two Weeks',
                data: lasttwoweekcount
            }
        ],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            position: 'top'
        },
        xaxis: {
            categories: orderstatustitles,
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '0.86rem'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '0.86rem'
                }
            }
        }
    };

    revenueReportChart = new ApexCharts($revenueReportChart, revenueReportChartOptions);
    revenueReportChart.render();

</script>

<script>
    var orderstatustitles = <?php echo json_encode($orderstatus->pluck('title')->toArray()); ?>;
    var orderamount = <?php echo json_encode($orderamount); ?>;

    var thisweekamount = [];
    var lastweekamount = [];
    var lasttwoweekamount = [];

    orderstatustitles.forEach(function(title) {
        thisweekamount.push(orderamount[title]['thisweekordersamount']);
        lastweekamount.push(orderamount[title]['lastweekordersamount']);
        lasttwoweekamount.push(orderamount[title]['lasttwoweeksordersamount']);
    });

    var $revenueReportChart = document.querySelector('#revenue-amount-chart');
    var $textMutedColor = '#b9b9c3';

    var revenueReportChartOptions = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '20%',
                endingShape: 'rounded'
            }
        },
        colors: ['#3f51b5', '#ff9800', '#4caf50'],
        series: [{
                name: 'This Week',
                data: thisweekamount
            },
            {
                name: 'Last Week',
                data: lastweekamount
            },
            {
                name: 'Last Two Weeks',
                data: lasttwoweekamount
            }
        ],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            position: 'top'
        },
        xaxis: {
            categories: orderstatustitles,
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '0.86rem'
                }
            }
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return val.toFixed(2);
                },
                style: {
                    colors: $textMutedColor,
                    fontSize: '0.86rem'
                }
            }
        }
    };

    revenueReportChart = new ApexCharts($revenueReportChart, revenueReportChartOptions);
    revenueReportChart.render();

</script>

<script>
    var orderstatustitles = <?php echo json_encode($orderstatus->pluck('title')->toArray()); ?>;
    var orderamountmonthly = <?php echo json_encode($orderamountmonthly); ?>;

    var sales = [];

    orderstatustitles.forEach(function(title) {
        sales.push(orderamountmonthly[title]['thismonthorders']);
    });
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var lineChartEl = document.querySelector('#line-chart'),
        lineChartConfig = {
            chart: {
                height: 400,
                type: 'line',
                zoom: {
                    enabled: false
                },
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            series: [{
                data: sales
            }],
            markers: {
                strokeWidth: 7,
                strokeOpacity: 1,
                strokeColors: [window.colors.solid.white],
                colors: ["#F26622"]
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            colors: ["#F26622"],
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    top: -20
                }
            },
            tooltip: {
                custom: function(data) {
                    return (
                        '<div class="px-1 py-50">' +
                        '<span>&pound' +
                        data.series[data.seriesIndex][data.dataPointIndex].toFixed(2) +
                        '</span>' +
                        '</div>'
                    );
                }
            },
            xaxis: {
                categories: orderstatustitles
            },
            yaxis: {
                opposite: isRtl,
                labels: {
                    formatter: function (val) {
                        return val.toFixed(2);
                    }
                }
            }
        };
        if (typeof lineChartEl !== undefined && lineChartEl !== null) {
            var lineChart = new ApexCharts(lineChartEl, lineChartConfig);
            lineChart.render();
        } 
</script>

<script>
    var orderstatustitles = <?php echo json_encode($orderstatus->pluck('title')->toArray()); ?>;
    var orderamountyearly = <?php echo json_encode($orderamountyearly); ?>;

    var sales = [];

    orderstatustitles.forEach(function(title) {
        sales.push(orderamountyearly[title]['thisyearorders']);
    });
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    var lineChartEl = document.querySelector('#whole-line-chart'),
        lineChartConfig = {
            chart: {
                height: 400,
                type: 'line',
                zoom: {
                    enabled: false
                },
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            series: [{
                data: sales
            }],
            markers: {
                strokeWidth: 7,
                strokeOpacity: 1,
                strokeColors: [window.colors.solid.white],
                colors: ["#F26622"]
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            colors: ["#F26622"],
            grid: {
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    top: -20
                }
            },
            tooltip: {
                custom: function(data) {
                    return (
                        '<div class="px-1 py-50">' +
                        '<span>&pound' +
                        data.series[data.seriesIndex][data.dataPointIndex].toFixed(2) +
                        '</span>' +
                        '</div>'
                    );
                }
            },
            xaxis: {
                categories: orderstatustitles
            },
            yaxis: {
                opposite: isRtl,
                labels: {
                    formatter: function (val) {
                        return val.toFixed(2);
                    }
                }
            }
        };
        if (typeof lineChartEl !== undefined && lineChartEl !== null) {
            var lineChart = new ApexCharts(lineChartEl, lineChartConfig);
            lineChart.render();
        } 
</script>

@stop