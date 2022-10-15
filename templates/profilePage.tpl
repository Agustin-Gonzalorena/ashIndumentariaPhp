{include file="header.tpl" title="Perfil"}

<div class="d-flex flex-column align-items-center  ">
    <div class="mb-5 mt-3 justify-content-start">
        <h1>Perfil del Usuario: {$smarty.session.USER_userName}</h1>
    </div>
    <div>
        <h2>{$smarty.session.USER_NAME} {$smarty.session.USER_LASTNAME}</h2>
        {if $smarty.session.ADMIN==1}
            <p>Tipo de Usuario: Administrador</p>
        {else}
            <p>Tipo de Usuario: Normal</p>
        {/if}
    </div>
    <div class="p-4 border border-dark rounded">
        {if $error}
            <div class="alert alert-danger mt-3">
                {$error}
            </div>
        {elseif $change}
            <div class="alert alert-success mt-3">
                {$change}
            </div>
        {/if}
        <h3>Cambiar contraseña:</h3>
        <form action="changePassword" method="POST">
            <div class="form-group">
                <label>Nueva contraseña:</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label>Repetir contraseña:</label>
                <input type="password" class="form-control" name="checkPassword">
            </div>
            <button type="submit" class="btn btn-dark mt-3">Confirmar</button>
        </form>
    </div>
    {if $smarty.session.USER_ID==1}
        <label class="mt-5 alert alert-danger">Esta cuenta es la principal, no se puede eliminar.</label>
    {else}
        <label class="mt-5 alert alert-danger">Elimine su cuenta de forma permanente:</label>
        <h2><a class="btn btn-danger " href="deleteUser/{$smarty.session.USER_ID}">Eliminar Cuenta</a></h2>
    {/if}
</div>

{include file="footer.tpl"}