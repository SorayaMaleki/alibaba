@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Show') }}</div>
                    <div class="card-body">
                        <h3>{{$article->title}}({{$article->status}})</h3>
                        <p> {{$article->content}}</p>
                        <p><b>author:</b> {{$article->user->name}}</p>
                        <p><b>publish date:</b> {{$article->publish_date}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
