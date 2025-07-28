<div>
    {{-- HEADER KONTEN --}}
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Daftar Periksa Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
         untuk {{ $namaDokter }} pada hari ini
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- TABEL AKTIF --}}
    <div wire:poll.visible.5s class="px-3 mb-10 w-3xl">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Pasien</flux:table.column>
                <flux:table.column>Keluhan</flux:table.column>
                <flux:table.column>Waktu Kedatangan</flux:table.column>
                <flux:table.column>Status</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($periksasAktif as $periksa)
                    <flux:table.row :key="$periksa->id">
                        <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                        <flux:table.cell>{{ $periksa->patient->nama_lengkap }}</flux:table.cell>
                        <flux:table.cell class="flex-1 whitespace-normal">{{ $periksa->keluhan }}</flux:table.cell>
                        <flux:table.cell>
                            {{ \Carbon\Carbon::parse($periksa->waktu_kedatangan)->diffForHumans(null, false, true, 2) }}
                        </flux:table.cell>
                        <flux:table.cell>
    @if ($periksa->status === 'menunggu')
        <flux:button
            size="xs"
            variant="outline"
            {{-- wire:click="mulaiPeriksa({{ $periksa->id }})" --}}
        >
            Mulai Periksa
        </flux:button>
    @elseif ($periksa->status === 'sedang diperiksa')
        <flux:button
            size="xs"
            variant="primary"
            icon:trailing="arrow-right"
            {{-- wire:click="lanjutPeriksa({{ $periksa->id }})" --}}
        >
            Lanjut Periksa
        </flux:button>
    @else
        {{ ucfirst($periksa->status) }}
    @endif
</flux:table.cell>

                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6" class="text-center">Tidak ada pasien aktif.</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

    </div>

    {{-- TABEL SELESAI / BILLING --}}
    {{-- <div class="px-3">
        <flux:heading size="lg" class="mb-2">Riwayat Billing & Selesai</flux:heading>
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
                @forelse ($periksasSelesai as $periksa)
                    <flux:table.row :key="$periksa->id">
                        <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                        <flux:table.cell>{{ $periksa->patient->nama_lengkap }}</flux:table.cell>
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
                        <flux:table.cell colspan="6" class="text-center">Belum ada riwayat billing/selesai.</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        <flux:pagination :paginator="$periksasSelesai" />
    </div> --}}
</div>
