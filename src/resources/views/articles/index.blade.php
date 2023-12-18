@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Articles') }}
                        <a class="btn btn-primary float-end" role="button"
                        href="{{route("articles.create")}}">create new article</a>
                    </div>
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
                                        @can('view', $article)
                                        <a class="btn btn-primary" role="button"
                                           href="{{route("articles.show", ['article' => $article->id])}}">Show</a>
                                        @endcan
                                        @can('approve', $article)
                                                <form action="{{ route('article.approve', ['article' => $article->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-info">publish</button>
                                                </form>
                                            @endcan
                                        @can('update', $article)
                                        <a class="btn btn-success" role="button"
                                           href="{{route("articles.edit", ['article' => $article->id])}}">edit</a>
                                        @endcan
                                        @can('delete', $article)
                                            <form action="{{ route('articles.destroy', ['article' => $article->id]) }}"
                                                  method="POST">
                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">delete</button>
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
