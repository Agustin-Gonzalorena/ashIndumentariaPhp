{include file="header.tpl" title="Editar Producto"}

{if empty($product)}
    <div class="notProduct">
        <h1>Producto no encontrado</h1>
    </div>
{else}
    <h1>Modificar producto ({$product->id}):</h1>
    <form action="updateProduct/{$product->id}" method="POST" enctype="multipart/form-data">
        <table class="table table-dark table-striped">
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
                        <img class="img-thumbnail" src="{$product->image}">
                        <div class="mt-3 mb-3">
                            <input class="form-control" name="input_name" type="file" id="formFile"
                                value="{$product->image}">
                        </div>
                    </td>
                    <td><input type="text" value="{$product->name}" name="name"></td>
                    <td><textarea cols="30" rows="4" name="description">{$product->description}</textarea></td>
                    <td><input type="number" class="col-sm-8" value="{$product->stock}" name="stock"></td>
                    <td><input type="number" class="col-sm-8" value="{$product->price}" name="price"></td>
                    <td>
                        <div class="col-15">
                            <div class="form-group">
                                <select name="type" class="form-control">
                                    <option value="">{$product->type} {$product->brand}</option>
                                    {foreach from=$categories item=$category}
                                        <option value="{$category->id}">{$category->type} {$category->brand}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </td>
                    <td><input type="submit" class="btn btn-success" value="Modificar"></td>
                </tr>
            </tbody>
        </table>
    </form>
{/if}

{include file="footer.tpl"}