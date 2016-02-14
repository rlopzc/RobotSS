<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación de estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-' . $key,
        ],
        'body' => $message,
    ]);
}
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label' => 'Proyecto', 'attribute' => 'projectName'],
            ['label' => 'Estudiante', 'attribute' => 'studentName'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{assign-student} {cancel-preregistration}',
                'buttons' => [
                    'assign-student' => function ($url) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-ok"></span>',
                            $url,
                            [
                                'title' => 'Asignar estudiante',
                                'data-pjax' => '0',
                                'data-confirm' => Yii::t('app', '¿Está seguro que desea asignar al estudiante?'),
                            ]
                        );
                    },
                    'cancel-preregistration' => function ($url) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            $url,
                            [
                                'title' => 'Cancelar preregistro',
                                'data-pjax' => '0',
                                'data-confirm' => Yii::t('app', '¿Está seguro que desea cancelar el registro del estudiante?'),
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

</div>
