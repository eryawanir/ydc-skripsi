<div>
    {{-- HEADER KONTEN --}}
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1" class="text-sky-700">Daftar Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3 text-amber-700">
            Cari dan pilih pasien untuk merekap pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- KONTEN --}}
    <div class="max-w-xl">
        {{-- SEARCH --}}
        <flux:input
            icon="magnifying-glass"
            placeholder="Cari Pasien"
            wire:model.live.debounce.500ms="searchKeyword"
         />
         {{-- TABEL --}}
        <div class="px-3">
            <flux:table class="max-w-1.5">
                <flux:table.columns>
                    <flux:table.column>#</flux:table.column>
                    <flux:table.column>ID</flux:table.column>
                    <flux:table.column>Nama</flux:table.column>
                    <flux:table.column>Aksi</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($patients as $patient)
                        <flux:table.row :key="$patient->id">
                            <flux:table.cell>
                                {{ $loop->iteration + ($patients->firstItem() - 1) }}
                            </flux:table.cell>
                            <flux:table.cell>P{{ $patient->id }}</flux:table.cell>
                            <flux:table.cell >
                                <flux:link variant="subtle"
                                    href="{{ route('admin.patient.show', ['patient' => $patient->id])}}">
                                    {{ $patient->nama_lengkap }}
                                </flux:link>
                            </flux:table.cell>
                            <flux:table.cell>
                                 <flux:button
                                    size="sm"
                                    variant="primary"
                                    icon:trailing="arrow-right"
                                    class="me-3 my-0"
                                    href="{{ route('admin.patient.show', ['patient' => $patient->id]) }}" wire:navigate>
                                    Pilih
                                </flux:button>
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
            <flux:pagination :paginator="$patients" class="[&_*]:bg-amber-50" />
        </div>
    </div>
</div>
