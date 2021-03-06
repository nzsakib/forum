@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                            <a href="{{ route('profile', $thread->creator) }}"> {{ $thread->creator->name }} </a>
                            posted: {{ $thread->title }}
                        </span>
                        
                        @can('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">Delete Thread</button>
                            </form>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>
            {{-- @foreach($replies as $reply)
                @include('threads.reply')
            @endforeach --}}
<br>
            {{ $replies->links() }}
            @if(auth()->check())
                <form method="post" action="{{ $thread->path() . '/replies' }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" cols="30" rows="5" placeholder="Have something to say?" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            @else 
                <div class="text-center">
                    Please <a href="{{ route('login') }}">Sign In</a> to participate in discussion
                </div>
            @endif


        </div> {{-- col-md-8 --}}

        <div class="col-md-4">
            <div class="card">

                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }}
                        <br> by <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> <br>
                        Currently has <span v-text="repliesCount"></span> {{ str_plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
</thread-view>
@endsection
