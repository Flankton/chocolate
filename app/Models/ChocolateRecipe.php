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

     /**
     * Return lotes
     *
     * @return BelongsTo
     */
    public function cocoaLote() : BelongsTo
    {
        return $this->belongsTo(CocoaLote::class);
    }

     /**
     * Return chocolates bar
     *
     * @return BelongsTo
     */
    public function chocolateBar() : BelongsTo
    {
        return $this->belongsTo(ChocolateBar::class);
    }

    protected $fillable = [
        'cocoa_lote_id',
        'chocolate_bar_id',
        'weight',
        'deleted',
        'created_at',
        'updated_at'
    ];
}