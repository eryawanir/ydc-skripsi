<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <flux:heading size="xl">Kelola Layanan</flux:heading>
        <flux:subheading size="lg">Daftar layanan medis dan persentase bagi hasil dokter</flux:subheading>
        <flux:separator />
    </div>

    {{-- TOMBOL TAMBAH (MODAL TRIGGER) --}}
    <flux:modal.trigger name="form-layanan">
        <flux:button wire:click="resetInput" icon="plus" variant="outline">
            Tambah Layanan
        </flux:button>
    </flux:modal.trigger>

    {{-- TABEL LAYANAN --}}
    <flux:card class="max-w-3xl">
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
                    <flux:table.row>
                        <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $layanan->nama }}</flux:table.cell>
                        <flux:table.cell>Rp{{ number_format($layanan->harga, 0, ',', '.') }}</flux:table.cell>
                        <flux:table.cell>{{ ucwords($layanan->jenis) }}</flux:table.cell>
                        <flux:table.cell>{{ $this->getFeeDokter($layanan->jenis)  }}</flux:table.cell>

                        <flux:table.cell>
                            <flux:modal.trigger name="form-layanan">
                                <flux:button size="xs" wire:click="edit({{ $layanan->id }})">Edit</flux:button>
                            </flux:modal.trigger>

                            <flux:button size="xs" variant="danger" wire:click="confirmHapus({{ $layanan->id }})">
                                Hapus
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>

    {{-- MODAL TAMBAH/EDIT --}}
    <flux:modal name="form-layanan" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $isEdit ? 'Edit Layanan' : 'Tambah Layanan' }}</flux:heading>
                <flux:text class="mt-2">Lengkapi detail layanan yang tersedia di klinik.</flux:text>
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

</div>
