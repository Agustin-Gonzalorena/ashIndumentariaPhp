{include file="header.tpl"}
<div class="mt-5 w-25 mx-auto">
    <form method="POST" action="validateSignUp">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" required class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Apellido:</label>
            <input type="text" required class="form-control" name="lastName">
        </div>
        <div class="form-group">
            <label>Nombre de usuario:</label>
            <input type="text" required class="form-control" name="userName">
        </div>
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" required class="form-control" name="password">
        </div>
        <div class="form-group">
            <label>Confirmar contraseña:</label>
            <input type="password" required class="form-control" name="checkPassword">
        </div>
        {if $msg}
            <div class="alert alert-danger mt-3">
                {$msg}
            </div>
        {/if}
        <button type="submit" class="btn btn-dark mt-3">Registrarse</button>
    </form>
</div>



{include file="footer.tpl"}