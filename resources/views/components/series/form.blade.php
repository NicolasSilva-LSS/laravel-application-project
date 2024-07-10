<form action="{{ $action }}" method="post">
    <?= csrf_field() ?> <!--ou @csrf-->

    @if($update)
    @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" 
                id="nome" 
                name="nome" 
                class="form-control" 
                @isset($nome)value="{{  $nome }}" @endisset>
    </div>

    <button class="btn btn-primary" type="submit">Adicionar</button>
</form>