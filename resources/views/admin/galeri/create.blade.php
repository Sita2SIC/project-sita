@extends('layouts.admin.app')

@section('title', 'Unggah Foto Galeri | Noona Salon')

@section('content')
<div class="py-4">

    <div class="mb-4">
        <h1 class="judul-halaman">Tambahkan momen baru.</h1>
        <p class="mb-0 text-muted">Unggah beberapa foto sekaligus. Semua foto memakai judul, kategori, dan visibilitas yang sama.</p>
    </div>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- enctype multipart wajib untuk upload file --}}
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">

            {{-- Kolom kiri: area unggah banyak foto --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4">Foto galeri</h2>

                        {{-- name="foto[]" + multiple = bisa memilih banyak file --}}
                        <label for="foto" class="dropzone-noona">
                            <strong>Pilih beberapa foto sekaligus</strong><br>
                            <span class="small text-muted">JPG atau PNG, maksimal 2 MB per foto, maksimal 10 foto</span>
                            <input type="file" id="foto" name="foto[]" accept=".jpg,.jpeg,.png" multiple class="d-none" onchange="tampilPreview(this)">
                        </label>

                        <div id="jumlah" class="small text-muted mt-2"></div>
                        <div id="preview" class="preview-grid"></div>
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: informasi foto --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h4">Informasi foto</h2>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul / koleksi</label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="form-control"
                                   placeholder="Contoh: Momen perawatan Oktober" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select id="kategori" name="kategori" class="form-select" required>
                                <option value="">Pilih kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Visibilitas</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="tampil" {{ old('status', 'tampil') == 'tampil' ? 'selected' : '' }}>Tampilkan di galeri</option>
                                <option value="disembunyikan" {{ old('status') == 'disembunyikan' ? 'selected' : '' }}>Sembunyikan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan ke Galeri</button>
        </div>
    </form>
</div>

<script>
    // Menampilkan pratinjau semua foto yang dipilih
    function tampilPreview(input) {
        var area = document.getElementById('preview');
        area.innerHTML = '';
        document.getElementById('jumlah').textContent = input.files.length + ' foto dipilih';

        Array.from(input.files).forEach(function (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                area.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
