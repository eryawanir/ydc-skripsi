<div>
    {{-- HEADER --}}
    <div class="relative mb-4 w-full">
        <flux:heading size="xl" level="1">Daftar Akun</flux:heading>
        <flux:subheading size="lg" class="mb-3">
            Kelola akun pengguna sesuai peran yang tersedia
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- TOMBOL TAMBAH --}}
    <div class="mb-4">
        <flux:button wire:click="$set('formVisible', true)">Tambah Akun</flux:button>
    </div>

    {{-- TABEL USER --}}
    <div class="px-3">
        <flux:table class="max-w-1.5">
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
                            <flux:button size="xs" class="me-2" wire:click="edit({{ $user->id }})">
                                Edit
                            </flux:button>
                            <flux:button size="xs" variant="danger" wire:click="confirmDelete({{ $user->id }})">
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
    <flux:modal wire:model="formVisible" title="{{ $editingId ? 'Edit Akun' : 'Tambah Akun' }}">
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
                    <flux:button variant="subtle" wire:click="$set('formVisible', false)">Batal</flux:button>
                    <flux:button wire:click="save">Simpan</flux:button>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
