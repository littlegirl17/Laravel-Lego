<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    // app/Http/Controllers/BlockController.php

    public function index()
    {
        $blocks = Block::all();
        return response()->json($blocks);
    }

    public function store(Request $request)
    {
        // Tạo khối mới
        $block = Block::create($request->all());
        return response()->json($block, 201); // Trả về khối mới được tạo
    }

    public function update(Request $request, $id)
    {
        // Tìm khối với ID tương ứng
        $block = Block::findOrFail($id);

        // Cập nhật vị trí khối
        $block->update($request->all());

        // Trả về phản hồi JSON
        return response()->json($block, 200);
    }
}
