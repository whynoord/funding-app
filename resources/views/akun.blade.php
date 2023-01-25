@extends('layouts.app')

@section('content')
    <div class="container text-center py-3">
        <img src="https://source.unsplash.com/random/?person" alt="" class="rounded-circle mb-3" width="150"
            height="150">
        <h5>{{ $user->name }}</h5>
        <div class="row text-center detail-text pt-3">
            <div class="col border-end">
                <div id="btn-proposal">
                    <strong>
                        <p class="text-primary">{{ $proposal_count }}</p>
                    </strong>
                    <p class="text-black">Proposal</p>
                </div>
            </div>
            <div class="col border-end">
                <div id="btn-investasi">
                    <strong>
                        <p class="text-primary">{{ $investment_count }}</p>
                    </strong>
                    <p class="text-black">Investasi</p>
                </div>
            </div>
            <div class="col">
                <div id="btn-donasi">
                    <strong>
                        <p class="text-primary">{{ $donation_count }}</p>
                    </strong>
                    <p class="text-black">Donasi</p>
                </div>
            </div>
            <hr class="mt-3">
        </div>

        {{-- proposal aktif --}}
        <div class="row mt-3 text-start" id="proposal">
            <h4 class="{{ $proposal_count == 0 ? 'd-none' : '' }}">Proposal aktif</h4>
            @foreach ($proposals as $proposal)
                <div class="row my-3">
                    <div class="col img-container">
                        <img src="https://source.unsplash.com/random/?business" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col">
                        <a href="{{ route('detail', $proposal->id) }}" class="text-decoration-none">
                            <p class="proposal-title mb-1">{{ $proposal->name }}: {{ $proposal->description }}</p>
                        </a>
                        <div class="row mb-2">
                            <progress class="mt-3" value="{{ ($proposal->nominal / $proposal->capital) * 100 }}"
                                max="100"></progress>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <p>Modal dibutuhkan
                                    <br><strong>Rp{{ number_format($proposal->capital, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                            <div class="col-4 text-end">
                                <p>Share
                                    <br><strong>{{ $proposal->share }}%</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
            <div class="col d-flex justify-content-center">
                <div>
                    <a href="{{ route('buatProposal') }}"><button class="btn btn-primary">Buat Proposal Baru</button></a>
                </div>
            </div>
        </div>

        {{-- investasi --}}
        <div class="row mt-3 text-start d-none" id="investasi">
            <h4 class="{{ $investment_count == 0 ? 'd-none' : '' }}">Investasi</h4>
            @foreach ($investments as $investment)
                <div class="row my-3">
                    <div class="col img-container">
                        <img src="https://source.unsplash.com/random/?business" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col">
                        <a href="{{ route('detail', $investment->proposal->id) }}" class="text-decoration-none">
                            <p class="proposal-title mb-1">{{ $investment->proposal->name }}:
                                {{ $investment->proposal->description }}</p>
                        </a>
                        <div class="row">
                            <div class="col-7">
                                <p>My investment
                                    <br><strong>Rp{{ number_format($investment->nominal, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                            <div class="col-5 text-end">
                                <p>My share
                                    <br><strong>{{ number_format((100 * $investment->nominal) / $investment->proposal->capital, 1) }}%</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

        {{-- donasi --}}
        <div class="row mt-3 text-start d-none" id="donasi">
            <h4 class="{{ $donation_count == 0 ? 'd-none' : '' }}">Donasi</h4>
            @foreach ($donations as $donation)
                <div class="row my-3">
                    <div class="col img-container">
                        <img src="https://source.unsplash.com/random/?business" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col">
                        <a href="{{ route('detail', $donation->proposal->id) }}" class="text-decoration-none">
                            <p class="proposal-title mb-1">{{ $donation->proposal->name }}:
                                {{ $donation->proposal->description }}</p>
                        </a>
                        <div class="row">
                            <div class="col-7">
                                <p>My Donation
                                    <br><strong>Rp{{ number_format($donation->nominal, 0, ',', '.') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#btn-investasi').on('click', function() {
                $('#investasi').removeClass('d-none');
                $('#donasi').addClass('d-none');
                $('#proposal').addClass('d-none');
            });
            $('#btn-proposal').on('click', function() {
                $('#proposal').removeClass('d-none');
                $('#investasi').addClass('d-none');
                $('#donasi').addClass('d-none');
            });
            $('#btn-donasi').on('click', function() {
                $('#donasi').removeClass('d-none');
                $('#investasi').addClass('d-none');
                $('#proposal').addClass('d-none');
            });
        });
    </script>
@endsection
