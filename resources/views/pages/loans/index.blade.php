@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Loans Data') }}</h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="mt-2">Loans List</h4>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <a href="#" class="btn btn-success">Add New Loan Record</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless" id="loans_table">
                        <thead class="font-weight-bold">
                            <tr>
                                <td>Nama Mahasiswa</td>
                                <td>Fasilitas</td>
                                <td>Tipe Fasilitas</td>
                                <td>Jurusan</td>
                                <td>Tanggal Peminjaman</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->user->getFullNameAttribute() }}</td>
                                    <td>{{ $loan->facility->name }}</td>
                                    <td>{{ $loan->facility->type }}</td>
                                    <td>{{ $loan->user->major }}</td>
                                    <td>{{ $loan->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection
@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#loans_table').DataTable();
        });
    </script>
@endsection
