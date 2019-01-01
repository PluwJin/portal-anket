<?php

use yii\db\Migration;

/**
 * Class m181230_230150_survey
 */
class m181230_230150_survey extends Migration
{
    
    public function up()
    {
        $this->createTable('survey', [
            'id' => $this->integer(11)->notNull(),
            'name' => $this->string(150)->notNull(),
            'q_number' => $this->integer(11)->notNull(),
            'creator_id' => $this->integer(11)->notNull(),
            'created_at' => $this->date()->notNull(),
            'ending_at' => $this->date()->notNull(),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
        
        $this->addPrimaryKey('primary11','survey','id');
        $this->createIndex('name','survey','name',true);


        $this->createTable('questions', [
            'id' => $this->integer(11)->notNull(),
            's_id' => $this->integer(11)->notNull(),
            'name' => $this->string(100)->notNull(),
            'type' => $this->string(50)->notNull(),
            'required' => $this->string(10)->defaultValue('false'),
            'option_number' => $this->integer(11)->defaultValue(null),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'); 

        $this->addPrimaryKey('primary2','questions','id');
        $this->createIndex('s_id','questions',['s_id','name'],true);
        $this->createIndex('foreign','questions','s_id');

        $this->createTable('options', [
            'id' => $this->integer(11)->notNull(),
            's_id' => $this->integer(11)->notNull(),
            'q_id' => $this->integer(11)->notNull(),
            'name' => $this->string(100)->notNull(),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->addPrimaryKey('primary3','options','id');
        $this->createIndex('tek','options',['s_id','q_id','name'],true);
        $this->createIndex('fk','options','q_id');

        $this->createTable('answers', [
            'id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            's_id' => $this->integer(11)->notNull(),
            'q_id' => $this->integer(11)->notNull(),
            'o_id' => $this->integer(11)->defaultValue(null),
            'textanswer' => $this->string(100)->defaultValue(null),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->addPrimaryKey('primary4','answers','id');
        $this->createIndex('user_id','answers',['user_id','s_id','q_id','o_id'],true);
        $this->createIndex('fksid','answers','s_id');
        $this->createIndex('fkqid','answers','q_id');
        $this->createIndex('fkoid','answers','o_id');

        //burada hata var aynı isimki foreign key olduğundan hata veriyor

        $this->addForeignKey('fkoid','answers','o_id','options','id','CASCADE','CASCADE');
        $this->addForeignKey('fkqid','answers','q_id','questions','id','CASCADE','CASCADE');
        $this->addForeignKey('fksid','answers','s_id','survey','id','CASCADE','CASCADE');
        $this->addForeignKey('fkuid','answers','user_id','user','id','CASCADE','CASCADE');

        $this->addForeignKey('fk','options','q_id','questions','id','CASCADE','CASCADE');
        $this->addForeignKey('foreign key2','options','s_id','survey','id','CASCADE','CASCADE');

        $this->addForeignKey('foreign key','questions','s_id','survey','id','CASCADE','CASCADE');

        

    }


    public function down()
    {
        echo "m181230_230150_survey cannot be reverted.\n";

        return false;
    }
    
}
