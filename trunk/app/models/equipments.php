<?php
/**
 * equipmentsテーブルモデルクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class Equipments extends Model
{
    /**{{{ getEquipments()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getEquipments()
    {
        $select = $this->select();
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getEquipment()
     *
     * IDを指定してレコードを取得
     *
     * @access  public
     * @param   int     $id
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getEquipment($id)
    {
        $select = $this->select();
        $select->where('id', $id);
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ getEquipmentList()
     *
     * 備品名のリストを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getEquipmentList()
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
    /**{{{ countEquipments()
     *
     * レコード数をカウントする
     *
     * @access  public
     * @param   (none)
     * @return  int
     * @author  k-tanaka@netcombb.co.jp
     */
    public function countEquipments()
    {
        $select = $this->select();
        $select->order('id ASC');
        $count = $select->fetchCount();

        return $count;
    }
    //}}}
    /**{{{ addEquipment()
     *
     * レコードを追加する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addEquipment($datas)
    {
        $id = $this->select()->fetchMax('id');

        $insert = $this->insert();

        $insert->values('name', $datas['name']);
        $insert->values('type', $datas['type']);
        $insert->values('quantity', $datas['quantity']);
        $insert->values('created_at', date('Y/m/d H:i:s', time()));
        $insert->values('updated_at', date('Y/m/d H:i:s', time()));

        $result = $insert->execute();

        return $result;
    }
    //}}}
    /**{{{ updateEquipment()
     *
     * レコードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updateEquipment($datas)
    {
        $vals = array();
        $equipment = $this->getEquipment($datas['id']);

        foreach ($datas as $key => $val) {
            if (isset($equipment[$key]) && $val !== $equipment[$key]) {
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
    /**{{{ deleteEquipment()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteEquipment($id)
    {
        $reuslt = $this->delete()->where('id', $id)->execute();
    }
    //}}}

    /**{{{ getQuantity()
     *
     * id を指定して数量を取得
     *
     * @access  public
     * @param   int     $id
     * @return  int
     */
    public function getQuantity($id)
    {
        $equipment = $this->getEquipment($id);

        return $equipment['quantity'];
    }
    //}}}
}
?>
