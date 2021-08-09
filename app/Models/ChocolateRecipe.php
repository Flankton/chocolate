<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChocolateRecipe extends Model
{
    use HasFactory;
    

    protected $table = 'chocolate_recipe';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //  /**
    //  * Return providers from a lote of cocoa
    //  *
    //  * @return BelongsTo
    //  */
    // public function provider() : BelongsTo
    // {
    //     return $this->belongsTo(Provider::class);
    // }

    protected $fillable = [
        'cocoa_lote_id',
        'chocolate_bar_id',
        'weight',
        'deleted',
        'created_at',
        'updated_at'
    ];
   // protected $hidden = 'id';
}