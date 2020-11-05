<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "listingimage".
 *
 * @property int $listingimageId
 * @property int $listingId
 * @property string $image
 *
 * @property Listing $listing
 */
class Listingimage extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listingimage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['listingId', 'image'], 'required'],
            [['listingId'], 'integer'],
            [['listingId'], 'exist', 'skipOnError' => true, 'targetClass' => Listing::className(), 'targetAttribute' => ['listingId' => 'listingId']],
            [['image'], 'file'],
            [['image'], 'safe'],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'listingimageId' => 'Listingimage ID',
            'listingId' => 'Listing ID',
            'image' => 'Image',
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
