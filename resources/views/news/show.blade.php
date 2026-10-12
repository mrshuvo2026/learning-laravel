<h1>{{ $news->title }}</h1>
<p>{{ $news->body }}</p>
<p>Category: {{ $news->category->name }}</p>
@if ($news->image)
    <img src="{{ asset('storage/' . $news->image) }}"
     alt="{{ $news->title }}"
     width="500">
@endif