<?php
/* Smarty version 4.3.2, created on 2023-07-30 02:03:00
  from '/neawolf/web-dev/template/module/_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64c5a8b4996952_59666408',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59a94727a808a50397e3ab7f023ad44c5dc8dbb8' => 
    array (
      0 => '/neawolf/web-dev/template/module/_header.tpl',
      1 => 1690210448,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./_header.navi.tpl' => 1,
  ),
),false)) {
function content_64c5a8b4996952_59666408 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <meta name="theme-color" content="#e6155e">

  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <META NAME="Copyright" CONTENT="">
  <META NAME="Author" CONTENT="">
  <META NAME="Subject" CONTENT="">
  <META NAME="Language" CONTENT="DE">
  <META NAME="Robots" CONTENT="index,follow">

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/plugins/fontawesome-free-6.4.0/css/all.min.css" rel="preload">
  <link rel="stylesheet" href="/assets/css/plugins/simple-line-icons/css/simple-line-icons.css" rel="preload">
  <link rel="stylesheet" href="/assets/css/_combine1.css" rel="preload">
  <link rel="stylesheet" href="/assets/css/less.css" rel="preload">

  <link rel="apple-touch-icon" sizes="180x180" href="/image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest.json" crossorigin="use-credentials">

  <?php echo '<script'; ?>
 src="/assets/js/plugins/jquery-3.6.1.min.js"><?php echo '</script'; ?>
>

  <meta property="og:title" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <link rel="canonical" href="<?php echo '<?'; ?>
=$_PATH_DOMAIN_PROTOCOL<?php echo '?>';
echo '<?'; ?>
=array_shift(explode('?',$_SERVER["REQUEST_URI"]))<?php echo '?>'; ?>
">

  <title>Lina Narzisse</title>

  <?php echo '<script'; ?>
>
    window.onerror = function (msg, url, line) {
       console.warn(msg, url, line);
       return true;
    };
    try{
      document.addEventListener('touchstart', (event) => {}, {passive: true});
      document.addEventListener('touchmove', (event) => {}, {passive: true});
    }catch(ex){};
    try{
      document.addEventListener('wheel', (event) => {}, {passive: true});
    }catch(ex){};
    try{
      document.addEventListener('scroll', (event) => {}, {passive: true});
    }catch(ex){};

  <?php echo '</script'; ?>
>
</head>

<body>
  
<?php $_smarty_tpl->_subTemplateRender("file:./_header.navi.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
