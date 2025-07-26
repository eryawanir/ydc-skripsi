<div>
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Identitas Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Digunakan sebagai referensi untuk layanan kesehatan lebih lanjut
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>



    <div class="max-w-xl">
        @if (session('status'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 1850)"
                x-show="show"
                x-transition.opacity.duration.500ms
                class="mt-4"
            >
                <flux:callout
                    variant="success"
                    icon="check-circle"
                    heading="{{ session('status') }}"
                />
            </div>
        @endif
        <flux:table>
            <flux:table.rows>
                <flux:table.row>
                    <flux:table.cell>Nama Lengkap</flux:table.cell>
                    <flux:table.cell>{{ $patient->nama_lengkap }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Jenis Kelamin</flux:table.cell>
                    <flux:table.cell>{{ $patient->jenis_kelamin }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Tempat Tanggal Lahir</flux:table.cell>
                    <flux:table.cell>{{ $patient->tempat_lahir }}, {{ $patient->tanggal_lahir }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Umur</flux:table.cell>
                    <flux:table.cell>{{ $patient->umur }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>No Handphone</flux:table.cell>
                    <flux:table.cell>{{ $patient->no_hp }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>NIK</flux:table.cell>
                    <flux:table.cell>{{ $patient->nik }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Alamat</flux:table.cell>
                    <flux:table.cell>{{ $patient->alamat }}</flux:table.cell>
                </flux:table.row>
            </flux:table.rows>
        </flux:table>
        <div class="flex justify-end mt-6">
            <flux:modal.trigger name="daftar-periksa">
                <flux:button>Daftar Periksa</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    {{-- MODAL DAFTAR PERIKSA  --}}
    <flux:modal name="daftar-periksa" title="Daftar Periksa" class="max-w-xl">
        <form wire:submit.prevent="simpanPeriksa" class="space-y-4">
                <div>
            <flux:heading size="lg">Daftar Periksa</flux:heading>
            <flux:text class="mt-2">Pendaftaran pemeriksaan atas nama {{ $patient->nama_lengkap }}</flux:text>
        </div>
            <flux:input
                wire:model.defer="waktuKedatangan"
                label="Waktu Kedatangan"
                type="datetime-local"
            />

            <flux:textarea
                wire:model.defer="keluhan"
                label="Keluhan"
                placeholder="Masukkan keluhan pasien"
            />

            <flux:select
                wire:model.defer="dokterId"
                label="Pilih Dokter"
            >
                <option value="">-- Pilih Dokter --</option>
                @foreach (\App\Models\Dokter::all() as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                @endforeach
            </flux:select>

            <div class="flex justify-end mt-4">
                <flux:button type="submit" variant="primary">
                    Daftar
                </flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- MODAL DAFTAR PERIKSA END --}}

</div>

