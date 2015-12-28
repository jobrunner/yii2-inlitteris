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
 * This is the model class for table "reference_setting".
 *
 * @property integer $referenceTypeId
 * @property string $genericName
 * @property string $contextualName
 * @property integer $position
 * @property integer $visible
 */
class ReferenceSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reference_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['referenceTypeId', 'genericName', 'contextualName'], 'required'],
            [['referenceTypeId', 'position', 'visible'], 'integer'],
            [['genericName', 'contextualName'], 'string', 'max' => 40],
            [['referenceTypeId', 'genericName'], 'unique', 'targetAttribute' => ['referenceTypeId', 'genericName'], 'message' => 'The combination of Reference Type ID and Generic Name has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'referenceTypeId' => 'Reference Type ID',
            'genericName' => 'Generic Name',
            'contextualName' => 'Contextual Name',
            'position' => 'Position',
            'visible' => 'Visible',
        ];
    }
}
