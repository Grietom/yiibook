<?php

class m140510_091941_comment_table extends CDbMigration
{
    public function up()
    {
        $transaction = $this->getDbConnection()->beginTransaction();

        try {
            $this->createTable('comment', array(
                "Id" => "pk",
                "User_id" => "integer",
                "Page_id" => "integer",
                "Comment" => "TEXT",
            ), 'ENGINE=InnoDB CHARSET=utf8');

            $this->addForeignKey('user_comment_id', 'page', 'User_id', 'user', 'Id');
            $this->addForeignKey('page_comment_id', 'comment', 'Page_id', 'page', 'Id');

            $transaction->commit();

        } catch (Exception $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable('comment');
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