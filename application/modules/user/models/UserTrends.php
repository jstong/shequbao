<?php

/**
 * This is the model class for table "{{user_trends}}".
 *
 * The followings are the available columns in table '{{user_trends}}':
 * @property string $id
 * @property string $user_id
 * @property string $content
 * @property string $publish_time
 * @property string $reply
 * @property string $support
 *
 * The followings are the available model relations:
 * @property User $user
 * @property UserTrendsPic[] $userTrendsPics
 * @property UserTrendsReply[] $userTrendsReplies
 * @property User[] $xcmsUsers
 */
class UserTrends extends SingleInheritanceModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_trends}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, content, publish_time', 'required'),
			array('user_id, publish_time', 'length', 'max'=>11),
			array('reply, support', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, publish_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'userTrendsPics' => array(self::HAS_MANY, 'UserTrendsPic', 'msg_id'),
			'userTrendsReplies' => array(self::HAS_MANY, 'UserTrendsReply', 'trends_id'),
			'xcmsUsers' => array(self::MANY_MANY, 'User', '{{user_trends_support}}(trends_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '动态ID',
			'user_id' => '用户ID',
			'content' => '内容',
			'publish_time' => '发布时间',
			'reply' => '回复',
			'support' => '赞',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('publish_time',$this->publish_time,true);
		$criteria->compare('reply',$this->reply,true);
		$criteria->compare('support',$this->support,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserTrends the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
