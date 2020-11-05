<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Listing */

$this->title = 'Add Listing';
$this->params['breadcrumbs'][] = ['label' => 'Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

