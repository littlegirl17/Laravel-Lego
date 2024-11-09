<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administration extends Authenticatable
//kế thừa Authenticatable mục đích là xác thực người dùng
{
    use HasFactory, Notifiable;

    // Khi bạn thêm các trường của bảng vào $fillable thì chỉ những trường đó có thể update hàng loạt và những trường khác thì không.
    protected $fillable = [
        'admin_group_id',
        'fullname',
        'username',
        'email',
        'password',
        'image',
        'status',
    ];

    public function countAdministrationGroup($administrationGroup_id)
    {
        return $this->where('admin_group_id', $administrationGroup_id)->count();
    }

    public function administrationAll()
    {
        return $this->orderBy('id', 'desc')->paginate(8);
    }

    public function searchAdministration($fillter_name, $filter_adminGroup)
    {
        $query = $this->query();
        if (!is_null($fillter_name)) {
            $query->where('username', 'LIKE', "%{$fillter_name}%");
        }
        if (!is_null($filter_adminGroup)) {
            $query->where('admin_group_id', $filter_adminGroup);
        }

        return $query->paginate(10);
    }

    public function administrationCheckLogin($username)
    {
        return $this->where('username', $username)->first();
    }

    public function administrationAssembly()
    {
        return $this->where('admin_group_id', '=', 20)->get();
    }

    public function countAdministrationAll()
    {
        return $this->count();
    }


    public function mailCheck($mail)
    {
        return $this->where('email', $mail)->first();
    }
    /*---------------------- CONNECT TABLE -----------------------------------*/
    public function administrationGroup()
    {
        return $this->belongsTo(AdministrationGroup::class, 'admin_group_id');
    }
}
