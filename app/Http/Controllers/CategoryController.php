<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Hiển thị danh sách các danh mục
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }
    

    // Hiển thị form để tạo danh mục mới
    public function create()
    {
        return view('categories.create');
    }

    // Lưu danh mục mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    // Hiển thị một danh mục cụ thể
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    // Hiển thị form để chỉnh sửa danh mục cụ thể
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Cập nhật danh mục cụ thể trong cơ sở dữ liệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    // Xóa danh mục cụ thể khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
