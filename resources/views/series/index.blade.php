<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">

    @auth
    <!-- <a href="/series/criar" class="btn btn-dark mb-2">Adicionar</a> -->
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        <?php foreach($series as $serie): ?>
            <li class="list-group-item d-flex justify-content-between aline-items-center">

                @auth<a href="{{route('seasons.index', $serie->id)}}">@endauth
                    <?= $serie->nome ?>
                @auth</a>@endauth

                @auth
                <span class="d-flex">
                    <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                        E
                    </a>

                    <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                        <?= csrf_field() ?>
                        <?= method_field('DELETE') ?>
                        <button class="btn btn-danger btn-sm">
                            X
                        </button>
                    </form>
                </span>
                @endauth
            </li>
        <?php endforeach?>
    </ul>
    
</x-layout>