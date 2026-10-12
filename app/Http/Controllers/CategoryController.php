<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
public function index(Request $request)
{
  $search=$request->search;

$categories = Category::search($search)
->with('news')
->withCount('news')
->withExists('news')
->paginate(3);

$latestNews = News::latest()->take(1)->get();
return view('Category',compact('categories', 'search','latestNews'));
}

public function create()
{
  return view('category-create');
}

public function show(Category $category)
{
   $latestNews = $category->news()
   ->latest()
   ->take(1)
   ->get();
   return $latestNews;
}

public function store(CategoryRequest $request)
{

  Category::create
           (['name' =>$request->name,
  ]);

  session()->flash('success', 'Category Created Successfully!');

  return redirect()->route('categories.index');
}

public function edit(Category $category)
{
return view('edit',compact('category'));
}

public function update(CategoryRequest $request, Category $category)
{
  
  $category->update([

'name'=>$request->name,

  ]);
  session()->flash('success', 'Category Updated Successfully!');
  return redirect()->route('categories.index');

}

public function destroy(Category $category)
{
  
  $category->delete();
  session()->flash('success', 'Category Deleted Successfully!');
  return redirect()->route('categories.index');
}

}
