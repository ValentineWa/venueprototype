<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

    <div class="container">
    <div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="progress" id="progress1">
            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">                
            </div>
            <span class="progress-type">Overall Progress</span>
            <span class="progress-completed">100%</span>
        </div> 
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-md-12">
    <div class="row step">
        <div id="div1" class="col-md-4" onclick="javascript: resetActive(event, 0);">
            <span class="fa fa-pencil"></span>
            <p>Listing Details</p>
        </div>
        <div class="col-md-4 " onclick="javascript: resetActive(event, 60);">
            <span class="fa fa-map-marker"></span>
            <p>Location Details</p>
        </div>
        <div id="last" class="col-md-4 activestep" onclick="javascript: resetActive(event, 100);">
            <span class="fa fa-picture-o"></span>
            <p>Add Images</p>
        </div>
  </div>
  </div>
  </div>

  <div class="row">
  <div class="image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="d-flex flex-column justify-content-center align-items-center">

        <div class="upload-icon">
            <i class="fas fa-upload"></i>
        </div>
          
       
        <?php $form = ActiveForm::begin(['id' => 'image-create'],['options' => ['enctype' => 'multipart/form-data'] ]) ?>

            <?= $form->field($model, 'listingId')->hiddenInput(['value' => $listingId]) ?>
            <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>
            <div class="form-group col-md-12">
                                <?= Html::submitButton('Save <span class="fa fa-forward"></span>', ['class' => 'btn btn-warning pull-right']) ?>
                            </div>
                    <?php ActiveForm::end() ?>
    </div>
    
</div>
</div>