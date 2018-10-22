@extends('layouts.app')

@section('content')
    <div style="margin: auto; width: 40%">
        <div>
            <h1>Edit post</h1>
            <form method="post" action="{{route('post.edit', ['post' => $post])}}" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT"/>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="group_id" value="{{ $post->group_id }}">

                <div>
                    <label for="group-select">Choose group</label>
                    <select name="group_id" id="group-select">
                        @foreach($admin_groups as $group)
                            <option value="{{$group->id}}"
                                    @if($group->id == $post->group_id)
                                    selected
                                    @endif
                            >
                                {{$group->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="text">Text:</label>
                    <input id='text' name="text" value="{{old('text') ?? $post->text}}"/>
                    @if($errors->has('text'))
                        <div>{{ $errors->first('text') }}</div>
                    @endif
                </div>
                <div>
                    <label for="post-date">Date:</label>
                    <input id="post-date" type="date" name="date" value="{{old('date') ?? $post->date}}" min="{{date('now')}}">
                    @if($errors->has('date'))
                        <div>{{ $errors->first('date') }}</div>
                    @endif
                </div>
                <div>
                    <label for="post-time">Time:</label>
                    <input id="post-time" type="time" name="time" value="{{old('time') ?? $post->time}}">
                    @if($errors->has('time'))
                        <div>{{ $errors->first('time') }}</div>
                    @endif
                </div>
                <div>
                    @foreach($images as $image)
                        {{--<a href="{{route('attachment.destroy', ['attachment' => $image])}}">X </a>--}}
                        <span class="image-destroy-btn">X </span>
                        <span>{{$image->name}}</span>
                        <br>
                    @endforeach
                    <label for="images">Add images</label>
                    <input type="file" accept=".jpeg,.png,.jpg,.gif" name="images[]" multiple>
                </div>
                <div>
                    @foreach($videos as $video)
                        <span class="video-destroy-btn">X </span>
                        <span>{{$video->name}}</span>
                        <br>
                    @endforeach
                    <label for="videos">Add videos</label>
                    <input type="file" accept="video/*" name="videos[]" multiple>
                </div>
                <button>Edit</button>
            </form>
        </div>
    </div>
@endsection
