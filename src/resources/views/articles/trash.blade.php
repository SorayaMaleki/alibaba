@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Trashed Articles') }} </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Author</th>
                                <th scope="col">title</th>
                                <th scope="col">status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $key=>$article)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$article->user->name}}</td>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->status}}</td>
                                    <td class="d-flex justify-content-around">
                                        @can('restore', $article)
                                            <form action="{{ route('article.restore', ['article' => $article->id]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-info">Restore</button>
                                            </form>
                                        @endcan
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
