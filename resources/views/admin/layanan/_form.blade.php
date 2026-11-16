{{--
    PARTIAL VIEW: form layanan (dipakai oleh halaman tambah dan edit)
    Variabel: $kategori (daftar kategori), $layanan (hanya ada saat edit)
--}}
@php $l = $layanan ?? null; @endphp

{{-- Tampilkan semua error validasi --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="nama_layanan" class="form-label">Nama layanan</label>
    <input type="text" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $l->nama_layanan ?? '') }}"
           class="form-control" placeholder="Contoh: Facial Glow" required>
</div>

<div class="mb-3">
    <label for="kategori" class="form-label">Kategori</label>
    <select id="kategori" name="kategori" class="form-select" required>
        <option value="">Pilih kategori</option>
        @foreach ($kategori as $k)
            <option value="{{ $k }}" {{ old('kategori', $l->kategori ?? '') == $k ? 'selected' : '' }}>{{ $k }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control"
              placeholder="Jelaskan manfaat dan isi perawatan">{{ old('deskripsi', $l->deskripsi ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="harga" class="form-label">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $l->harga ?? '') }}" class="form-control" min="0" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="durasi" class="form-label">Durasi (menit)</label>
        <input type="number" id="durasi" name="durasi" value="{{ old('durasi', $l->durasi ?? '') }}" class="form-control" min="1" required>
    </div>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status layanan</label>
    <select id="status" name="status" class="form-select" required>
        <option value="aktif" {{ old('status', $l->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ old('status', $l->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
</div>

{{-- Upload satu foto + pratinjau --}}
<div class="mb-4">
    <label for="foto" class="form-label">Foto layanan (JPG/PNG, maksimal 2 MB)</label>
    <img id="preview" src="{{ $l ? $l->foto_url : '' }}" alt="Pratinjau foto" class="thumb-besar {{ $l ? '' : 'd-none' }}">
    <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png" class="form-control" onchange="tampilPreview(this)">
    <div class="form-text">Kalau tidak diunggah, dipakai foto bawaan sesuai kategori.</div>
</div>

<script>
    // Menampilkan pratinjau foto yang dipilih sebelum disimpan
    function tampilPreview(input) {
        var img = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
                img.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
