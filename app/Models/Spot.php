<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Spot é uma aldeia
 */
class Spot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'location',
        'price',
        'type_id', 
        'villager',
        'image', 
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}