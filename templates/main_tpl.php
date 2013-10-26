<!DOCTYPE html>
<html>
<head>
    <title><?=$this->title()?> - <?=get('main:title');?></title>
    <link rel="stylesheet" type="text/css" href="/app.css">
    <link href='http://fonts.googleapis.com/css?family=Unkempt' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arapey' rel='stylesheet' type='text/css'>
    <?php $this->css(); ?>
</head>
<body>
<div class="content">
    <div class="head">
        <h1 class="title" onclick="window.location.href='/';">Paste it!</h1>
        <span class="subtitle">Need a place to stick your code? Paste it in our simple pastebin service here for quick sharing!</span>
        <?php $this->head(); ?>
    </div>
    <div class="body">
         <?php $this->page(); ?>
    </div>
    <div class="foot">
         <?php $this->foot(); ?>
    </div>
</div>
<footer>
    <?php $this->js(); ?>
</footer>
</body>
</html>
