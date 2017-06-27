<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relationships".
 *
 * @property integer $id
 * @property string $relation
 * @property string $status
 * @property string $created_date
 * @property string $modified_date
 *
 * @property RelationEvents[] $relationEvents
 * @property TmpCategoryRelation[] $tmpCategoryRelations
 */
class Relationships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relationships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relation', 'created_date'], 'required'],
            [['status'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['relation'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'relation' => 'Relation',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationEvents()
    {
        return $this->hasMany(RelationEvents::className(), ['relation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTmpCategoryRelations()
    {
        return $this->hasMany(TmpCategoryRelation::className(), ['relation_id' => 'id']);
    }
}
