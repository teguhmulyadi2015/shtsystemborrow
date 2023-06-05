@extends('templates.app')

@section('content')
<div class="row py-2">
  <div class="col">
    <h1>Form Borrow Headphone</h1>
  </div>
</div>

<div class="row py-3">
    <div class="col">
        <a class="btn btn-secondary" href="{{ route('borrow.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
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
        <form action="{{ route('borrow.storeHeadphone') }}" method="POST">
            @csrf
            {{-- @method('POST') --}}
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">NIK</label>
                        <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Input your Employee ID" name="nik" value="{{ old('nik') }}" onkeyup="autoFill()"  autofocus>
                        @error('nik')                   
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>           
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" readonly disabled>
                        @error('fullname')                   
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>           
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Department</label>
                        <input type="text" class="form-control @error('dept') is-invalid @enderror"  name="dept" value="{{ old('dept') }}" readonly disabled>
                        @error('dept')                   
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>           
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Asset Code</label>
                        <select class="form-select @error('asset') is-invalid @enderror" name="asset" aria-label="Default select example">
                            <option value="">--Select--</option>
                            @foreach ($assets as $a)                                                           
                                <option value="{{ $a->asset_code }}" @if (old('asset') == $a->asset_code ) selected="selected" @endif>{{$a->asset_code .' - '. $a->asset_name }}</option>
                            @endforeach

                            @if ($assets->isEmpty())
                            <option value="">all Headphone is being borrowed</option>
                            @endif   
                        </select>
                        @error('asset')                   
                        <div class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                       </div>           
                        @enderror
                    </div>
                     <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Return Date Plan</label>
                        <input type="date" class="form-control @error('return_date_plan') is-invalid @enderror"  name="return_date_plan" value="{{ old('return_date_plan') }}" min={{date('Y-m-d', strtotime('+0 days')) }}   max="{{ date('Y-m-d', strtotime('+7 days')) }}" style="width:250px;" >
                        {{-- <input type="date" class="form-control @error('return_date_plan') is-invalid @enderror"  name="return_date_plan" value="{{ date('Y-m-d') }}"  style="width:250px;" disabled> --}}
                        @error('return_date_plan')                   
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>           
                        @enderror
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