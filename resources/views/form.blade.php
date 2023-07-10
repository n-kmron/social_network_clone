@error('owner')
{{$message}}
@enderror
<form action="" method="post" enctype="multipart/form-data" class="form-group">
    @csrf
    <div>
        <input type="text" name="title" value="{{old('title', $post->name)}}" class="form-control" required>
        @error('name')
        {{$message}}
        @enderror
    </div>
    <div>
        <textarea name="content" class="form-control">{{old('content', $post->content)}}</textarea>
        @if ($errors->has('picture_link'))
            <p>{{ $errors->first('picture_link') }}</p>
        @endif
        @error('content')
        {{$message}}
        @enderror
    </div>
    <div>
        <input type="file" name="picture_link" class="form-control">
        @error('picture_link')
        {{$message}}
        @enderror
    </div>
    <button class="form-control">
        @if($post->id)
            Edit
        @else
            Create
        @endif
    </button>
</form>