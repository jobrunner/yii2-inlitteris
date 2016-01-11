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
use yii\base\Model;
use yii\data\ActiveDataProvider;
use jobrunner\inlitteris\models\Reference;

/**
 * ReferenceSearch represents the model behind the search form about `jobrunner\inlitteris\models\Reference`.
 */
class ReferenceSearch extends Reference
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'id',
                'referenceTypeId',
                'authors',
                'title',
                'secondaryTitle',
                'secondaryAuthors',
                'tertiaryTitle',
                'tertiaryAuthors',
                'year',
                'volume',
                'number',
                'pages',
                'section',
                'edition',
                'place',
                'publisher',
                'isbn'
            ], 'safe'],
            [['referenceTypeId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reference::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'referenceTypeId' => $this->referenceTypeId,
        ]);

        $query
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'authors', $this->authors])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'secondaryTitle', $this->secondaryTitle])
            ->andFilterWhere(['like', 'secondaryAuthors', $this->secondaryAuthors])
            ->andFilterWhere(['like', 'tertiaryTitle', $this->tertiaryTitle])
            ->andFilterWhere(['like', 'tertiaryAuthors', $this->tertiaryAuthors])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'pages', $this->pages])
            ->andFilterWhere(['like', 'section', $this->section])
            ->andFilterWhere(['like', 'edition', $this->edition])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'isbn', $this->isbn]);

        return $dataProvider;
    }
}
