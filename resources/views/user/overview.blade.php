@extends('layouts.performansi')

@section('usershow')
    <div class="container text-center">
        <h2 style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 20px; padding-bottom: 10px">
            Today User Performance Data "Closed"</h2>

        <p class="text-center" id='ct'></p>
    </div>


    <br>
    <br>
    <br>
    <div class="container">
        <br>
        {{-- <center>
            <div class="chart" id="chart" style=" width:600px"></div>
        </center> --}}
        <form class="form" method="get" action="{{ 'user/filter' }}">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select class="form-control" name="filternama" id="filter-nama">
                            <option value="">Nama</option>
                            @foreach ($user as $us)
                                <option value={{ $us->name }}>{{ $us->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col d-grid">
                    <a href="{{ url('overview/user') }}" class="btn btn-light">Reset</a>
                </div>
                <div class="col d-grid">
                    <button type="submit" class="btn btn-danger ">Filter</button>
                </div>
            </div>
        </form>
        <br>

        {{-- <div class="row">
            <div class="col-sm-4">
                <p> Total Closed Data : </p>
            </div>
            <div class="col-sm-8"> <b> <span id="totalrow"> </b></span></div>
        </div> --}}
        <div class="container">
            <p style="display:inline">Total Closed Data : </p>
            <b>
                <p id="totalrow" style="display:inline"></p>
            </b>
        </div>
        <br>

        <div class="table-responsive bg-light rounded shadow">
            <table class="table table-hover" id="my_table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">User ID</th>
                        <th scope="col">ID Moban</th>
                        <th scope="col">Updated by</th>
                        <th scope="col">No. Order</th>
                        <th scope="col">Update Status</th>
                        <th scope="col">Waktu Update</th>
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
                            <td>{{ $pr->updated_at }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <br>
        <br>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function display_c() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct()', refresh)
        }

        function display_ct() {
            var x = new Date()
            var x1 = x.getMonth() + 1 + "/" + x.getDate() + "/" + x.getFullYear();
            x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
            document.getElementById('ct').innerHTML = x1;
            display_c();
        }
    </script>
    <script type="text/javascript">
        var totalrow = $('#my_table tr').length - 1;

        document.getElementById("totalrow").innerHTML = totalrow;
    </script>
@endsection
