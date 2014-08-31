<h2 id="resource<?php echo $class->getPresentation(); ?>"><?php echo $class->getPresentation(); ?></h2>
<?php foreach ($class->getResources() as $resource) { ?>
<div class="panel panel-default">
    <div class="panel-heading" id="method<?php echo $resource->getUri(); ?>">
        <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
    </div>
    <div class="panel-body">
        <?php echo $resource->getHelp(); ?>
    </div>
</div>
<?php include __DIR__. '/requestDoc.php'; ?>
<?php include __DIR__. '/responseDoc.php'; ?>
<?php } ?>