<?php
/* Smarty version 4.3.2, created on 2023-07-24 11:19:16
  from '/var/www/clients/client1/web43/web/public/template/view/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64be4214bf6e72_82519665',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c3c0e3b4feac55f28c5340fff6828878707f3d9' => 
    array (
      0 => '/var/www/clients/client1/web43/web/public/template/view/index.tpl',
      1 => 1690188775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../module/_header.tpl' => 1,
    'file:../module/_footer.tpl' => 1,
  ),
),false)) {
function content_64be4214bf6e72_82519665 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../module/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

startseite
<br>
index template tpl


<?php echo $_smarty_tpl->tpl_vars['name']->value;?>



<?php $_smarty_tpl->_subTemplateRender("file:../module/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
