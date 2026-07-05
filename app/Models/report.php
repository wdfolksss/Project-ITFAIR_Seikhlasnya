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
        'district',
        'latitude',
        'longitude',
        'description',
        'admin_response',
        'image',
        'status_id',
        'hash',
        'previous_hash',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function timelines()
    {
    return $this->hasMany(ReportTimeline::class)->latest();
    }

    public function getNamaDaerahAttribute()
    {
        return explode(',', $this->address)[0];
    }

    public function getKodePosAttribute()
    {
        preg_match('/\b\d{5}\b/', $this->address, $matches);
        return $matches[0] ?? '';
    }
}
