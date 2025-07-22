<div>
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Daftar Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Cari dan pilih pasien untuk merekap pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="max-w-xl">
        <div class="flex gap-4">
            <flux:input
                placeholder="Masukan kata kunci pencarian nama pasien"
                wire:model.defer="kataKunci"
                wire:keydown.enter="cari"
             />
             <flux:button
                icon="magnifying-glass"
                wire:click="cari">
                Cari
            </flux:button>

        </div>
        <div class="px-3">
            <flux:table class="max-w-1.5">
                <flux:table.columns>
                    <flux:table.column>#</flux:table.column>
                    <flux:table.column>ID</flux:table.column>
                    <flux:table.column>Nama</flux:table.column>
                    <flux:table.column>Skor</flux:table.column>
                    <flux:table.column>Aksi</flux:table.column>
                </flux:table.columns>
                @php
                    dump($hasil);
                @endphp
                <flux:table.rows>
                    @forelse ($hasil as $pasien)
                        <flux:table.row>
                            <flux:table.cell>

                            </flux:table.cell>
                            <flux:table.cell></flux:table.cell>
                            <flux:table.cell >
                                {{ $pasien['nama'] }}
                            </flux:table.cell>
                            <flux:table.cell >
                                {{ $pasien['skor'] }}
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:button
                                    size="xs"
                                    class="me-3 my-0"
                                    href="#">
                                    Periksa
                                </flux:button>
                                <flux:button size="xs">Edit</flux:button>
                            </flux:table.cell>

                        </flux:table.row>
                    @empty
                    <flux:table.row>
                        <flux:table.cell colspan="4" class="text-center">
                                Tidak ada data pasien ditemukan.
                        </flux:table.cell>
                     </flux:table.row>
                    @endforelse
                </flux:table.rows>

            </flux:table>

        </div>
    </div>
</div>
