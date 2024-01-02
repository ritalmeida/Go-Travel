<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use LaravelIdea\Helper\App\Models_IH_Guide_C;
use App\Models\Profile;

/**
 * User é o utilizador do site
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes thar are mass assignable.
     * 
     * @var array<int, string> */    
    protected $fillable = [
        'name',
        'email',
        'password',
        'spot',
        'is_villager'              //aldeão

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
     * @var array<int, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}