{if isset($errors)}
<h4 class="alert_error">
    入力内容にエラーがあります<br>
    <table class="erros">
        {if isset($errors.loginid)}<tr><td>ログインID</td><td>：</td><td>{$errors.loginid}</td></tr>{/if}
        {if isset($errors.name)}<tr><td>表示名</td><td>：</td><td>{$errors.name}</td></tr>{/if}
    </table>
</h4>
{/if}
<article class="module width_half">
    <header><h3>{$page_title}</h3></header>

{$form->render()}

</article>
