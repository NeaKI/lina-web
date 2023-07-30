<?php
/* Smarty version 4.3.2, created on 2023-07-30 04:19:20
  from '/neawolf/web-dev/template/view/error/404.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64c5c8a80aa791_79220073',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c892ccc2e727862f58e6e67ea88245e6a92434c1' => 
    array (
      0 => '/neawolf/web-dev/template/view/error/404.tpl',
      1 => 1690188549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../../module/_header.tpl' => 1,
    'file:../../module/_footer.tpl' => 1,
  ),
),false)) {
function content_64c5c8a80aa791_79220073 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:../../module/_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


php parse tpl file

<br>

bei error 404 - prüfen, ob dieses template mit pfadangabe in der datenbank liegt
über die 404 template class abfragen und in smarty laden
...
wenn nicht, erst dann den status 404 senden



<?php $_smarty_tpl->_subTemplateRender("file:../../module/_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
