<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\forms\auth\SignUpForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('admin', 'Signup');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-signup">
  <h1><?= Html::encode($this->title) ?></h1>

  <p><?= Yii::t('admin', 'Please fill out the following fields to signup:') ?></p>
    <?= Html::errorSummary($model) ?>
  <div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
      <div class="form-group">
          <?= Html::submitButton(Yii::t('admin', 'Signup'),
              ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
      </div>
        <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
