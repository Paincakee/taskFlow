<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'deadline',
        'status'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->attributes['deadline'])->format('d M Y');
    }

    public function getDefaultDateAttribute(): string
    {
        return Carbon::parse($this->attributes['deadline'])->format('Y-m-d');
    }

}
