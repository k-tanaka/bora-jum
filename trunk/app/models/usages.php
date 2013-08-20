<?php
/**
 * usagesテーブルモデルクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class Usages extends Model
{
    /**{{{ getUsages()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUsages()
    {
        $select = $this->select();
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getUsage()
     *
     * IDを指定してレコードを取得
     *
     * @access  public
     * @param   int     $id
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getUsage($id)
    {
        $select = $this->select();
        $select->where('id', $id);
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ countUsages()
     *
     * レコード数をカウントする
     *
     * @access  public
     * @param   (none)
     * @return  int
     * @author  k-tanaka@netcombb.co.jp
     */
    public function countUsages()
    {
        $select = $this->select();
        $select->order('id ASC');
        $count = $select->fetchCount();

        return $count;
    }
    //}}}
    /**{{{ addUsage()
     *
     * レコードを追加する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addUsage($datas)
    {
        $id = $this->select()->fetchMax('id');

        $insert = $this->insert();

        $insert->values('id', $id + 1);
        $insert->values('equipment_id', $datas['equipment_id']);
        $insert->values('type', $datas['type']);
        $insert->values('quantity', $datas['quantity']);
        $insert->values('created_at', date('Y/m/d H:i:s', time()));
        $insert->values('updated_at', date('Y/m/d H:i:s', time()));

        $result = $insert->execute();
    }
    //}}}
    /**{{{ updateUsage()
     *
     * レコードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updateUsage($datas)
    {
        $vals = array();
        $user = $this->getUsage($datas['id']);

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
    /**{{{ deleteUsage()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteUsage($id)
    {
        $reuslt = $this->delete()->where('id', $id)->execute();
    }
    //}}}
}
?>
