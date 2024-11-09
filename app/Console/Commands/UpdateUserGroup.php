<?php

namespace App\Console\Commands;

use App\Models\UserGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Thêm model User
use App\Models\Order; // Thêm model Order

class UpdateUserGroup extends Command
{
    protected $signature = 'app:update-user-group';
    protected $description = 'Cập nhật user_group_id cho người dùng dựa trên tổng số tiền đã chi tiêu';

    public function handle()
    {
        Log::info('Lệnh cập nhật user group đang chạy...'); // Ghi log khi lệnh chạy


        $users = User::all(); // Lấy tất cả người dùng
        $gold = UserGroup::where('name', 'Vàng')->value('id');
        $silver = UserGroup::where('name', 'Bạc')->value('id');
        $bronze = UserGroup::where('name', 'Đồng')->value('id');
        $default = UserGroup::where('name', 'Mặc định')->value('id');

        foreach ($users as $user) {
            $totalUserOrder = Order::where('user_id', $user->id)->sum('total');
            // Cập nhật user_group_id dựa trên tổng số tiền
            if ($totalUserOrder >= 30000000) {
                $user->user_group_id =  $gold; // ID cho nhóm vàng
            } elseif ($totalUserOrder >= 20000000) {
                $user->user_group_id =  $silver; // ID cho nhóm bạc
            } elseif ($totalUserOrder >= 10000000) {
                $user->user_group_id = $bronze; // ID cho nhóm đồng
            } else {
                $user->user_group_id = $default; // Không cần xếp
            }

            // Lưu thay đổi
            $user->save();
        }

        $this->info('Cập nhật user_group_id thành công!');
    }
}