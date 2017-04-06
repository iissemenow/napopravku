<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
 
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Для регистрации заполните необходимые поля:</p>
    <div class="row">
        <div class="col-lg-5">
 
            <?php $form = ActiveForm::begin(['id' => 'form-register']); ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'captcha')->widget(Captcha::className(), [
    'captchaAction' => 'site/captcha'
]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>