<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferredVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'summary_id',
        'variant_id',
    ];

    public function variant()
    {
        return $this->hasOne(Variant::class, 'id', 'variant_id');
    }
}
