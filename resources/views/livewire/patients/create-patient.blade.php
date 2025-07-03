<div>
    <div class="relative mb-2 w-full">
        <flux:heading size="xl" level="1">Pendaftaran Pasien Baru</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Memasukan data identitas pasien baru untuk pemerikasaan
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="max-w-xl">
        <form wire:submit.prevent="" class="space-y-3">
            <flux:input label="Nama"/>
            <flux:field>
                <flux:label>Jenis Kelamin</flux:label>
                <flux:select wire:model="jenis_kelamin" placeholder="Pilih...">
                    <flux:select.option value="L">Laki-laki</flux:select.option>
                    <flux:select.option value="P">Perempuan</flux:select.option>
                </flux:select>
                <flux:error name="jenis_kelamin" />
            </flux:field>
            <flux:input type="date" label="Tanggal Lahir" />
            <flux:input label="Tempat Lahir" />
            <div class="flex gap-4">
                <flux:input type="date" label="Tanggal Lahir" />
                <flux:input label="Tempat Lahir" />
            </div>
        </form>
    </div>
</div>

