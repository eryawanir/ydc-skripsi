<div>
    {{-- HEADER KONTEN --}}
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Daftar Periksa Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Menampilkan pasien yang telah mendaftar untuk pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- TABEL --}}
    <div wire:poll.visible.5s class="px-3" >
        <flux:table class="max-w-1.5">
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Pasien</flux:table.column>
                <flux:table.column>Dokter</flux:table.column>
                <flux:table.column>Keluhan</flux:table.column>
                <flux:table.column>Waktu Kedatangan</flux:table.column>
                <flux:table.column>Status</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($periksas as $periksa)
                    <flux:table.row :key="$periksa->id">
                        <flux:table.cell>{{ $loop->iteration + ($periksas->firstItem() - 1) }}</flux:table.cell>
                        <flux:table.cell>{{ $periksa->patient->nama_lengkap }} gdigd gdag</flux:table.cell>
                        <flux:table.cell>{{ $periksa->dokter->nama ?? '-' }}</flux:table.cell>
                        <flux:table.cell class="flex-1 whitespace-normal">{{ $periksa->keluhan }}</flux:table.cell>
                        <flux:table.cell>
                           {{ \Carbon\Carbon::parse($periksa->waktu_kedatangan)->diffForHumans(null, false, true, 2) }}

                        </flux:table.cell>
                        <flux:table.cell>
                            @if ($periksa->status === 'billing')
                                <flux:button
                                    size="xs"
                                    variant="primary"
                                    icon:trailing="arrow-right"
                                    {{-- href="{{ route('admin.billing.proses', ['periksa' => $periksa->id]) }}" --}}
                                >
                                    Lanjut ke Billing
                                </flux:button>
                            @else
                                {{ ucfirst($periksa->status) }}
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6" class="text-center">
                            Tidak ada data periksa ditemukan.
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        {{-- PAGINATION --}}
        <flux:pagination :paginator="$periksas" />
    </div>
</div>
