<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrationGroup extends Model
{
    use HasFactory;

    // Khi bạn thêm các trường của bảng vào $fillable thì chỉ những trường đó có thể update hàng loạt và những trường khác thì không.
    protected $fillable = [
        'name',
        'permission',
    ];


    public function administrationGroupAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8);
    }

    public function countAdministrationGroupAll()
    {
        return $this->count();
    }
}
