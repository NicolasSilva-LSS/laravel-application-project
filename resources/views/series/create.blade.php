<x-layout title="Nova Série">

    <form action="{{ route('series.store') }}" method="post">
        <?= csrf_field() ?> <!--ou @csrf-->

        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" 
                        autofocus
                        id="nome" 
                        name="nome" 
                        class="form-control" 
                        value="{{  old('nome') }}">
            </div>

            <div class="col-2">
                <label for="seasonsQty" class="form-label">Número de temporadas:</label>
                <input type="text" 
                        id="seasonsQty" 
                        name="seasonsQty" 
                        class="form-control" 
                        value="{{  old('seasonsQty') }}">
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Número de episódios:</label>
                <input type="text" 
                        id="episodesPerSeason" 
                        name="episodesPerSeason" 
                        class="form-control" 
                        value="{{  old('episodesPerSeason') }}">
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Adicionar</button>
    </form>

</x-layout>