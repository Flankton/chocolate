<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChocolateBar extends Model
{
    use HasFactory;
    

    protected $table = 'chocolate_bar';
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
        'public_id',
        'created_at',
        'updated_at'
    ];
   // protected $hidden = 'id';
}