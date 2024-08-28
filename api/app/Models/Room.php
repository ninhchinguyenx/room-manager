<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    

    public function floor()
    {
        return $this->belongsTo(Floor::class, 'floorId');
    }

    public function roomGallery()
    {
        return $this->hasOne(RoomGallery::class, 'id', 'roomGalleryId');
    }
}
