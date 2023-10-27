@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Your Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- Alert Message Start --}}
                @if (Session::has('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('updateSuccess')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                @endif
                {{-- Alert Message End --}}
                <form action="{{ route('admin#update')}}" method="POST">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-2">Name</div>
                        <div class="col">
                            <input type="text" name="adminName" class="form-control" placeholder="Enter Name" value="{{ old('adminName',$userInfo->name)}}">
                            @error('adminName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Email</div>
                        <div class="col">
                            <input type="text" name="adminEmail" class="form-control" placeholder="Enter Email" value="{{ old('adminEmail',$userInfo->email)}}">
                            @error('adminEmail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Phone</div>
                        <div class="col">
                            <input type="text" name="adminPhone" class="form-control" placeholder="Enter Phone" value="{{$userInfo->phone}}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Address</div>
                        <div class="col">
                            <textarea type="text" name="adminAddress" class="form-control" cols="30" rows="10" placeholder="Enter Address">{{$userInfo->address}}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Gender</div>
                        <div class="col">
                            <select class="form-control" name="adminGender">
                                @if ($userInfo->gender == 'male')
                                <option value="">Choose Gender</option>
                                <option value="female">Female</option>
                                <option value="male" selected>Male</option>
                                @elseif($userInfo->gender == 'female')
                                <option value="">Choose Gender</option>
                                <option value="female" selected>Female</option>
                                <option value="male">Male</option>
                                @elseif($userInfo->gender == '')
                                <option value="" selected>Choose Gender</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <form method="post">
                        <button class="btn bg-dark text-white w-25 mt-2 col" type="submit" style="margin-left: 85px">Update</button>
                    </form>
                </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
