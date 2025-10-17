<div>
    {{-- HEADER --}}
    <div class="space-y-2 mb-3">
        <flux:heading size="xl" level="1" class="text-sky-700">Kelola Akun</flux:heading>
        <flux:subheading size="lg" class=" text-amber-700">
            Daftar akun sistem informasi Klinik Yusti Dental Care
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- TOMBOL TAMBAH (MODAL TRIGGER) --}}
    <flux:modal.trigger name="form-akun">
        <flux:button icon="plus" variant="primary">
            Tambah Akun
        </flux:button>
    </flux:modal.trigger>

    {{-- TABEL USER --}}
    <div class="max-w-2xl">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Nama</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column>Aksi</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($users as $user)
                    <flux:table.row :key="$user->id">
                        <flux:table.cell>{{ $loop->iteration }}</flux:table.cell>
                        <flux:table.cell>{{ $user->name }}</flux:table.cell>
                        <flux:table.cell>{{ $user->email }}</flux:table.cell>
                        <flux:table.cell>{{ $user->role->label() }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:modal.trigger name="form-akun">
                                <flux:button size="xs" variant="primary" class="me-2" wire:click="edit({{ $user->id }})">
                                    Edit
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:button size="xs" variant="danger" wire:click="confirmHapus({{ $user->id }})">
                                Hapus
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="5" class="text-center">
                            Tidak ada data akun ditemukan.
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    {{-- MODAL FORM TAMBAH/EDIT --}}
    <flux:modal class="!bg-amber-50" name="form-akun">

        <div class="mb-3">
            <flux:heading size="lg" class="text-sky-700">Tambah Akun</flux:heading>
            <flux:text class="mt-2 text-amber-700">Silahkan isi data akun dengan sesuai</flux:text>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <div x-data="{ role: @entangle('role') }" class="space-y-4">
                {{-- Kiri --}}
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 space-y-4">
                        <flux:select label="Role" wire:model="role">
                            <option value="">Pilih Role</option>
                            @foreach (\App\Enums\UserRole::cases() as $role)
                                <option value="{{ $role->value }}">{{ $role->label() }}</option>
                            @endforeach
                        </flux:select>

                        {{-- Input Dokter ditampilkan saat role == Dokter --}}
                        <div x-show="role == {{ \App\Enums\UserRole::Dokter->value }}">
                            <flux:select label="Pilih Dokter" wire:model.defer="dokter_id">
                                <option value="">Pilih Dokter</option>
                                @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                @endforeach
                            </flux:select>
                        </div>
                        <flux:input label="Nama" wire:model.defer="name" />
                    </div>

                    {{-- Kanan --}}
                    <div class="flex-1 space-y-4">
                        <flux:input label="Email" wire:model.defer="email" type="email" autocomplete="off" />
                        <flux:input label="Password" wire:model.defer="password" type="password" autocomplete="new-password" />
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-2">
                    <flux:button variant="primary" wire:click="save">Simpan</flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
    <flux:modal name="unallowed-delete-akun" class="min-w-[18rem] !bg-amber-50">
    <div class="space-y-4">
        <div>
            <flux:heading size="lg" class="flex items-center gap-1">
                <flux:icon.x-circle class="text-red-500 size-6" />
                Akun tidak bisa dihapus
            </flux:heading>

            <flux:text class="mt-2">
                <p>Akun ini dilarang dihapus</p>
                <p>Tindakan hapus tidak dapat dilakukan.</p>
            </flux:text>
        </div>

        <div class="flex justify-center">

            <flux:modal.close>
                <flux:button variant="primary">Ok</flux:button>
            </flux:modal.close>

        </div>
    </div>
</flux:modal>


<flux:modal name="konfirmasi-hapus-akun" class="min-w-[22rem] !bg-amber-50">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Hapus Akun?</flux:heading>
            <flux:text class="mt-2">
                <p>Anda akan menghapus akun ini</p>
                <p>Aksi anda tidak dapat dibatalkan.</p>
            </flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            <flux:button wire:click="delete" variant="danger">Hapus Akun</flux:button>
        </div>
    </div>
</flux:modal>
</div>
