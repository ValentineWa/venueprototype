<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Listing */

$this->title = 'Update Listing: ' . $model->listingId;
$this->params['breadcrumbs'][] = ['label' => 'Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->listingId, 'url' => ['view', 'id' => $model->listingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="listing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
