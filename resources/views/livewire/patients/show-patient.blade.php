<div>
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Identitas Pasien</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Digunakan sebagai referensi untuk layanan kesehatan lebih lanjut
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="max-w-xl">
        <flux:table>
            <flux:table.rows>
                <flux:table.row>
                    <flux:table.cell>Nama Lengkap</flux:table.cell>
                    <flux:table.cell>{{ $patient->nama_lengkap }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Jenis Kelamin</flux:table.cell>
                    <flux:table.cell>{{ $patient->jenis_kelamin }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Tempat Tanggal Lahir</flux:table.cell>
                    <flux:table.cell>{{ $patient->tempat_lahir }}, {{ $patient->tanggal_lahir }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Umur</flux:table.cell>
                    <flux:table.cell>{{ $patient->umur }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>No Handphone</flux:table.cell>
                    <flux:table.cell>{{ $patient->no_hp }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>NIK</flux:table.cell>
                    <flux:table.cell>{{ $patient->nik }}</flux:table.cell>
                </flux:table.row>
                <flux:table.row>
                    <flux:table.cell>Alamat</flux:table.cell>
                    <flux:table.cell>{{ $patient->alamat }}</flux:table.cell>
                </flux:table.row>
            </flux:table.rows>
        </flux:table>
    </div>
</div>

