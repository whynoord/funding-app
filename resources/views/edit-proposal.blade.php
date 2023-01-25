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
  <form method="post" action="{{ route('updateProposal', $proposal->id) }}" enctype="multipart/form-data" class="col col-lg-6 pt-5">
        @csrf
        
          <div class="mb-3">
            <label for="name" class="form-label">Nama Bisnis</label>
            <input type="text" class="form-control" name="name" value="{{ $proposal->name }}">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Deskripsi singkat</label>
            <textarea class="form-control" rows="2" name="description">{{ $proposal->description }}</textarea>
            <div class="form-text">Contoh: Bisnis berjualan donat aneka rasa</div>
          </div>
          <div class="mb-3">
            <label for="capital" class="form-label">Modal yang dibutuhkan</label>
            <input type="number" class="form-control" name="capital" value="{{ $proposal->capital }}">
          </div>
          <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="share" class="form-label">Bagi hasil</label>
                    <input type="number" class="form-control" name="share" value="{{ $proposal->share }}">
                </div>
            </div>
            <div class="col-1 d-flex align-items-center">
              %
            </div>
          </div>
          <div class="mb-3">
            <label for="detail" class="form-label">Detail bisnis</label>
            <textarea class="form-control" rows="10" name="detail">{{ $proposal->detail }}</textarea>
          </div>
          {{-- <div class="row">
            <h5>Rencana penggunaan dana</h5>
            <div class="col-4">
              <div class="mb-3">
                  <input type="number" class="form-control" name="nominal" placeholder="nominal">
              </div>
            </div>
            <div class="col-7">
              <div class="mb-3">
                  <input type="text" class="form-control" name="usage" placeholder="penggunaan">
              </div>
            </div>
            <div class="col-1">
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                  <input type="number" class="form-control" name="nominal" placeholder="nominal">
              </div>
            </div>
            <div class="col-7">
              <div class="mb-3">
                  <input type="text" class="form-control" name="usage" placeholder="penggunaan">
              </div>
            </div>
            <div class="col-1">
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                  <input type="number" class="form-control" name="nominal" placeholder="nominal">
              </div>
            </div>
            <div class="col-7">
              <div class="mb-3">
                  <input type="text" class="form-control" name="usage" placeholder="penggunaan">
              </div>
            </div>
            <div class="col-1">
              <button type="button" class="btn btn-transparent"><i class="bi bi-plus-square"></i></button>
            </div>
          </div> --}}
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

@endsection
