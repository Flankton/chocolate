<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChocolateBar extends Model
{
    use HasFactory;
    

    protected $table = 'chocolate_bar';
    protected $primaryKey = 'id';
    public $timestamps = false;

     /**
     * Return recipes
     *
     * @return ToHasMany
     */
    public function recipes() : HasMany
    {
        return $this->HasMany(ChocolateRecipe::class);
    }

    protected $fillable = [
        'public_id',
        'deleted',
        'created_at',
        'updated_at'
    ];
   // protected $hidden = 'id';
}