@extends('templates.app')

@section('content')
{{-- <div class="row text-center">
    <div class="col">
        <h2>Asset List</h2>
    </div>
</div> --}}
{{-- <div class="row py-3">
    <div class="col">
        <a class="btn btn-secondary" href="{{ route('home.index') }}"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
</div> --}}
<div class="row d-flex justify-content-between">
    <div class="col">
        <table class="table">           
            <tr>
                <td>
                    <!-- <center> -->
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('borrow.fd') }}">
                            <img src="{{ asset('assets/img/fd.png') }}" class="card-img-top" width="500px" height="300px">
                            <a href="{{ route('borrow.fd') }}" class="btn btn-primary">Borrow Flashdisk</a>
                        </a>
                    </div>
                    <!-- </center> -->
                </td>

                <td>
                    <!-- <center> -->
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('borrow.laptop') }}">
                            <img src="{{ asset('assets/img/laptop.png') }}" class="card-img-top" width="500px" height="300px">
                            <a href="{{ route('borrow.laptop') }}" class="btn btn-primary">Borrow Laptop</a>
                        </a>
                    </div>
                    <!-- </center> -->
                </td>
                <td>
                    <!-- <center> -->
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('borrow.pointer') }}">
                            <img src="{{ asset('assets/img/pointer.png') }}" class="card-img-top" width="500px" height="300px">
                            <a href="{{ route('borrow.pointer') }}" class="btn btn-primary">Borrow Pointer</a>
                        </a>
                    </div>
                    <!-- </center> -->
                </td>
            </tr>
            <tr>
                <td>
                    <!-- <center> -->
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('borrow.jabra') }}">
                            <img src="{{ asset('assets/img/jabra.png') }}" class="card-img-top" width="500px" height="300px">
                            <a href="{{ route('borrow.jabra') }}" class="btn btn-primary">Borrow Jabra</a>
                        </a>
                    </div>
                    <!-- </center> -->
                </td>
                <td>
                    <!-- <center> -->
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('borrow.headphone') }}">
                            <img src="{{ asset('assets/img/headphone.png') }}" class="card-img-top" width="500px" height="300px">
                            <a href="{{ route('borrow.headphone') }}" class="btn btn-primary">Borrow Headphone</a>
                        </a>
                    </div>
                    <!-- </center> -->
                </td>
                <td>
                    <!-- <center> -->
                    <div class="card" style="width: 18rem;">
                        <a href="{{ route('borrow.saramonic') }}">
                            <img src="{{ asset('assets/img/saramonic.png') }}" class="card-img-top" width="500px" height="300px">
                            <a href="{{ route('borrow.saramonic') }}" class="btn btn-primary">Borrow Saramonic</a>
                        </a>
                    </div>
                    <!-- </center> -->
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
