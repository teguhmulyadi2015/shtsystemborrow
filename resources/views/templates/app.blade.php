<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SHT SBI</title>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.min.css') }}"> --}}
  </head>
  <body>
    @include('templates.navbar')  
    <div class="container">

      <div class="row pb-5">
          <div class="col py-2">
              <a href="{{ route('home.index') }}" class="btn btn-info" style="width:250px"><i class="bi bi-house"></i> Home Page</a>
          </div>
          <div class="col py-2">
              <a href="{{ route('borrow.index') }}" class="btn btn-success" style="width:250px"><i class="bi bi-bag-plus"></i> Borrow</a>
          </div>
          <div class="col py-2">
              <a href="{{ route('history.index') }}" class="btn btn-warning" style="width:250px"><i class="bi bi-clock-history"></i> History</a>
          </div>
          <div class="col py-2">
              <a href="{{ route('print.index') }}" class="btn btn-secondary" style="width:250px"><i class="bi bi-clock-history"></i> Print IT</a>
          </div>
      </div>
      
        @yield('content')

{{-- 
<footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
    <span class="text-body-secondary text-center">Place sticky footer content here.</span>
    </div>
</footer> --}}

  


    {{-- </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    {{-- <script>

      var today = new Date();
      var maxDate = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000); // 7 days from today
      var maxDateString = maxDate.toISOString().slice(0, 10); // convert to yyyy-mm-dd format
      document.getElementById("mydate").setAttribute("max", maxDateString);
    </script> --}}

    <script>      
        function autoFill() {
        var nik = document.getElementsByName("nik")[0].value;
        
          $.ajax({
            url: "{{ route('employee.getnik') }}",
            type: "GET",
            data: { nik: nik },
            dataType: "json",
            success: function(data) {
                // Mengisi field lainnya dengan data yang diterima
                document.getElementsByName("fullname")[0].value = data.employee_name;
                document.getElementsByName("dept")[0].value = data.dept_name;
                // dst
            }
        });
        
        
    }
    </script>


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            // Jalankan fungsi setInterval() untuk melakukan reload otomatis setiap 5 detik
            setInterval(function(){
                $("#example-content").load(location.href + " #example-content");
            }, 5000);
        });
    </script> --}}


    {{-- script for always run controller to check late return --}}
    <script>
    setInterval(function(){
        $.get('{{ route('sendemail') }}', function(data){
            console.log(data);
        });
    }, 12600000); // call the route every 2 jam perdetik yaitu 1000ms
  </script>
  </body>
</html>