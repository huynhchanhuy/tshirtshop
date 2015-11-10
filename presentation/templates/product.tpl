{load_presentation_object filename="product" assign="obj"}
{*<pre>{$obj->mProduct|@print_r}</pre>*}

<h1 class="title">{$obj->mProduct.name}</h1>
{if $obj->mProduct.image}
    <img class="product-image" src="{$obj->mProduct.image}"
    alt="{$obj->mProduct.name} image" />
{/if}
{if $obj->mProduct.image_2}
    <img class="product-image" src="{$obj->mProduct.image_2}"
    alt="{$obj->mProduct.name} image 2" />
{/if}
<p class="description">{$obj->mProduct.description}</p
<p class="section">
    Price:
    {if $obj->mProduct.discounted_price != 0}
        <span class="old-price">{$obj->mProduct.price}</span>
        <span class="price">{$obj->mProduct.discounted_price}</span>
    {else}
        <span class="price">{$obj->mProduct.price}</span>
    {/if}
</p>

{* Generate the list of attribute values *}
<p class="attributes">

    {* Parse the list of attributes and attribute values *}
    {section name=l loop=$obj->mProduct.attributes}
        {*<pre>{$obj->mProduct.attributes|@print_r}</pre>*}
        {* Generate the new select tag ? *}
        {if $smarty.section.l.first || 
            $obj->mProduct.attributes[l].attribute_name !=
            $obj->mProduct.attributes[l.index_prev].attribute_name
        }
            {$obj->mProduct.attributes[l].attribute_name}:
            <select name="attr_{$obj->mProduct.attributes[l].attributes_name}
        {/if}

        {* Generate a new option tag *}
        <option value="{$obj->mProduct.attributes[l].attribute_value}">
            {$obj->mProduct.attributes[l].attribute_value}
        </option>

        {* Close the select tag? *} 
        {if $smarty.section.l.last ||
            $obj->mProduct.attributes[l].attribute_name !==
            $obj->mProduct.attributes[l.index_next].attribute_name
        }
            </select>
        {/if}

     {/section}
</p>

{if $obj->mLinkToContinueShopping}
    <a href="{$obj->mLinkToContinueShopping}">Continue Shopping</a>
{/if}

<h2>Find similar products in our catalog:</h2>
<ol>
    {section name=i loop=$obj->mLocations}
        <li class="navigation">
            {strip}
                <a href="{$obj->mLocations[i].link_to_department}">
                    {$obj->mLocations[i].department_name}
                </a>
            {/strip}
            {* >> sign *}
            &raquo;
            {strip}
                <a href="{$obj->mLocations[i].link_to_category}">
                    {$obj->mLocations[i].category_name}
                </a>
            {/strip}
        </li>
    {/section}
</ol>