@extends('layouts.performansi')

@section('usershow')
    <div class="container">
        <div class="row" style="margin-top: 15px">
            <div class="col-2">
                <a href="javascript: history.go(-1)" class="btn btn-danger shadow" style="margin-left: 20px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg>
                    Back
                </a>
            </div>
            <div class="col-8">
                <h2 class="text-center" style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 5px"> Data User </h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col" style="margin-left: 15px">
                <p>Nama : {{ $user->name }}</p>
                <p>Email : {{ $user->email }}</p>
                <p>Telegram username : <a target="_blank"
                        href="https://t.me/{{ $user->teleuser }}">{{ $user->teleuser }}</a></p>
            </div>
            {{-- <hr> --}}
            <div class="col">
                <p>Status :
                    @if (Cache::has('user-is-online-' . $user->id))
                        <span class="text-success">Online</span>
                    @else
                        <span class="text-secondary">Offline</span>
                    @endif
                </p>
                <p>Last Seen :
                    @if ($user->last_seen != null)
                        {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                    @else
                        No data
                    @endif
                </p>
            </div>
        </div>
        <input type="button" class="btn btn-primary" value="Print" onclick="printDiv()" style="margin-left: 15px; margin-bottom: 15px; width: 90px">
    </div>
@endsection

@section('showuser')
    <div class="row text-center bg-white shadow" style="border-radius: 1rem; margin-top: 25px">
        <h2 style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 5px">charts</h2>
        <center>
            <div class="chart" id="chart" style=" width:600px"></div>
        </center>
    </div>

    <div class="row text-center bg-white shadow" style="border-radius: 1rem; margin-top: 25px">
        <h2 style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 5px">filter & download data</h2>
        <div class="col-4">
            <form class="form" method="get" action="{{ route('performansi.filter', $user->id) }}">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <select class="form-control" name="filteraction" id="filter-action">
                                <option value="">Choose Action</option>
                                <option value="open_ogp">open to ogp</option>
                                <option value="ogp_eskalasi">ogp to eskalasi</option>
                                <option value="ogp_closed">ogp to closed</option>
                                <option value="eskalasi_closed">eskalasi to closed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4 d-grid">
                        <button type="submit" class="btn btn-danger ">Filter !</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form action={{ 'datefilter' }} method="GET">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="from" value="{{ date('y-m-d') }}">
                    <span class="input-group-text">to</span>
                    <input type="date" class="form-control" name="to" value="{{ date('y-m-d') }}"
                        aria-describedby="button-addon2">
                    <button class="btn btn-danger" type="submit" id="button-addon2">Filter</button>
                </div>
            </form>
        </div>
        <div class="col-2">
            <a href="" class="btn btn-success d-grid" type="button">download</a>
        </div>
    </div>

    <div class="row text-center bg-white shadow" style="border-radius: 1rem; margin-top: 25px">
        <h2 style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 5px">data</h2>
        <div class="table-responsive">
            <table class="table table-hover" id="my_table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">User ID</th>
                        <th scope="col">ID Moban</th>
                        <th scope="col">Updated by</th>
                        <th scope="col">No. Order</th>
                        <th scope="col">Update Status</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                @foreach ($performance as $pr)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $count++ }}</th>
                            <td>{{ $pr->user_id }}</td>
                            <td>{{ $pr->id_moban }}</td>
                            <td>{{ $pr->user_name }}</td>
                            <td>{{ $pr->no_order }}</td>
                            <td>{{ $pr->update_status }}</td>
                            <td>{{ $pr->created_at }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        function printDiv() {
            var divContents = document.getElementById("PFM").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            // a.document.write('<html>');
            // a.document.write('<body>');
            a.document.write(divContents);
            // a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{ $user->name }} Performance Data'
            },
            subtitle: {
                text: 'Data for the last 30 days'
            },
            xAxis: {
                categories: ['Open -> OGP', 'OGP -> Eskalasi', 'OGP -> Closed', 'Eskalasi -> Closed']
            },

            yAxis: {
                min: 0,
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: 'Status',
                data: [{
                    name: 'Open -> OGP',
                    color: '#f2bd1f',
                    y: {{ $open_ogp }}
                }, {
                    name: 'OGP -> Eskalasi',
                    color: '#0aa9ff',
                    y: {{ $ogp_eskalasi }}
                }, {
                    name: 'OGP -> Closed',
                    color: '#1e4afa',
                    y: {{ $ogp_closed }}
                }, {
                    name: 'Eskalasi -> Closed',
                    color: '#1cbd00',
                    y: {{ $eskalasi_closed }}
                }]
            }, ]
        });
    </script>
@endsection
