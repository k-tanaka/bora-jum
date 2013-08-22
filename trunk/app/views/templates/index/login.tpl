{if isset($errors)}
<h4 class="alert_error">ログインできませんでした</h4>
{/if}
<article class="module width_half">
    <header><h3>{$page_title}</h3></header>

{$form->render()}

</article>
