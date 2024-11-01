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
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


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
            <<div class="row">
                @foreach ($estoques as $estoqueItem)
                    <div class="col-lg-4">
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="/detalhes/{{ $estoqueItem->id }}" data-bs-toggle="modal"><i
                                                    class="fa fa-eye"></i></a></li>
                                        <li><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                    class="fa fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <img class="foto_vitrine" src="{{ asset('storage/' . $estoqueItem->imagem->caminho) }}"
                                    alt="{{ $estoqueItem->est_descricao }}">
                            </div>
                            <div class="down-content">
                                <h4>{{ $estoqueItem->est_descricao }}</h4>
                                <span>R$ {{ number_format($estoqueItem->est_valor, 2, ',', '.') }}</span>
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


        <div class="col-lg-12">
            <div class="pagination">
                <ul>
                    <li>
                        <a href="/">1</a>
                    </li>
                    <li class="active">
                        <a href="/2">2</a>
                    </li>
                </ul>
            </div>
        </div>
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

                        <div class="mb-3">
                            <label for="fk_est_id" class="form-label">Escolha a Roupa</label>
                            <select class="form-select" id="fk_est_id" name="fk_est_id" required onchange="updateImage()">
                                
                                @foreach ($estoques as $estoque)
                                    <option value="{{ $estoque->id }}"
                                        data-image="{{ asset('storage/' . $estoque->imagem->caminho) }}"> <!-- Ajuste para o caminho correto -->
                                        {{ $estoque->est_nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Imagem da Roupa</label>
                            <div id="image-preview" style="width: 100%; height: 200px; overflow: hidden;">
                                <img id="selected-image" src="" alt="Imagem da Roupa"
                                    style="max-width: 100%; height: auto; display: none;">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>



                </div>

            </div>
        </div>
    </div>



    <script>
        function updateImage() {
            var select = document.getElementById("fk_est_id");
            var selectedOption = select.options[select.selectedIndex];
            var imageUrl = selectedOption.getAttribute('data-image');
            var imagePreview = document.getElementById("selected-image");
    
            if (imageUrl) {
                imagePreview.src = imageUrl;
                imagePreview.style.display = "block"; // Mostrar a imagem
            } else {
                imagePreview.src = "";
                imagePreview.style.display = "none"; // Ocultar a imagem
            }
        }
    </script>

@endsection
