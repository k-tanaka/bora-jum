<?php
/**
 * バリデータ拡張クラス
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

Class ValidatorEx extends Validator
{
    /**{{{ _construct()
     *
     * コンストラクタ
     *
     * @access  public
     * @param   (none)
     * @return  void
     * @author  k-tanaka@netcombb.co.jp
     */
    public function __construct()
    {
        self::$_messages = array(
                'required'      => '入力してください',
                'length'        => '規定外の文字数です',
                'length_range'  => '規定外の文字数です',
                'numeric'       => '数値で入力してください',
                'number_string' => '数字で入力してください',
                'alpha'         => 'アルファベットで入力してください',
                'alphanum'      => 'アルファベットと数値で入力してください',
                'singlebyte'    => '1byte文字ですべて入力してください',
                'regex'         => '無効な文字列が入力されました',
                );
        self::$_messages['loginid']  = '無効な文字列が入力されました';
        self::$_messages['loginid_duplicate']  = '同じログインIDが存在します';
        self::$_messages['password'] = '無効な文字列が入力されました';
    }
    //}}}

    /**{{{ loginid()
     *
     * ログインIDの文字列バリデーションメソッド
     *
     * @access  public
     * @param   string  $value
     * @return  bool
     * @author  k-tanaka@netcombb.co.jp
     */
    public function loginid($value)
    {
        if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9\-_]+[a-zA-Z0-9]$/', $value)) {
            return false;
        }
        return true;
    }
    //}}}
    /**{{{ loginidDuplicate()
     *
     * ログインIDの重複バリデーションメソッド
     *
     * @access  public
     * @param   string  $value
     * @return  bool
     * @author  k-tanaka@netcombb.co.jp
     */
    public function loginidDuplicate($value)
    {
        $Users = new Users();

        if ($Users->isDuplicateLoginID($value)) {
            return false;
        }
        return true;
    }
    //}}}
    /**{{{ password()
     *
     * パスワードの文字列バリデーションメソッド
     *
     * @access  public
     * @param   string  $value
     * @return  bool
     * @author  k-tanaka@netcombb.co.jp
     */
    public function password($value)
    {
        if (!preg_match('/^[a-zA-Z][a-zA-Z0-9\-_;@!"#\$%&\']+$/', $value)) {
            return false;
        }
        return true;
    }
    //}}}
}
?>
