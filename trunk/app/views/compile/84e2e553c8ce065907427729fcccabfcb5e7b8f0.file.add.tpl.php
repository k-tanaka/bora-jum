<?php /* Smarty version Smarty-3.1.12, created on 2013-07-02 20:55:44
         compiled from "/home/curry/app/views/templates/users/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175083172551d2bfc0559e28-76962549%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84e2e553c8ce065907427729fcccabfcb5e7b8f0' => 
    array (
      0 => '/home/curry/app/views/templates/users/add.tpl',
      1 => 1372765853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175083172551d2bfc0559e28-76962549',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51d2bfc057d1b5_20676391',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d2bfc057d1b5_20676391')) {function content_51d2bfc057d1b5_20676391($_smarty_tpl) {?><article class="module width_half">
    <header><h3><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h3></header>

<?php echo $_smarty_tpl->tpl_vars['form']->value->render();?>


</article>
<?php }} ?>