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
        <h2>Print Page</h2>
    </div>
    <div class="col">
        <div class="d-flex justify-content-between">
            <div></div>
        <a href="{{ route('print.add') }}" class="btn btn-primary float-right">Add Data</a>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form action="{{ route('print.search') }}" method="get"> 
                        @csrf
                    <div class="form-group">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Search..." name="search">
                    </div>
                </div>
                <div class="col-md px-1">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                </div>
                </form>
                <div class="col-auto text-right">
                    <form action="{{ route('print.report') }}" method="GET">
                        {{-- By actual print date =>  --}}
                        <input type="date" name="start_date"> -
                        <input type="date" name="end_date">
                        {{-- <a href="{{ route('history.report') }}" class="btn btn-success"><i class="bi bi-clipboard2-data"></i> Download Report</a> --}}
                        <button type="submit" class="btn btn-primary">Download Report</button>
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
                            <th scope="col">Color / BW</th>
                            <th scope="col">Sheets</th>
                            <th scope="col">Sheets Qty</th>
                            <th scope="col">Date Print</th>                           
                            </tr>
                        </thead>
                        <tbody>
                             {{-- <?php $i=1; ?> --}}
                            @foreach ($print as $p )  
                                      
                                <tr>
                                    <th scope="row">{{$p->trno}}</th>
                                    <td>{{ $p->employee_id }}</td>
                                    <td>{{ $p->employee_name }}</td>
                                    <td>{{ $p->dept_name }}</td>
                                    <td>{{ $p->colorbw }}</td>
                                    <td>
                                        @if ($p->sheets=='KS')                                            
                                        {{ 'Kertas Sendiri' }}
                                        @else
                                        {{ 'Kertas IT' }}
                                        @endif
                                    </td>
                                    <td>{{ $p->sheets_qty }}</td>
                                    <td>{{ date('m/d/Y',strtotime($p->date_print)) }}</td>
                                </tr>
                            @endforeach
                            
                            
                            @if ($print->isEmpty())
                            <td colspan="8"><b class="text-danger">No Data!! </b></td>                    
                            @endif
                        </tbody>
                    </table>
                    {{ $print->links('pagination::bootstrap-5')}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection