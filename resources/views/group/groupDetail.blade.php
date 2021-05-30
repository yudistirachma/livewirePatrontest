@extends('layouts.app', ['title' => 'Group Detail', 'livewire' => true])

@section('content')
<div class="row">
    <div class="col-xl col-lg">
        <div class="card mb-3 shadow">
            <div class="card-body">        
                <div class="table-responsive">
                    <table class="table table-borderless text-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">&nbsp;&nbsp;&nbsp;ID</th>
                            <th scope="col">On Going</th>
                            <th scope="col">Validated</th>
                            <th scope="col">Late</th>
                            <th scope="col">All</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($userList as $users)
                            <tr>
                                <th scope="row" class="">
                                    <img style="height: 35px;width :35px;" src="{{ isset($users->imgprofile) ? asset('storage/'. $users->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-2">
                                    <span class="text-capitalize">{{$users->name}}</span><br>
                                </th>
                                <td class="align-middle text-center">{{$users->id}}</td>
                                <td class="align-middle text-center">{{ $users->onGoing }}</td>
                                <td class="align-middle text-center">{{ $users->validated }}</td>
                                <td class="align-middle text-center">{{ $users->late }}</td>
                                <td class="align-middle text-center">{{ $users->total }}</td>
                            </tr>
                        @endforeach
                        {{-- @foreach ($users as $user)
                            <tr>
                                <th scope="row" class="">
                                    <img style="height: 35px;width :35px;" src="{{ isset($user->imgprofile) ? asset('storage/'. $user->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle mr-2">
                                    <span class="text-capitalize">{{$user->name}}</span><br>
                                </th>
                                <td class="align-middle text-center">{{$user->id}}</td>
                                @foreach ($userList as $data)
                                    @if ($user->id == $data->id)
                                        <td class="align-middle text-center">{{ $data->onGoing }}</td>
                                        <td class="align-middle text-center">{{ $data->validated }}</td>
                                        <td class="align-middle text-center">{{ $data->late }}</td>
                                        <td class="align-middle text-center">{{ $data->total }}</td>
                                        @php
                                            $y = true;
                                        @endphp
                                        @break
                                    @else
                                        @php
                                            $y = null;
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($y == null)
                                    <td class="align-middle text-center">0</td>
                                    <td class="align-middle text-center">0</td>
                                    <td class="align-middle text-center">0</td>
                                    <td class="align-middle text-center">0</td>
                                @endif
                            </tr>
                        @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Group Performa</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="myPieChart" width="662" height="490" style="display: block; width: 331px; height: 245px;" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-secondry"></i> On Going
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Late
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Validated 
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script src={{asset("tamplate/vendor/chart.js/Chart.min.js")}}></script>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Late", "Validated", "On Going"],
        datasets: [{
        data: [ JSON.parse("{{ json_encode($late)}}"), JSON.parse("{{ json_encode($validated)}}"), JSON.parse("{{ json_encode($notValidated)}}")],
        backgroundColor: ['#e74a3b', '#1cc88a', '#858796'],
        hoverBackgroundColor: ['#cc3e31', '#17a673', '#797a82'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });

</script>

@endsection