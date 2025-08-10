<div>
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1" class="text-sky-700">Identitas Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3" class="text-amber-700">
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
                <flux:table.row class="font-bold">
                    <flux:table.cell class="!text-lg">ID Pasien</flux:table.cell>
                    <flux:table.cell class="!text-lg" size="lg">P - {{ $patient->id }}</flux:table.cell>
                </flux:table.row>
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
            <flux:modal.trigger name="edit" class="me-4">
                <flux:button class="me-4" variant="primary" icon="pencil">Edit</flux:button>
            </flux:modal.trigger>
            <flux:modal.trigger name="daftar-periksa">
                <flux:button variant="primary" icon="stethoscope">Daftar Periksa</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    {{-- MODAL DAFTAR PERIKSA  --}}
    <flux:modal name="daftar-periksa" title="Daftar Periksa" class="max-w-xl !bg-amber-50">
        <form wire:submit.prevent="simpanPeriksa" class="space-y-4">
            <div>
                <flux:heading size="lg">Daftar Periksa</flux:heading>
                <flux:text class="mt-2">
                    Pendaftaran pemeriksaan atas nama {{ $patient->nama_lengkap }}
                </flux:text>
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
    {{-- MODAL EDIT  --}}
    <flux:modal name="edit" title="Edit Pasien" class="max-w-xl !bg-amber-50">
        <form wire:submit.prevent="simpan" class="space-y-4">
            <div>
                <flux:heading size="lg" class="text-sky-700">Edit Pasien</flux:heading>
                <flux:text class="mt-2 text-amber-700">Silahkan ubah data yang diperlukan</flux:text>
            </div>
            <flux:input label="Nama Lengkap" wire:model="nama_lengkap"/>
            <div class="flex flex-wrap gap-4">
                <div class="w-full sm:w-36">
                    <flux:field>
                        <flux:label>Jenis Kelamin</flux:label>
                        <flux:select wire:model="jenis_kelamin">
                            <option value="" >Pilih ...</option>
                            <flux:select.option value="L">Laki-laki</flux:select.option>
                            <flux:select.option value="P">Perempuan</flux:select.option>
                        </flux:select>
                        <flux:error name="jenis_kelamin" />
                    </flux:field>
                </div>

                <div class="flex-1 min-w-[160px]">
                    <flux:input label="Tempat Lahir" wire:model="tempat_lahir" />
                </div>

                <div class="flex-1 min-w-[160px]">
                    <flux:input type="date" label="Tanggal Lahir" wire:model="tanggal_lahir" />
                </div>
            </div>

            {{-- Baris 2: No HP dan NIK --}}
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[160px]">
                    <flux:input label="No. HP" wire:model="no_hp" />
                </div>

                <div class="flex-1 min-w-[160px]">
                    <flux:input label="NIK" wire:model="nik" />
                </div>
            </div>

            {{-- Alamat --}}
            <flux:textarea label="Alamat" rows="2" wire:model="alamat" />

            <div class="pt-4 flex justify-end">
                <flux:button type="submit" variant="primary">
                    Simpan Data Pasien
                </flux:button>
            </div>

        </form>
    </flux:modal>

    {{-- MODAL DAFTAR PERIKSA END --}}

</div>

