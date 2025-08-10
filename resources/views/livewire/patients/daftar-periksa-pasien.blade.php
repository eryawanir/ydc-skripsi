<div>
    {{-- HEADER KONTEN --}}
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1" class="text-sky-700">Daftar Periksa Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3" class="text-amber-700">
            Menampilkan pasien yang telah mendaftar untuk pemeriksaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>
        @if (session('status'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 1850)"
                x-show="show"
                x-transition.opacity.duration.500ms
                class="mt-4"
            >
                <flux:callout
                    variant="success"
                    icon="check-circle"
                    heading="{{ session('status') }}"
                />
            </div>
        @endif
    {{-- TABEL --}}
    <div wire:poll.visible.5s class="px-3 w-2xl" >
        <flux:table class="max-w-1.5">
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Pasien</flux:table.column>
                <flux:table.column>Keluhan</flux:table.column>
                <flux:table.column>Waktu Kedatangan</flux:table.column>
                <flux:table.column>Status</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($periksas as $periksa)
                    <flux:table.row :key="$periksa->id">
                        <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                        <flux:table.cell>{{ $periksa->patient->nama_lengkap }}</flux:table.cell>
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
                                    href="{{ route('admin.patient.proses-pembayaran', ['periksaId' => $periksa->id]) }}"
                                >
                                    Lanjut ke Billing
                                </flux:button>
                            @elseif ($periksa->status === 'sedang diperiksa')
                            <flux:badge color="yellow">{{ ucfirst($periksa->status) }}</flux:badge>
                            @else
                            <flux:badge color="amber">{{ ucfirst($periksa->status) }}</flux:badge>
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


    </div>
</div>
