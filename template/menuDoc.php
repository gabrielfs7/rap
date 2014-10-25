<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
    <?php foreach ($classesDoc as $class) { ?>
        <li class="sidebar-brand">
            <a href="#resource<?php echo $class->getPresentation(); ?>">
                <?php echo $class->getPresentation(); ?>
            </a>
        </li>
        <?php foreach ($class->getResources() as $resource) { ?>
        <li>
            <a href="#method<?php echo $resource->getMethod() . $resource->getUri(); ?>">
                <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
            </a>
        </li>
        <?php } ?>
    <?php } ?>
    </ul>
</div>