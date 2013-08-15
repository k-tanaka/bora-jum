<?php /* Smarty version Smarty-3.1.12, created on 2013-07-02 17:41:26
         compiled from "/home/curry/app/views/templates/error/develop.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170603050451d29236a6dfe5-13206750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ebef9c814622747a747090819181e2bb6c22581' => 
    array (
      0 => '/home/curry/app/views/templates/error/develop.tpl',
      1 => 1362227892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170603050451d29236a6dfe5-13206750',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'file' => 0,
    'line' => 0,
    'message' => 0,
    'trace' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51d29236a7caf8_64958736',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d29236a7caf8_64958736')) {function content_51d29236a7caf8_64958736($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['file']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['line']->value;?>
)
<br />
<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

<br /><br />
<?php echo nl2br($_smarty_tpl->tpl_vars['trace']->value);?>
<?php }} ?>