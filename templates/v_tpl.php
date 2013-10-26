<?php
if(isset($pass[0])):
    $page = $handler->get($pass[0]);
?>
<div class="margined">
    <h2 class="header">Viewing paste <?= $pass[0] ?></h2>
    <span><a href="/_raw/<?=$pass[0]?>/">(raw)</a></span>
    <pre data-language="<?=$page['syntax']?>">
<?=$page['text'];?>
    </pre>
</div>
<?php endif; ?>