@extends('layouts.app')

@section('title', $produto->titulo )

@section('content')
<br>
<div class="container">
    <h1> Produto {{ $produto->titulo }} </h1>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-3">
            <ul>
                <li>Referência: {{ $produto->referencia }}</li>
                <li>Preço: {{ number_format($produto->preco,2,',','.') }}</li>
                <li>Adicionado em: {{ date("d/m/Y", strtotime($produto->created_at)) }}</li>
            </ul>
                <p> {{ $produto->descricao }}</p>
            </div>
            @if(file_exists("./img/produtos/" .md5($produto->id)). ".jpg")    
                <div class="col-md-6 col-md-3">
                    <a href="{{ asset("img/produtos/" .md5($produto->id). ".jpg") }}" class="thumbnail" >
                        {{ Html::image(asset("img/produtos/" .md5($produto->id) .".jpg")) }}
                    </a>
                </div>
            @endif
        </div>
    </div>
    <a href="javascript:history.go(-1)"> Voltar </a>
@endsection