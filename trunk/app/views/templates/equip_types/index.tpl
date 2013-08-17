<article class="module width_3_quarter">
    <header>
        <h3 class="tabs_involved">{$page_title}</h3>
        <div class="header_btns">
            <a href="/equip_types/add/"><input type="button" value="追加"></a>
        </div>
    </header>
    <table class="tablesorter" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>種別名</th>
                <th>更新日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
{foreach from=$types item=type}
            <tr>
                <td>{$type.id}</td>
                <td>{$type.name}</td>
                <td>{$type.updated_at}</td>
                <td>
                    <a href="/equip_types/edit/{$type.id}/"><input type="image" src="/images/icn_edit.png" title="変更"></a>
                    <a href="/equip_types/delete/{$type.id}/" onClick="return confirm('{$type.name} を削除しますか?');"><input type="image" src="/images/icn_trash.png" title="削除"></a>
                </td> 
            </tr>
{/foreach}
        </tbody>
    </table>
</article>
