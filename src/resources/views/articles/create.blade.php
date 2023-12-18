@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create new article') }}</div>
                    <div class="card-body">
                    <form action="{{ route('articles.store') }}"
                          method="POST">
                        @csrf
{{--                        @method('POST')--}}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">title</label>
                            <input name="title" type="text" class="form-control" required value="{{old('title')}}">
                            @if($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">content</label>
                            <textarea name="content" class="form-control" rows="3" required>{{old('content')}}</textarea>
                            @if($errors->has('content'))
                                <p class="text-danger">{{ $errors->first('content') }}</p>
                            @endif
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-info">create</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
