<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $tagline
 * @property string $category_image
 * @property string $status
 * @property string $created_date
 * @property string $modified_date
 *
 * @property CategoryRelation[] $categoryRelations
 */
class Category extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'created_date'], 'required'],
            [['status'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['name', 'tagline', 'category_image'], 'string', 'max' => 255],
            ['imageFile', 'image','skipOnEmpty' => true, 'minWidth' =>50, 'maxWidth' => 250,'minHeight' => 50, 'maxHeight' => 250, 'extensions' => 'jpg, gif, png', 'maxSize' => 256 * 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'tagline' => 'Tagline',
            'category_image' => 'Category Image',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryRelations()
    {
        return $this->hasMany(CategoryRelation::className(), ['cat_id' => 'id']);
    }
}
