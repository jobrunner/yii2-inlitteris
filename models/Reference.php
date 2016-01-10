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
            [['id'], 'string', 'max' => 48],
            [['referenceTypeId', 'formerReferenceTypeId'], 'integer'],
            [[
                'authors',
                'year',
                'title',
                'secondaryTitle',
                'secondaryAuthors',
                'tertiaryTitle',
                'tertiaryAuthors',
                'volume',
                'number',
                'pages',
                'section',
                'edition',
                'place',
                'publisher',
                'isbn',
            ], 'string'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'               => Yii::t('inlitteris', 'ID'),
            'referenceTypeId'  => Yii::t('inlitteris', 'Reference Type'),
            'authors'          => Yii::t('inlitteris', 'Authors'),
            'year'             => Yii::t('inlitteris', 'Year'),
            'title'            => Yii::t('inlitteris', 'Title'),
            'secondaryTitle'   => Yii::t('inlitteris', 'Secondary Title'),
            'secondaryAuthors' => Yii::t('inlitteris', 'Secondary Authors'),
            'tertiaryTitle'    => Yii::t('inlitteris', 'Tertiary Title'),
            'tertiaryAuthors'  => Yii::t('inlitteris', 'Tertiary Authors'),
            'volume'           => Yii::t('inlitteris', 'Volume'),
            'number'           => Yii::t('inlitteris', 'Number'),
            'pages'            => Yii::t('inlitteris', 'Pages'),
            'section'          => Yii::t('inlitteris', 'Section'),
            'edition'          => Yii::t('inlitteris', 'Edition'),
            'place'            => Yii::t('inlitteris', 'Place'),
            'publisher'        => Yii::t('inlitteris', 'Publisher'),
            'isbn'             => Yii::t('inlitteris', 'Isbn'),
        ];
    }


}
