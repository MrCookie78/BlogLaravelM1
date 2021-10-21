@extends('layouts.layout')


@section('title')
Le titre de ma page
@endsection

@section('content')

  @include("components.navbar", ['currentPage' => 'posts'])

  <div class="container-md mt-3">
    @if($loading)
      {{$loading}}
      <p>Chargement...</p>
    @else
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-auto">
            <h1>Liste des articles</h1>
          </div>
          <div class="col-auto">
            <a class="btn btn-success" href="{{ route('postAdd') }}" role="button">Ajouter</a>
          </div>
        </div>
      </div>
      <div class="container-md">
        @if(sizeof($posts) > 0)
        <div class="row mt-3">
          @foreach ($posts as $post)
          <div class="col-md-4 mb-3 d-flex align-items-stretch">
            <div class="card w-100">
                <img src="{{asset("storage/".$post->picture)}}"
                class="card-img-top"
                style="object-fit: cover"
                height="200"/>
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->extrait}}</p>
                <p>Il y a {{$post->countComments()}} commentaire(s)</p>
                @foreach ($post->categories as $category)
                    <span>{{$category->name}}</span>
                @endforeach
                <div class="d-flex mt-auto">
                  <a class="btn btn-info" href="{{ route('postDetail', $post->id) }}">Détail</a>
                  <form method="POST" action="{{ route('postDelete', $post->id) }}">
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
      </div>
      @else
        <p>Il n'y a aucun article.</p>
      @endif

      <div class="d-flex justify-content-center">
        {{ $posts->links() }}
      </div>

    @endif
  </div>
@endsection

{{-- @section('js')
  <script>
    let button = document.querySelectorAll();
  </script>
@endsection --}}

