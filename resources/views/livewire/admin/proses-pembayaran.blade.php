<div class="space-y-4 max-w-3xl">

    <flux:heading size="xl" class="text-sky-700">Proses Pembayaran</flux:heading>

    <flux:card size="sm" class=" !border-amber-200 !bg-amber-50">
        <p class="text-amber-700">Nama Pasien: <strong>{{ $periksa->patient->nama_lengkap }}</strong></p>
        <p class="text-amber-700">Keluhan: {{ $periksa->keluhan }}</p>
    </flux:card>

    <flux:card size="sm" class=" !border-amber-200 !bg-amber-50">
        <flux:table>
            <flux:table.columns>
                <flux:table.column class="!text-amber-800">No</flux:table.column>
                <flux:table.column class="!text-amber-800">Layanan</flux:table.column>
                <flux:table.column class="!text-amber-800">Harga</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($tindakans as $i => $t)
                    <flux:table.row>
                        <flux:table.cell class="!text-amber-800">{{ $i + 1 }}</flux:table.cell>
                        <flux:table.cell class="!text-amber-800">{{ $t->layanan->nama }}</flux:table.cell>
                        <flux:table.cell class="!text-amber-800">Rp{{ number_format($t->layanan->harga, 0, ',', '.') }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>

    <flux:heading size="xl" class="text-amber-800">Total Tagihan: Rp{{ number_format($totalTagihan, 0, ',', '.') }}</flux:heading>

    <div class="flex justify-end">
        <flux:button variant="primary" wire:click="prosesPembayaran">Dana Telah Diterima</flux:button>
    </div>

</div>
