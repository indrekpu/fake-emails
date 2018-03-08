Analüüsimise leht

<?php
$this->load->database();
$query = $this->db->query('SELECT * FROM test_user');
foreach ($query->result() as $row)
{
        echo $row->name;
        echo $row->id;
}
?>