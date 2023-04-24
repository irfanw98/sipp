<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Offset;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role'
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

    public function getAllUsers()
    {
        return $this->orderBy('name');
    }

    public function getUserById($id)
    {
        return $this->findOrFail($id);
    }

    public function countAllUsers()
    {
        return $this->count();
    }

    public function countUserAdmin()
    {
        return $this->where('role', '=', 'admin')->count();
    }

    public function countUserCustomerService()
    {
        return $this->where('role', '=', 'customer_service')->count();
    }

    public function countUserKadivOffset()
    {
        return $this->where('role', '=', 'kadiv_offset')->count();
    }

    public function countUserKadivProduction()
    {
        return $this->where('role', '=', 'kadiv_produksi')->count();
    }

    public function countUserKadivfinishing()
    {
        return $this->where('role', '=', 'kadiv_finishing')->count();
    }

    public function offset()
    {
        return $this->hasMany(Offset::class);
    }
}