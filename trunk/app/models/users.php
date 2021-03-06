<?php
/**
 * usersテーブルモデルクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class Users extends Model
{
    /**{{{ getUsers()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUsers()
    {
        $select = $this->select();
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getUser()
     *
     * IDを指定してレコードを取得
     *
     * @access  public
     * @param   int     $id
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUser($id)
    {
        $select = $this->select();
        $select->where('id', $id);
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ getUserByLoginID()
     *
     * ログインID(users.loginid)を指定してレコードを取得
     *
     * @access  public
     * @param   string  $loginid
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUserByLoginID($loginid)
    {
        $select = $this->select();
        $select->where('loginid', $loginid);
        $row = $select->fetchRow();

        return $row;
    }
    //}}}
    /**{{{ getUserName()
     *
     * IDを指定してユーザ名(users.name)を取得
     *
     * @access  public
     * @param   int     $id
     * @return  string
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUserName($id)
    {
        $user = $this->getUser($id);

        return $user['name'];
    }
    //}}}
    /**{{{ getUserLoginID()
     *
     * IDを指定してログインID(users.loginid)を取得
     *
     * @access  public
     * @param   int     $id
     * @return  string
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUserLoginID($id)
    {
        $user = $this->getUser($id);

        return $user['loginid'];
    }
    //}}}
    /**{{{ isDuplicateLoginID()
     *
     * ログインID(users.loginid)の重複を調べる
     *
     * @access  public
     * @param   string  $id
     * @return  bool
     * @author  k-tanaka@netcombb.co.jp
     */
    public function isDuplicateLoginID($loginid)
    {
        $user = $this->getUserByLoginID($loginid);

        if ($user === false) {
            return false;
        }
        return true;
    }
    //}}}
    /**{{{ countUsers()
     *
     * レコード数をカウントする
     *
     * @access  public
     * @param   (none)
     * @return  int
     * @author  k-tanaka@netcombb.co.jp
     */
    public function countUsers()
    {
        $select = $this->select();
        $select->order('id ASC');
        $count = $select->fetchCount();

        return $count;
    }
    //}}}
    /**{{{ addUser()
     *
     * レコードを追加する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addUser($datas)
    {
        $id = $this->select()->fetchMax('id');

        $insert = $this->insert();

        $insert->values('id', $id + 1);
        $insert->values('loginid', $datas['loginid']);
        $insert->values('name', $datas['name']);
        $insert->values('password', hash('sha512', $datas['password']));
        $insert->values('created_at', date('Y/m/d H:i:s', time()));
        $insert->values('updated_at', date('Y/m/d H:i:s', time()));

        $result = $insert->execute();
    }
    //}}}
    /**{{{ updateUser()
     *
     * レコードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updateUser($datas)
    {
        $vals = array();
        $user = $this->getUser($datas['id']);

        foreach ($datas as $key => $val) {
            if (isset($user[$key]) && $val !== $user[$key]) {
                $vals[$key] = $val;
            }
        }

        if (count($vals) === 0) {
            return true;
        }

        $vals['updated_at'] = date('Y/m/d H:i:s', time());

        $update = $this->update();

        $update->values($vals);
        $update->where('id', $datas['id']);
        $update->execute();

        return true;
    }
    //}}}
    /**{{{ updatePassword()
     *
     * パスワードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updatePassword($datas)
    {
        $user = $this->getUser($datas['id']);

        if (hash('sha512', $datas['password']) === $user['password']) {
            return true;
        }

        $vals = array(
                'password' => hash('sha512', $datas['password']),
                'updated_at' => date('Y/m/d H:i:s', time()),
                );

        $update = $this->update();

        $update->values($vals);
        $update->where('id', $datas['id']);
        $update->execute();

        return true;
    }
    //}}}
    /**{{{ deleteUser()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteUser($id)
    {
        $reuslt = $this->delete()->where('id', $id)->execute();
    }
    //}}}

    /**{{{ auth
     *
     * ログイン認証
     *
     * @access  public
     * @param   string  $loginid
     * @param   string  $password
     * @return  int / false
     */
    public function auth($loginid, $password)
    {
        $select = $this->select();
        $select->where('loginid', $loginid);
        $select->where('password', hash('sha512', $password));
        $row = $select->fetchRow();

        if (count($row) > 0) {
            return $row['id'];
        }
        else {
            return false;
        }
    }
    //}}}
}
?>
