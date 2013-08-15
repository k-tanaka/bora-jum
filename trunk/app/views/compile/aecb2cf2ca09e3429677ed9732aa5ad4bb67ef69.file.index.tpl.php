<?php /* Smarty version Smarty-3.1.12, created on 2013-07-02 18:01:35
         compiled from "/home/curry/app/views/templates/users/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82645500051d24bb58ba148-81034037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aecb2cf2ca09e3429677ed9732aa5ad4bb67ef69' => 
    array (
      0 => '/home/curry/app/views/templates/users/index.tpl',
      1 => 1372755693,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82645500051d24bb58ba148-81034037',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51d24bb58f6e64_40380189',
  'variables' => 
  array (
    'users' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d24bb58f6e64_40380189')) {function content_51d24bb58f6e64_40380189($_smarty_tpl) {?><article class="module width_3_quarter">
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
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['display'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['updated_at'];?>
</td>
                <td>
                    <input type="image" src="/images/icn_edit.png" title="変更">
                    <input type="image" src="/images/icn_trash.png" title="削除">
                </td> 
            </tr>
<?php } ?>
        </tbody>
    </table>
</article>
<?php }} ?>