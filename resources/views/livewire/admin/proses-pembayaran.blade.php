<div class="space-y-4 max-w-3xl">

    <flux:heading size="xl">Proses Pembayaran</flux:heading>

    <flux:card size="sm">
        <p>Nama Pasien: <strong>{{ $periksa->patient->nama_lengkap }}</strong></p>
        <p>Keluhan: {{ $periksa->keluhan }}</p>
    </flux:card>

    <flux:card size="sm">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>No</flux:table.column>
                <flux:table.column>Layanan</flux:table.column>
                <flux:table.column>Harga</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($tindakans as $i => $t)
                    <flux:table.row>
                        <flux:table.cell>{{ $i + 1 }}</flux:table.cell>
                        <flux:table.cell>{{ $t->layanan->nama }}</flux:table.cell>
                        <flux:table.cell>Rp{{ number_format($t->layanan->harga, 0, ',', '.') }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>

    <flux:heading size="xl">Total Tagihan: Rp{{ number_format($totalTagihan, 0, ',', '.') }}</flux:heading>

    <div class="flex justify-end">
        <flux:button wire:click="prosesPembayaran">Dana Telah Diterima</flux:button>
    </div>

</div>
