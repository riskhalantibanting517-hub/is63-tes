@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Data Mahasiswa</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mahasiswa
            </a>
        </div>
    </div>

                <div class="row mb-3">
                    <div class="col-md-7">
                        <form method="GET" action="{{ route('students.index') }}" class="d-flex" role="search" aria-label="Pencarian mahasiswa">
                            <label for="search" class="visually-hidden">Cari mahasiswa</label>
                            <input id="search" name="q" value="{{ $q ?? '' }}" class="form-control me-2" placeholder="Cari berdasarkan NIM, nama, email, atau jurusan" aria-label="Cari mahasiswa">
                            <select name="perPage" class="form-select form-select-sm me-2" aria-label="Jumlah per halaman">
                                @foreach([5,10,25,50] as $n)
                                    <option value="{{ $n }}" {{ (isset($perPage) && $perPage == $n) ? 'selected' : '' }}>{{ $n }} / halaman</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                            @if(!empty($q))
                                <a href="{{ route('students.index') }}" class="btn btn-link ms-2">Reset</a>
                            @endif
                        </form>
                    </div>
                    <div class="col-md-5 text-end text-muted align-self-center">
                        <small>Menampilkan {{ $students->total() }} hasil</small>
                        <a class="btn btn-sm btn-outline-secondary ms-2" href="{{ url('students/export') . (request()->getQueryString() ? ('?' . request()->getQueryString()) : '') }}">Export CSV</a>
                    </div>
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                            <th>No</th>
                            <th>
                                @php $dir = request('sort') == 'nim' && request('dir') == 'asc' ? 'desc' : 'asc'; @endphp
                                <a href="{{ route('students.index', array_merge(request()->except('page'), ['sort' => 'nim','dir'=>$dir])) }}">NIM @if(request('sort')=='nim') <i class="fas fa-sort-{{ request('dir')=='asc' ? 'up' : 'down' }}"></i> @endif</a>
                            </th>
                            <th>
                                @php $dir = request('sort') == 'name' && request('dir') == 'asc' ? 'desc' : 'asc'; @endphp
                                <a href="{{ route('students.index', array_merge(request()->except('page'), ['sort' => 'name','dir'=>$dir])) }}">Nama @if(request('sort')=='name') <i class="fas fa-sort-{{ request('dir')=='asc' ? 'up' : 'down' }}"></i> @endif</a>
                            </th>
                            <th>
                                @php $dir = request('sort') == 'email' && request('dir') == 'asc' ? 'desc' : 'asc'; @endphp
                                <a href="{{ route('students.index', array_merge(request()->except('page'), ['sort' => 'email','dir'=>$dir])) }}">Email @if(request('sort')=='email') <i class="fas fa-sort-{{ request('dir')=='asc' ? 'up' : 'down' }}"></i> @endif</a>
                            </th>
                            <th>
                                @php $dir = request('sort') == 'major' && request('dir') == 'asc' ? 'desc' : 'asc'; @endphp
                                <a href="{{ route('students.index', array_merge(request()->except('page'), ['sort' => 'major','dir'=>$dir])) }}">Jurusan @if(request('sort')=='major') <i class="fas fa-sort-{{ request('dir')=='asc' ? 'up' : 'down' }}"></i> @endif</a>
                            </th>
                            <th>Status</th>
                            <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                            <td><strong>{{ $student->nim }}</strong></td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->major }}</td>
                            <td>
                                @if ($student->status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif ($student->status == 'inactive')
                                    <span class="badge bg-warning">Tidak Aktif</span>
                                @else
                                    <span class="badge bg-info">Lulus</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Tidak ada data mahasiswa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $students->links() }}
    </div>
</div>
@endsection
