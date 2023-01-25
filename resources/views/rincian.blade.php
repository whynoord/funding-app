@extends('layouts.app')

@section('content')
<section class="pb-3">
    <div class="container">
        <h3>Rincian penggunaan dana</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penggunaan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($funds as $fund)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fund->usage }}</td>
                    <td>Rp{{ number_format($fund->nominal,0,',','.') }}</td>
                </tr>
                @endforeach
                <tr class="table-warning">
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td><strong>Rp{{ number_format($total,0,',','.') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection
