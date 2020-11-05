<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Listing;

/**
 * ListingSearch represents the model behind the search form of `frontend\models\Listing`.
 */
class ListingSearch extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['listingId', 'status'], 'integer'],
            [['listingName', 'listingDesc', 'videoUrl', 'size', 'createdAt'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Listing::find();

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
            'listingId' => $this->listingId,
            'price' => $this->price,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
        ]);

        $query->andFilterWhere(['like', 'listingName', $this->listingName])
            ->andFilterWhere(['like', 'listingDesc', $this->listingDesc])
            ->andFilterWhere(['like', 'videoUrl', $this->videoUrl])
            ->andFilterWhere(['like', 'size', $this->size]);

        return $dataProvider;
    }
}
