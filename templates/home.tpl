{include file="header.tpl"}

<div class="banner">
    <a href="jackets/all"><img src="css/img/banner.jpg"></a>
</div>
<section class="containerLastStock">
    <h1>Ultimas unidades:</h1>
    <div class="lastStock">
        <div class="productsCards">
            <section id="caja_remeras">
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
</section>


{include file="footer.tpl"}