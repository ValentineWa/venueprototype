<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "listing".
 *
 * @property int $listingId
 * @property string $listingName
 * @property string $listingDesc
 * @property string $videoUrl
 * @property string $size
 * @property float $price
 * @property int $status
 * @property string $createdAt
 *
 * @property Location[] $locations
 */
class Listing extends \yii\db\ActiveRecord
{
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['listingName', 'listingDesc', 'videoUrl', 'size', 'price', 'status'], 'required'],
            [['listingDesc'], 'string'],
            [['price'], 'number'],
            [['status'], 'integer'],
            [['createdAt'], 'safe'],
            [['listingName', 'size'], 'string', 'max' => 255],
            [['videoUrl'], 'string', 'max' => 300],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'listingId' => Yii::t('app', 'Listing ID'),
            'listingName' => Yii::t('app', 'Listing Name'),
            'listingDesc' => Yii::t('app', 'Listing Desc'),
            'videoUrl' => Yii::t('app', 'Video Url'),
            'size' => Yii::t('app', 'Size'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'createdAt' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['listingId' => 'listingId']);
    }
}
