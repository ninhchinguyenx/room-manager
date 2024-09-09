<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "code",
        "is_active"
    ];
    protected $cats = [
        "is_active" => "boolean"
    ];
}
