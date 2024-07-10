<x-layout title="Registrar novo usuário">
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" autofocus>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" autofocus>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mt-3">
            <button class="bg-info bg-opacity-10 p-2 border border-info border-start-0 rounded-end">
                Registrar
            </button>
        </div>

        <div class="mt-4">
            <a href="{{route('login')}}" 
               class="bg-danger bg-opacity-10 p-2 border border-danger border-start-0 rounded-end text-danger">
                Já tem cadastro? Clique aqui!
            </a>
        </div>
    </form>
</x-layout>