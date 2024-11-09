<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssemblyPackages extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'fee',
        'price_assembly	',
    ];

    public function assemblyPackageAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }
}
