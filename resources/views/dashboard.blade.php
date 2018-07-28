@extends('layouts.common')
@section('pageTitle')
    {{__('app.dashboard_title',["app_name"=> __('app.app_name')])}}
@endsection
@push('externalCssLoad')
<link rel="stylesheet" href="{{url('css/plugins/jquery-jvectormap-1.2.2.css')}}" type="text/css" />
<link rel="stylesheet" href="{{url('css/plugins/jqvmap.min.css')}}" type="text/css" />
@endpush
@push('internalCssLoad')

@endpush
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">

                <!-- <li><a href="#">Master Managemet</a></li> -->
                <!-- <li class="active">Collapsible Sidebar</li> -->
            </ol>
        </div>
        <div class="main-content container-fluid">


            <div class="row">
                <div class="col-md-6">
                    <div class="widget widget-fullwidth">
                        <div class="widget-head">
                            <!--                            <div class="tools"><span class="icon mdi mdi-chevron-down"></span><span class="icon mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span></div>-->
                            <span class="title">Activity Report</span><span class="description">&nbsp;</span>
                        </div>
                        <div class="widget-chart-container">
                            <div id="line-chart3" style="height: 220px;"></div>
                            <div class="chart-table xs-pt-15">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget widget-fullwidth">
                        <div class="widget-head">
                            <span class="title">Activity Report</span><span class="description">&nbsp;</span>
                        </div>
                        <div class="widget-chart-container">
                            <div id="bar-chart2" style="height: 220px;"></div>
                            <div class="chart-table xs-pt-15">

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

@push('externalJsLoad')
<script src="{{url('js/plugins/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.vmap.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.vmap.world.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/countUp.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.pie.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/jquery.flot.orderBars.js')}}" type="text/javascript"></script>
<script src="{{url('js/plugins/curvedLines.js')}}" type="text/javascript"></script>

@endpush
@push('internalJsLoad')
<script type="text/javascript">
    $(document).ready(function () {
        App.charts();
    });
</script>
@endpush