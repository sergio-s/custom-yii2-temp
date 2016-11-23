<?php

namespace modules\admin\controllers;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends BaseController
{
    public $layout = 'main';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
