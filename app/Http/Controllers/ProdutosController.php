<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Produto;
use Session;
use Illuminate\Support\Facades\Auth;

class ProdutosController extends Controller
{
    public function index() 
    {
        if(Auth::check())
        {
            $produtos = Produto::paginate(4);
            
            return view('produto.index')->with(['produtos'=>$produtos,'busca'=>null]);
        } else {
            return redirect('login');
        }
    }

    public function show($id) {

        if(Auth::check())
        {
            $produto = Produto::find($id);
            
            return view('produto.show')->with(['produto'=>$produto]);
        } else {
            return redirect('login');
        }
    }

    public function create() {
        if(Auth::check()) {
            return view('produto.create');
        } else {
            return redirect('login');
        }
    }

    public function store(Request $request){
        $this->validate($request,[
            'referencia' => 'required|unique:produtos|min:3',
            'titulo' => 'required|min:3',
        ]);
        $produto = new Produto();
        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        if($produto->save())
        {
            return redirect('produtos');
        }
    }

    public function edit($id)
    {
        $produto = Produto::find($id);

        return view('produto.edit')->with(['produto'=>$produto]);
    }

    public function update($id,Request $request) {
        
        $produto = Produto::find($id);
            $this->validate($request, [
                'referencia' => 'required|min:3',
                'titulo' => 'required|min:3',
            ]);
            if($request->hasFile('fotoproduto')){
                $imagem = $request->file('fotoproduto');
                $nomearquivo = md5($id) .".". $imagem->getClientOriginalExtension();
                $request->file('fotoproduto')->move(public_path('./img/produtos'),$nomearquivo);
            }
        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        $produto->save();

        Session::flash('mensagem', 'Produto alterado com sucesso.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        Session::flash('mensagem', 'Produto excluído com sucesso');
        return redirect()->back();
    }

    public function buscar(Request $request)
    {
        if(Auth::check())
        {

            $buscar = $request->input('busca');
            
            if(isset($buscar)) {
                $produtos = Produto::where('titulo','LIKE','%'.$request->input('busca').'%')
                ->orWhere('descricao','LIKE','%'.$request->input('busca').'%')->paginate(4);
            } else {
                $produtos = Produto::paginate(4);
            }
            
            return view('produto.index')->with(['produtos'=>$produtos,'busca'=>$request->input('busca')]);
        } else {
            return redirect('login');
        }
    }

    
}
