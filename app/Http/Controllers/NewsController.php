<?php

namespace App\Http\Controllers;

use App\Notifications\NewsCreateNotification;
use App\Events\NewsCreated;
use App\Jobs\SendNewsNotification;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsCreatedMail;
class NewsController extends Controller implements HasMiddleware
{
    public static function middleware():array
    {
       return [
        new Middleware('auth'),
       ];
    }

    public function index( Request $request)
    {
        $categories = Category::all();
        
        $news = News::with('category')->when($request->search, function($query,$search){
            $query->search($search);
        })
        ->when($request->category, function ($query, $category){
            $query->byCategory($category);
        })
        ->paginate(5);

        return view('news.index', compact('news','categories'));
    }

    public function show(News $news)
{
    return view('news.show', compact('news'));
}

 public function create()
{
    Gate::authorize('create-news');
    $categories = Category::all();

    return view('news.create', compact('categories'));
}

   public function store(NewsRequest $request)
   {
    $imagePath = null;
    if ($request->hasFile('image')){

    $imagePath =$request->file('image')->store('news','public');
    }
    
   
     $news= News::create([
        'user_id' => auth()->id(),
        'category_id' =>$request->category_id,
        'title' =>$request->title,
        'body'=>$request->body,
        'image' =>$imagePath,
    ]);
    Mail::to(config('mail.admin_email'))->queue(
        new NewsCreatedMail($news)
    );
    
    SendNewsNotification::dispatch($news);
    event(new NewsCreated($news));
    auth()->user()->notify(new NewsCreateNotification($news));

    return redirect()->route('news.index');
   }
    public function edit(News $news)
    {
        Gate::authorize('update', $news);
        $categories = Category::all();
        return view('news.edit', compact('news', 'categories'));
    }

    public function update(NewsRequest $request, News $news)
    {
        Gate::authorize('update',$news);
       
       if($request->hasFile('image')){
        if($news->image){
            Storage::disk('public')->delete($news->image);
        }
        $imagePath = $request->file('image')->store('news','public');
        $news->image=$imagePath;
       }
       $news->category_id = $request->category_id;
       $news->title = $request->title;
       $news->body = $request->body;
       $news->save();
        return redirect()->route('news.index');
    }

    public function destroy(News $news)
    {
        Gate::authorize('delete',$news);
        if($news->image){
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('news.index');
    }
}