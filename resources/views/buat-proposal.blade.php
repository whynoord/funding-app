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
  <form method="post" action="{{ route('simpanProposal') }}" enctype="multipart/form-data" class="col col-lg-6 pt-5">
        @csrf
        
          <div class="mb-3">
            <label for="name" class="form-label">Nama Bisnis</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi singkat</label>
            <textarea class="form-control" rows="2" name="description"></textarea>
            <div class="form-text">Contoh: Bisnis berjualan donat aneka rasa</div>
          </div>
          <div class="mb-3">
            <label for="capital" class="form-label">Modal yang dibutuhkan</label>
            <input type="number" class="form-control" name="capital">
          </div>
          <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="share" class="form-label">Bagi hasil</label>
                    <input type="number" class="form-control" name="share">
                </div>
            </div>
            <div class="col-1 d-flex align-items-center">
              %
            </div>
          </div>
          <div class="mb-3">
            <label for="detail" class="form-label">Detail bisnis</label>
            <textarea class="form-control" rows="10" name="detail"></textarea>
          </div>
          <h5>Rencana penggunaan dana</h5>
          <div class="fund"></div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                  <input type="number" class="form-control" name="nominal[]" placeholder="nominal">
              </div>
            </div>
            <div class="col-7">
              <div class="mb-3">
                  <input type="text" class="form-control" name="usage[]" placeholder="penggunaan">
              </div>
            </div>
            <div class="col-1">
              <button type="button" class="btn btn-transparent addFund"><i class="bi bi-plus-square"></i></button>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addFund').on('click', function(){
    addFund();
  });
  function addFund(){
    var fund = '<div class="row"><div class="col-4"><div class="mb-3"><input type="number" class="form-control" name="nominal[]" placeholder="nominal"></div></div><div class="col-7"><div class="mb-3"><input type="text" class="form-control" name="usage[]" placeholder="penggunaan"></div></div><div class="col-1"><button type="button" class="btn btn-transparent remove"><i class="bi bi-x-square-fill"></i></button></div></div>';
    $('.fund').append(fund);
  };
  $('.remove').live('click', function(){
    $(this).parent().parent().remove();
  });
</script>

@endsection
