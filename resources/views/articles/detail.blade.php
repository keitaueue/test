@extends('articles.layout')
@section('title', '詳細')
@section('content')
    <h1>{{ $article->title }}</h1>
    <hr>
    <p>{{ $article->body }}</p>

    @unless ($article->tags->isEmpty())
        <h5>Tags:</h5>
        <ul>
            @foreach($article->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    @endunless

    {!! link_to(route('articles.edit', ['id' => $article->id]), $title = '編集', $attributes = array('a', 'b'), $secure = null) !!}
    <br/>

    {!! delete_form([route('articles.destroy', ['id' => $article->id]), $article->id]) !!}
@endsection
