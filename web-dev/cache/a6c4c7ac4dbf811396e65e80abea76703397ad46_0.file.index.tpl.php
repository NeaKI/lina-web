<?php
/* Smarty version 4.3.2, created on 2023-07-31 12:01:29
  from '/neawolf/web-dev/template/view/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64c78679a3c600_77377587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6c4c7ac4dbf811396e65e80abea76703397ad46' => 
    array (
      0 => '/neawolf/web-dev/template/view/index.tpl',
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
function content_64c78679a3c600_77377587 (Smarty_Internal_Template $_smarty_tpl) {
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
