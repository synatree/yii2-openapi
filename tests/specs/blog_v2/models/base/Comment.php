<?php

namespace app\models\base;

/**
 * 
 *
 * @property int $id
 * @property int $post_id A blog post (uid used as pk for test purposes)
 * @property int $user_id The User
 * @property string $message
 * @property string $created_at
 *
 * @property \app\models\Post $post
 * @property \app\models\User $user
 */
abstract class Comment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%v2_comments}}';
    }

    public function rules()
    {
        return [
            [['message', 'created_at'], 'trim'],
            [['post_id', 'message', 'created_at'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            [['post_id'], 'exist', 'targetRelation'=>'Post'],
            [['user_id'], 'exist', 'targetRelation'=>'User'],
            [['message', 'created_at'], 'string'],
        ];
    }

    public function getPost()
    {
        return $this->hasOne(\app\models\Post::class,['id' => 'post_id']);
    }
    public function getUser()
    {
        return $this->hasOne(\app\models\User::class,['id' => 'user_id']);
    }
}
