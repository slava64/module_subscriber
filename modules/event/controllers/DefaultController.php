<?php

namespace app\modules\event\controllers;

/**
 * Default controller for the `event` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->redirect(["subscriber/index"]);
    }
}
