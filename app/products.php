<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{

    protected $fillable = [
        'product_name',
        'description',
        'section_id'
    ];

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(sections::class, 'section_id');
    }
}
