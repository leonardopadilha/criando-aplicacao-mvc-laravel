{{-- <x-layout title="Nova Série">
    <!-- <form action="/series/salvar" method="post"> -->
        <form action="{{ route('series.store') }}" method="post">

        @csrf <!-- Cross-Site Request Forgery (CSRF)!-->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout> --}}

<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post">

            @csrf <!-- Cross-Site Request Forgery (CSRF)!-->

            <div class="row mb-3">
                <div class="col-8">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text"
                           autofocus
                           id="nome"
                           name="nome"
                           class="form-control"
                           value="{{ old('nome') }}">
                </div>

                <div class="col-2">
                    <label for="seasonsQty" class="form-label">Nº Temporadas: </label>
                    <input type="text"
                           id="seasonsQty"
                           name="seasonsQty"
                           class="form-control"
                           value="{{ old('seasonsQty') }}">
                </div>


            <div class="mb-2">
                <label for="episodesPerSeasons" class="form-label">Eps / Temporada: </label>
                <input  type="text" 
                        id="episodesPerSeasons" 
                        name="episodesPerSeasons" 
                        class="form-control"
                        value="{{ old('episodesPerSeasons') }}">
            </div>
    
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>

</x-layout>