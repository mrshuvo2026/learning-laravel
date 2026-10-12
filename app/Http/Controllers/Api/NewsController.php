<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
public function index()
{
$news = News::with('category')->get();
return NewsResource::collection($news);
}

public function show($id)
{
    $news = News::with('category')->findOrFail($id);
    return new NewsResource($news);
}

public function store(Request $request)
{
    $request->validate([
    'category_id' => 'required|exists:categories,id',
    'title' => 'required|min:5|max:100',
    'body' => 'required|min:10',
    ]);


    $news = News::create([
        'category_id'=>$request->category_id,
        'title'=>$request->title,
        'body'=>$request->body,
    ]);
return new NewsResource($news);
}
public function update(Request $request, $id)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|min:5|max:100',
        'body' => 'required|min:10',
    ]);

    $news = News::findOrFail($id);

    $news->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return new NewsResource($news);

}
public function destroy($id)
{
$news = News::findOrFail($id);
$news->delete();
 return response()->json([
 'message' =>'News Deleted Successfully',
 ]);

}

}
