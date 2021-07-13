@extends('layouts.app')

@section('content')
    <!--Search, Date Filter, and Download as excel Bar -->
    <div class="row" style="margin-top: 30px; padding-left: 20px; padding-right: 20px">
        <div class="col" style="margin-top: 7px; text-align: right">
            Search
        </div>
        <div class="col-2">
            <div class="input-group mb-3">
                <?php $search = isset($_GET['search']) ? htmlentities($_GET['search']) : ''; ?>
                <form action={{ 'search' }} method="GET" class="input-group mb-3">
                    <input type="text" name="search" value="<?= $search ?>"
                            class="form-control" id="search" placeholder="report number">
                        <input type="submit" value="Search" class="btn btn-danger">
                    </form>
                </div>
            </div>
            
            <div class="col-1" style="margin-top: 7px; text-align: right">
                Start date
            </div>
                            
            <div class="col-4">
                <form action={{ 'datefilter_ogp' }} method="GET">
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
                                                
            <div class="col-1">
                <a class="btn btn-outline-danger" type="button" href="{{ route('report.ogp') }}" id="button-addon2">Clear</a>
            </div>
            
            <div class="col">
                <a href={{ 'report.export.ogp' }} type="button" class="btn btn-success">
                    Download
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16" style="margin-bottom: 3px">
                        <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>
                </a>
            </div>
                            
            <br>
        </div>
                        
        <!-- Table Show -->
        {{-- <h1 class="text-center">ALL REPORT</h1> --}}
        <div class="row" style="padding: 35px; padding-top: 0px; margin-top: 10px">
            <table class="table bg-light" style="text-align: center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Report Type</th>
                        <th scope="col">Report Number</th>
                        <th scope="col">Report Value</th>
                        <th scope="col">Report Detail</th>
                        <th scope="col">Report ID Sender</th>
                        <th scope="col">Report Sender</th>
                        <th scope="col">Report Status</th>
                        <th scope="col">Latest Updated at</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report as $rp)
                        @if ($rp->report_status == 'ogp')
                            <tr>
                                <th style="padding-top:15px">{{ $rp->id }}</th>
                                <td style="padding-top:15px">{{ $rp->report_type }}</td>
                                <td style="padding-top:15px">{{ $rp->report_number }}</td>
                                <td style="padding-top:15px">{{ $rp->report_value }}</td>
                                <td style="padding-top:15px; width: 350px">{{ $rp->report_detail }}</td>
                                <td style="padding-top:15px">{{ $rp->report_idsender }}</td>
                                <td style="padding-top:15px">{{ $rp->report_sender }}</td>
                                <td style="padding-top:15px">{{ $rp->report_status }}</td>
                                <td style="padding-top:15px">{{ $rp->updated_at }}</td>
                                <td>
                                    <div class="container-fluid" style="padding: 0px">
                                        <div class="row" style="padding: 0px">
                                            <!--button details modal-->
                                            <div class="col" style="padding: 0px; margin: 0px">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $rp->id }}">
                                                    Details
                                                </button>
                                            </div>
                                            <!--button delete-->
                                            @if (Auth::user()->admin == 1)
                                                <div class="col" style="padding: 0px; margin: 0px">
                                                    <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                            <path fill-rule="evenodd"
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            Showing {{ $report->count() }} from total {{ $report->total() }} ogp data
        </div>

            <!--pagination button-->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li>
                        {{ $report->onEachSide(5)->links() }}
                    </li>
                </ul>
            </nav>

            <!-- Modal Details -->
            @foreach ($report as $rp)
                <div class="modal fade" id="exampleModal{{ $rp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ID : {{ $rp->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <ul style="list-style: none">
                                            <li>
                                                <pre>Type               : {{ $rp->report_type }}</pre>
                                            </li>
                                            <li>
                                                <pre>Number             : {{ $rp->report_number }}</pre>
                                            </li>
                                            <li>
                                                <pre>Value              : {{ $rp->report_value }}</pre>
                                            </li>
                                            <li>
                                                <pre>Created            : {{ $rp->created_at }}</pre>
                                            </li>
                                            <li>
                                                <pre>ID Telegram Sender : {{ $rp->report_idsender }}</pre>
                                            </li>
                                            <li>
                                                <pre>Sender Name        : {{ $rp->report_sender }}</pre>
                                            </li>
                                            <li>
                                                <pre>Status             : {{ $rp->report_status }}</pre>
                                            </li>
                                            <li>
                                                <pre>Details            : {{ $rp->report_detail }}</pre>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <table class="table table-bordered border-danger" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col" colspan="2">open-ogp</th>
                                            <th scope="col" colspan="2">ogp-eskalasi</th>
                                            <th scope="col" colspan="2">ogp-closed</th>
                                            <th scope="col" colspan="2">eskalasi-closed</th>
                                            <th scope="col" rowspan="2">last update at</th>
                                        </tr>
                                        <tr>
                                            <th scope="col">by</th>
                                            <th scope="col">at</th>
                                            <th scope="col">by</th>
                                            <th scope="col">at</th>
                                            <th scope="col">by</th>
                                            <th scope="col">at</th>
                                            <th scope="col">by</th>
                                            <th scope="col">at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $rp->open_ogp }}</td>
                                            <td>{{ $rp->open_ogp_time }}</td>
                                            <td>{{ $rp->ogp_eskalasi }}</td>
                                            <td>{{ $rp->ogp_eskalasi_time }}</td>
                                            <td>{{ $rp->ogp_closed }}</td>
                                            <td>{{ $rp->ogp_closed_time }}</td>
                                            <td>{{ $rp->eskalasi_closed }}</td>
                                            <td>{{ $rp->eskalasi_closed_time }}</td>
                                            <td>{{ $rp->updated_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                        
            <!-- Modal Excel Download -->
            <div class="modal fade" id="ExcelModal" tabindex="-1" aria-labelledby="ExcelModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ExcelModalLabel">Excel Download </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <!--Download Option-->
                            <div class="accordion" id="accordionExample">
                                
                                <!--Option 1 ALL DB-->    
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    everything in the database 
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Download all report data from database : <a href={{ 'export_excel' }} class="btn btn-success" style="margin-left: 10px">Download</a>
                                    </div>
                                </div>
                                </div>
                                
                                <!--Option 2 BY DATE-->
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    specific date range
                                    </button>
                                </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col">
                                                    Start date
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col" style="text-align: left">
                                                    <form action={{ 'datefilter' }} method="POST">
                                                    {{ csrf_field() }}
                                                        <div class="input-group mb-3" style="margin-top: 10px">
                                                            <input type="date" class="form-control" name="from" value="{{ date('y-m-d') }}">
                                                            <span class="input-group-text">to</span>
                                                            <input type="date" class="form-control" name="to" value="{{ date('y-m-d') }}"
                                                                aria-describedby="button-addon2">
                                                        </div>
                                                        <div class="col-auto" style="margin-top: 10px">
                                                            <button type="submit" class="btn btn-success mb-3">Download</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <!--Option 3 BY REPORT TYPE-->
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    report type
                                    </button>
                                </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col">
                                                    Choose report type :
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col" style="text-align: left">
                                                    <form action={{ 'datefilter' }} method="POST">
                                                    {{ csrf_field() }}
                                                        <div class="form-check form-check-inline" style="margin-top: 10px">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                                            <label class="form-check-label" for="inlineCheckbox1">AO</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                            <label class="form-check-label" for="inlineCheckbox2">GGN</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                            <label class="form-check-label" for="inlineCheckbox2">MO</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                            <label class="form-check-label" for="inlineCheckbox2">PDA</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                            <label class="form-check-label" for="inlineCheckbox2">MIG</label>
                                                        </div>
                                                        <div class="col-auto" style="margin-top: 10px">
                                                            <button type="submit" class="btn btn-success mb-3">Download</button>
                                                        </div>
                                                    </form>
                                                </div>
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
