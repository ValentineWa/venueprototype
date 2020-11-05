<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $locationId
 * @property int $listingId
 * @property string $address
 * @property string $country
 * @property string $countryRegion
 * @property string $city
 * @property string|null $streetRoad
 * @property float $lattitude
 * @property float $longitude
 * @property string|null $vicinity
 * @property string $createdAt
 *
 * @property Listing $listing
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['listingId', 'address', 'country', 'countryRegion', 'city', 'lattitude', 'longitude'], 'required'],
            [['listingId'], 'integer'],
            [['lattitude', 'longitude'], 'number'],
            [['createdAt'], 'safe'],
            [['address', 'country', 'countryRegion', 'city', 'streetRoad', 'vicinity'], 'string', 'max' => 255],
            [['listingId'], 'exist', 'skipOnError' => true, 'targetClass' => Listing::className(), 'targetAttribute' => ['listingId' => 'listingId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'locationId' => Yii::t('app', 'Location ID'),
            'listingId' => Yii::t('app', 'Listing ID'),
            'address' => Yii::t('app', 'Address'),
            'country' => Yii::t('app', 'Country'),
            'countryRegion' => Yii::t('app', 'Country Region'),
            'city' => Yii::t('app', 'City'),
            'streetRoad' => Yii::t('app', 'Street Road'),
            'lattitude' => Yii::t('app', 'Lattitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'vicinity' => Yii::t('app', 'Vicinity'),
            'createdAt' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Listing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getListing()
    {
        return $this->hasOne(Listing::className(), ['listingId' => 'listingId']);
    }
}
