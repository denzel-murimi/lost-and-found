<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_name',
        'category',
        'description',
        'lost_date',
        'location',
        'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
