<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\models;

use Yii;

/**
 * This is the model class for table "reference_type".
 *
 * @property integer $id
 * @property string $typeName
 * @property integer $visible
 */
class ReferenceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reference_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'typeName'], 'required'],
            [['id', 'visible'], 'integer'],
            [['typeName'], 'string', 'max' => 40],
            [['id'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeName' => 'Type Name',
            'visible' => 'Visible',
        ];
    }
}