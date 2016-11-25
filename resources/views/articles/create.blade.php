@extends('articles.layout')
@section('title', 'ブログ登録')
@section('content')
  　<h1>New Article Add Form</h1>
    <hr>

    @include('articles.form_error')

    {!! Form::open(['route' => 'articles.store']) !!}
        @include('articles.form', ['submitButton' => '登録'])
　  {!! Form::close() !!}
@endsection
