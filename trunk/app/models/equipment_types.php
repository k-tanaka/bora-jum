<?php
/**
 * equipment_typesテーブルモデルクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class EquipmentTypes extends Model
{
    /**{{{ getTypes()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getTypes()
    {
        $select = $this->select();
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getMainTypes()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getMainTypes()
    {
        $select = $this->select();
        $select->where('level', 0);
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getTypesByParentId()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getTypesByParentId($parent_id)
    {
        $select = $this->select();
        $select->where('parent_id', $parent_id);
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getType()
     *
     * IDを指定してレコードを取得
     *
     * @access  public
     * @param   int     $id
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getType($id)
    {
        $select = $this->select();
        $select->where('id', $id);
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ getTypeList()
     *
     * 備品種別名のリストを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getTypeList()
    {
        $select = $this->select();
        $select->fields('id, name');
        $select->order('id ASC');
        $rows = $select->fetchAll();

        $ret = array();

        foreach ($rows as $row) {
            $ret[$row['id']] = $row['name'];
        }

        return $ret;
    }
    //}}}
    /**{{{ countTypes()
     *
     * レコード数をカウントする
     *
     * @access  public
     * @param   (none)
     * @return  int
     * @author  k-tanaka@netcombb.co.jp
     */
    public function countTypes()
    {
        $select = $this->select();
        $select->order('id ASC');
        $count = $select->fetchCount();

        return $count;
    }
    //}}}
    /**{{{ addType()
     *
     * レコードを追加する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addType($datas)
    {
        $id = $this->select()->fetchMax('id');

        if ($datas['parent_id'] > 0) {
            $parent = $this->getType($datas['parent_id']);
            $level = $parent['level'] + 1;
        }
        else {
            $level = 0;
        }

        $insert = $this->insert();

        $insert->values('id', $id + 1);
        $insert->values('parent_id', $datas['parent_id']);
        $insert->values('level', $level);
        $insert->values('name', $datas['name']);
        $insert->values('created_at', date('Y/m/d H:i:s', time()));
        $insert->values('updated_at', date('Y/m/d H:i:s', time()));

        $result = $insert->execute();
    }
    //}}}
    /**{{{ updateType()
     *
     * レコードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updateType($datas)
    {
        $vals = array();
        $type = $this->getType($datas['id']);

        foreach ($datas as $key => $val) {
            if (isset($type[$key]) && $val !== $type[$key]) {
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
    /**{{{ deleteType()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteType($id)
    {
        $reuslt = $this->delete()->where('id', $id)->execute();
    }
    //}}}
}
?>
