{include file="header.tpl"}
<div class="containerOneProduct">
    {if empty($product)}
        <div class="notProduct">
            <h1>Producto no encontrado</h1>
        </div>
    {else}

        <div class="containerImage">
            <img src={$product->image} alt="">
        </div>
        <div class="containerDetails">

            <p class="sold">Nuevo | 700 vendidos</p>
            <h1>{$product->name}</h1>
            <p class="score">★★★★★<span> (347) </span></p>
            <h2>${$product->price}</h2>
            <p>STOCK: {$product->stock}</p>
            <h3>Descripcion:</h3>
            <p>Tipo de producto:{$product->type}</p>
            <p class="descriptionProduct">Marca: {$product->brand}</p>
            <p class="descriptionProduct">{$product->description}</p>
        </div>
    {/if}



</div>




{include file="footer.tpl"}