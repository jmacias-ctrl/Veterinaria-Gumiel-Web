<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rut',
        'phone',
        'roles',
        'last_seen'
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
    ];

    public function horario()
    {
        return $this->hasOne(Horario::class, 'id_users');
    }

    public function scopeFuncionario($query)
    {
        return $query->role(['Veterinario', 'Peluquero']);
    }

    public function scopePaciente($query)
    {
        return $query->Role('Cliente');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
    public function tiposervicio()
    {
        return $this->belongsTo(tiposervicios::class);
    }
}
