<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('index', compact('items'));
    }

    public function userIndex()
    {
        $items = Item::all();

        return view('userIndex', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        // upload image
        $imageName = NULL;
        if($request->hasFile('image')){
            $now = now()->format('Y-m-d_H.i.s');
            $imageName = $now . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $imageName, 'public');
        }


        // insert database
        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName
        ]);

        return redirect()->route('item.index');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        $categories = Category::all();

        return view('edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;

        // optional image update
        if($request->hasFile('image')){
            if($item->image) {
                Storage::disk('public')->delete('images/' . $item->image);
            }
            $now = now()->format('Y-m-d_H.i.s');
            $imageName = $now . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $imageName, 'public');
            $item->image = $imageName;
        }

        $item->save();

        return redirect()->route('item.index');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if($item->image) {
            Storage::disk('public')->delete('images/' . $item->image);
        }

        $item->delete();

        return redirect()->route('item.index');
    }
}