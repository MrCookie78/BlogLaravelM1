@extends('layouts.layout')


@section('title')
Liste des catégories
@endsection

@section('content')

  @include("components.navbar", ['currentPage' => 'posts'])

  <div class="container-md mt-3">

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
            <h1>Liste des catégories</h1>
            </div>
            <div class="col-auto">
            <a class="btn btn-success" href="{{ route('categoryAdd') }}" role="button">Ajouter</a>
            </div>
        </div>
    </div>
    <div class="container-md">
    @if(sizeof($categories) > 0)
        <div class="row mt-3">
            @foreach ($categories as $category)
            <div class="col-md-4 mb-3 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex flex-column text-center">

                        <form method="POST" action="{{ route('categoryUpdate', $category->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <input type="text" class="form-control" id="inputTitle" name="name" value="{{ old('title', $category->name) }}" placeholder="Nom de la catégorie">
                            </div>

                            <button class="btn btn-primary ms-2">Modifier</button>
                        </form>

                        <div class="d-flex mt-auto">
                            {{-- <a class="btn btn-info" href="{{ route('', $category->id) }}">Détail</a> --}}
                            <form method="POST" action="{{ route('categoryDelete', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger ms-2">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
    <p>Il n'y a aucun article.</p>
    @endif

    <div class="d-flex justify-content-center">
    {{ $categories->links() }}
    </div>

  </div>
@endsection

{{-- @section('js')
  <script>
    let button = document.querySelectorAll();
  </script>
@endsection --}}

