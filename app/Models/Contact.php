<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function avatarUrl(): string
    {
        return $this->avatar
            ? Storage::disk('public')->url($this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name);
    }

    public function getDateForHumansAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
