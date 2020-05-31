@extends('layouts.app')

@section('title','Listagem de Produtos')

@section('content')
    <br>
    <h1> Produtos </h1>
    <hr>
    {{ Form::open(['url' => 'produtos/buscar']) }}
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    {{ Form::text('busca',$busca,['class' => 'form-control','placeholder'=>'Buscar']) }}
                    <span class="input-group-btn">
                        {{ Form::submit('Buscar',['class' => 'btn btn-primary']) }}
                    </span>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    <br>
    <br>
    @if(Session::has('mensagem'))
        <div class="alert alert-success">{{ Session::get('mensagem') }}</div>
    @endif

    <div class="row">
        @foreach($produtos as $produto)
            <div class="imagens col-md-3">
                <h4>{{ $produto->titulo }}</h4>
                @if(file_exists("./img/produtos/".md5($produto->id).".jpg"))
                    <a href="{{ url('produtos/'.$produto->id) }}" class="thumbnail">
                        {{ Html::image(asset("img/produtos/".md5($produto->id).".jpg")) }}
                    </a>
                @else
                    <a href="{{ url('produtos/'.$produto->id) }}" class="thumbnail">
                        {{ $produto->titulo }}
                    </a>
                @endif
                @if(Auth::check())
                    {{ Form::open(['route'=>['produtos.destroy', $produto->id], 'method' =>'DELETE']) }}
                        <a href="{{ url('produtos/'.$produto->id.'/edit') }}" class="btn btn-primary">Editar</a>
                        {{ Form::submit('Excluir',['class'=>'btn btn-danger']) }}
                    {{ Form::close() }}
                @endif
            </div>
        @endforeach
    </div>
    <br>
    {{ $produtos->links() }}
@endsection