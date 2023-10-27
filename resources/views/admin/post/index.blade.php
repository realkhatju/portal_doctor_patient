@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-3">
        <div class="card">
                <div class="card-body">
                    <form action="{{route('admin#createPost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="">Name of Your Disease</label>
                        <input name="postTitle" type="text" placeholder="Enter Your Disease Name" class="form-control" value="{{old('postTitle')}}">
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Disease's Condition</label>
                        <textarea name="postDescription" type="text" cols="30" rows="10"class="form-control" placeholder="Pls Describe Full Detials of Your Disease">{{old('postDescription')}}</textarea>
                        @error('postDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Attch Your X-ray or Medical Findings(with Image)</label>
                        <input type="file" value="old('postImage')" name="postImage" class="form-control">
                    </div>

                    <div class="form-group">
                    <select name="userName" class="form-control" hidden>
                            @foreach ($userInfo as $item)
                            <option value="{{$item['id']}}" @if ($item['id'] == $userDetails) selected @endif>{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @error('userName')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- <div class="form-group">
                        <select name="userName" class="form-control">
                            @foreach ($userInfo as $item)
                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                        @error('userName')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div> --}}
                    <div class="form-group">
                            <select name="postDescriptionName" class="form-control">
                                <option value="">Disease Category</option>
                                @foreach ($category as $item)
                                <option value="{{$item['category_id']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                            @error('postDescriptionName')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <button class="btn btn-info" type="submit">Post</button>
                </form>
                </div>
        </div>
    </div>
    <div class="col-9">
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
            <h3 class="card-title">Patient's Informations</h3>

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
            {{-- Alert Message Start --}}
            @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('updateSuccess')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            @endif
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>Patient Id</th>
                  <th>Disease No</th>
                  <th>Disease Title</th>
                  <th>Disease's Condition</th>
                  {{-- <th>Category</th> --}}
                  <th>Medical Checkup</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($post as $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['post_id']}}</td>
                    <td>{{$item['title']}}</td>
                    <td><p style="width: 200px;white-space: nowrap;overflow: hidden;text-overflow: clip;">{{$item['description']}}</p></td>
                    {{-- <td>{{$item['category_id']}}</td> --}}
                    <td><img width="120px" class="rounded shadow" height="120vh"
                        @if ($item['image']==null) src="{{asset('default/default.png')}}"
                        @else  src="{{asset('postImage/'.$item['image'])}}">
                        @endif
                    </td>
                    <td>
                        {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                        <a href="{{ route('admin#updatePostPage',$item['post_id'])}}" @if(Auth::user()->role == 'user')   @endif >
                          <button class="btn btn-sm bg-warning text-white"><i class="fas fa-edit"></i></button>
                        </a>
                      </td>
                    <td>
                      {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                      <a href="{{ route('admin#deletePost',$item['post_id'])}}">
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


