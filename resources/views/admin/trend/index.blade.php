@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Disease Lists</h3>

            <div class="card-tools">
            {{-- <form action="{{route('admin#trendPostSearchList')}}" method="POST">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="nameSearchKey" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
            </form> --}}
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap text-center">
              <thead>
                <tr>
                  <th>Disease No</th>
                  <th>Disease Title</th>
                  <th>Disease Metions</th>
                  <th>Patient Count</th>
                  <th>Check</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($post as $item)
                <tr >
                    <td>{{$item['category_id']}}</td>
                    <td>{{$item['title']}}</td>
                    <td ><p style="width: 600px;white-space: nowrap;overflow: hidden;text-overflow: clip;">{{$item['description']}}</p></td>
                    {{-- <td><img width="150px" class="rounded shadow py-3"
                        @if ($item['image']==null) src="{{asset('default/default.png')}}"
                        @else  src="{{asset('postImage/'.$item['image'])}}">
                        @endif
                    </td> --}}
                    <td>
                        {{-- <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button> --}}
                        <i class="fa-solid fa-people-line"></i> {{ $item["post_count"] }}
                      </td>
                    <td>
                        <a href="{{route('admin#trendPostDetails',$item['category_id'])}}"><button class="btn btn-sm bg-info text-white"><i class="fa-solid fa-circle-info"></i></button></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-end mr-3">
                {{-- {{ $post->links() }} --}}
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>
@endsection
