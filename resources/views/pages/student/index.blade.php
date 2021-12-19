@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Student Data') }}</h1>
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
                            <h4 class="mt-2">Students List</h4>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-create"> <i
                                        class="fa fa-plus-square mr-1"></i>New Student</button>
                            </div>
                        </div>
                    </div>
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
                                <td>Action</td>
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
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-show-{{ $student->id }}"><i
                                                    class="fa fa-eye mr-1"></i>Show</button>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modal-edit-{{ $student->id }}"><i
                                                    class="fa fa-edit mr-1"></i>Edit</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modal-delete-{{ $student->id }}"><i
                                                    class="fa fa-trash mr-1"></i>Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($students as $student)
                        <!-- Modal Show -->
                        <div class="modal fade" id="modal-show-{{ $student->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-show" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Student Details</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3"><strong>Nama</strong></div>
                                            <div class="col">: {{ $student->name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><strong>NIM</strong></div>
                                            <div class="col">: {{ $student->nim }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><strong>Email</strong></div>
                                            <div class="col">: {{ $student->email }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><strong>Jurusan</strong></div>
                                            <div class="col">: {{ $student->major }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><strong>Fakultas</strong></div>
                                            <div class="col">: {{ $student->faculty }}</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modal-edit-{{ $student->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-edit" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Student Data:
                                            <strong>{{ $student->name }}</strong>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('student.update', $student->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name" class="col-form-label"> <strong>Nama
                                                        Mahasiswa:</strong></label>
                                                <input type="text" class="form-control"
                                                    value="{{ $student->getFullNameAttribute() }}" name="name" id="name"
                                                    placeholder="Nama Mahasiswa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nim" class="col-form-label"> <strong>NIM:</strong></label>
                                                <input type="text" class="form-control" name="nim" id="nim"
                                                    value="{{ $student->nim }}" placeholder="NIM" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-form-label"> <strong>Email:</strong></label>
                                                <input type="text" class="form-control" name="email" id="email"
                                                    placeholder="Email" value="{{ $student->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="major" class="col-form-label"> <strong>Jurusan:</strong></label>
                                                <select name="major" id="major" class="form-control" required>
                                                    <option value="Teknik Informatika"
                                                        {{ $student->major == 'Teknik Informatika' ? 'selected' : '' }}>
                                                        Teknik Informatika</option>
                                                    <option value="Fisika"
                                                        {{ $student->major == 'Fisika' ? 'selected' : '' }}>Fisika
                                                    </option>
                                                    <option value="Matematika"
                                                        {{ $student->major == 'Matematika' ? 'selected' : '' }}>
                                                        Matematika</option>
                                                    <option value="Biologi"
                                                        {{ $student->major == 'Biologi' ? 'selected' : '' }}>Biologi
                                                    </option>
                                                    <option value="Bahasa Arab"
                                                        {{ $student->major == 'Bahasa Arab' ? 'selected' : '' }}>
                                                        Bahasa Arab</option>
                                                    <option value="Bahasa Inggris"
                                                        {{ $student->major == 'Bahasa Inggris' ? 'selected' : '' }}>
                                                        Bahasa Inggris</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="faculty" class="col-form-label">
                                                    <strong>Faculty:</strong></label>
                                                <select name="faculty" id="faculty" class="form-control" required>
                                                    <option value="Saintek"
                                                        {{ $student->faculty == 'Saintek' ? 'selected' : '' }}>
                                                        Saintek</option>
                                                    <option value="Humaniora"
                                                        {{ $student->faculty == 'Humaniora' ? 'selected' : '' }}>
                                                        Humaniora</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Delete -->
                        <div class="modal fade" id="modal-delete-{{ $student->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete data with name:
                                            <strong>{{ $student->getFullNameAttribute() }}</strong></h5>
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
                                        <form action="{{ route('student.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Student</button>
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
                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Add New Student</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('student.store') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="col-form-label"> <strong>Nama Mahasiswa:</strong></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Mahasiswa"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="nim" class="col-form-label"> <strong>NIM:</strong></label>
                                <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label"> <strong>Email:</strong></label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="major" class="col-form-label"> <strong>Jurusan:</strong></label>
                                <select name="major" id="major" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Fisika">Fisika</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Biologi">Biologi</option>
                                    <option value="Bahasa Arab">Bahasa Arab</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="faculty" class="col-form-label"> <strong>Faculty:</strong></label>
                                <select name="faculty" id="faculty" class="form-control" required>
                                    <option value="" disabled selected>Pilih Fakultas</option>
                                    <option value="Saintek">Saintek</option>
                                    <option value="Humaniora">Humaniora</option>
                                </select>
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
            $('#student_table').DataTable({                
            });
        });
    </script>
@endsection
