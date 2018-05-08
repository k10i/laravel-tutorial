@extends('layout')

@section('content')
    <h1>ブログ一覧(テスト)</h1>
    <p><a href="/create" class="btn btn-primary">新規追加</a></p>

    @foreach ($articles as $article)
    <div class="card mb-2">
      <div class="card-body">
        <h4 class="card-title"><a href="/articles/{{ $article->id }}">{{ $article->title }}</a></h4>
        <h6 class="card-subtitle mb-2 text-muted">{{ $article->updated_at }}</h6>
        <p class="card-text">{{ $article->body }}</p>
        <a href="/edit/{{ $article->id }}" class="card-link">修正</a>
        <a href="/delete/{{ $article->id }}" class="card-link">削除</a>
      </div>
    </div>
    @endforeach

    <div class="row">
       <div class="col-md-4 col-md-offset-4">
    {{ $articles->links() }}
  </div>
  </div>
@endsection
