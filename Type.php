<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Type é o tipo de experiência: restaurantes, 
 * passadiços/parques, estátuas, alojamentos, etc..
 */
class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name',
    ];

}