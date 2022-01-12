@extends('layouts.admin')

@section('title', 'Articles index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Analytics" link="{{ route('admin.analytics.index') }}"/>
  
  <h2>PageViews Last 30 Days</h2>
  
  
  <div>
    <canvas id="myChart"></canvas>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var labels = [];
    for (var i = 0; i < 30; i++) {
    let d = new Date();
    d.setDate(d.getDate() - (29 - i));
    labels.push(d.toLocaleDateString());
    }

    const data = {
      labels: labels,
      datasets: [{
      label: 'PageViews',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: {{ $pageViewsLast30Days }},
      }]
    };

    const config = {
      type: 'line',
      data: data,
      options: {}
    };
  </script>
  <script>
    const myChart = new Chart(
    document.getElementById('myChart'),
    config
    );
  </script>

  
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">ip</th>
        <th scope="col">path</th>
        <th scope="col">referrer</th>
        <th scope="col">user_agent</th>
        <th scope="col">created_at</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($pageViews as $pageView)
      <tr>
        <td>{{ $pageView->id }}</td>
        <td>{{ $pageView->ip }}</td>
        <td>{{ $pageView->path }}</td>
        <td>{{ $pageView->referrer }}</td>
        <td>{{ $pageView->user_agent }}</td>
        <td>{{ $pageView->created_at }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $pageViews->links() }}
@endsection