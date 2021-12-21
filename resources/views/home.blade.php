@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Account Status</h6>
                </div>
                <div class="card-body">
                    <p>Welcome {{ auth()->user()->getFullNameAttribute() }}</p>
                    <p class="mb-0">Currently your access is <strong>{{ auth()->user()->type }}</strong></p>
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-4">

        <!-- Total Facilities Card Example -->
        <div class="col">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Laboratorium</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['laboratoria']->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-door-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Facilities Card Example -->
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Tools</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['tools']->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Users') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="card border-primary shadow text-center">
                <div class="card-body">
                    <h5 class="text-primary font-weight-bold"> Ajukan peminjaman barang</h5>
                </div>
                <div class="card-footer">
                    <button data-toggle="modal" data-target="#modal-create-tool" class="btn btn-block btn-primary">
                        Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success shadow text-center">
                <div class="card-body">
                    <h5 class="text-success font-weight-bold"> Ajukan peminjaman laboratorium</h5>
                </div>
                <div class="card-footer">
                    <button data-toggle="modal" data-target="#modal-create-laboratorium" class="btn btn-block btn-success">
                        Tambah
                    </button>
                </div>
            </div>
        </div>
        <!-- Modal Create Loan Tool-->
        <div class="modal fade" id="modal-create-tool" tabindex="-1" role="dialog" aria-labelledby="modal-create"
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
                    <form action="{{ route('dashboard.loan.tool') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="tool" class="col-form-label"> <strong>Tool:</strong></label>
                                <select name="tool" id="tool" class="form-control" required>
                                    <option value="" selected disabled>Select tool</option>
                                    @foreach ($widget['tools'] as $tool)
                                        <option value="{{ $tool->id }}">{{ $tool->name }}
                                            (stok:{{ $tool->stock }})</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Apabila alat yang diinginkan tidak ada di list ini
                                    brarti sedang digunakan semua</small>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-form-label"> <strong>Quantity:</strong></label>
                                <input type="number" class="form-control" name="quantity" id="quantity"
                                    placeholder="Tuliskan jumlah barang yang dipinjam" required>
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
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Create Loan Laboratorium-->
        <div class="modal fade" id="modal-create-laboratorium" tabindex="-1" role="dialog"
            aria-labelledby="modal-create" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Add New Loan Laboratorium</strong>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('dashboard.loan.laboratorium') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="laboratorium" class="col-form-label"> <strong>Laboratorium:</strong></label>
                                <select name="laboratorium" id="laboratorium" class="form-control" required>
                                    <option value="" selected disabled>Select laboratorium</option>
                                    @foreach ($widget['laboratoria'] as $laboratorium)
                                        <option value="{{ $laboratorium->id }}">{{ $laboratorium->name }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Apabila lab yang diinginkan tidak ada di list ini
                                    brarti lab sedang digunakan</small>
                            </div>
                            <div class="form-group">
                                <label for="reason" class="col-form-label"> <strong>Alasan:</strong></label>
                                <input type="text" class="form-control" name="reason" id="reason" required>
                                <small class="form-text text-muted">Tuliskan alasan singkat kenapa meminjam lab yang
                                    dipilih</small>
                            </div>
                            <div class="form-group">
                                <label for="proposal" class="col-form-label"> <strong>Proposal:</strong></label>
                                <input type="text" class="form-control" name="proposal" id="proposal" required>
                                <small class="form-text text-muted">Masukkan link proposal pada field diatas</small>
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
    <h1 class="h3 mb-4 text-gray-800">{{ __('Loans History') }}</h1>
    <hr>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Peminjaman Barang</h4>
                </div>
                <div class="card-body">
                    <table class="table text-center" id="loan_tool_table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Status Pengembalian</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->loanTools()->with('tool')->get() as $loan)
                                <tr>
                                    <td>{{ $loan->tool->name }}</td>
                                    <td>{{ $loan->quantity }}</td>
                                    <td>
                                        <strong>
                                            @if ($loan->status)
                                                Sudah Dikembalikan
                                            @else
                                                Masih dipinjam
                                            @endif
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-show-tool-{{ $loan->id }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach (auth()->user()->loanTools()->with('tool')->get() as $loan)
                        <!-- Modal Show Loan Tool-->
                        <div class="modal fade" id="modal-show-tool-{{ $loan->id }}" tabindex="-1" role="dialog"
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
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Peminjaman Laboratorium</h4>
                </div>
                <div class="card-body">
                    <table class="table text-center" id="loan_laboratorium_table">
                        <thead>
                            <tr>
                                <th>Nama Laboratorium</th>
                                <th>Status Pengembalian</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth()->user()->loanLaboratoria()->with('laboratorium')->get()
        as $loan)
                                <tr>
                                    <td>{{ $loan->laboratorium->name }}</td>
                                    <td>
                                        <strong>
                                            @if ($loan->status)
                                                Sudah Dikembalikan
                                            @else
                                                Masih dipinjam
                                            @endif
                                        </strong>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-show-laboratorium-{{ $loan->id }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @foreach (auth()->user()->loanLaboratoria()->with('laboratorium')->get()
                    as $loan)
                         <!-- Modal Show Loan Laboratorium -->
                         <div class="modal fade" id="modal-show-laboratorium-{{ $loan->id }}" tabindex="-1" role="dialog"
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
                                            <div class="col-md-4"><strong>Nama Laboratorium</strong></div>
                                            <div class="col">: {{ $loan->laboratorium->name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Alasan</strong></div>
                                            <div class="col">: {{ $loan->reason }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><strong>Link Proposal</strong></div>
                                            <div class="col">: <a href="{{ $loan->proposal }}"
                                                    target="_blank">{{ $loan->proposal }}</a></div>
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
                    @endforeach
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
            $('#loan_laboratorium_table').DataTable();

        });
    </script>
@endsection
