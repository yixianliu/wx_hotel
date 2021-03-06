<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "w_rooms_field".
 *
 * @property int    $id
 * @property string $f_key       参数关键KEY
 * @property string $name        字段名
 * @property string $description 字段描述
 * @property string $is_using    是否启用
 * @property int    $created_at
 * @property int    $updated_at
 */
class RoomsField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_rooms_field';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_using'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['f_key'], 'string', 'max' => 55],
            [['name'], 'string', 'max' => 85],
            [['name'], 'unique'],

            [['is_using'], 'default', 'value' => 'On'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'f_key'      => '参数关键KEY',
            'name'       => '参数名称',
            'is_using'   => '审核状态',
            'created_at' => '添加数据时间',
            'updated_at' => '更新数据时间',
        ];
    }

    /**
     * 列表
     *
     * @param string $status
     *
     * @return array|RoomsField[]|\yii\db\ActiveRecord[]
     */
    public static function findByAll($status = 'On')
    {

        // 审核状态
        $array = !empty($status) ? ['is_using' => $status] : ['!=', 'is_using', null];

        return static::find()->where($array)
            ->orderBy(['id' => SORT_DESC])
            ->all();
    }

}
