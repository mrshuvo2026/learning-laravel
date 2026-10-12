@extends('layouts.app')
@section('content')
@if (session('success'))
    <div style="color: green; border: 2px solid green; padding: 10px; margin: 10px 0;">
{{ session('success') }}
    </div>
@endif
<h1>Add Category</h1>
<form action="{{route ('categories.store') }} " method = "POST">
    @csrf
    <input type="text" 
           name = "name"
           placeholder= "Category Name"
           >
           @error('name')
               <p style="color:red">{{ $message }}</p>
           @enderror
           <button type= "submit">Save</button>

</form>
<form action="{{ route('categories.index') }}"method = "GET">
<input type="text"
       name="search"
       value="{{ $search }}"
       placegolder="Search News....";
>
<button type="submit">Search</button>
</form>

<h1>Categories</h1>
@foreach ($categories as $category )
<p>{{ $category->id }} - {{ $category->name }}

<a href="{{ route('categories.edit',$category) }}">Edit</a>
<form action="{{ route('categories.destroy',$category) }}" method="POST">
@csrf
@method('DELETE')
<button type= "submit" onclick="return confirm('Are You Sure You Want To Delete This Category?')">
    Delete</button>
</form>

</p>
<p>News Count: {{ $category->news_count }}</p>
<p>News Exists:{{ $category->news_exists ? 'Yes' : 'No'}}</p>
@if ($category->news_count > 0)

<ul>
@foreach ($category->news as $news)
<li>{{ $news->title }}</li>
@endforeach
</ul>

@endif

@endforeach
{{ $categories->links()}}
<h1>Latest News</h1>
@foreach ($latestNews as $News)
<h2>{{ $news->title }}</h2>
<p>{{ $news->body }}</p>
    
@endforeach
@endsection