@extends('layouts.app', ['title' => 'User Account Manage', 'livewire' => true])

@section('content')
    <div class="row mb-3">
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">User Account Manage</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-2">
                        <img class="rounded-circle" style="height: 100px;width :100px;" src="{{ isset($user->imgprofile) ? asset('storage/'. $user->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" class="rounded mx-auto d-block" alt="...">
                    </div>
                    <h4 class="text-center text-capitalize">{{ $user->name }}</h4>
                    <p class="text-center text-capitalize">{{ $user->id }}</p>
                    <form style="width: 40%;" class="mx-auto" action="{{route('employeUpdate', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label for="inputEmail4">Position</label>
                                <select id="role" name="role" class="form-control">
                                    <option class="text-capitalize" disabled>Choose...</option>
                                    @foreach ($positions as $position)
                                        @if ($user->getRoleNames()->contains($position))
                                            <option class="text-capitalize" selected>{{$position}}</option>    
                                        @else
                                            <option class="text-capitalize">{{$position}}</option>
                                        @endif
                                    @endforeach
                                </select>                    
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="true" {{boolval($user->status) ? "checked" : ""}}>
                                    <label class="form-check-label" for="status" >
                                        Status active
                                    </label>
                                </div>
                            </div>
                        <div class=""><button type="submit" class="btn btn-sm btn-primary float-right">Save</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow" style="height: 100%;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">User Performance</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="myPieChart" width="662" height="490" style="display: block; width: 331px; height: 245px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-secondry"></i> On Going ({{$notValidated}})
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Late ({{$late}})
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Validated ({{$validated}})
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @livewire('user.all-content-tracking', ['user' => $user])
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