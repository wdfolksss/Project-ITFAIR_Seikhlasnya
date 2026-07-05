<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportTimeline extends Model
{
    protected $fillable = [
        'report_id',
        'status_id',
        'title',
        'description',
        'admin_response'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}