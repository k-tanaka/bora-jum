<h3>{$page_title}</h3>
<article class="module width_3_quarter">
    <header>
        <h3 class="tabs_involved">子種別</h3>
        <div class="header_btns">
            <a href="/equip_types/add/{$equipment_type.id}/"><input type="button" value="追加"></a>
        </div>
    </header>
{$child_types_table}
</article>
<article class="module width_3_quarter">
    <header>
        <h3 class="tabs_involved">オプション項目</h3>
        <div class="header_btns">
            <a href="/eq_options/add/{$equipment_type.id}/"><input type="button" value="追加"></a>
        </div>
    </header>
{$options_table}
</article>
