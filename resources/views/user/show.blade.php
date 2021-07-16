@extends('layouts.performansi')

@section('user')
    <br>
    <div class="container">
        <a href="javascript: history.go(-1)" class="">Back</a>
        <br>
        <hr>
        <div class="row bg-light shadow rounded">
            <h5 class=" text-center"> Data User </h5>
            <hr>
            <p>Nama : {{ $user->name }}</p>
            <p>Email : {{ $user->email }}</p>
        </div>
        <br>
    </div>

@endsection

@section('isi')
    <div class="container">
        @foreach ($performance as $pr)
            @if ($pr->user_id == $user->id)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">ID Moban</th>
                            <th scope="col">Updated by</th>
                            <th scope="col">No. Order</th>
                            <th scope="col">Update Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pr->id }}</td>
                            <td>{{ $pr->user_id }}</td>
                            <td>{{ $pr->id_moban }}</td>
                            <td>{{ $pr->user_name }}</td>
                            <td>{{ $pr->no_order }}</td>
                            <td>{{ $pr->update_status }}</td>
                            <td>{{ $pr->created_at }}</td>
                            <td>{{ $pr->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endforeach
    </div>
@endsection
