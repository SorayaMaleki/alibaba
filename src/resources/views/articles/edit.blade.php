@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('update article') }}</div>
                    <div class="card-body">
                        <form action="{{ route('articles.update',["article"=>$article->id]) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleFormControlInput1">title</label>
                                <input name="title" type="text" class="form-control" required
                                       value="{{$article->title}}">
                                @if($errors->has('title'))
                                    <p class="text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">content</label>
                                <textarea name="content" class="form-control" rows="3"
                                          required>{{$article->content}}</textarea>
                                @if($errors->has('content'))
                                    <p class="text-danger">{{ $errors->first('content') }}</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-info">update</button>
                            <br/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
