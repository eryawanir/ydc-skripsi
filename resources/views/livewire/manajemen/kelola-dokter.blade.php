<div>

    {{-- HEADER --}}
    <div class="space-y-2 mb-3">
        <flux:heading size="xl" level="1" class="text-sky-700">Kelola Dokter</flux:heading>
        <flux:subheading size="lg" class=" text-amber-700">
            Daftar dokter yang terdaftar pada Klinik Yusti Dental Care
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- TOMBOL TAMBAH (MODAL TRIGGER) --}}
    <flux:modal.trigger name="form-dokter">
        <flux:button icon="plus" variant="primary">
            Tambah dokter
        </flux:button>
    </flux:modal.trigger>

    {{-- TABEL dokter --}}
    <div class="max-w-2xl">
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
                    <flux:table.row :key="$dokter->id">
                        <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->nama }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->jenis_kelamin }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->alamat }}</flux:table.cell>
                        <flux:table.cell>{{ $dokter->no_hp }}</flux:table.cell>

                        <flux:table.cell>
                            <flux:modal.trigger name="form-dokter">
                                <flux:button size="xs" variant="primary" wire:click="edit({{ $dokter->id }})">Edit</flux:button>
                            </flux:modal.trigger>

                            <flux:button size="xs" variant="danger" wire:click="confirmHapus({{ $dokter->id }})">
                                Hapus
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>

    {{-- MODAL TAMBAH/EDIT --}}
<flux:modal name="form-dokter" class="md:w-[36rem] !bg-amber-50" wire:close="resetInput">
    <div class="space-y-3">
        <div>
            <flux:heading size="lg" class="text-sky-700">{{ $isEdit ? 'Edit Dokter' : 'Tambah Dokter' }}</flux:heading>
            <flux:text class="mt-2 text-amber-700">Lengkapi informasi lengkap dokter.</flux:text>
        </div>

        <flux:input label="Nama Lengkap" wire:model.defer="nama" />

        {{-- No Sertifikat & Status SIP --}}
        <div class="flex gap-4">
            <div class="w-1/2">
                <flux:input label="No. Sertifikat" wire:model.defer="no_sertifikat" />
            </div>
            <div class="w-1/2">
                <flux:select label="Status SIP" wire:model.defer="tipe_dokter">
                    <option value="">Pilih Status SIP</option>
                    <option value="1">SIP</option>
                    <option value="2">Non SIP</option>
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
                <flux:input type="date" label="Tanggal Lahir" wire:model.defer="tanggal_lahir" />
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

<flux:modal name="unallowed-delete-dokter" class="min-w-[18rem] !bg-amber-50">
    <div class="space-y-4">
        <div>
            <flux:heading size="lg" class="flex items-center gap-1">
                <flux:icon.x-circle class="text-red-500 size-6" />
                Data tidak bisa dihapus
            </flux:heading>

            <flux:text class="mt-2">
                <p>Data Dokter terpakai pada data lain</p>
                <p>Tindakan hapus tidak dapat dilakukan.</p>
            </flux:text>
        </div>

        <div class="flex justify-center">

            <flux:modal.close>
                <flux:button variant="primary">Ok</flux:button>
            </flux:modal.close>

        </div>
    </div>
</flux:modal>


<flux:modal name="konfirmasi-hapus-dokter" class="min-w-[22rem] !bg-amber-50">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Hapus Data?</flux:heading>
            <flux:text class="mt-2">
                <p>Anda akan menghapus data ini</p>
                <p>Aksi anda tidak dapat dibatalkan.</p>
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button wire:click="delete" variant="danger">Hapus data</flux:button>
        </div>
    </div>
</flux:modal>
</div>
