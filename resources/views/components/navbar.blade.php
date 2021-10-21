<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" style="padding-left: 1cm;" href="{{route('postList') }}">Accueil</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ $currentPage === 'category' ? "active" : "" }}" href="{{ route('categoryList') }}">Categories</a>
      </li>
    </ul>
  </div>
</nav>
