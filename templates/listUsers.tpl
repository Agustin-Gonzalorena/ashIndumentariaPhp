{include file="header.tpl"}
<div>
    {if $error}
        <p class="alert alert-danger mt-3 text-center">{$error}</p>
    {/if}
    <h1>Lista de Usuarios:</h1>
    <table class="table table-dark table-striped align-middle">
        <thead>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Permisos</th>
            <th>Dar permiso</th>
        </thead>
        <tbody>
            {foreach from=$users item=$user}
                {if $user->id!=$smarty.session.USER_ID}
                    <tr>
                        <td>{$user->name}</td>
                        <td>{$user->lastName}</td>
                        <td>{$user->userName}</td>
                        {if $user->admin==0}
                            <td>Basico</td>
                            <td><a class="btn btn-warning" href="updateAdmin/{$user->id}">Admin</a></td>
                        {else}
                            <td class="text-info">Administrador</td>
                            <td><a class="btn btn-danger" href="updateAdmin/{$user->id}">Revocar</a></td>
                        {/if}
                    </tr>
                {/if}
            {/foreach}
        </tbody>
    </table>
</div>





{include file="footer.tpl"}