<div>
    <div class="relative mb-3 w-full">
        <flux:heading size="xl" level="1" class="text-sky-700">Pencarian Pasien</flux:heading>
        <flux:subheading size="lg" class=" text-amber-700">
            Cari dan pilih pasien untuk mendaftar pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="max-w-2xl space-y-2">
        {{-- Form Pencarian --}}
        <label class="text-sm font-medium">Kata Kunci</label>
        <div class="flex gap-4 items-end mt-1">
            <div class="flex flex-col w-full">

                <flux:field>
                    <flux:input
                    placeholder="Masukkan kata kunci nama pasien"
                    wire:model="kataKunci"
                    wire:keydown.enter="cari"
                    />
                    <flux:error name="kataKunci" />
                </flux:field>
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
                class="self-start"
                variant="primary"
                icon="magnifying-glass"
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
                    <flux:table.column>Pilih</flux:table.column>
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
                                    size="sm"
                                    variant="primary"
                                    icon:trailing="arrow-right"
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
