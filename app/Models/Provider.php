<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'provider';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cocoaLote(){
        return $this->hasMany(CocoaLote::class);
    }
}
