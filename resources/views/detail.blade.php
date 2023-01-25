@extends('layouts.app')

@section('content')
<div class="section header">
    <img class='img-fluid' src="https://source.unsplash.com/random/?business" alt="">
</div>
<section>
    <div class="container detail">
        <p class="text-title mb-3">{{ $proposal->name }}: {{ $proposal->description }}</p>
        <div class="row mb-3 detail-text">
            <div class="col-9">
                <p><span class="text-primary">Rp{{ number_format($accfund,0,',','.') }}</span>
                <br>Terkumpul dari <strong>Rp{{ number_format($proposal->capital,0,',','.') }}</strong></p>
            </div>
            <div class="col-3 text-end">
                <p>Share
                <br><strong>{{ $proposal->share }}%</strong></p>
            </div>
        </div>
        <div class="row">
            <progress class="mt-3" value = "{{ $persen }}" max = "100"></progress>
        </div>
        <div class="row text-center detail-text pt-3">
            <div class="col border-end">
                <strong><p class="text-primary">{{ $investasi }}</p></strong>
                <p>Investasi</p>
            </div>
            <div class="col">
                <strong><p class="text-primary">{{ $donasi }}</p></strong>
                <p>Donasi</p>
            </div>
            <hr class="mt-3">
        </div>
    </div>
</section>

<section class="info">
    <div class="container">
        <p class="text-title">Informasi Enterpreneur</p>
        <div class="row mt-2">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="https://source.unsplash.com/random/?user" alt="" class="rounded-circle" width="50" height="50">
                        </div>
                        <div class="col-9 d-flex align-items-center">
                            <div>
                                <p><strong>{{ $proposal->user->name }}</strong>
                                <br>Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6><a href="{{ route('rincian', $proposal->id) }}" class="text-decoration-none">Rincian Penggunaan Dana ></a></h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mb-3">
        <h3 class="text-title">Deskripsi bisnis</h3>
        <p>{{ $proposal->detail }}</p>
    </div>
</section>

<div class="container action-call pb-3">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <button class="btn btn-success me-2"><i class="bi bi-whatsapp"></i>Chat</button>
            <a href="{{ route('kirimDana', $proposal->id) }}"><button class="btn btn-warning">Kirim Dana Sekarang</button></a>
        </div>
    </div>
</div>
@endsection
