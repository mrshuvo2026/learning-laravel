{{ $errors->first('title') }}

@if ($errors->any())
    <div style="color: red;">
<ul>
    @foreach ($errors->all() as $error )
        <li>{{  $error }}</li>
    @endforeach
</ul>
    </div>
@endif
@error('title')
    <p style="color:red">{{ $message }}</p>
@enderror

<h1>Add News</h1>

<form action="{{ route('news.store') }}" method="POST">
    @csrf
    <select name="category_id">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
    <input type="text" name="title" placeholder="Title">
    @error('body')
    <p style="color:red">{{ $message }}</p>
    @enderror

    <textarea name="body" placeholder="Body"></textarea>
    <button type="submit">Save</button>
</form>