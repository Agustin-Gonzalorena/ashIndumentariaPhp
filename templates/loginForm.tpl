{include file="header.tpl" title="Iniciar sesion"}

<div class="mt-5 w-25 mx-auto">
    {if $addMsg}
        <div class="alert alert-success mt-3">
            {$addMsg}
        </div>
    {/if}
    <form method="POST" action="validate">
        <div class="form-group">
            <label>Usuario:</label>
            <input type="text" required class="form-control" name="userName">
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" required class="form-control" name="password">
        </div>
        {if $error}
            <div class="alert alert-danger mt-3">
                {$error}
            </div>
        {/if}
        <button type="submit" class="btn btn-dark mt-3">Entrar</button>
        <a class="ms-3" href="signUp">¿No tenes cuenta? Registrate</a>
    </form>
</div>

{include file="footer.tpl"}