<div class="space-y-6">

    {{-- HEADER --}}
    <div class="space-y-2">
        <flux:heading size="xl" level="1">Sortir Bagi Hasil</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Daftar bagi hasil antara dokter dan klinik berdasarkan layanan.
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- FILTER --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-5xl items-end">

    {{-- PILIH DOKTER --}}
    <flux:select variant="listbox" placeholder="Semua Dokter" wire:model.defer="dokterId">
        <flux:select.option value="">Semua Dokter</flux:select.option>
        @foreach ($listDokter as $dokter)
            <flux:select.option value="{{ $dokter->id }}">{{ $dokter->nama }}</flux:select.option>
        @endforeach
    </flux:select>

    {{-- RENTANG TANGGAL --}}
    <flux:date-picker
        mode="range"
        with-presets
        placeholder="Pilih rentang waktu"
        wire:model.defer="tanggalRange"
    />

    {{-- TOMBOL --}}
    <flux:button  wire:click="ambilDataRekap">
        Terapkan Filter
    </flux:button>

</div>


    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
        <flux:card>
            <flux:heading size="md">Kunjungan Pasien</flux:heading>
            <flux:heading size="xl" class="text-gray-300 font-extrabold">{{ $totalKunjungan }}</flux:heading>
        </flux:card>

        <flux:card>
            <flux:heading size="md">Tindakan</flux:heading>
            <flux:heading size="xl" class="text-gray-300 font-extrabold">{{ $totalTindakan }}</flux:heading>
        </flux:card>

        <flux:card>
            <flux:heading size="md">Total Masuk</flux:heading>
            <flux:heading size="lg" class="text-gray-300 font-extrabold">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</flux:heading>
        </flux:card>

        <flux:card>
            <flux:heading size="md">Dokter</flux:heading>
            <flux:heading size="lg" class="text-gray-300 font-extrabold">Rp {{ number_format($totalDokter, 0, ',', '.') }}</flux:heading>
        </flux:card>

        <flux:card>
            <flux:heading size="md">Klinik</flux:heading>
            <flux:heading size="lg" class="text-gray-300 font-extrabold">Rp {{ number_format($totalKlinik, 0, ',', '.') }}</flux:heading>
        </flux:card>
    </div>

    {{-- TABEL BAGI HASIL --}}
    <div class="mt-6 px-3">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Dokter</flux:table.column>
                <flux:table.column>Layanan</flux:table.column>
                <flux:table.column>Uang Masuk</flux:table.column>
                <flux:table.column>Fee Dokter</flux:table.column>
                <flux:table.column>Pendapatan Klinik</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($rekap as $index => $item)
                    <flux:table.row>
                        <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $item['dokter'] }}</flux:table.cell>
                        <flux:table.cell>{{ $item['layanan'] }}</flux:table.cell>
                        <flux:table.cell>Rp {{ number_format($item['uang_masuk'], 0, ',', '.') }}</flux:table.cell>
                        <flux:table.cell>Rp {{ number_format($item['fee_dokter'], 0, ',', '.') }}</flux:table.cell>
                        <flux:table.cell>Rp {{ number_format($item['pendapatan_klinik'], 0, ',', '.') }}</flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6" class="text-center">Tidak ada data ditemukan.</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        {{-- Jika pakai pagination nanti bisa aktifkan --}}
        {{-- <flux:pagination :paginator="$rekap" /> --}}
    </div>

</div>
