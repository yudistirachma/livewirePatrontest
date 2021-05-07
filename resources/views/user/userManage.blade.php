@extends('layouts.app', ['title' => 'Employ Manage'])

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Manage</h6>
        </div>
        <div class="card-body">
            <div class="text-center mb-2">
                <img class="rounded-circle" style="height: 200px;width :200px;" src="{{ isset($user->imgprofile) ? asset('storage/'. $user->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" class="rounded mx-auto d-block" alt="...">
            </div>
            <h2 class="text-center text-capitalize">{{ $user->name }}</h2>
            <h4 class="text-center text-capitalize">{{ $user->id }}</h4>
            <form style="width: 40%;" class="mx-auto" action="{{route('employeUpdate', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail4"><strong>Position</strong></label>
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
                <div class=""><button type="submit" class="btn btn-primary float-right">Save</button></div>
            </form>
        </div>
    </div>
@endsection