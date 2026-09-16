@extends('layouts.app')

@section('title', 'Proses Pengembalian')

@section('content')
<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.pengembalian.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Pilih Transaksi Peminjaman (Aktif)</label>
                    <select name="peminjaman_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm bg-white">
                        <option value="">-- Pilih Peminjam & Tanggal Rencana --</option>
                        @foreach($peminjamans as $pinjam)
                            <option value="{{ $pinjam->id }}" {{ old('peminjaman_id') == $pinjam->id ? 'selected' : '' }}>
                                {{ $pinjam->user->name ?? 'User' }} - (Rencana Kembali: {{ $pinjam->tgl_kembali_plan }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Tanggal Pengembalian Aktual</label>
                    <input type="date" name="tgl_kembali" value="{{ old('tgl_kembali', date('Y-m-d')) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Kondisi Alat Saat Kembali</label>
                    <input type="text" name="kondisi_kembali" value="{{ old('kondisi_kembali', 'Baik') }}" required placeholder="Contoh: Baik, Rusak Ringan"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                </div>

                <div class="mb-2">
                    <label class="block text-gray-700 text-xs font-bold uppercase mb-2">Denda Tambahan (Opsional, misal: Alat Rusak/Hilang)</label>
                    <input type="number" name="denda_tambahan" value="{{ old('denda_tambahan', 0) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                </div>

                <p class="text-xs text-gray-400 mb-6 italic">
                    *Denda keterlambatan hari akan dihitung otomatis oleh sistem jika melewati tanggal rencana kembali.
                </p>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.pengembalian.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-semibold transition">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                        Proses Pengembalian
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-gray-100 rounded-lg border border-gray-200 hidden md:block"></div>
    </div>
</div>
@endsection