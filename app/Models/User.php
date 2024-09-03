<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
        'profile_type',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $with = ['address', 'providedServices', 'contacts', 'pictures'];
    protected $appends = ['image', 'contact'];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function providedServices(): HasMany
    {
        return $this->hasMany(ProvidedServices::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contacts::class);
    }

    public function contact(): Attribute
    {
        return Attribute::make(get: function (mixed $value, array $attributes) {
            return $this->contacts()->where('main', 1)->first();
        });
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    public function image(): Attribute
    {
        return Attribute::make(get: function(mixed $value, array $attributes) {
            return $this->pictures()->where('main', 1)->first();
        });
    }

    public function scopeIsPending(Builder $query): void
    {
        $query->whereNull('active');
    }

    public function scopeIsDenied(Builder $query): void
    {
        $query->where('active', '=', false);
    }

}
