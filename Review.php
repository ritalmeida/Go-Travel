<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    protected $table = "reviews";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'comment',
        'rating',
        'spot_id',
        'user_id',
    ];
}