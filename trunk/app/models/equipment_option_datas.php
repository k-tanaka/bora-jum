<?php
/**
 * equipment_option_datasテーブルモデルクラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class EquipmentOptionDatas extends Model
{
    /**{{{ getOptionDatas()
     *
     * すべてのレコードを取得
     *
     * @access  public
     * @param   (none)
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOptionDatas()
    {
        $select = $this->select();
        $select->order('id ASC');
        $rows = $select->fetchAll();

        return $rows;
    }
    //}}}
    /**{{{ getOptionData()
     *
     * IDを指定してレコードを取得
     *
     * @access  public
     * @param   int     $id
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOptionData($id)
    {
        $select = $this->select();
        $select->where('id', $id);
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ getOptionDataAtParams()
     *
     * 検索データを指定してレコードを取得
     *
     * @access  public
     * @param   array   $params
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOptionDataAtParams($params)
    {
        $select = $this->select();
        foreach ($params as $key => $val) {
            $select->where($key, $val);
        }
        $row = $select->fetchRow();

       return $row; 
    }
    //}}}
    /**{{{ getOptionDataValue()
     *
     * オプション項目データ(.value)を取得
     *
     * @access  public
     * @param   array   $params
     * @return  array
     * @author  k-tanaka@netcombb.co.jp
     */
    public function getOptionDataValue($params)
    {
        $row = $this->getOptionDataAtParams($params);

        $value = ($row) ? $row['value'] : '';

       return $value; 
    }
    //}}}
    /**{{{ countOptionDatas()
     *
     * レコード数をカウントする
     *
     * @access  public
     * @param   (none)
     * @return  int
     * @author  k-tanaka@netcombb.co.jp
     */
    public function countOptionDatas()
    {
        $select = $this->select();
        $select->order('id ASC');
        $count = $select->fetchCount();

        return $count;
    }
    //}}}
    /**{{{ addOptionData()
     *
     * レコードを追加する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function addOptionData($datas)
    {
        $id = $this->select()->fetchMax('id');

        $insert = $this->insert();

        $insert->values('id', $id + 1);
        $insert->values('equipment_id', $datas['equipment_id']);
        $insert->values('equipment_option_id', $datas['equipment_option_id']);
        $insert->values('value', $datas['value']);
        $insert->values('created_at', date('Y/m/d H:i:s', time()));
        $insert->values('updated_at', date('Y/m/d H:i:s', time()));

        $result = $insert->execute();
    }
    //}}}
    /**{{{ updateOptionData()
     *
     * レコードを変更する
     *
     * @access  public
     * @param   array   $datas
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function updateOptionData($datas)
    {
        $vals = array();
        $params = array(
                'equipment_id' => $datas['equipment_id'],
                'equipment_option_id' => $datas['equipment_option_id']
                );
        $option_data = $this->getOptionDataAtParams($params);

        foreach ($datas as $key => $val) {
            if (isset($option_data[$key]) && $val !== $option_data[$key]) {
                $vals[$key] = $val;
            }
        }
        var_dump($option_data);

        if (count($vals) === 0) {
            return true;
       }

        $vals['updated_at'] = date('Y/m/d H:i:s', time());

        $update = $this->update();

        $update->values($vals);
        $update->where('id', $option_data['id']);
        $update->execute();

        return true;
    }
    //}}}
    /**{{{ deleteOptionData()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteOptionData($id)
    {
        $reuslt = $this->delete()->where('id', $id)->execute();
    }
    //}}}
    /**{{{ deleteOptionDataByEquipmentId()
     *
     * レコードを削除する
     *
     * @access  public
     * @param   int     $equip_id
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function deleteOptionDataByEquipmentId($equip_id)
    {
        $this->delete()->where('equipment_id', $equip_id)->execute();
    }
    //}}}
}
?>
