@extends('articles.layout')
@section('title', 'ブログ一覧')
@section('content')
    @if(Session::has('flash_message'))
        <div>{{ session('flash_message') }}</div>
    @endif

    {!! link_to('/articles/create', '新規作成', ['class' => 'btn btn-primary']) !!}

    @foreach($articles as $article)
        <div>
          　<a href="{{ route('articles.show', ['id' => $article->id]) }}">
              <p>{{ $article->title }}</p>
            </a>
            <p>{{ $article->body }}</p>
        </div>
        <hr>
    @endforeach
@endsection
