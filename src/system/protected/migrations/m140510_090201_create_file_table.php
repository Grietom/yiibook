<?php

class m140510_090201_create_file_table extends CDbMigration
{
	public function up()
	{
        $transaction = $this->getDbConnection()->beginTransaction();

        try {

            $this->createTable("file", array(
                "Id" => "pk",
                "User_id" => "integer",
                "Name" => "string NOT NULL COMMENT 'File name'",
                "Type" => "string NOT NULL COMMENT 'File type mostly based on extension'",
                'Size' => 'integer',
                'Description' => "text",
                "Date_entered" => "TIMESTAMP NOT NULL",
                "Date_updated" => "DATETIME"
            ), "ENGINE=InnoDB CHARSET=utf8");

            $this->addForeignKey('user_file_id', 'file', 'User_id', 'user', 'Id');

            $transaction->commit();

        } catch (Exception $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
	}

	public function down()
	{
        $this->dropTable('file');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}