<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserStatus;
use App\Traits\FilterableByDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, FilterableByDates, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'status',
        'mobile_number',
        'gender',
        'date_of_birth',
        'address',
        'avatar',
        'username',
        'email_verified_at',
        'state_id',
        'city_id',
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
            'status' => UserStatus::class,
            'password' => 'hashed',
        ];
    }

    protected $appends = ['full_name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['first_name', 'middle_name', 'last_name', 'email', 'status', 'mobile_number', 'gender', 'date_of_birth', 'address', 'avatar', 'username', 'state_id', 'city_id']);
    }

    /**
     * The accessors to append to the model's array form.
     * 
     * @var list<string>
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    // Create unique username on user creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->username = $user->email;
        });
    }

    /**
     * The roles that belong to the user.
     * 
     * @return ?Role
     * 
     */
    public function currentRole(): ?Role
    {
        return $this->roles()->first();
    }

    /**
     * The state that belong to the user.
     * 
     * @return BelongsTo
     * 
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * The city that belong to the user.
     * 
     * @return BelongsTo
     * 
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
