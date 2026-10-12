@if(auth()->check())
    <h3>
        Notifications
        ({{ auth()->user()->unreadNotifications->count() }})
    </h3>

    @forelse(auth()->user()->notifications as $notification)
        <p>
            {{ $notification->data['title'] }}
            -
            {{ $notification->data['message'] }}

            @if(is_null($notification->read_at))
                <strong>(Unread)</strong>

                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="submit">Mark as Read</button>
                </form>
            @else
                <strong>(Read)</strong>
            @endif
        </p>
    @empty
        <p>No notifications found.</p>
    @endforelse
@endif

<h1>All News</h1>
@can('create-news')
     <a href="{{ route('news.create') }}">Add News</a>
@endcan
   
<form action="{{ route('news.index') }}" method="GET"> 
    <input type="text" 
        name="search" 
        placeholder="Search news..." 
        value="{{ request('search') }}" 
    >

    <select name="category">
        <option value="">All Categories</option>

        @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Search</button> 
</form>

    

@foreach ($news as $item )
<div>
<h3>{{ $item->title }}</h3>
<a href="{{ route('news.show', $item) }}">Read More</a>

@if ($item->image)
    <img src="{{ asset('storage/' . $item->image) }}"
     alt="{{ $item->title }}"
     width= "300">
     
@endif

<p>{{ $item->body }}</p>
<small>Category:{{ $item->category->name ?? 'No Category' }}</small>
<br>

@can('update',$item)
    <a href="{{ route('news.edit',$item) }}">Edit</a>
    @endcan
    
    @can('delete',$item)
<form action="{{ route('news.destroy',$item) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button type="submit" onclick ="return confirm('delete?')">Delete</button>
</form>
@endcan


</div>
@endforeach
{{ $news->withQueryString()->links() }}
    
