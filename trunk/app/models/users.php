<?php
Class Users extends Model
{
    public function getUsers()
    {
        $sql = $this->select();
        $sql->order('id ASC');
        $rows = $sql->fetchAll();

        return $rows;
    }

    public function getUser($id)
    {
        $sql = $this->select();
        $sql->where('id', $id);
        $row = $sql->fetchRow();

       return $row; 
    }

    public function getUserName($id)
    {
        $user = $this->getUser($id);

        return $user['display'];
    }

    public function getUserLoginID($id)
    {
        $user = $this->getUser($id);

        return $user['name'];
    }
}
?>
