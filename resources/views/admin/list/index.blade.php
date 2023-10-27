@extends('admin.layouts.app')

@section('content')
    <div class="col">
        <div class="col-3">
            {{-- Alert Message Start --}}
            @if (Session::has('accountDelete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('accountDelete')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            @endif
            {{-- Alert Message End --}}
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">User Lists</h3>

            <div class="card-tools">
            <form action="{{route('admin#searchList')}}" method="POST">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="nameSearchKey" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
            </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Gender</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userList as $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['phone']}}</td>
                    <td>{{$item['address']}}</td>
                    <td>{{$item['gender']}}</td>
                    <td>
                      {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                      <a @if (count($userList) == 1)
                      href="#"
                      @else
                      href="{{ route('admin#deleteAccount',$item['id'])}}"
                      @endif>
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
@endsection

