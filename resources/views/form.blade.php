@error('owner')
{{$message}}
@enderror
@error('picture_link')
You already have a post with this name !
@enderror
<form action="" method="post">
    @csrf
    <div>
        <input type="text" name="title" value="{{old('title', $post->name)}}" required>
        @error('name')
        {{$message}}
        @enderror
    </div>
    <div>
        <textarea name="content">{{old('content', $post->content)}}</textarea>
        @error('content')
        {{$message}}
        @enderror
    </div>
    <button>
        @if($post->id)
            Edit
        @else
            Create
        @endif
    </button>
</form>