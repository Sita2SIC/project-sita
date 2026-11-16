@extends('layouts.admin.app')

@section('title', 'Kelola Layanan | Noona Salon')

@section('content')
<div class="py-4">

    {{-- Header Page --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h1 class="judul-halaman">Kelola Layanan</h1>
            <p class="mb-0 text-muted">Menu perawatan yang sama ditampilkan pada halaman Layanan pelanggan.</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif
    @if (session('error'))
        <x-alert type="danger">{{ session('error') }}</x-alert>
    @endif

    {{-- FORM PENCARIAN DAN FILTER --}}
    <form method="GET" action="{{ route('admin.layanan.index') }}" class="row g-2 mb-3">
        <div class="col-md-5">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama layanan...">
        </div>
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua kategori</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">Semua status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- TABEL LAYANAN --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table tabel-noona mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Layanan</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td class="ps-3">
                                <img src="{{ $item->foto_url }}" alt="" class="thumb-layanan">
                                {{ $item->nama_layanan }}
                            </td>
                            <td>{{ $item->kategori }}</td>
                            <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->durasi }} menit</td>
                            <td><x-status-badge :status="$item->status" /></td>
                            <td>
                                <a href="{{ route('admin.layanan.edit', $item) }}" class="aksi-link">Edit</a>
                                &middot;
                                {{-- Hapus memakai form method DELETE + konfirmasi --}}
                                <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus layanan {{ $item->nama_layanan }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0 aksi-link text-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
