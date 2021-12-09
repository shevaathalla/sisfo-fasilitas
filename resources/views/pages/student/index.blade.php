@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Student Data') }}</h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Students List
                </div>
                <div class="card-body">
                    <table class="table table-borderless" id="student_table">
                        <thead class="font-weight-bold">
                            <tr>
                                <td>NIM</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Jurusan</td>
                                <td>Fakultas</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->nim }}</td>
                                    <td>{{ $student->getFullNameAttribute() }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->major }}</td>
                                    <td>{{ $student->faculty }}</td>
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
            $('#student_table').DataTable();
        });
    </script>
@endsection
