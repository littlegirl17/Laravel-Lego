<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public static function userGroupAll()
    {
        return self::orderBy('id', 'desc')->get();
    }



    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $userGroups = UserGroup::all();

        return view('admin.user.edit', compact('user', 'userGroups'));
    }

    public function userGroupDefault()
    {
        return $this->where('id', 1)->first();
    }

    public function countUserGroupAll()
    {
        return $this->count();
    }
}
