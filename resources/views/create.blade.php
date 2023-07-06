@extends('canevas')
@section('title', 'Créer un post')
@section('content')
    <form action="" method="post">
        @csrf
        <input type="text" name="title" value="Mon article"required>
        <textarea name="content">Contenu de démonstration</textarea>
        <button>Enregistrer</button>
    </form>
@endsection