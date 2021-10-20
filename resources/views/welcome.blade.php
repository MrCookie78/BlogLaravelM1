@extends('layouts.layout')


@section('content')

  @include("components.navbar", ['currentPage' => 'home'])

  <div class="container-fluid">
    <h1>Ceci est un titre</h1>
    <h1>Ceci est un titre</h1>
    <h1>Ceci est un titre</h1>
    <h1>Ceci est un titre</h1>
    <h1>Ceci est un titre</h1>
  </div>

@endsection

@section('title')

Welcome

@endsection