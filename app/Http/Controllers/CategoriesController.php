<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{

    public function show(Category $category, Request $request)
    {
        $topics = Topic::withOrder($request->order)
                        ->where('category_id', $category->id)
                        ->paginate(20);
        return view('topics.index', compact('topics', 'category'));
    }

    //
    // public function show(Category $category){
    //     $topics = Topic::where('category_id', $category->id)->paginate(20);

    //     return view('topics.index', compact('topics', 'category'));
    // }
}
