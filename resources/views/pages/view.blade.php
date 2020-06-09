@extends('layout', ['title' => $user->name])

@section('styles')
@stop

@section('content')
    <header>
        <span class="avatar"><img src="{{ $user->image }}" alt="user avatar" /></span>
        <h1>{{ $user->name }}</h1>
        <a href="{{route('comment', ['id' => $user->id])}}?type=form">
        	<button>Add Comment</button>
        </a>
        <a href="{{route('comment', ['id' => $user->id])}}?type=json">
            <button>Add JSON Comment</button>
        </a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        
        <hr/>
        @forelse($user->comments as $comment)
            <p>{{ nl2br($comment->comment) }}</p>
            {{-- <p>{!! nl2br($comment->comment) !!}</p> --}}
        @empty
        	<p>No any comment.</p>
        @endforelse
    </header>
@stop

@section('scripts')
@stop