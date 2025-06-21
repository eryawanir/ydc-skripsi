<div>
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Daftar Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Cari dan pilih pasien untuk merekap pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>
{{--
    <flux:callout class="mb-2" variant="success" icon="check-circle"
    heading="Your account is verified and ready to use." /> --}}

    <div class="max-w-xl">
        <flux:input
            icon="magnifying-glass"
            placeholder="Cari Pasien"
            wire:model.live.debounce.500ms="searchKeyword"
         />
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
                                    href="{{ route('patient.show', ['patient' => $patient->id])}}">
                                    {{ $patient->nama_lengkap }}
                                </flux:link>
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
            <flux:pagination :paginator="$patients" />
        </div>
    </div>
</div>
