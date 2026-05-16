@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Detail Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">NIM</h6>
                            <p class="h5"><strong>{{ $student->nim }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Status</h6>
                            <p>
                                @if ($student->status == 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif ($student->status == 'inactive')
                                    <span class="badge bg-warning">Tidak Aktif</span>
                                @else
                                    <span class="badge bg-info">Lulus</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Nama</h6>
                            <p class="h6">{{ $student->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Email</h6>
                            <p class="h6">{{ $student->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Jurusan</h6>
                            <p class="h6">{{ $student->major }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Telepon</h6>
                            <p class="h6">{{ $student->phone ?? 'Tidak ada' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Tanggal Lahir</h6>
                            <p class="h6">{{ $student->birth_date ? $student->birth_date->translatedFormat('d F Y') : 'Tidak ada' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Jenis Kelamin</h6>
                            <p class="h6">
                                @if ($student->gender == 'male')
                                    Laki-laki
                                @elseif ($student->gender == 'female')
                                    Perempuan
                                @else
                                    Tidak ada
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Alamat</h6>
                        <p class="h6">{{ $student->address ?? 'Tidak ada' }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Kota</h6>
                            <p class="h6">{{ $student->city ?? 'Tidak ada' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Provinsi</h6>
                            <p class="h6">{{ $student->province ?? 'Tidak ada' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
