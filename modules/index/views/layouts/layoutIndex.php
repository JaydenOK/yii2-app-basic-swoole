<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $content string 字符串 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>YaFex后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/libs/layuilib/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/libs/layuilib/layuiadmin/style/admin.css" media="all">
    <script>
        /^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');
    </script>
    <?php $this->head() ?>
</head>
<body class="layui-layout-body">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>