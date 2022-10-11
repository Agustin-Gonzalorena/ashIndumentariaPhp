{include file="header.tpl"}
<h1>Modificar categoria ({$category->id}):</h1>
<div>
    <form action="updateCategory/{$category->id}" method="POST">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Tipo de producto</th>
                    <th>Marca del producto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <td><input type="text" name="type" value="{$category->type}"></td>
                <td><input type="text" name="brand" value="{$category->brand}"></td>
                <td><input class="btn btn-warning" type="submit" value="Modificar"></td>
            </tbody>
        </table>
    </form>
</div>
{include file="footer.tpl"}