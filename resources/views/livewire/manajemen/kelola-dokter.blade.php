<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <flux:heading size="xl">Kelola dokter</flux:heading>
        <flux:subheading size="lg">Daftar dokterr</flux:subheading>
        <flux:separator />
    </div>

    {{-- TOMBOL TAMBAH (MODAL TRIGGER) --}}
    <flux:modal.trigger name="form-dokter">
        <flux:button wire:click="resetInput" icon="plus" variant="outline">
            Tambah dokter
        </flux:button>
    </flux:modal.trigger>

    {{-- TABEL dokter --}}
    <flux:card class="max-w-3xl">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Nama dokter</flux:table.column>
                <flux:table.column>Jenis Kelamin</flux:table.column>
                <flux:table.column>Alamat</flux:table.column>
                <flux:table.column>No Hp</flux:table.column>
                <flux:table.column>Aksi</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($dokters as $index => $dokter)
                    <flux:table.row>
                        <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->nama }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->jenis_kelamin }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->alamat }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->no_hp }}</flux:table.cell>

                        <flux:table.cell>
                            <flux:modal.trigger name="form-dokter">
                                <flux:button size="xs" wire:click="edit({{ $dokter->id }})">Edit</flux:button>
                            </flux:modal.trigger>

                            <flux:button size="xs" variant="danger" wire:click="confirmHapus({{ $dokter->id }})">
                                Hapus
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>

    {{-- MODAL TAMBAH/EDIT --}}
<flux:modal name="form-dokter" class="md:w-[36rem]">
    <div class="space-y-3">
        <div>
            <flux:heading size="lg">{{ $isEdit ? 'Edit Dokter' : 'Tambah Dokter' }}</flux:heading>
            <flux:text class="mt-2">Lengkapi informasi lengkap dokter.</flux:text>
        </div>

        <flux:input label="Nama Lengkap" wire:model.defer="nama" />

        {{-- No Sertifikat & Status SIP --}}
        <div class="flex gap-4">
            <div class="w-1/2">
                <flux:input label="No. Sertifikat" wire:model.defer="no_sertifikat" />
            </div>
            <div class="w-1/2">
                <flux:select label="Status SIP" wire:model.defer="status_sip">
                    <option value="">Pilih Status SIP</option>
                    <option value="sip">SIP</option>
                    <option value="non-sip">Non SIP</option>
                </flux:select>
            </div>
        </div>

        {{-- Jenis Kelamin, Tempat Lahir, Tanggal Lahir --}}
        <div class="flex gap-4">
            <div class="w-1/3">
                <flux:select label="Jenis Kelamin" wire:model.defer="jenis_kelamin">
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </flux:select>
            </div>
            <div class="w-1/3">
                <flux:input label="Tempat Lahir" wire:model.defer="tempat_lahir" />
            </div>
            <div class="w-1/3">
                <flux:date-picker label="Tanggal Lahir" wire:model.defer="tanggal_lahir" />
            </div>
        </div>

        {{-- No HP & NIK --}}
        <div class="flex gap-4">
            <div class="w-1/2">
                <flux:input label="No. HP" wire:model.defer="no_hp" />
            </div>
            <div class="w-1/2">
                <flux:input label="NIK" wire:model.defer="nik" />
            </div>
        </div>

        <flux:textarea label="Alamat" wire:model.defer="alamat" rows="1"/>


        <div class="flex">
            <flux:spacer />
            <flux:button wire:click="simpan" variant="primary">
                Simpan
            </flux:button>
        </div>
    </div>
</flux:modal>


</div>
