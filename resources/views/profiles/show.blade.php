@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="page-header">
                <h1>
                    {{ $profileUser->name }}
                    <small> Since {{ $profileUser->created_at->diffForHUmans() }}</small>
                </h1>
            </div>
            <hr> 
            @foreach ($activities as $date => $activity)
                <h3 class="page-header">{{ $date }}</h3>
                @foreach($activity as $record)
                    @include("profiles.activities.{$record->type}", ['activity' => $record])
                    <br>
                @endforeach
            @endforeach 
        </div>
    </div>
</div>
@endsection