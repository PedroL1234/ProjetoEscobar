@extends('clinte.layout')
@section('layout')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id='image-container' class="col-md-6">
                <img src="{{$imagem -> $id }}" alt="">
            </div>
            <div id="info-container" class="col-md-6">  
                <h1>
                    {{$estoqueItem -> $est_nome}}
                </h1>
            </div>


        </div>

    </div>

@endsection