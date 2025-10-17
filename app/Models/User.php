<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'dokter_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    protected $casts = [
        'role' => UserRole::class,
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function hasDokter(): bool
{
    return $this->dokter()->exists();
}

public function hasPeriksa(): bool
{
    // Kalau dokter ada, cek apakah ada periksa
    return $this->dokter && $this->dokter->periksas()->exists();
}

public function hasDokterWithoutPeriksa(): bool
{
    // Punya dokter, tapi tidak ada periksa
    return $this->dokter && !$this->dokter->periksas()->exists();
}

}
