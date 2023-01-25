@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container d-flex justify-content-center">
        <form method="post" action="{{ route('updateCollected', $proposal_id) }}" class="col col-lg-6 pt-5">
            @csrf
            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" class="form-control" name="nominal" id="nominal">
                <div class="form-text text-danger">Maksimal: Rp{{ number_format($maksimal,0,',','.') }}</div>
            </div>
            <div class="mb-3">
                <label for="share" class="form-label">Anda akan memiliki bisnis ini sebesar</label>
                <input type="text" class="form-control" name="share" id="share" disabled>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Kirim sebagai</label>
                <select id="status" class="form-select" name="status" id="status">
                    <option value="investasi">Investasi</option>
                    <option value="donasi">Donasi</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#nominal, #status').on('keyup change', function() {
                let capital = @json($capital);
                let maksimal = @json($maksimal);
                let acc_input = $('#nominal').val();
                let status = $('#status').val();
                
                if(acc_input >= maksimal) {
                    acc_input = maksimal;
                    $(this).val(maksimal);
                }

                var persen = 100*acc_input/capital;

                if(status == 'donasi') {
                    persen = 0;
                }

                var your_share = persen.toFixed(2).toString() + '%';
                
                $('#share').val(your_share);
            });
        });
    </script>
@endsection
