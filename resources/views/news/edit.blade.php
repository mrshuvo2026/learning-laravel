<h1>Edit News</h1>

<form action="{{ route('news.update',
 $news) }}"
 method="POST"
 enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <select name="category_id">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id == $news->category_id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    <input type="text" name="title" value="{{ $news->title }}">
    <textarea name="body">{{ $news->body }}</textarea>
    @if ($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" 
        alt="{{ $news->title }}"
        width="300">
    @endif
    <input type="file" name="image">
    <button type="submit">Update</button>
</form>