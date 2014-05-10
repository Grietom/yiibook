<?php

class m140510_091048_page_table extends CDbMigration
{
    public function up()
    {
        $transaction = $this->getDbConnection()->beginTransaction();

        try {
            $this->createTable('page', array(
                "Id" => "pk",
                "User_id" => "integer",
                "Live" => "integer",
                "Title" => "string NOT NULL",
                "Content" => "TEXT",
                "Created" => "TIMESTAMP NOT NULL",
                "Published" => "DATE",
            ), 'ENGINE=InnoDB CHARSET=utf8');

            $this->addForeignKey('user_page_id', 'page', 'User_id', 'user', 'Id');

            $transaction->commit();

        } catch (Exception $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable('page');
    }
}