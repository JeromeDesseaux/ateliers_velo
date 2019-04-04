@extends('layouts.app')

@section('content')
<div class="container white-bg">
    <div class="row">
        <div class="col-sm-4 text-center">
            <img class="img-fluid my-2" src="{{ Avatar::create($user->name)->setDimension(75)->toBase64() }}"/>
            <p>{{$user->name}}</p>
            <p>Inscrit depuis le {{$user->created_at->format('d/m/Y')}}</p>
            <a href="#" class="btn btn-primary btn-green btn-block">Editer</a>
            <a href="#" class="btn btn-danger rounded-0 btn-block">Changer de mot de passe</a>
            
        </div>
        <div class="col-sm-8">
            @if ($workshops->count() > 0)
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Evènement</th>
                        <th scope="col">Date</th>
                        <th scope="col">Participants</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Gestion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workshops as $workshop)
                    
                        <td>{{$workshop->title}}</td>
                        <td>{{$workshop->date}}</td>
                        <td>{{$workshop->participants->count()}}/{{$workshop->inscriptions->count()}}</td>
                        <td>{{$workshop->status}}</td>
                        <td>
                            <a href="{{route('workshop.edit',['slug'=>$workshop->slug])}}" class="btn btn-info btn-circle mx-1"><i class="fa fa-pen"></i>
                            <a href="#" class="btn btn-success btn-circle mx-1"><i class="fa fa-link"></i>
                            <a href="#" class="btn btn-danger btn-circle mx-1"><i class="fa fa-times"></i>
                        </td>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>Pas d'atelier</p>
            @endif
        </div>
    </div>
    @endsection
    
    @section('script')
    @endsection