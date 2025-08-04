<div>
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Pencarian Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Cari dan pilih pasien untuk mendaftar pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="max-w-2xl space-y-4">
        {{-- Form Pencarian --}}
        <div class="flex gap-4 items-end">
            <div class="flex flex-col w-full">
                <label class="text-sm font-medium mb-1">Kata Kunci</label>
                <flux:input
                    placeholder="Masukkan kata kunci nama pasien"
                    wire:model.defer="kataKunci"
                    wire:keydown.enter="cari"
                />
            </div>
            {{-- <div class="flex flex-col w-48">
                <label class="text-sm font-medium mb-1">Nilai Threshold</label>
                <flux:input
                    type="number"
                    min="1"
                    max="100"
                    wire:model.defer="threshold"
                    :value="$threshold"
                />
            </div> --}}
            <flux:button
                icon="magnifying-glass"
                class="mb-1"
                wire:click="cari">
                Cari
            </flux:button>
        </div>
        @if ($kataKunci !== '')
                    {{-- Tabel Hasil --}}
        <div class="px-3">
            <flux:table class="max-w-1.5">
                <flux:table.columns>
                    <flux:table.column>#</flux:table.column>
                    <flux:table.column>ID</flux:table.column>
                    <flux:table.column>Nama</flux:table.column>
                    <flux:table.column>Skor</flux:table.column>
                    <flux:table.column>Jumlah kata <br>yang relevan</flux:table.column>
                    <flux:table.column>Aksi</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @forelse ($hasil as $index => $pasien)
                        <flux:table.row>
                            <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                            <flux:table.cell>P - {{ $pasien['id'] ?? '-' }}</flux:table.cell>
                            <flux:table.cell>{{ $pasien['nama'] }}</flux:table.cell>
                            <flux:table.cell>{{ $pasien['skor'] }}</flux:table.cell>
                            <flux:table.cell>{{ $pasien['cocok'] }}</flux:table.cell>

                            <flux:table.cell>
                                <flux:button
                                    size="xs"
                                    class="me-3 my-0"
                                    href="{{ route('admin.patient.show', ['patient' => $pasien['id']]) }}" wire:navigate>
                                    Pilih
                                </flux:button>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="5" class="text-center">
                                Tidak ada data pasien ditemukan. Salah kata kunci atau data pasien tidak terdaftar.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>
        @endif

    </div>
</div>
