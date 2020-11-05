<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ListingSearch */
/* @var $form yii\widgets\ActiveForm */



$this->title = 'Add image'

?>

<div class="listing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'listingId') ?>

    <?= $form->field($model, 'listingName') ?>

    <?= $form->field($model, 'listingDesc') ?>

    <?= $form->field($model, 'videoUrl') ?>

    <?= $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
