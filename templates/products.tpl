{include file="header.tpl" title="Productos"}

<div class="containerProducts">
    <div class="category">
        <h2>Categorias:</h2>
        <ul>
            <li class="title"><a class="subTitle" href="allProducts">TODOS</a></li>
            <li class="title">
                <a class="subTitle" href="t-shirts/all">REMERAS</a>
                <ul>
                    {foreach from=$remeras item=$item}
                        <li><a href="t-shirts/{$item->brand}"> {$item->brand}</a></li>
                    {/foreach}
                </ul>
            </li>
            <li class="title">
                <a class="subTitle" href="sweatshirt/all">BUZOS</a>
                <ul>
                    {foreach from=$buzos item=$item}
                        <li><a href="sweatshirt/{$item->brand}"> {$item->brand}</a></li>
                    {/foreach}
                </ul>
            </li>
            <li class="title">
                <a class="subTitle" href="jackets/all">CAMPERAS</a>
                <ul>
                    {foreach from=$camperas item=$item}
                        <li><a href="jackets/{$item->brand}"> {$item->brand}</a></li>
                    {/foreach}
                </ul>
            </li>
        </ul>
    </div>
    <div class="productsCards">
        <section id="caja_remeras">
            {if empty($products)}
                <h2>Productos no encontrados</h2>
            {/if}
            {foreach from=$products item=$product}
                <div class="card" style="width: 18rem;">
                    <img src="{$product->image}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{$product->name}</h5>
                        <p class="card-text">${$product->price}</p>
                        <a href="product/{$product->id}" class='btn btn-dark'> Ver mas </a>
                    </div>
                </div>
            {/foreach}
        </section>
    </div>
</div>

{include file="footer.tpl"}