@extends('templates.app')

@section('content')
{{-- <div id="example-content"></div> --}}
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
        <h2>Borrow List Page</h2>
    </div>    
</div>
<div class="row">
    <div class="col">
        <button class="btn btn-lg btn-warning"></button> => Late Return
    </div>
    
</div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('home.search') }}" method="get">
                {{-- @csrf --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search..." name="search">
                    </div>
                </div>
                <div class="col-md-6 px-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                </div>
            </div>
        </form>
            <div class="row py-3">
                <div class="col">
                    <table class="table ">
                        <thead>
                            <tr>
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">trno</th>
                            <th scope="col">nik</th>
                            <th scope="col">Emp.Name</th>
                            <th scope="col">Dept</th>
                            <th scope="col">Asset Code</th>
                            <th scope="col">Asset Name</th>
                            <th scope="col">Date Borrow</th>
                            <th scope="col">Date Return Plan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <?php $i=1; ?> --}}
                            @foreach ($borrow as $b )  
                                      
                                <tr class="@if (date('m/d/Y',strtotime(now())) > date('m/d/Y',strtotime($b->date_return_plan))) bg-warning @endif">
                                    {{-- <th scope="row">{{ $i++ }}</th> --}}
                                    <td>{{ $b->trno }}</td>
                                    <td>{{ $b->employee_id_borrow }}</td>
                                    <td>{{ $b->employee_name }}</td>
                                    <td>{{ $b->dept_name }}</td>
                                    <td>{{ $b->asset_id }}</td>
                                    <td>{{ $b->asset_name }}</td>
                                    <td>{{ date('m/d/Y',strtotime($b->date_borrow)) }}</td>
                                    <td>{{ date('m/d/Y',strtotime($b->date_return_plan)) }}</td>
                                    <td>
                                        @if ($b->date_return == NULL)
                                        <span class="badge bg-danger">Not yet return</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('borrow.return',$b->id) }}"><i class="bi bi-box-arrow-in-down"></i> Return</a>
                                            
                                        {{-- <form action="{{ route('companies.destroy',$company->id) }}" method="Post">
                                            <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                            
                            
                            @if ($borrow->isEmpty())
                            <td colspan="8"><b class="text-danger">No Data!</b></td>                    
                            @endif
                        </tbody>
                    </table>
                    {{ $borrow->links('pagination::bootstrap-5')}}
                </div>

            </div>
        </div>
    </div>

@endsection