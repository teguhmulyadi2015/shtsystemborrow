@extends('templates.app')

@section('content')
<div class="row py-2">
  <div class="col">
    <h2>Form Print</h2>
  </div>
</div>

<div class="row py-3">
    <div class="col">
        <a class="btn btn-secondary" href="{{ route('print.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
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
        <form action="{{ route('print.store') }}" method="POST">
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
                        <label for="exampleFormControlTextarea1" class="form-label">Color / BW</label>
                        <select class="form-select @error('colorbw') is-invalid @enderror" name="colorbw" aria-label="Default select example">
                            <option value="">--Select--</option> 
                            <option value="C" @if (old('colorbw') == "C" ) selected="selected" @endif>Color</option> 
                            <option value="BW" @if (old('colorbw') == "BW" ) selected="selected" @endif>Black White</option> 
                        </select>
                        @error('asset')                   
                        <div class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                       </div>           
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Kertas</label>
                        <select class="form-select @error('kertas') is-invalid @enderror" name="kertas" aria-label="Default select example">
                            <option value="">--Select--</option> 
                            <option value="KS"  @if (old('kertas') == "KS" ) selected="selected" @endif>Kertas Sendiri</option> 
                            <option value="KI" @if (old('kertas') == "KI" ) selected="selected" @endif>Kertas IT</option> 
                        </select>
                        @error('asset')                   
                        <div class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                       </div>           
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jumlah Kertas</label>
                        <input type="number" step="1" min="1" class="form-control @error('sheetsQty') is-invalid @enderror" placeholder="Input your Amount Sheets Printed" name="sheetsQty" value="{{ old('sheetsQty') }}"  autofocus>
                        @error('sheetsQty')                   
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>           
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">        
                            <button type="submit" class="btn btn-primary float-right  mx-1" id="submit"><i class="bi bi-box-arrow-down"></i> Save</button>    
                            <button type="reset" class="btn btn-secondary float-right  mx-1"><i class="bi bi-x-square"></i> Reset</button>    
                        </div>
                    </div>

                </div>
            </div>  
    </form>      
    </div>
</div>



  @endsection