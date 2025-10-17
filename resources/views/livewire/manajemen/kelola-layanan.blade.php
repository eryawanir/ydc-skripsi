<div>

    <div class="space-y-2 mb-3">
        <flux:heading size="xl" level="1" class="text-sky-700">Kelola Layanan</flux:heading>
        <flux:subheading size="lg" class=" text-amber-700">
            Daftar layanan yang tersedia pada Klinik Yusti Dental Care
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- TOMBOL TAMBAH (MODAL TRIGGER) --}}
    <flux:modal.trigger name="form-layanan">
        <flux:button icon="plus" variant="primary" class="mb-3">
            Tambah Layanan
        </flux:button>
    </flux:modal.trigger>

    {{-- TABEL LAYANAN --}}
    <div class="w-2xl">
    <flux:table>
        <flux:table.columns>
            <flux:table.column>#</flux:table.column>
            <flux:table.column>Nama Layanan</flux:table.column>
            <flux:table.column>Harga</flux:table.column>
            <flux:table.column>Jenis</flux:table.column>
            <flux:table.column>Pembagian Dokter</flux:table.column>
            <flux:table.column>Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($layanans as $index => $layanan)
                <flux:table.row :key="$layanan->id">
                    <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                    <flux:table.cell class="whitespace-normal break-words">{{ $layanan->nama }} </flux:table.cell>
                    <flux:table.cell>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</flux:table.cell>
                    <flux:table.cell>{{ ucwords($layanan->jenis) }}</flux:table.cell>
                    <flux:table.cell class="text-center">{{ $this->getFeeDokter($layanan->jenis)  }}</flux:table.cell>

                    <flux:table.cell>
                        <flux:modal.trigger name="form-layanan">
                            <flux:button size="xs" variant="primary" wire:click="edit({{ $layanan->id }})">Edit</flux:button>
                        </flux:modal.trigger>

                        <flux:button size="xs" variant="danger" wire:click="confirmHapus({{ $layanan->id }})">
                            Hapus
                        </flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    </div>
    {{-- MODAL TAMBAH/EDIT --}}
    <flux:modal name="form-layanan" class="md:w-96 !bg-amber-50" wire:close="resetInput" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg" class="text-sky-700">{{ $isEdit ? 'Edit Layanan' : 'Tambah Layanan' }}</flux:heading>
                <flux:text class="mt-2 text-amber-700">Lengkapi detail layanan yang tersedia di klinik.</flux:text>
            </div>

            <flux:input label="Nama Layanan" wire:model.defer="nama" />
            <flux:select label="Jenis" wire:model="jenis">
                <option value="">Pilih Jenis Layanan</option>
                <option value="umum">Umum - 40%</option>
                <option value="bedah">Bedah - 60%</option>
                <option value="odontologi">Odontologi - 70%</option>
                <option value="lab">Laboratorium - 55%</option>
            </flux:select>

            <flux:input
                label="Harga Layanan"
                type="number"
                prefix="Rp"
                wire:model.defer="harga"
            />

            <div class="flex">
                <flux:spacer />
                <flux:button wire:click="simpan" variant="primary">Simpan</flux:button>
            </div>
        </div>
    </flux:modal>


<flux:modal name="unallowed-delete-layanan" class="min-w-[18rem] !bg-amber-50">
    <div class="space-y-4">
        <div>
            <flux:heading size="lg" class="flex items-center gap-1">
                <flux:icon.x-circle class="text-red-500 size-6" />
                Data tidak bisa dihapus
            </flux:heading>

            <flux:text class="mt-2">
                <p>Data Layanan terpakai pada data lain</p>
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

<flux:modal name="konfirmasi-hapus-layanan" class="min-w-[22rem]">
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
            <flux:button wire:click="deleteLayanan" variant="danger">Hapus data</flux:button>
        </div>
    </div>
</flux:modal>


</div>
