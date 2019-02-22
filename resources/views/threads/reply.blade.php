<br>
<div class="card">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="#" class="flex">
                    {{ $reply->owner->name }}
                </a> said
                {{ $reply->created_at->diffForHumans() }} ...
            </h5>
            
            <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                @csrf
                <button type="submit" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    {{ $reply->favorites()->count() }} {{ str_plural('Favorite', $reply->favorites()->count()) }}
                </button>
            </form>
            
        </div>
        
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>