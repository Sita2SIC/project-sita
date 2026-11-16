@extends('layouts.admin.app')

@section('title', 'Edit Foto Galeri | Noona Salon')

@section('content')
<div class="py-4">

    <div class="mb-4">
        <h1 class="judul-halaman">Edit foto.</h1>
        <p class="mb-0 text-muted">Ubah informasi foto atau ganti dengan foto baru.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Foto saat ini</label>
                    <img src="{{ $galeri->foto_url }}" alt="{{ $galeri->judul }}" class="thumb-besar">
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Ganti foto (opsional, JPG/PNG maksimal 2 MB)</label>
                    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" name="kategori" class="form-select" required>
                            @foreach ($kategori as $k)
                                <option value="{{ $k }}" {{ old('kategori', $galeri->kategori) == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Visibilitas</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="tampil" {{ old('status', $galeri->status) == 'tampil' ? 'selected' : '' }}>Tampilkan di galeri</option>
                            <option value="disembunyikan" {{ old('status', $galeri->status) == 'disembunyikan' ? 'selected' : '' }}>Sembunyikan</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
