@extends('layouts.layout')

@section('title')
Ajouter
@endsection

@section('content')

  @include("components.navbar", ['currentPage' => 'posts'])

  <div class="container-fluid mt-3">

    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-auto">
          <h1>Ajouter un article</h1>
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

    <div class="container-md">
      <form method="POST" class="mt-3" action="{{ route('postStore') }}">
        @csrf
        <div class="form-group mt-3">
          <label>Titre</label>
          <input type="text" class="form-control" name='title' placeholder="Titre de l'article" required/>
        </div>
        <div class="form-group mt-3">
          <label>Description</label>
          <textarea class="form-control" name="description" rows="5" required></textarea>
        </div>
        <div class="form-group mt-3">
          <label>Extrait</label>
          <input type="text" class="form-control" name='extrait' placeholder="Extrait de l'article" required/>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
      </form>
    </div>
  </div>
@endsection

