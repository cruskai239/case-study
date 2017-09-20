@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Welcome, {!! \Auth::user()->name !!}.
                        <div class="pull-right">
                            Currently {!! $weather->main->temp !!} &#8457; in {!! $weather->name !!}
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger">
                                {{ session('danger') }}
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div id="app-hourly-report" class="app">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="card-title">Page Views</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">Per Half Hour</h6>
                                        <hr/>
                                        {{--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                                        {{--<a href="#" class="card-link">Card link</a>--}}
                                        {{--<a href="#" class="card-link">Another link</a>--}}
                                        <div id="hourly-report"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="app-hourly-report-ri" class="app">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="card-title">Reports And Page Views</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">Per Half Hour</h6>
                                        <hr/>
                                        {{--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                                        {{--<a href="#" class="card-link">Card link</a>--}}
                                        {{--<a href="#" class="card-link">Another link</a>--}}
                                        <div id="hourly-report-ri"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                            <div id="app-activity" class="app">
                                <div class="card">
                                    <div class="card-block">
                                        <div>
                                            <h4 class="card-title">My Recent Activity</h4>
                                            <a href="{!! url()->action('HomeController@get_ExportRecentActivity') !!}">Export
                                                To Excel</a>
                                            <hr/>
                                        </div>
                                        <div class="pull-right clearfix">
                                            {!! $impressions->links() !!}
                                        </div>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Timestamp</th>
                                                    <th>User</th>
                                                    <th>Event</th>
                                                    <th>Page</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($impressions as $impression)
                                                    <tr>
                                                        <td>{!! $impression->created_at->format('Y-m-d H:i:s') !!}</td>
                                                        <td>{!! $impression->User->name !!}</td>
                                                        <td>{!! $impression->event_name !!}</td>
                                                        <td>{!! $impression->data ?: 'N/A' !!}</td>
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
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var HourlyReport = new Vue({
                el: '#app-hourly-report',
                data: {},
                methods: {
                    getValues: function () {
                        var params = {eventNames: ['page_view'], _token: '{!! csrf_token() !!}'};
                        axios.post('{!! url()->action('ReportController@post_GetReportData') !!}', params)
                            .then(function (response) {
                                console.log(response);
                                var chart = new Morris.Line({
                                    // ID of the element in which to draw the chart.
                                    element: 'hourly-report',
                                    // Chart data records -- each entry in this array corresponds to a point on
                                    // the chart.
                                    data: response.data.data,
                                    // The name of the data record attribute that contains x-values.
                                    xkey: 'slice',
                                    // A list of names of data record attributes that contain y-values.
                                    ykeys: response.data.ykeys,
                                    // Labels for the ykeys -- will be displayed when you hover over the
                                    // chart.
                                    labels: response.data.labels
                                });
                                console.log(chart);
                            });
                    }
                },
                mounted: function () {
                    this.getValues();
                }
            });
            var HourlyReportRI = new Vue({
                el: '#app-hourly-report-ri',
                data: {},
                methods: {
                    getValues: function () {
                        var params = {eventNames: ['report_generated'], _token: '{!! csrf_token() !!}'};
                        axios.post('{!! url()->action('ReportController@post_GetReportData') !!}', params)
                            .then(function (response) {
                                console.log(response);
                                var chart = new Morris.Line({
                                    // ID of the element in which to draw the chart.
                                    element: 'hourly-report-ri',
                                    // Chart data records -- each entry in this array corresponds to a point on
                                    // the chart.
                                    data: response.data.data,
                                    // The name of the data record attribute that contains x-values.
                                    xkey: 'slice',
                                    // A list of names of data record attributes that contain y-values.
                                    ykeys: response.data.ykeys,
                                    // Labels for the ykeys -- will be displayed when you hover over the
                                    // chart.
                                    labels: response.data.labels
                                });
                                console.log(chart);
                            });
                    }
                },
                mounted: function () {
                    this.getValues();
                }
            });
        });
    </script>
@endpush
