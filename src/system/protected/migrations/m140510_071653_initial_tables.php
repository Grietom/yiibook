<?php

class m140510_071653_initial_tables extends CDbMigration
{
    public function up()
    {
        $transaction = $this->getDbConnection()->beginTransaction();

        try {

            //user table
            $this->createTable("User", array(
                "Id" => "pk",
                "Username" => "string NOT NULL COMMENT 'Username' ",
                "Email" =>  "string NOT NULL COMMENT 'User email' ",
                "Password" => "string NOT NULL COMMENT 'User password' ",
                "Type" => "ENUM('public', 'author', 'admin')",
                "Created_at" => "TIMESTAMP NOT NULL",
                "Last_login" =>  "DATETIME NULL",
            ), 'ENGINE=InnoDB CHARSET=utf8');

//            adding test users
            $this->insert('User', array(
                'Id' => 1,
                'Username' => 'admin',
                'Email' => 'admin@example.org',
                'Password' => sha1('admin'),
                'Type' => 'admin',
                "Created_at" => new CDbExpression('NOW()'),
            ));
            $this->insert('User', array(
                'Id' => 2,
                'Username' => 'admin2',
                'Email' => 'admin2@example.org',
                'Password' => sha1('admin2'),
                'Type' => 'admin',
                "Created_at" => new CDbExpression('NOW()'),
            ));
            $this->insert('User', array(
                'Id' => 3,
                'Username' => 'author',
                'Email' => 'author@example.org',
                'Password' => sha1('editor'),
                'Type' => 'author',
                "Created_at" => new CDbExpression('NOW()'),
            ));
            $this->insert('User', array(
                'Id' => 4,
                'Username' => 'public',
                'Email' => 'public@example.org',
                'Password' => sha1('creator'),
                'Type' => 'public',
                "Created_at" => new CDbExpression('NOW()'),
            ));

            $transaction->commit();

        } catch (Exception $ex) {
            echo "Exception: " . $ex->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }

    public function down()
    {
        $this->dropTable("User");
    }
}