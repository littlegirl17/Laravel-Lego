<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $fillable = ['position_x', 'position_y', 'position_z', 'color']; // Các thuộc tính có thể được gán
}
