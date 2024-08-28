<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "price",
        "quantity",
        "description",
        "is_active",
    ];
    protected $cats = [
        "is_active" => "boolean"
    ];
}
