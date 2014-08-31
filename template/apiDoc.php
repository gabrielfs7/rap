<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>RAP - Rest API for PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::BOOTSTRAP_CSS_URL); ?>" rel="stylesheet">
<script src="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::JQUERY_URL); ?>"></script>
<script src="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::BOOTSTRAP_JAVASCRIPT_URL); ?>"></script>
<style type="text/css">
    .page-header {
        padding: 0 20px !important; margin: -20px !important;
        background: #285e8e;
        color: #FFF;
        position: fixed;
        z-index: 3;
        width: 100%;
    }

    .page-header a {
        color: #EAEAEA;
        font-size: 11px;
    }

    .col-lg-12 {
        margin-top: 90px;
    }

    #wrapper {
        padding-left: 0;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled {
        padding-left: 30%;
    }

    #sidebar-wrapper {
        z-index: 1000;
        position: fixed;
        left: 30%;
        width: 0;
        height: 100%;
        margin-left: -30%;
        overflow-y: auto;
        background: #444444;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 30%;
    }

    #page-content-wrapper {
        width: 100%;
        padding: 15px;
    }

    #wrapper.toggled #page-content-wrapper {
        position: absolute;
        margin-right: -30%;
    }

    /* Sidebar Styles */

    .sidebar-nav {
        position: absolute;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sidebar-nav li {
        text-indent: 20px;
        line-height: 30px;
    }

    .sidebar-nav li a {
        display: block;
        text-decoration: none;
        color: #999999;
    }

    .sidebar-nav li a:hover {
        text-decoration: none;
        color: #fff;
        background: rgba(255,255,255,0.2);
    }

    .sidebar-nav li a:active,
    .sidebar-nav li a:focus {
        text-decoration: none;
    }

    .sidebar-nav {
        font-size: 12px;
    }

    .sidebar-nav > .sidebar-brand {
        background: #333;
        font-weight: bold;
        font-size: 15px;
    }

    .sidebar-nav > .sidebar-brand a {
        color: #999999;
    }

    .sidebar-nav > .sidebar-brand a:hover {
        color: #fff;
        background: none;
    }

    @media(min-width:768px) {
        #wrapper {
            padding-left: 30%;
        }

        #wrapper.toggled {
            padding-left: 0;
        }

        #sidebar-wrapper {
            width: 30%;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 0;
        }

        #page-content-wrapper {
            padding: 20px;
        }

        #wrapper.toggled #page-content-wrapper {
            position: relative;
            margin-right: 0;
        }
    }
</style>
</head>
<body>
<div id="wrapper">
    <?php include __DIR__. '/menuDoc.php'; ?>
    <div id="page-content-wrapper">
        <div class="page-header">
            <h1>RAP! </h1>
            <p>
                <strong>R</strong>est <strong>A</strong>pi For <strong>P</strong>HP
                <em>
                    <a href="https://github.com/gabrielfs7/rap">[ github.com/gabrielfs7/rap ]</a>
                </em>
                <a href="#menu-toggle" id="menu-toggle">(Toggle Menu)</a>
            </p>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($classesDoc as $class) { ?>
                        <?php include __DIR__. '/resourceDoc.php'; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>
</html>