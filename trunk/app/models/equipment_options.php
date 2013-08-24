<?php
/**
 * equipment_optionsテーブルモデルクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class EquipmentOptions extends Model
{
    /**{{{ getOptions()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOptions()
    {
        $select = $this->select();
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getOptionsByEquipmentTypeId()
     *
     * equipment_type_id を指定して項目オプションを取得
     *
     * @access  public
     * @param   int     $equipment_type_id
     * @return  array
     */
    public function getOptionsByEquipmentTypeId($equipment_type_id)
    {
        $select = $this->select();
        $select->where('equipment_type_id', $equipment_type_id);
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getOption()
     *
     * IDを指定してレコードを取得
     *
     * @access  public
     * @param   int     $id
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOption($id)
    {
        $select = $this->select();
        $select->where('id', $id);
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ getOptionList()
     *
     * 備品種別名のリストを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOptionList()
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
    /**{{{ countOptions()
     *
     * レコード数をカウントする
     *
     * @access  public
     * @param   (none)
     * @return  int
     * @author  k-tanaka@netcombb.co.jp
     */
    public function countOptions()
    {
        $select = $this->select();
        $select->order('id ASC');
        $count = $select->fetchCount();

        return $count;
    }
    //}}}
    /**{{{ addOption()
     *
     * レコードを追加する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addOption($datas)
    {
        $id = $this->select()->fetchMax('id');

        $insert = $this->insert();

        $insert->values('id', $id + 1);
        $insert->values('equipment_type_id', $datas['equipment_type_id']);
        $insert->values('caption', $datas['caption']);
        $insert->values('created_at', date('Y/m/d H:i:s', time()));
        $insert->values('updated_at', date('Y/m/d H:i:s', time()));

        $result = $insert->execute();
    }
    //}}}
    /**{{{ updateOption()
     *
     * レコードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updateOption($datas)
    {
        $vals = array();
        $user = $this->getOption($datas['id']);

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
    /**{{{ deleteOption()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteOption($id)
    {
        $reuslt = $this->delete()->where('id', $id)->execute();
    }
    //}}}
}
?>
