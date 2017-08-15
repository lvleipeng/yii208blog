<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>


    <?php
    /*
       1
        $psObjs = Poststatus::find()->all();
        $allStatus = ArrayHelper::map($psObjs,'id','name');
2
        $psArray = Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
        $allStatus = ArrayHelper::map($psArray,'id','name');

3
        $allStatus =  (new \yii\db\Query())
                ->select(['name','id'])
                ->from('poststatus')
                ->indexBy('id')
                ->column();

    */

        $allStatus = Poststatus::find()
            ->select(['name'])
            ->orderBy('position')
            ->indexBy('id')
            ->column();

    ?>


    <?= $form -> field($model,'status')
        -> dropDownList($allStatus,['prompt'=>'请选择状态']);
    ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

<!--    --><?//= $form->field($model, 'author_id')->textInput() ?>

    <?php

        $allStatus = \common\models\Adminuser::find()
                ->select('nickname')

                ->indexBy('id')
                ->column();


    ?>
    <?= $form ->field($model,'author_id')->dropDownList($allStatus,['prompt'=>'请选择作者']);   ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
