<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Listing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="progress" id="progress1">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">                
            </div>
            <span class="progress-type">Overall Progress</span>
            <span class="progress-completed">0%</span>
        </div> 
     </div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="row step">
            <div id="div1" class="col-md-4 activestep" onclick="javascript: resetActive(event, 0);">
                <span class="fa fa-pencil"></span>
                <p>Listing Details</p>
            </div>
            <div class="col-md-4" onclick="javascript: resetActive(event, 60);">
                <span class="fa fa-map-marker"></span>
                <p>Location Details</p>
            </div>
            <div id="last" class="col-md-4" onclick="javascript: resetActive(event, 100);">
                <span class="fa fa-picture-o"></span>
                <p>Add Images</p>
            </div>
      </div>
      </div>
      </div>
   <div class="panel panel-primary">
    <div class="panel-body">
      <h3 class="text-on-pannel text-primary"><strong class="text-uppercase"> <?= Html::encode($this->title) ?> </strong></h3>
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false) ?>
                
            
                <?= $form->field($model, 'listingName')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'listingDesc')->textarea(['rows' => 6]) ?>
            
                <?= $form->field($model, 'videoUrl')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'price')->textInput() ?>
            
                <div class="form-group">
                    <?= Html::submitButton('<span class="fa fa-forward"></span> Next', ['class' => 'btn btn-success pull-right']) ?>
                </div>
            
                <?php ActiveForm::end(); ?>
              </div>
       </div>
    </div>
  </div>
</div>



