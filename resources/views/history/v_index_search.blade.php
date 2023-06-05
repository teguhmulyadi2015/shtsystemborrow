@extends('templates.app')

@section('content')
<div class="container">
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
        <h2>History Page</h2>
    </div>
</div>
<div class="row">
    <div class="col">
        <button class="btn btn-lg btn-warning"></button> => Late Return
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('history.search') }}" method="get">
                {{-- @csrf --}}
            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search..." name="search">
                    </div>
                </div>
                <div class="col-md px-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                </div>
            </form>
                <div class="col-auto text-right">
                    <form>
                        <input type="date" name="date"> 
                        -
                        <input type="date" name="date">
                        <a href="{{ route('history.report') }}" class="btn btn-success"><i class="bi bi-clipboard2-data"></i> Download Report</a>
                    </form>

                </div>
                
            </div>
        
            <div class="row py-3">
                <div class="col">
                    <table class="table ">
                        <thead>
                            <tr>
                            <th scope="col">trno</th>
                            <th scope="col">nik</th>
                            <th scope="col">Emp.Name</th>
                            <th scope="col">Dept</th>
                            <th scope="col">Asset Code</th>
                            <th scope="col">Asset Name</th>
                            <th scope="col">Date Borrow</th>
                            <th scope="col">Date Return Plan</th>
                            <th scope="col">NIK Return</th>
                            <th scope="col">Actual Date Return</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <?php $i=1; ?> --}}
                            @foreach ($history as $h )  
                                      
                                <tr class="@if (date('m/d/Y',strtotime($h->date_return)) > date('m/d/Y',strtotime($h->date_return_plan))) bg-warning @endif">
                                    <th scope="row">{{ $h->trno }}</th>
                                    <td>{{ $h->employee_id_borrow }}</td>
                                    <td>{{ $h->employee_name }}</td>
                                    <td>{{ $h->dept_name }}</td>
                                    <td>{{ $h->asset_id }}</td>
                                    <td>{{ $h->asset_name }}</td>
                                    <td>{{ date('m/d/Y',strtotime($h->date_borrow)) }}</td>
                                    <td>{{ date('m/d/Y',strtotime($h->date_return_plan)) }}</td> 
                                    <td>{{ $h->employee_id_return }}</td>
                                    <td>{{ date('m/d/Y',strtotime($h->date_return)) }}</td>
                                    <td>
                                        @if ($h->date_return != NULL)
                                        <span class="badge bg-success">Finish</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            
                            
                            @if ($history->isEmpty())
                            <td colspan="8"><b class="text-danger">No Data!! </b></td>                    
                            @endif
                        </tbody>
                    </table>
                    {{ $history->links('pagination::bootstrap-5')}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection