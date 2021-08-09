<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CocoaLote extends Model
{
    use HasFactory;

    protected $table = 'cocoa_lote';
    protected $primaryKey = 'id';
    public $timestamps = false;

     /**
     * Return providers from a lote of cocoa
     *
     * @return BelongsTo
     */
    public function provider() : BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    protected $fillable = [
        'description',
        'provider_id',
        'organic',
        'created_at',
        'updated_at'
    ];
}