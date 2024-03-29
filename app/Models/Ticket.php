<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tickets';
    protected $fillable = [
        'title',
        'description',
        'status',
        'created_by',
        'assigned_user',
        'due_date',
        "created_at",
        'updated_at',
        'deleted_at'
    ];

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_user');
    }

    public function ticketLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketLog::class);
    }
}
