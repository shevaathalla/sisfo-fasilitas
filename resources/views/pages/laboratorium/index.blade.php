@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Laboratoria Data') }}</h1>
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="mt-2">Laboratoria List</h4>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-create"> <i
                                        class="fa fa-plus-square mr-1"></i> Add New Laboratorium</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="laboratoria_table">
                        <thead class="font-weight-bold">
                            <tr>
                                <td>Nama Laboratorium</td>
                                <td>Status Laboratorium</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laboratoria as $laboratorium)
                                <tr>
                                    <td>{{ $laboratorium->name }}</td>
                                    <td><span
                                            class="badge {{ $laboratorium->status == 'available' ? 'badge-success' : 'badge-danger' }}">{{ $laboratorium->status }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modal-edit-{{ $laboratorium->id }}"><i
                                                    class="fa fa-edit mr-1"></i>Edit</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modal-delete-{{ $laboratorium->id }}"><i
                                                    class="fa fa-trash mr-1"></i>Delete</button>
                                        </div>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($laboratoria as $laboratorium)
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modal-edit-{{ $laboratorium->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-edit" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Add New
                                                Laboratorium</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('laboratorium.update', $laboratorium->id) }}" method="post">
                                        <div class="modal-body">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="col-form-label"> <strong>Nama
                                                        Laboratorium:</strong></label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="Nama Laboratorium" value="{{ $laboratorium->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-form-label"> <strong>Select
                                                        Status:</strong></label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="available"
                                                        {{ $laboratorium->status == 'available' ? 'selected' : '' }}>
                                                        Available</option>
                                                    <option value="unavailable"
                                                        {{ $laboratorium->status == 'unavailable' ? 'selected' : '' }}>Unavailable
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Delete -->
                        <div class="modal fade" id="modal-delete-{{ $laboratorium->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete data with name:
                                            <strong>{{ $laboratorium->name }}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure want to delete this record, the deleted is cannot be restored</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('laboratorium.destroy', $laboratorium->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Laboratorium</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Modal Create -->
        <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Add New Laboratorium</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('laboratorium.store') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label"> <strong>Nama Laboratorium:</strong></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Nama Laboratorium" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
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
            $('#laboratoria_table').DataTable();
        });
    </script>
@endsection
