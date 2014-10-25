<h2 id="resource<?php echo $class->getPresentation(); ?>"><?php echo $class->getPresentation(); ?></h2>
<?php foreach ($class->getResources() as $resource) { ?>
<div class="panel panel-primary">
    <div class="panel-heading" id="method<?php echo $resource->getMethod() . $resource->getUri(); ?>">
        <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
    </div>
    <div class="panel-body">
        <p>
        <?php echo $resource->getHelp(); ?>
        </p>

        <?php include __DIR__. '/requestDoc.php'; ?>
        <?php include __DIR__. '/responseDoc.php'; ?>
    </div>
</div>
<?php } ?>