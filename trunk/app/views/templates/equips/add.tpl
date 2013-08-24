{if isset($errors)}
<h4 class="alert_error">
    入力内容にエラーがあります<br>
    <table class="erros">
        {if isset($errors.name)}<tr><td>備品名</td><td>：</td><td>{$errors.name}</td></tr>{/if}
        {if isset($errors.type)}<tr><td>種別</td><td>：</td><td>{$errors.type}</td></tr>{/if}
        {if isset($errors.quantity)}<tr><td>数量</td><td>：</td><td>{$errors.quantity}</td></tr>{/if}
    </table>
</h4>
{/if}
<article class="module width_half">
    <header><h3>{$page_title}</h3></header>

{$form->render()}

</article>
