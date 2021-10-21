@extends('layouts.layout')


@section('title')
Le titre de ma page
@endsection

@section('content')

  @include("components.navbar", ['currentPage' => 'posts'])

  <div class="container-md mt-3">

    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-auto">
          <h1>Détail de l'article</h1>
        </div>
        <div class="col-auto">
          <a class="btn btn-primary" href="{{ route('postList') }}" role="button">Retour</a>
        </div>
      </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form class="mt-3" method="POST" action="{{ route('postUpdate', $post->id) }}">
                @csrf
                @method("PUT")

                <div class="form-group">
                    <label for="inputTitle">Titre</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter Title">
                </div>
                <div class="form-group mt-3">
                    <label for="inputDesc">Description</label>
                    <textarea type="text" class="form-control" id="inputDesc" name="description" placeholder="Enter Description">{{ old('description', $post->description) }}</textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="inputExtrait">Extrait</label>
                    <input type="text" class="form-control" id="inputExtrait" name="extrait" value="{{ old('extrait', $post->extrait) }}" placeholder="Enter Extrait">
                </div>
                <div class="form-group mt-3">
                    <label for="inputExtrait">Ecrit le {{ $post->created_at->format('d/m/Y') }}</label>
                </div>
                <div>
                    @foreach ($categories as $category)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="check-{{$category->id}}" name="checkboxCategories[{{$category->id}}]" value="{{$category->id}}" @if($post->categories->contains('id', $category->id)) checked @endif/>
                            <label for="check-{{$category->id}}" class="form-check-label">{{$category->name}}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-warning mt-3">Modifier</button>
                <a class="btn btn-success mt-3" href="{{ route('postList') }}" role="button">Retour</a>
            </form>
        </div>

        <div class="col-md-6">
            <form class="mt-3" method="POST" action="{{ route('postUpdatepicture', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="form-group mt-3">
                    <label>Image</label>
                    <input type="file" class="form-control" name="picture" accept="image/png, image/jpeg, image/jpg, image/svg+xml" required />
                </div>
                <button type="submit" class="btn btn-warning mt-3">Modifier</button>
            </form>
        </div>
    </div>

    <form class="mt-3" method="POST" action="{{ route('postDelete', $post->id) }}">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger mt-3">Supprimer cette Article</button>
    </form>

    <h2 class="mt-4">Commentaires</h2>

    @if (sizeof($post->comments) > 0)
        <ul>
            @foreach ($post->comments as $comment)
                <li class="d-flex flex-row align-items-baseline">
                    <p>{{ $comment->content }}</p>
                    <form method="post" action="{{ route('comment-delete', $comment->id) }}" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Il n'y a aucun commentaire.</p>
    @endif

    <form method="post" action="{{ route('commentAdd', $post->id) }}">
        @csrf

        <div class="form-group">
            <label>Votre commentaire</label>
            <input type="text" class="form-control" name="content" required />
        </div>
        <button type="submit" class="btn btn-primary">Ajouter ce commentaire</button>
    </form>
  </div>
@endsection

