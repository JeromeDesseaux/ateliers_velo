@extends('layouts.app')

@section('content')
<div class="container d-flex">
    @if (count($workshops))
        <div class="row justify-content-center">
            @foreach ($workshops as $workshop)
            <div class="card mx-2 my-2 rounded-0" style="width: 18rem;">
                    @if(isset($workshop->image))
                        <img src="{{ asset("thumbnails/$workshop->image") }}" style="height:200px" class="card-img-top rounded-0">
                    @else
                        <img src="{{ asset('img/bctn.jpg') }}" style="height:200px" class="card-img-top rounded-0">
                    @endif
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title">{{$workshop->title}}</h5>
                      <h6 class="important">Le {{$workshop->date}}</h6>
                      <p>À <b>{{$workshop->city}}</b> ({{$workshop->zipcode}})</p>
                      <p class="card-text">{{str_limit($workshop->description, $limit = 120, $end = '...')}}</p>
                      <a href="{{ route('workshop.details',[$workshop->slug]) }}" class="btn btn-primary btn-block btn-green mt-auto">Consulter</a>
                    </div>
                  </div>
            @endforeach
        </div>
        
        {{-- <div class="card mb-2">
            <a href="{{ route('workshop.details',[$workshop->slug]) }}">
                <div class="row" style="max-height:168px;">
                    <div class="col-sm-3 col-md-4" style="max-height:100%">
                        @if(isset($workshop->image))
                            <img src="{{ asset("storage/$workshop->image") }}" style="height:100%;width:100%;" class="img-fluid">
                        @else
                            <img src="{{ asset('img/bctn.jpg') }}" style="height:100%;width:100%;" class="img-fluid">
                        @endif
                    </div>
                    <div class="col-sm-9 col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>{{$workshop->title}}</h3>
                                    <span>{{$workshop->category->title}} à</span>
                                    <b>{{$workshop->city}} {{$workshop->zipcode}}</b>
                                    <h6>Organisé par {{$workshop->user->name}} le {{$workshop->date}}</h6>
                                </div>
                                <div class="col-sm-6">
                                    {{str_limit($workshop->description, $limit = 150, $end = '...')}}
                                </div>
                            </div>
                            <!-- <hr>
                            <p>{{str_limit($workshop->description, $limit = 150, $end = '...')}}</p> -->
                        </div>
                    </div>
                </div>
            </a>
        </div> --}}
    @else
        <p>No items</p>
    @endif
</div>
@endsection

@section('script')
@endsection