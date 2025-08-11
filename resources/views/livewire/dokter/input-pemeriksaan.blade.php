<div class="space-y-4">

    {{-- HEADER --}}
    <div class="space-y-1">
        <flux:heading size="xl" class="text-sky-700">Input Pemeriksaan</flux:heading>
        <flux:subheading size="lg" class="text-amber-700">
            {{ $periksa->patient->nama_lengkap }},
           {{ $periksa->patient->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
          @if ($periksa->patient->tanggal_lahir)
        , {{ \Carbon\Carbon::parse($periksa->patient->tanggal_lahir)->age }} tahun
    @endif
            </flux:subheading>
        <flux:separator />
    </div>

    <div class="max-w-2xl space-y-4">

        {{-- INFORMASI PASIEN --}}
        <flux:card size="sm">
            <flux:heading size="md">Keluhan</flux:heading>
            <flux:text class="mt-2">
                <p>{{ $periksa->keluhan }}</p>
            </flux:text>
        </flux:card>

        {{-- INPUT DIAGNOSA --}}
        <div class="space-y-2">
            <flux:textarea
                label="Keterangan Diagnosa"
                rows="2"
                wire:model.defer="diagnosa"
            />
        </div>

        {{-- DAFTAR TINDAKAN + MODAL --}}
        <div class="space-y-3">

            {{-- Heading & Tombol Modal --}}
            <div class="flex items-center gap-3">
                <flux:heading size="md">Daftar Tindakan</flux:heading>

                <flux:modal.trigger name="tambah-tindakan">
                    <flux:button size="sm" variant="primary" icon="plus">
                        Tambah Tindakan
                    </flux:button>
                </flux:modal.trigger>
            </div>

            {{-- MODAL TAMBAH TINDAKAN --}}
            <flux:modal name="tambah-tindakan" class="md:w-96">
                <div class="space-y-6">
                    <div>
                        <flux:heading size="lg">Tambah Tindakan</flux:heading>
                        <flux:text class="mt-2">Menambahkan tindakan selama pemeriksaan</flux:text>
                    </div>

                    <flux:input
                        label="Lokasi"
                        placeholder="Contoh: Gigi kanan bawah"
                        wire:model.defer="lokasi"
                    />
<div class="space-y-1">
    <flux:label>Tindakan</flux:label>
    <flux:select
        variant="listbox"
        searchable
        placeholder="Pilih layanan tindakan..."
        wire:model.defer="layanan_id"
    >
        <flux:select.option value="">-- Pilih --</flux:select.option>
        @foreach ($layanans as $layanan)
            <flux:select.option value="{{ $layanan->id }}">
                {{ $layanan->nama }} - Rp{{ number_format($layanan->harga, 0, ',', '.') }}
            </flux:select.option>
        @endforeach
    </flux:select>
    <flux:error name="layanan_id" />
</div>


                    <div class="flex">
                        <flux:spacer />
                        <flux:button variant="primary" wire:click="simpanTindakan">
                            Tambah
                        </flux:button>
                    </div>
                </div>
            </flux:modal>

            {{-- TABEL TINDAKAN --}}
         <flux:card size="sm">
    @if (empty($tindakanList))
        <p class="text-sm italic text-zinc-500 px-4 py-2">Belum ada tindakan.</p>
    @else
        <flux:table>
            <flux:table.columns>
                <flux:table.column>No</flux:table.column>
                <flux:table.column>Layanan</flux:table.column>
                <flux:table.column>Lokasi</flux:table.column>
                <flux:table.column>Aksi</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($tindakanList as $i => $tindakan)
                    <flux:table.row>
                        <flux:table.cell>{{ $i + 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $tindakan['nama'] }}</flux:table.cell>
                        <flux:table.cell>{{ $tindakan['lokasi'] }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:button size="xs" variant="danger" wire:click="hapusTindakan({{ $i }})">
                                Hapus
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    @endif
</flux:card>


        </div>

        {{-- TOMBOL SELESAI --}}
        <div class="pt-1 flex justify-end">
            <flux:button variant="primary" wire:click="simpan">
                Pemeriksaan selesai
            </flux:button>
        </div>

    </div>
</div>
