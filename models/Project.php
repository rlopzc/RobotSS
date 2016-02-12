<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $name
 * @property string $dependency
 * @property string $objective
 * @property string $goals
 * @property string $actions_by_students
 * @property string $induction
 * @property string $materials_for_students
 * @property string $economic_support
 * @property string $human_resource
 * @property string $infraestrcture
 * @property integer $ammount
 * @property string $approved
 *
 * @property StudentProfile[] $studentProfiles
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'dependency', 'objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestrcture', 'ammount'], 'required'],
            [['ammount'], 'integer'],
            [['name', 'dependency'], 'string', 'max' => 200],
            [['objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestrcture', 'approved'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre del proyecto',

            'dependency' => 'Dependencia solicitante',
            'objective' => 'Objetivos del proyecto',
            'goals' => 'Metas del proyecto',
            'actions_by_students' => 'Acciones a realizar por los prestadores',
            'induction' => 'Inducción',
            'materials_for_students' => 'Recursos materiales',
            'economic_support' => 'Recursos economicos',
            'human_resource' => 'Recursos humanos',
            'infraestrcture' => 'Infraestrctura',
            'ammount' => 'Monto',
            'approved' => 'Approved',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentProfiles()
    {
        return $this->hasMany(StudentProfile::className(), ['project_id' => 'id']);
    }
}