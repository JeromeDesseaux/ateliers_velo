@extends('layouts.app')

@section('content')
<div class="container white-bg">
    <div class="row">
        @if(isset($workshop->image))
            <div class="col-sm-8">
                <img src="{{asset("uploads/$workshop->image")}}" alt="" class="img-fluid">                        
            </div>
        @endif
        <div class="col-sm-{{isset($workshop->image)?'4':'12'}} d-flex align-items-center w-100 justify-content-center">
            <div class="align-middle w-100 text-center">
                <img class="img-fluid my-2" src="{{ Avatar::create($workshop->user->name)->setDimension(75)->toBase64() }}"/>
                <h1>{{$workshop->user->name}}</h1>
                @if($workshop->user->workshops->count() == 1)
                    <p>Première organisation</p>
                @else
                    <p>{{$workshop->user->workshops->count()}} ateliers organisés</p>
                @endif
                @guest
            <a class="btn btn-primary btn-block btn-green" href="{{route('login')}}" >Inscription</a>
                @else
                    @if(Auth::user()->id == $workshop->user->id)
                        <a class="btn btn-danger btn-block btn-green" href="{{route('workshop.update', ['slug'=>$workshop->slug])}}">Modifier</a>
                        <div class="btn btn-danger btn-block rounded-0" data-toggle="modal" data-target="#deletionModal">Supprimer</div>
                    @else
                        <div class="btn btn-primary btn-block btn-green" data-toggle="modal" data-target="#inscriptionModal">Inscription</div>
                    @endif
                @endguest
            </div>
            
        </div>
    </div>
    <div class="row text-center my-3">
        <div class="col-sm-12">
            <h1>{{$workshop->title}}</h1>
            <h4 class="important">{{$workshop->date}}</h4>
            <span>{{$workshop->category->title}} à <b>{{$workshop->city}} {{$workshop->zipcode}}</b></span>
            @if(isset($workshop->place))
                <p>Lieu de rendez-vous : {{$workshop->place}}</p>
            @endif
        </div>
    </div>
    <!-- <hr> -->
    <div class="my-3">
        <h1 class="text-center mb-3">Description</h1>
        <hr width="25%"> 
        <p>{{$workshop->description}}</p>
    </div>
    <div class="text-center">
        <h1 class="text-center mb-3">Participants</h1>
        <hr width="25%"> 
        @if($workshop->participants->count()>0)
            @foreach($workshop->participants as $inscription)
                {{$inscription->user->name}}
            @endforeach
        </div>
        @else
        😥Aucun participant pour le moment, inscris-toi!
        @endif
    <div>
</div>

    @include('workshop/partials/inscription',['workshop_id' => $workshop->id])

    <div class="modal fade" id="deletionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('workshop.destroy', ['slug'=>$workshop->slug])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cette action est irréversible. Supprimer ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Confirmer</button>
                </div>
                </div>
            </form>
        </div>
        </div>
@endsection

@section('script')
@endsection