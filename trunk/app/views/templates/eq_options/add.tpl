{if isset($errors)}
<h4 class="alert_error">
    入力内容にエラーがあります<br>
    <table class="erros">
        {if isset($errors.caption)}<tr><td>オプション項目名</td><td>：</td><td>{$errors.caption}</td></tr>{/if}
    </table>
</h4>
{/if}
<article class="module width_half">
    <header><h3>{$page_title}</h3></header>

{$form->render()}

</article>
