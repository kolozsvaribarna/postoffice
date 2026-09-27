@extends('layouts.app')

@section('title', $city->name)

@section('content')
    <h1>Város adatai</h1>

    <div class="card">
        <h3>Név</h3>
        <h4>{{ $city->name }}</h4>

        <h3>Népesség</h3>
        <h4>{{ number_format($city->population, 0, ',', ' ') }}</h4>

        <h3>Irányítószám</h3>
        <h4>{{ $city->zip_code }}</h4>

        <h3>Megye</h3>
        <h4>{{ $city->county->name ?? '' }}</h4>
        @if ($city->county && $city->county->coat_of_arms_url)
            <img width="100" src="{{ $city->county->coat_of_arms_url }}" alt="county image">
        @endif

        <p><a href="{{ route('cities.index') }}" class="button">← Vissza a listához</a></p>
    </div>
@endsection
