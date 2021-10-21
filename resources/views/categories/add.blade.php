@extends('layouts.layout')


@section('title')
Categories
@endsection

@section('content')

  @include("components.navbar", ['currentPage' => 'category'])

  <div class="container-md mt-3">

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
            <h1>Ajouter une category</h1>
            </div>
            <div class="col-auto">
            <a class="btn btn-success" href="{{ route('categoryList') }}" role="button">Retour</a>
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
        <form method="POST" class="mt-3" action="{{ route('categoryStore') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group mt-3">
            <label>Nom de la categorie</label>
            <input type="text" class="form-control" name='name' placeholder="Nom de la catégorie" required/>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
        </form>
      </div>

@endsection
