@extends('admin.layouts.app')

@section('content')
<i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
    <div class="mt-5">
        @foreach ($post as $item)
        <div class="card-header">
            <div class="text-center">
                <img width="400px" class="rounded shadow py-3"
                @if ($item['image']==null) src="{{asset('default/default.png')}}"
                @else  src="{{asset('postImage/'.$item['image'])}}">
                @endif
            </div>
            <div class="card-body">
                <div class=" text-center">
                    <span style="font-size: 20px;">Disease Name</span>
                    <span class="text-info" style="font-size: 35px;">{{$item['title']}}</sp>
                </div>
                <label for="">Name</label>
                <p class="text-start">{{$item['name']}}</p>
                <label for="">Email</label>
                <p class="text-start">{{$item['email']}}</p>
                <label for="">Phone</label>
                <p class="text-start">{{$item['phone']}}</p>
                <label for="">Address</label>
                <p class="text-start">{{$item['address']}}</p>
                <label for="">Gender</label>
                <p class="text-start">{{$item['gender']}}</p>
                <label for="">Disease Conditions</label>
                <p class="text-start">{{$item['description']}}</p>
            </div>
        </div>
        @endforeach
    </div>
@endsection
