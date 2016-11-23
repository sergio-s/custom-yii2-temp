<?php
use dmstr\widgets\Alert;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = $this->title;
\modules\admin\assets\AdminAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Ionicons -->
    <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <?php $this->head() ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">

    <header class="main-header">
        <a href="<?= \Yii::$app->homeUrl ?>" class="logo">ADMIN</a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if (!\Yii::$app->user->isGuest): ?>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 1 notification(s)</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> Welcome to Phundament 4!
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= \Yii::$app->user->identity->email ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <p>
                                        <?= \Yii::$app->user->identity->email ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= \yii\helpers\Url::to(['/user/settings/profile']) ?>"
                                           class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= \yii\helpers\Url::to(['/user/security/logout']) ?>"
                                           class="btn btn-default btn-flat" data-method="post">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?= $this->render('_sidebar') ?>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1><?= $this->title ?></h1>
            <?=\yii\widgets\Breadcrumbs::widget([
                'tag' => 'ol',
                'options' => [
                    'class' => 'breadcrumb'
                ],
                'links' => $this->params['breadcrumbs']
            ])?>
        </section>
        <section class="content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </section>
    </div>
    <footer class="main-footer">
        Powered by <strong>Yii2</strong>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
