<article class="module width_full">
    <header>
        <h3>{$page_title}</h3>
    </header>
    <table class="tablesorter" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>備品名</th>
                <th>種別</th>
                <th>数量</th>
                <th>更新日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
{foreach from=$equipments item=equipment}
            <tr>
                <td>{$equipment.id}</td>
                <td>{$equipment.name}</td>
                <td>{$type_list[$equipment.type]}</td>
                <td>{$equipment.quantity}</td>
                <td>{$equipment.updated_at}</td>
                <td>
                    <a href="/equips/edit/{$equipment.id}/"><input type="image" src="/images/icn_edit.png" title="変更"></a>
                    <a href="/equips/delete/{$equipment.id}/" onClick="return confirm('{$equipment.name} を削除しますか?');"><input type="image" src="/images/icn_trash.png" title="削除"></a>
                </td> 
            </tr>
{/foreach}
        </tbody>
    </table>
</article>
