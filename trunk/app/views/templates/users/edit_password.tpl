{if isset($errors)}
<h4 class="alert_error">
    入力内容にエラーがあります<br>
    <table class="erros">
        {if isset($errors.password)}<tr><td>パスワード</td><td>：</td><td>{$errors.password}</td></tr>{/if}
    </table>
</h4>
{/if}
<article class="module width_half">
    <header><h3>{$page_title}</h3></header>
    <div class="module_content"><h4>ユーザ名： {$user.display}</h4></div>

{$form->render()}

</article>
