
@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">Skundo nr</th>
            <th scope="col">Puslapio nuoroda</th>
            <th scope="col">Skundimo data</th>
            <th scope="col">Priežastis</th>
            <th scope="col">Komentaro nr</th>
          </tr>
        </thead>
        <tbody>
          @foreach ( $post as $skundas)
          <tr>
          <th scope="row">{{$skundas->id_Skundas}}</th>
            <td><a href="{{$skundas->skelbimo_nuoroda}}">{{$skundas->skelbimo_nuoroda}}</a></td>
            <td>{{$skundas->paskundimo_data}}</td>
            <td>{{$skundas->skundimo_priezastis}}</td>
            <td>{{$skundas->fk_KomentaraskomentaroNr}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
      @endsection

