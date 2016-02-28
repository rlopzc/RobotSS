<?php

use app\models\ProjectManager;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(['action' => Url::to(['create'])]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'delivery_date')->widget(\yii\jui\DatePicker::classname(), [

        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>

    <?php

    $user = User::find()
        ->where("id=" . Yii::$app->user->id)
        ->one();
    $user_id = $user->id;
    $manager = ProjectManager::find()
        ->where("user_id=" . $user_id)
        ->one();
    $manager_id = $manager->id;

    $students = Yii::$app->db->createCommand('Select
        registration.student_id,
        student.id,
        person.name,
        person.lastname
        From
        registration Inner Join
        student
        On registration.student_id = student.id Inner Join
        user
        On student.user_id = user.id Inner Join
        person
        On user.person_id = person.id
        where registration.project_id=' . $project_id)
        ->queryAll();


    echo $form->field($model, 'students')->checkboxList(ArrayHelper::map($students, 'student_id', 'name'));

    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
