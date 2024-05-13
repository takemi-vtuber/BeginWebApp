<?php
require_once __DIR__.'/../libs/001/views.php';
require_once __DIR__.'/../libs/001/calendar.php';

define('MODE_MONTH', 1 );
define('MODE_YEAR', 2 );

//処理日を取得する
$trg_date = GetTargetDate();
$mode = GetMode();

//今日の日付
$today = [
	'y' => date('Y'),
	'm' => date('m'),
	'd' => date('d'),
];

exit;

//-------------------------------------------------------------
//以下、関数定義
//-------------------------------------------------------------

/**
 * Get変数から処理日を算出する
 * @return int
 */
function GetTargetDate(){
	//処理日を取得する
	$trg_date = null;
	//URL引数のtarget_dateを取得する
	if( isset( $_GET['target_date'] ) && !empty( $_GET['target_date'] ) ) {
		$trg_date = strtotime( $_GET['target_date'] );
		if( $trg_date === false || count( explode('-', $_GET['target_date']) ) < 2) {
			$trg_date = time();
		}
	} else {
		$trg_date = time();
	}
	return $trg_date;
}

function GetMode(){
    $mode = MODE_MONTH;
    if( !empty($_GET['mode']) ) {
        switch( $_GET['mode'] )  {
            case '1':
            case 1:
            case 'month' :
                $mode = MODE_MONTH;
                break;
                
            case '2':
            case 2:
            case 'year':
                $mode = MODE_YEAR;
                break;
        }
    }
    return $mode;
}