<h1>Edit News</h1>

<form action="{{ route('news.update', $news) }}" method ="POST">

@csrf
@method('PUT')

<select name="category_id">
@foreach ($category as $cat )
<option value="{{ $cat->id }}"
    {{ $news->category_id == $cat->id ? 'selected' : '' }}>
    {{ $cat->name }}
</option>
@endforeach
</select>

<input type="text"
       name="title"
       value="{{ $news->title }}">
       <textarea name="body" >{{ $news->body }}</textarea>
       <button type="submit">Update</button>
</form>


