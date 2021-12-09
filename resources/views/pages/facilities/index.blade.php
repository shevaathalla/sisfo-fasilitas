@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Facilities Data') }}</h1>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="mt-2">Facilities List</h4>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <a href="#" class="btn btn-success">Create New Facility</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless" id="facilities_table">
                        <thead class="font-weight-bold">
                            <tr>
                                <td>Nama Fasilitas</td>                                
                                <td>Tipe Fasilitas</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $facility)
                                <tr>
                                    <td>{{ $facility->name }}</td>                                    
                                    <td>{{ $facility->type }}</td>                                    
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
            $('#facilities_table').DataTable();
        });
    </script>
@endsection
