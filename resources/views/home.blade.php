@extends('layouts.app')

@section('content')
<div class="container home py-3">
    @foreach ($proposals as $proposal)
    <div class="row my-3">
        <div class="col img-container">
            <img src="https://source.unsplash.com/random/?business" class="img-fluid rounded" alt="">
        </div>
        <div class="col">
            <a href="{{ route('detail', $proposal->id) }}" class="text-decoration-none">
                <p class="proposal-title mb-1">{{ $proposal->name }}: {{ $proposal->description }}</p>
            </a>
            <p><i class="bi bi-person"></i> {{ $proposal->user->name }}</p>
            {{-- <div class="row mb-2">
                <progress class="mt-3" value = "{{ ($proposal->nominal)/($proposal->capital)*100 }}" max = "100"></progress>
            </div> --}}
            <div class="row">
                <div class="col-8">
                    <p>Modal dibutuhkan
                    <br><strong>Rp{{ number_format($proposal->capital,0,',','.') }}</strong></p>
                </div>
                <div class="col-4 text-end">
                    <p>Share
                    <br><strong>{{ $proposal->share }}%</strong></p>
                </div>
            </div>
        </div>
    </div> 
    <hr>
    @endforeach
    <div class="row">
        <div class="col text-center">
            <h6>Test App<br> Email: user@gmail.com; Pass:12345</h6> 
        </div>
    </div>
</div>
@endsection
