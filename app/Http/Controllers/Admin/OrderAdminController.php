<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Assembly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderAdminController extends Controller
{
    private $orderModel;
    private $assemblyModel;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->assemblyModel = new Assembly();
    }
    public function order(Request $request)
    {
        // Khởi tạo query builder cho Order
        $query = Order::with('orderProducts.product');

        // Lọc theo ID đơn hàng
        if ($request->filled('filter_iddh')) {
            $query->where('id', $request->filter_iddh);
        }

        // Lọc theo tên khách hàng
        // Lọc theo tên khách hàng
        if ($request->filled('filter_userName')) {
            $query->where('name', 'like', '%' . $request->filter_userName . '%');
        }

        // Lọc theo trạng thái đơn hàng
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // Lọc theo tổng tiền
        if ($request->filled('filter_total')) {
            $query->where('total', '>=', $request->filter_total);
        }

        $statuses = $this->getOrderStatuses();
        $orderCounts = $this->getOrderCounts();
        // Lấy danh sách đơn hàng đã lọc
        $orders = $query->orderBy('id', 'desc')->paginate(8);

        return view('admin.order', compact('orders', 'statuses', 'orderCounts'));
    }

    // Phương thức để lấy trạng thái đơn hàng
    private function getOrderStatuses()
    {
        return [
            'all' => ['label' => 'Tất cả', 'color' => '#F38773'],
            1 => ['label' => 'Chờ xác nhận', 'color' => '#FFB356'],
            2 => ['label' => 'Đã xác nhận', 'color' => '#00bcd4'],
            3 => ['label' => 'Đang vận chuyển', 'color' => '#188DD1'],
            4 => ['label' => 'Hoàn thành', 'color' => '#2bc500'],
            5 => ['label' => 'Đã hủy', 'color' => '#FF0000'],
        ];
    }

    private function getOrderCounts()
    {
        return [
            'all' => Order::count(),
            1 => Order::where('status', 1)->count(),
            2 => Order::where('status', 2)->count(),
            3 => Order::where('status', 3)->count(),
            4 => Order::where('status', 4)->count(),
            5 => Order::where('status', 5)->count(),
        ];
    }



    public function orderEdit($id)
    {
        $order = Order::with('orderProducts.product')->findOrFail($id); // Tải thông tin đơn hàng và các sản phẩm liên quan
        $orderStatus = $this->orderModel->statusOrder();
        return view('admin.orderEdit', compact('order', 'orderStatus'));
    }


    public function orderUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|min:1|max:5', // Kiểm tra trạng thái phải nằm trong khoảng 1-5
        ]);

        $order = Order::findOrFail($id);
        $assembly = $this->assemblyModel->assmblyOrderId($order->id);

        if ($assembly) { // nếu trong bảng assembly có id đơn hàng thì thực hiện status case này
            // Gọi hàm với trạng thái mới từ request
            $result = $this->orderUpdateStatusAssembly($order->id, $request->status);

            // Kiểm tra kết quả trả về
            if ($result) {
                return $result; // Nếu có redirect từ hàm, trả về ngay
            }

            return redirect()->route('admin.order')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
        } else {
            $statuses = $request->status; // status được client gửi lên (chưa được lưu vào db)
            //dd($order->status); //Lấy giá trị trạng thái hiện tại của đơn hàng từ cơ sở dữ liệu

            switch ((int)$statuses) {
                case 1: // Chờ xác nhận
                    if ($order->status != 1) {
                        return redirect()->route('admin.order')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận"!');
                    }
                    break;

                case 2: // Đã xác nhận
                    if ($order->status != 1) { // nếu nó không bằng thì thực thi IF báo lỗi
                        return redirect()->route('admin.order')->with('error', 'Không thể chuyển về trạng thái "Đã xác nhận"!');
                    }
                    break;
                    //=> nghĩa là khi nó lấy từ DB lên và ss 1=1 thì là (cho phép chuyển sang trạng thái "Đã xác nhận" nếu đơn hàng hiện tại đang ở trạng thái "Chờ xác nhận"). Nếu không, hiển thị lỗi.
                case 3: // Đã vận chuyển
                    if ($order->status != 2) { // nếu nó không bằng thì thực thi IF báo lỗi
                        return redirect()->route('admin.order')->with('error', 'Không thể chuyển về trạng thái "Đã vận chuyển"!');
                    }
                    break;
                    //=> nghĩa là khi nó lấy từ DB lên và ss 2=2 chỉ có thể chuyển sang trạng thái "Đã vận chuyển" nếu nó đang ở trạng thái "Đã xác nhận".
                case 4: // Hoàn thành
                    if ($order->status != 3) { // nếu nó không bằng thì thực thi IF báo lỗi
                        return redirect()->route('admin.order')->with('error', 'Không thể chuyển về trạng thái "Hoàn thành"!');
                    }
                    break;

                case 5: // Hủy
                    if ($order->status != 4) {
                        return redirect()->route('admin.order')->with('error', 'Không thể chuyển về trạng thái "Hủy"!');
                    }
                    break;

                default:
                    return redirect()->route('admin.order')->with('error', 'Trạng thái không hợp lệ!');
                    break;
            }

            // Cập nhật trạng thái khi không có lỗi
            $order->status = $statuses;
            $order->save();
            return redirect()->route('admin.order')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
        }
    }

    public function orderUpdateStatusAssembly($id, $statusOrder)
    {
        $order = $this->orderModel->findOrFail($id);
        $assembly = $this->assemblyModel->assmblyOrderId($order->id);
        if ($assembly) {
            switch ($assembly->status) {
                case 2: // trạng thái của assembly (đang trong quá trình lắp ráp)
                    if (in_array($statusOrder, [1])) { // kiểm tra xem giá trị của $statusOrder có nằm trong mảng không
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận", do đơn đang được lắp!');
                    } elseif (in_array($statusOrder, [3])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã vận chuyển", do đơn đang được lắp!');
                    } elseif (in_array($statusOrder, [4])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Hoàn thành", do đơn đang được lắp!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy", do đơn đang được lắp!');
                    }
                    break;
                case 3: // trạng thái của assembly (Hoàn thành lắp ráp)
                    if (in_array($statusOrder, [1])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái "Chờ xác nhận"!');
                    } elseif (in_array($statusOrder, [2])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã xác nhận"!');
                    } elseif (in_array($statusOrder, [5])) {
                        return redirect()->route('assembly')->with('error', 'Không thể chuyển sang trạng thái "Đã hủy"!');
                    }
                    break;
                    // case 4: // trạng thái của assembly
                    //     if (in_array($statusOrder, [1, 2, 3, 4])) {
                    //         $order->status = 5;
                    //         return redirect()->route('assembly')->with('error', 'Không thể chuyển về trạng thái, vì đơn đã bị hủy!');
                    //     }
                    //     break;
                default:
                    # code...
                    break;
            }
        }
        $order->status = $statusOrder;

        $order->save();
    }
}