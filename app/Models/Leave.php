<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'form_date',
        'to_date',
        'leave_type',
        'attachment',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'form_date'   => 'date',
        'to_date'     => 'date',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
