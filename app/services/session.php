<?php
 
/**
 * flashメッセージセット
 *
 * @param string $type タイプ
 * @param string $message メッセージ
 * @return void
 * @example flash('error', 'エラーです');
 */
function flash($type, $message)
{
    global $flash;
    $_SESSION['flash'][$type] = $message;
    $flash[$type] = $message;

    return $flash;
}
