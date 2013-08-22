<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>{if !is_null($page_title)}{$page_title} | {/if}{if !is_null($section_title)}{$section_title} | {/if}{$site_title}</title>

{foreach from=$stylesheets item=css}
    <link rel="stylesheet" type="text/css" href="{$request.base_path}/css/{$css}" />
{/foreach}

    <!--[if lt IE 9]>
    <link rel="stylesheet" href="/css/ie.css" type="text/css" media="screen" />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

{foreach from=$javascripts item=js}
    <script type="text/javascript" src="{$request.base_path}/js/{$js}"></script>
{/foreach}
</head>

<body>

    <header id="header">
        <hgroup>
            <h1 class="site_title"><a href="/">{$site_title}</a></h1>
        </hgroup>
    </header> <!-- end of header bar -->

    <section id="secondary_bar">
        <div class="user">
            <p>Not Auth User</p>
        </div>
        <div class="breadcrumbs_container">
            <article class="breadcrumbs">
{foreach from=$breadcrumbs item=breadcrumb}
    {if $breadcrumb.url !== ''}
                <a href="{$breadcrumb.url}" title="{$breadcrumb.title}">{$breadcrumb.title}</a>
                <div class="breadcrumb_divider"></div>
    {else}
                <a class="current">{$breadcrumb.title}</a>
    {/if}
{/foreach}
            </article>
        </div>
    </section><!-- end of secondary bar -->

    <aside id="sidebar" class="column">
        <div class="dummy-container">
        </div>
        <footer>
            <hr />
            <p><strong>Copyright &copy; 2013 NetComBB</strong></p>
        </footer>
    </aside><!-- end of sidebar -->

    <section id="main" class="column">

{$inner_contents}

        <div class="spacer"></div>
    </section>
</body>

</html>
