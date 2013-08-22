<article class="module width_full">
    <header>
        <h3>{$page_title}</h3>
    </header>
    <div class="module_content">
        <article class="stats stats_mini stats_1_column">
            <div class="stats_content">
                <p class="stats_title">種別</p>
                <p class="stats_body">{$type.name}</p>
            </div>
        </article>
        <article class="stats stats_short stats_2_column">
            <div class="stats_content">
                <p class="stats_title">総数</p>
                <p class="stats_body">{$equipment.quantity}</p>
            </div>
            <div class="stats_content">
                <p class="stats_title">使用中</p>
                <p class="stats_body">{$used_quantity}</p>
                <p class="stats_title">未使用</p>
                <p class="stats_body">{$equipment.quantity - $used_quantity}</p>
            </div>
        </article>
        <div class="clear"></div>
    </div>
</article>

<article class="module width_full">
    <header>
        <h3 class="tabs_involved">使用状況一覧</h3>
        <div class="header_btns">
            <a href="/usages/add/{$equipment.id}/"><input type="button" value="追加"></a>
        </div>
    </header>
{$usages_table}
</article>
