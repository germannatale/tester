@extends('dashboard.base')

@section('content')

  
  <div class="container-fluid">
    <div class="fade-in">
      <div class="card-columns cols-3">

        @foreach ($estadisticas as $estadistica)
          <div class="card">
            <div class="card-header">{{ strtoupper($estadistica['test']) }}
              <div class="card-header-actions"><small class="text-muted">Versus</small></div>
            </div>
            <div class="card-body">
              <div class="c-chart-wrapper">
                <canvas id="{{$estadistica['test']}}"></canvas>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>
  

@endsection

@section('javascript')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script> 

    @foreach ($estadisticas as $estadistica)
      <script>
        const {{ $estadistica['test'] . 'LineChart'}} = new Chart(document.getElementById('{{ $estadistica['test'] }}'), {
            type: 'line',
            data: {
              labels : {{ $estadistica['cant'] }},
              datasets : [                
                {
                  label: 'MariaDB',
                  backgroundColor : 'rgba(255, 99, 132, 0.2)', //'rgba(220, 220, 220, 0.2)',
                  borderColor : 'rgba(255, 99, 132, 1)',
                  pointBackgroundColor : 'rgba(255, 99, 132, 1)',
                  pointBorderColor : '#fff',
                  data : {{ $estadistica['mariadb'] }}
              },
              {
                  label: 'MongoDB',
                  backgroundColor : 'rgba(54, 162, 235, 0.2)', //'rgba(151, 187, 205, 0.2)',
                  borderColor : 'rgba(54, 162, 235, 1)',
                  pointBackgroundColor : 'rgba(54, 162, 235, 1)',
                  pointBorderColor : '#fff',
                  data : {{ $estadistica['mongodb'] }}
              },
              {
                  label: 'PostgresSQL',
                  backgroundColor : 'rgba(255, 206, 86, 0.2)', //'rgba(80, 100, 150, 0.2)'
                  borderColor : 'rgba(255, 206, 86, 1)',
                  pointBackgroundColor : 'rgba(255, 206, 86, 1)',
                  pointBorderColor : '#fff',
                  data : {{ $estadistica['postgres'] }}
              }
              ]
            },
            options: {
              responsive: true
            }
        });      
      </script>
    @endforeach

@endsection