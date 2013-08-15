<?php /* Smarty version Smarty-3.1.12, created on 2013-07-02 20:56:17
         compiled from "/home/curry/app/views/layouts/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61108580851d24a1c7563a1-99193571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e43fb48379fca04c33b33e19b44454e291316f6' => 
    array (
      0 => '/home/curry/app/views/layouts/default.tpl',
      1 => 1372766164,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61108580851d24a1c7563a1-99193571',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51d24a1c7b09b8_84968833',
  'variables' => 
  array (
    'page_title' => 0,
    'section_title' => 0,
    'site_title' => 0,
    'stylesheets' => 0,
    'request' => 0,
    'css' => 0,
    'javascripts' => 0,
    'js' => 0,
    'user_name' => 0,
    'breadcrumbs' => 0,
    'breadcrumb' => 0,
    'inner_contents' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d24a1c7b09b8_84968833')) {function content_51d24a1c7b09b8_84968833($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['section_title']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</title>

<?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['stylesheets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value){
$_smarty_tpl->tpl_vars['css']->_loop = true;
?>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['request']->value['base_path'];?>
/css/<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" />
<?php } ?>

    <!--[if lt IE 9]>
    <link rel="stylesheet" href="/css/ie.css" type="text/css" media="screen" />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['javascripts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['request']->value['base_path'];?>
/js/<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
"></script>
<?php } ?>
</head>

<body>

    <header id="header">
        <hgroup>
            <h1 class="site_title"><a href="/"><?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</a></h1>
            <h2 class="section_title"><?php echo $_smarty_tpl->tpl_vars['section_title']->value;?>
</h2>
            <div class="btn_view_site"><a href="">ログアウト</a></div>
        </hgroup>
    </header> <!-- end of header bar -->

    <section id="secondary_bar">
        <div class="user">
            <p><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</p>
        </div>
        <div class="breadcrumbs_container">
            <article class="breadcrumbs">
<?php  $_smarty_tpl->tpl_vars['breadcrumb'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['breadcrumb']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['breadcrumbs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['breadcrumb']->key => $_smarty_tpl->tpl_vars['breadcrumb']->value){
$_smarty_tpl->tpl_vars['breadcrumb']->_loop = true;
?>
    <?php if ($_smarty_tpl->tpl_vars['breadcrumb']->value['url']!==''){?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['title'];?>
</a>
                <div class="breadcrumb_divider"></div>
    <?php }else{ ?>
                <a class="current"><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['title'];?>
</a>
    <?php }?>
<?php } ?>
            </article>
        </div>
    </section><!-- end of secondary bar -->

    <aside id="sidebar" class="column">
        <form class="quick_search">
            <input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
        </form>
        <hr/>
        <h3>ユーザ管理</h3>
        <ul class="toggle">
            <li class="icn_add_user"><a href="/users/add/">ユーザ登録</a></li>
            <li class="icn_view_users"><a href="/users/">ユーザ一覧</a></li>
            <li class="icn_profile"><a href="#">Your Profile</a></li>
        </ul>
        <h3>Content</h3>
        <ul class="toggle">
            <li class="icn_new_article"><a href="#">New Article</a></li>
            <li class="icn_edit_article"><a href="#">Edit Articles</a></li>
            <li class="icn_categories"><a href="#">Categories</a></li>
            <li class="icn_tags"><a href="#">Tags</a></li>
        </ul>
        <footer>
            <hr />
            <p><strong>Copyright &copy; 2011 Website Admin</strong></p>
            <p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
        </footer>
    </aside><!-- end of sidebar -->

    <section id="main" class="column">

<?php echo $_smarty_tpl->tpl_vars['inner_contents']->value;?>


        <div class="spacer"></div>
    </section>
</body>

</html>
<?php }} ?>