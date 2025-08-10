<x-slot:title>{{ $title }}</x-slot>
<div>
    <div class="relative mb-2 w-full">
        <flux:heading size="xl" level="1" class="text-sky-700">{{ $title ?? 'Page Title' }}</flux:heading>
        <flux:subheading size="lg" class="mb-3" class="text-amber-700">
            Memasukan data identitas pasien baru untuk pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="max-w-xl">
        <form wire:submit.prevent="simpan" class="space-y-4">
            <flux:input label="Nama Lengkap" wire:model.defer="nama_lengkap" />
            {{-- Baris 1: Jenis Kelamin, Tempat Lahir, Tanggal Lahir --}}
            <div class="flex flex-wrap gap-4">
                <div class="w-full sm:w-36">
                    <flux:field>
                        <flux:label>Jenis Kelamin</flux:label>
                        <flux:select wire:model.defer="jenis_kelamin">
                            <option value="" >Pilih ...</option>
                            <flux:select.option value="L">Laki-laki</flux:select.option>
                            <flux:select.option value="P">Perempuan</flux:select.option>
                        </flux:select>
                        <flux:error name="jenis_kelamin" />
                    </flux:field>
                </div>

                <div class="flex-1 min-w-[160px]">
                    <flux:input label="Tempat Lahir" wire:model.defer="tempat_lahir" />
                </div>

                <div class="flex-1 min-w-[160px]">
                    <flux:input type="date" label="Tanggal Lahir" wire:model.defer="tanggal_lahir" />
                </div>
            </div>

            {{-- Baris 2: No HP dan NIK --}}
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[160px]">
                    <flux:input label="No. HP" wire:model.defer="no_hp" />
                </div>

                <div class="flex-1 min-w-[160px]">
                    <flux:input label="NIK" wire:model.defer="nik" />
                </div>
            </div>

            {{-- Alamat --}}
            <flux:textarea label="Alamat" rows="2" wire:model.defer="alamat" />

            <div class="pt-4 flex justify-end">
                <flux:button type="submit" variant="primary">
                    Simpan Data Pasien
                </flux:button>
            </div>

        </form>
    </div>
</div>
