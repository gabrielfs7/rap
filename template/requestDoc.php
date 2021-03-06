<?php if (count($resource->getParams())) { ?>
<div class="panel panel-info">
    <div class="panel-heading">
        Request parameter(s):
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Required</th>
                <th>Default</th>
                <th>Example</th>
                <th>Help</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($resource->getParams() as $param) { ?>
        <tr>
            <td><?php echo $param->getName(); ?></td>
            <td><?php echo $param->isClass() ? 'Object' : $param->getType(); ?></td>
            <td><?php echo ($param->isRequired() ? '<i class="icon-ok"></i> YES' : ''); ?></td>
            <td><?php echo $param->getDefault(); ?></td>
            <td><?php echo $param->getSample(); ?></td>
            <td><?php echo $param->getHelp(); ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>
<div class="panel panel-info">
    <div class="panel-heading">
        Request Example:
    </div>
    <pre class="code-sample"><?php echo $resource->getSample(); ?></pre>
</div>