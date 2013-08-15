<?php /* Smarty version Smarty-3.1.12, created on 2013-07-02 20:51:33
         compiled from "/home/curry/app/views/templates/users/create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1228873251d2a4d7b98476-49385486%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32eec5bde5c82a1de6ce9da65a1286946625bc28' => 
    array (
      0 => '/home/curry/app/views/templates/users/create.tpl',
      1 => 1372765853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1228873251d2a4d7b98476-49385486',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51d2a4d7bae5f3_04754615',
  'variables' => 
  array (
    'page_title' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d2a4d7bae5f3_04754615')) {function content_51d2a4d7bae5f3_04754615($_smarty_tpl) {?><article class="module width_half">
    <header><h3><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h3></header>

<?php echo $_smarty_tpl->tpl_vars['form']->value->render();?>


</article>
<?php }} ?>