@extends('templates.app')

@section('content')
<div class="row py-2">
  <div class="col">
    <h1>Form Returned Asset</h1>
  </div>
</div>

<div class="row pb-1">
    <div class="col">
        <a class="btn btn-secondary" href="{{ route('home.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row">
    <div class="col">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col">
        <form action="{{ route('borrow.returned') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $borrow->id }}">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">NIK</label>
                        <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Input your Employee ID" name="nik" value="{{ old('nik') }}"  autofocus>
                        @error('nik')                   
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>           
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Asset Code</label>
                        <input type="text" class="form-control" name="asset_id" value="{{ $borrow->asset_id }}"  readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Asset Name</label>
                        <input type="text" class="form-control" value="{{ $borrow->asset_name }}"  readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date Borrow</label>
                        <input type="datetime" class="form-control"  value="{{ $borrow->date_borrow }}"  readonly>
                      
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date Return Plan</label>
                        <input type="datetime" class="form-control"  value="{{ $borrow->date_return_plan }}"  readonly>
                      
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date Returned</label>
                        <input type="datetime" class="form-control text-success" name="date_returned" value="{{ now() }}"  readonly>                      
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end">        
                            <button type="submit" class="btn btn-primary float-right  mx-1"><i class="bi bi-box-arrow-down"></i> Save</button>    
                            <button type="reset" class="btn btn-secondary float-right  mx-1"><i class="bi bi-x-square"></i> Reset</button>    
                        </div>
                    </div>

                </div>
            </div>  
    </form>      
    </div>
</div>



  @endsection