<?php

class m140510_071653_initial_tables extends CDbMigration
{
    public function up()
    {
        $transaction = $this->getDbConnection()->beginTransaction();

        try {

            //types table
            $this->createTable("type", array(
                "Id" => "pk",
                "typeName" => "string NOT NULL COMMENT '1 = admin, 2 = editor, 3 = Creator, 4 = Basic'",
            ));

            $this->insert('type', array('Id' => 1, 'typeName' => 'Admin'));
            $this->insert('type', array('Id' => 2, 'typeName' => 'Editor'));
            $this->insert('type', array('Id' => 3, 'typeName' => 'Creator'));
            $this->insert('type', array('Id' => 4, 'typeName' => 'Basic'));
            //user table
            $this->createTable("User", array(
                "Id" => "pk",
                "Username" => "string NOT NULL COMMENT 'Username' ",
                "Email" =>  "string NOT NULL COMMENT 'User email' ",
                "Password" => "string NOT NULL COMMENT 'User password' ",
                "type_id" => "integer NOT NULL COMMENT '1 = admin, 2 = editor, 3 = Creator, 4 = Basic'",
                "Created_at" => "DATETIME NOT NULL",
                "Last_login" =>  "DATETIME NULL",
            ), 'ENGINE=InnoDB CHARSET=utf8');

            //foreign keys for user
            $this->addForeignKey('user_type', 'User', 'type_id', 'type', 'Id');

//            adding test users
            $this->insert('User', array(
                'Id' => 1,
                'Username' => 'admin',
                'Email' => 'admin@example.org',
                'Password' => sha1('admin'),
                'type_id' => 1,
                "Created_at" => new CDbExpression('NOW()'),
            ));
            $this->insert('User', array(
                'Id' => 2,
                'Username' => 'admin2',
                'Email' => 'admin2@example.org',
                'Password' => sha1('admin2'),
                'type_id' => 1,
                "Created_at" => new CDbExpression('NOW()'),
            ));
            $this->insert('User', array(
                'Id' => 3,
                'Username' => 'editor',
                'Email' => 'editor@example.org',
                'Password' => sha1('editor'),
                'type_id' => 2,
                "Created_at" => new CDbExpression('NOW()'),
            ));
            $this->insert('User', array(
                'Id' => 4,
                'Username' => 'creator',
                'Email' => 'creator@example.org',
                'Password' => sha1('creator'),
                'type_id' => 3,
                "Created_at" => new CDbExpression('NOW()'),
            ));

            $this->insert('User', array(
                'Id' => 5,
                'Username' => 'basic',
                'Email' => 'basic@example.org',
                'Password' => sha1('basic'),
                'type_id' => 4,
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
        $this->delete("User");
        $this->dropTable("User");
        $this->delete("type");
        $this->dropTable("type");
    }
}