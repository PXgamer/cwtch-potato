<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Torrents_Table extends CI_Migration
{

    public function up()
    {
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'BIGINT',
                'unique' => true,
                'auto_increment' => true
            ),
            'info_hash' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000'
            ),
            'torrents_ids' => array(
                'type' => 'VARCHAR',
                'constraint' => '5000'
            ),
            'date_added' => array(
                'type' => 'BIGINT'
            ),
            'date_updated' => array(
                'type' => 'BIGINT'
            )
        );
        $this->dbforge->add_field($fields);
		$this->dbforge->create_table('torrents', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('torrents');
    }
}