<?php
/* Smarty version 4.3.2, created on 2023-07-24 15:03:00
  from '/var/www/clients/client1/web43/web/public/template/view/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64be76846bcef3_78539636',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '534b87334b3c4828123950c1dcce3e1eaed400eb' => 
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
function content_64be76846bcef3_78539636 (Smarty_Internal_Template $_smarty_tpl) {
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
