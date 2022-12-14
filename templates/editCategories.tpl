{include file="header.tpl" title="Lista Categorias"}

{if $successMsg}
    <p class="alert alert-success mt-3 text-center">{$successMsg}</p>
{/if}
{if $errorMsg}
    <p class="alert alert-danger mt-3 text-center">{$errorMsg}</p>
{/if}
<h1>Agregar Categoria:</h1>
<p class="alert alert-dark mt-3">Si agrega un nuevo tipo de producto, contáctese con el equipo de Front para el
    rediseño de la pagina.</p>
<div>
    <form action="addCategory" method="POST">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Tipo de producto</th>
                    <th>Marca del producto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <td><input type="text" name="type" value="productos"></td>
                <td><input type="text" name="brand" value="marca"></td>
                <td><input class="btn btn-success" type="submit" value="Agregar"></td>
            </tbody>
        </table>
    </form>
</div>
<h1>Lista de Categorias:</h1>
<p class="alert alert-dark mt-3">Antes de eliminar una categoria, asegúrese de haber eliminado
    todos los productos de
    está.</p>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Tipo de producto</th>
            <th>Marca</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$categories item=$category}
            <tr>
                <td>{$category->id}</td>
                <td>{$category->type}</td>
                <td>{$category->brand}</td>
                <td><a class="btn btn-warning" type="button" href="editCategory/{$category->id}">✎</a></td>
                <td><a class="btn btn-danger" type="button" href="deleteCategory/{$category->id}">X</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

{include file="footer.tpl"}