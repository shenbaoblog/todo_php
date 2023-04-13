<?php
 
/**
 * flashメッセージセット
 *
 * @param string $type タイプ
 * @param string $message メッセージ
 * @return void
 * @example flash('error', 'エラーです');
 */


class Session
{
    public static function getErrors()
    {
        // セッションからエラーメッセージを取得
        if($_SESSION['errors']) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        return $errors;
    }

    public function clearFlash() {
        
    }
}
