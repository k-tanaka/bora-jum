<article class="module width_3_quarter">
    <header>
        <h3>ユーザ一覧</h3>
    </header>
    <table class="tablesorter" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ログインID</th>
                <th>表示</th>
                <th>更新日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
{foreach from=$users item=user}
            <tr>
                <td>{$user.id}</td>
                <td>{$user.name}</td>
                <td>{$user.display}</td>
                <td>{$user.updated_at}</td>
                <td>
                    <input type="image" src="/images/icn_edit.png" title="変更">
                    <input type="image" src="/images/icn_trash.png" title="削除">
                </td> 
            </tr>
{/foreach}
        </tbody>
    </table>
</article>
