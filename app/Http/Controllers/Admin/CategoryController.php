<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name'=> $request->name,
            'type' => $request->type,
            'image' => $imagePath,
            'status' => 'active'
        ]);
        return redirect()->back();
    }

    public function bulkDelete(Request $request) {
        $ids = json_decode($request->category_ids);
        if ($ids) {
            Category::whereIn('id', $ids)->delete();
        }
        return redirect()->back();
    }
}