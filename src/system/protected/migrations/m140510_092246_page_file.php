<?php

class m140510_092246_page_file extends CDbMigration
{
    public function up()
    {
        $transaction = $this->getDbConnection()->beginTransaction();

        try {
            $this->createTable('page_file', array(
                "Id" => "pk",
                "Page_id" => "integer",
                "File_id" => "integer"
            ), 'ENGINE=InnoDB CHARSET=utf8');

            $this->addForeignKey('page_file_page_id', 'page_file', 'Page_id', 'Page', 'Id');
            $this->addForeignKey('page_file_file_id', 'page_file', 'File_id', 'File', 'Id');

            $transaction->commit();

        } catch (Exception $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable('page_file');
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