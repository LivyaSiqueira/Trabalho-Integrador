<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
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
     * The subjects (matérias) that belong to this user.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'users_id');
    }

    /**
     * All contents of the user, through their subjects.
     */
    public function contents()
    {
        return $this->hasManyThrough(Content::class, Subject::class, 'users_id', 'subjects_id');
    }

    /**
     * The administrator is the account whose e-mail is stored in config('auth.admin.email').
     */
    public function isAdmin(): bool
    {
        return $this->email === config('auth.admin.email');
    }

    /**
     * Whether the given name/e-mail is reserved for the administrator account.
     */
    public static function isReservedForAdmin(string $value): bool
    {
        $value = mb_strtolower(trim($value));

        return $value === mb_strtolower((string) config('auth.admin.email'))
            || $value === mb_strtolower((string) config('auth.admin.name'));
    }

    /**
     * Regular users only (everyone except the administrator).
     */
    public function scopeStudents(Builder $query): Builder
    {
        return $query->where('email', '!=', config('auth.admin.email'));
    }
}
