<h1>Add Category</h1>
<form action="{{ route('categories.store') }} " method="POST">
@csrf
<input type="text" 
name="name"
placeholder="Category Name">
@error('name')
<p style="color: red">{{ $message }}</p>
@enderror
<button type="submit">Save</button>

</form>