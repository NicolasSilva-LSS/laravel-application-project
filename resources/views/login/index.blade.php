<x-layout title="Login">
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" autofocus>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mt-3">
            <button class="bg-info bg-opacity-10 border border-info border-start-0 rounded-end text-dark p-2">
                Entrar
            </button>
        </div>

        <div class="mt-4">
            <a href="{{route('users.create')}}" 
               class="bg-secondary bg-opacity-50 border border-secondary border-start-0 rounded-end text-dark  p-2">
                Registrar
            </a>
        </div>
    </form>
</x-layout>