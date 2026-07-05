<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

    class Report extends Model {
        protected $fillable = [
        'reporter_name',
        'contact',
        'category_id',
        'severity',
        'address',
        'latitude',
        'longitude',
        'description',
        'image',
        'status_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
