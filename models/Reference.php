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
 * This is the model class for table "reference".
 *
 * @property string $id
 * @property integer $referenceType
 * @property string $authors
 * @property string $year
 * @property string $title
 * @property string $secondaryTitle
 * @property string $secondaryAuthors
 * @property string $tertiaryTitle
 * @property string $tertiaryAuthors
 * @property string $volume
 * @property string $number
 * @property string $pages
 * @property string $section
 * @property string $edition
 * @property string $place
 * @property string $publisher
 * @property string $isbn
 */
class Reference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['referenceTypeId'], 'integer'],
            [['authors', 'year', 'title', 'secondaryTitle', 'secondaryAuthors', 'tertiaryTitle', 'tertiaryAuthors', 'volume', 'number', 'pages', 'section', 'edition', 'place', 'publisher', 'isbn'], 'string'],
            [['id'], 'string', 'max' => 48],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'referenceTypeId' => Yii::t('app', 'Reference Type'),
            'authors' => Yii::t('app', 'Authors'),
            'year' => Yii::t('app', 'Year'),
            'title' => Yii::t('app', 'Title'),
            'secondaryTitle' => Yii::t('app', 'Secondary Title'),
            'secondaryAuthors' => Yii::t('app', 'Secondary Authors'),
            'tertiaryTitle' => Yii::t('app', 'Tertiary Title'),
            'tertiaryAuthors' => Yii::t('app', 'Tertiary Authors'),
            'volume' => Yii::t('app', 'Volume'),
            'number' => Yii::t('app', 'Number'),
            'pages' => Yii::t('app', 'Pages'),
            'section' => Yii::t('app', 'Section'),
            'edition' => Yii::t('app', 'Edition'),
            'place' => Yii::t('app', 'Place'),
            'publisher' => Yii::t('app', 'Publisher'),
            'isbn' => Yii::t('app', 'Isbn'),
        ];
    }


}
