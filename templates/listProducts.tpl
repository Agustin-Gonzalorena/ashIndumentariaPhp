{include file="header.tpl" title="Lista Productos"}

{if $successMsg}
    <p class="alert alert-success mt-3 text-center">{$successMsg}</p>
{/if}
<h1 class="mt-2">Agregar Producto:</h1>
<div>
    <form action="addProduct" method="POST" enctype="multipart/form-data">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="mb-2">
                            <input class="form-control" name="input_name" type="file" id="formFile"
                                value="img-products/default.png">
                        </div>
                    </td>
                    <td><input class="form-control" type="text" value="Nuevo Producto" name="name"></td>
                    <td><textarea class="form-control" cols="30" rows="4"
                            name="description">Aqui va la descripcion de este producto.</textarea>
                    </td>
                    <td><input class="form-control" type="number" value="1" name="stock"></td>
                    <td><input class="form-control" type="number" value="0" name="price"></td>
                    <td>
                        <div class="col-15">
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    {foreach from=$categories item=$category}
                                        <option value="{$category->id}">{$category->type} {$category->brand}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </td>
                    <td><input class="btn btn-success" type="submit" value="Agregar"></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<h1 class="mt-5">Lista de Productos:</h1>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$products item=$product}
            <tr>
                <td>{$product->id}</td>
                <td><img class="img-thumbnail" src="{$product->image}"></td>
                <td>{$product->name}</td>
                <td>{$product->description}</td>
                <td>{$product->stock}</td>
                <td>${$product->price}</td>
                <td>{$product->type}</td>
                <td>{$product->brand}</td>
                <td><a href="editProduct/{$product->id}" type="button" class="btn btn-warning">✎</a></td>
                <td><a href="deleteProduct/{$product->id}" type="button" class="btn btn-danger">X</a></td>
            </tr>
        {/foreach}
    </tbody>
</table>

{include file="footer.tpl"}