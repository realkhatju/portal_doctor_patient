@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card">
                <div class="card-body">
                    <form action="{{route('admin#categoryUpdate',$updateData['category_id'])}}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label for="">Category Title</label>
                        <input name="categoryTitle" type="text" value="{{$updateData['title']}}" placeholder="Enter Your Category Title" class="form-control">
                        @error('categoryTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Category Description</label>
                        <textarea type="text" cols="30" rows="10" name="categoryDescription" class="form-control" placeholder="Enter Your Category Description">{{ $updateData['description']}}</textarea>
                        @error('categoryDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href=" {{route('admin#category')}}"><button class="btn btn-info" type="button">Create</button></a>

                </form>
                </div>


        </div>
    </div>
    <div class="col-8">
        <div class="col-4">
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
            <h3 class="card-title">List Table</h3>

            <div class="card-tools">
            <form action="{{route('admin#categorySearchList')}}" method="POST">
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
                  <th>Category ID</th>
                  <th>Category Title</th>
                  <th>Category Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categoryList as $item)
                <tr>
                    <td>{{$item['category_id']}}</td>
                    <td>{{$item['title']}}</td>
                    <td><p style="width: 200px;white-space: nowrap;overflow: hidden;text-overflow: clip;">{{$item['description']}}</p></td>
                    <td>
                        {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                        <a href="{{ route('admin#categoryEditPage',$item['category_id'])}}">
                          <button class="btn btn-sm bg-warning text-white"><i class="fas fa-edit"></i></button>
                        </a>
                      </td>
                    <td>
                      {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                      <a @if (count($categoryList) == 1)
                      href="#"
                      @else
                      href="{{ route('category#deleteAccount',$item['category_id'])}}"
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
</div>
@endsection


