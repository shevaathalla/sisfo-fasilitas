@extends('layouts.admin')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Loans Tool Data') }}</h1>
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
                            <h4 class="mt-2">Loans Tool List</h4>
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <button data-toggle="modal" data-target="#modal-create" class="btn btn-success"> <i class="fa fa-plus-square mr-1"></i> <strong>  Add New Tool Loan</strong></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="loan_tool_table">
                        <thead class="font-weight-bold">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Pinjam</th>
                                <th>Status Peminjaman</th>
                                <th>Konfirmasi Pengembalian</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>{{ $loan->user->getFullNameAttribute() }}</td>
                                    <td>{{ $loan->tool->name }}</td>
                                    <td>{{ $loan->quantity }}</td>
                                    <td>
                                        <strong>
                                            @if ($loan->status)
                                                Sudah dikembalikan
                                            @else
                                                Masih dipinjam
                                            @endif
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        @if ($loan->status)
                                            <i class="fa fa-check fa-3x" aria-hidden="true"></i>
                                        @else
                                            <button class="btn btn-success btn-sm"
                                                data-target="#modal-confirm-{{ $loan->id }}" data-toggle="modal">
                                                <strong>
                                                    Konfirmasi pengembalian
                                                </strong>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#modal-show-{{ $loan->id }}"><i
                                                    class="fa fa-eye mr-1"></i>Show</button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-edit-{{ $loan->id }}"><i
                                                    class="fa fa-edit mr-1"></i>Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modal-delete-{{ $loan->id }}"><i
                                                    class="fa fa-trash mr-1"></i>Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach ($loans as $loan)
                        <!-- Modal Show -->
                        <div class="modal fade" id="modal-show-{{ $loan->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-show" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Loan Details</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4"><strong>Nama Mahasiswa</strong></div>
                                            <div class="col">: {{ $loan->user->getFullNameAttribute() }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Nama Barang</strong></div>
                                            <div class="col">: {{ $loan->tool->name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Jumlah Pinjam</strong></div>
                                            <div class="col">: {{ $loan->quantity }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Alasan</strong></div>
                                            <div class="col">: {{ $loan->reason }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Link Proposal</strong></div>
                                            <div class="col">: <a href="{{ $loan->proposal }}" target="_blank">{{ $loan->proposal }}</a></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Izin Fakultas</strong></div>
                                            <div class="col">: @if ($loan->faculty_verification)
                                                    <span class="badge badge-success">sudah diizinkan</span>
                                                @else
                                                    <span class="badge badge-danger">belum diizinkan</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Izin Jurusan</strong></div>
                                            <div class="col">: @if ($loan->department_verification)
                                                    <span class="badge badge-success">sudah diizinkan</span>
                                                @else
                                                    <span class="badge badge-danger">belum diizinkan</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Status Peminjaman</strong></div>
                                            <div class="col">: @if ($loan->status)
                                                    <span class="font-weight-bold">Sudah dikembalikan</span>
                                                @else
                                                    <span class="font-weight-bold">Masih dipinjam</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="modal-edit-{{ $loan->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="modal-edit-{{ $loan->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Update Loan
                                                Laboratorium Data</strong>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('loan.tool.update', $loan->id) }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="nim" class="col-form-label"> <strong>NIM
                                                        Mahasiswa:</strong></label>
                                                <input type="text" class="form-control" name="nim" id="nim"
                                                    value="{{ $loan->user->nim }}" placeholder="NIM Mahasiswa" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tool" class="col-form-label">
                                                    <strong>Tool:</strong></label>
                                                <select name="tool" id="tool" class="form-control"
                                                    required>
                                                    <option value="{{ $loan->tool_id }}" selected>
                                                        {{ $loan->tool->name }}</option>
                                                    @foreach ($tools as $tool)
                                                        <option value="{{ $tool->id }}">
                                                            {{ $tool->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Apabila alat yang diinginkan tidak ada di list ini
                                                    brarti sedang digunakan semua</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity" class="col-form-label"> <strong>Quantity:</strong></label>
                                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Tuliskan jumlah barang yang dipinjam"
                                                    value="{{ $loan->quantity }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="reason" class="col-form-label"> <strong>Alasan:</strong></label>
                                                <input type="text" class="form-control" name="reason" id="reason"
                                                    value="{{ $loan->reason }}" required>
                                                    <small class="form-text text-muted">Tuliskan alasan singkat kenapa meminjam alat yang
                                                        dipilih</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="proposal" class="col-form-label">
                                                    <strong>Proposal:</strong></label>
                                                <input type="text" class="form-control" name="proposal" id="proposal"
                                                    required value="{{ $loan->proposal }}">
                                                <small class="form-text text-muted">Masukkan link proposal pada field
                                                    diatas</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="faculty_verification" class="col-form-label"> <strong>Perizinan
                                                        Fakultas:</strong></label>
                                                <select class="form-control" name="faculty_verification"
                                                    id="faculty_verification" required>
                                                    <option value="1"
                                                        {{ $loan->faculty_verification ? 'selected' : '' }}>Diizinkan
                                                    </option>
                                                    <option value="0"
                                                        {{ !$loan->faculty_verification ? 'selected' : '' }}>Belum ada
                                                        Izin</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="department_verification" class="col-form-label">
                                                    <strong>Perizinan
                                                        Jurusan:</strong></label>
                                                <select class="form-control" name="department_verification"
                                                    id="department_verification" required>
                                                    <option value="1"
                                                        {{ $loan->department_verification ? 'selected' : '' }}>Diizinkan
                                                    </option>
                                                    <option value="0"
                                                        {{ !$loan->department_verification ? 'selected' : '' }}>Belum ada
                                                        Izin</option>
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
                        <div class="modal fade" id="modal-delete-{{ $loan->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete data with id:
                                            <strong>{{ $loan->id }}</strong>
                                        </h5>
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
                                        <form action="{{ route('loan.tool.destroy', $loan->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Loan Tool</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Confirm -->
                        <div class="modal fade" id="modal-confirm-{{ $loan->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm return item data with id:
                                            <strong>{{ $loan->id }}</strong>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>apakah barang / ruangan sudah selesai digunakan</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('loan.tool.confirm', $loan->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
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
                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Add New Loan Laboratorium</strong>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('loan.tool.store') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="nim" class="col-form-label"> <strong>NIM Mahasiswa:</strong></label>
                                <input type="text" class="form-control" name="nim" id="nim" placeholder="NIM Mahasiswa"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="tool" class="col-form-label"> <strong>Tool:</strong></label>
                                <select name="tool" id="tool" class="form-control" required>
                                    <option value="" selected disabled>Select tool</option>
                                    @foreach ($tools as $tool)
                                        <option value="{{ $tool->id }}">{{ $tool->name }} (stok:{{ $tool->stock }})</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Apabila alat yang diinginkan tidak ada di list ini
                                    brarti sedang digunakan semua</small>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-form-label"> <strong>Quantity:</strong></label>
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Tuliskan jumlah barang yang dipinjam"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="reason" class="col-form-label"> <strong>Alasan:</strong></label>
                                <input type="text" class="form-control" name="reason" id="reason" required>
                                <small class="form-text text-muted">Tuliskan alasan singkat kenapa meminjam alat yang
                                    dipilih</small>
                            </div>
                            <div class="form-group">
                                <label for="proposal" class="col-form-label"> <strong>Proposal:</strong></label>
                                <input type="text" class="form-control" name="proposal" id="proposal" required>
                                <small class="form-text text-muted">Masukkan link proposal pada field diatas</small>
                            </div>
                            <div class="form-group">
                                <label for="faculty_verification" class="col-form-label"> <strong>Perizinan
                                        Fakultas:</strong></label>
                                <select class="form-control" name="faculty_verification" id="faculty_verification"
                                    required>
                                    <option value="" selected disabled>Pilih salah satu</option>
                                    <option value="1">Diizinkan</option>
                                    <option value="0">Belum ada Izin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department_verification" class="col-form-label"> <strong>Perizinan
                                        Jurusan:</strong></label>
                                <select class="form-control" name="department_verification" id="department_verification"
                                    required>
                                    <option value="" selected disabled>Pilih salah satu</option>
                                    <option value="1">Diizinkan</option>
                                    <option value="0">Belum ada Izin</option>
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
            $('#loan_tool_table').DataTable();
        });
    </script>
@endsection
