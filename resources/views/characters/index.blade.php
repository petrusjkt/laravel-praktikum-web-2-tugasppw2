@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center">Character List</h1>
    
    <h3 class="text-center">total: {{ $characters->count() }}</h3>
    
    @foreach ($characters as $character )
        <ul>
            <li>Name : {{ $character->name }}</li>
            <li>Game Series : {{ $character->game_series }}</li>
            <li>First Appearance : {{ $character->first_appearance_year }}</li>
            <li>Creator : {{ $character->creator }}</li>
            <li>Description : {{ $character->description }}</li>
        </ul>
    @endforeach
</div>

    
@endsection

