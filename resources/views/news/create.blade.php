<h1>Add News</h1>
@error('title')
    <p style="color:red">{{ $message }}</p>
@enderror
<form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <select name="category_id">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <p style="color: red">{{ $message }}</p>
    @enderror
    <input type="text" name="title" placeholder="Title">
    <textarea name="body" placeholder="Body"></textarea>
    @error('body')
        <p style="color: red">{{ $message }}</p>
    @enderror
    <input type="file" name="image">
    @error('image')
        <p style="color: red">{{ $message }}</p>
    @enderror
    <button type="submit">Save</button>
</form>