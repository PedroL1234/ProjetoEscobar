@extends('cliente.layout.index1')
@section('principal')
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Dona Amora store</h2>
                        <span>Estilo que veste sua essência.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Main Banner Area End ***** -->


    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Ultimos lançamentos</h2>
                        <span>Confira todos os nossos produtos.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($estoque as $linha)
                    <!-- Corrigir para percorrer a coleção de estoques -->
                    <div class="col-lg-4">
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="fa fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <img class="foto_vitrine" src="{{ asset('storage/' . $linha->imagem->caminho) }}">
                                
                                    {{-- alt="{{ $linha->est_descricao }}" width="300">
                                    <img class="foto_vitrine" 
     src="{{ $linha->imagem ? asset('storage/' . $linha->imagem->caminho) : asset('storage/default_image.jpg') }}" 
     alt="{{ $linha->est_descricao }}" 
     width="300"> --}}

                                
                            </div>
                            <div class="down-content">
                                <h4>{{ $linha->est_descricao }}</h4>
                                <h6>{{$linha->est_tamanho }}</h6>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
            </div>
        </div>
    </section>



    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Informações para sua reserva</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('clientes.salvar') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="number" class="form-control" id="telefone" name="telefone" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>



                </div>

            </div>
        </div>
    </div>
@endsection
