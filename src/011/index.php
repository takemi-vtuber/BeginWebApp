<?php
require_once __DIR__.'/../libs/001/views.php';
require_once __DIR__.'/../libs/001/calendar.php';

/**
 * 処理を関数化して整理
 */

//処理日を取得する
$trg_date = GetTargetDate();

//今日の日付
$today = [
	'y' => date('Y'),
	'm' => date('m'),
	'd' => date('d'),
];

//処理年
$proc_year = date('Y', $trg_date );
$rows = [];
for( $mon = 1; $mon <= 12; $mon ++ ) {
	$proc_date = strtotime( "{$proc_year}-{$mon}-1" );
	//処理対象年月
	$trg = [
		'y' => $proc_year,
		'm' => $mon,
	];

	//月の日データ
	$data = MakeCalendarData( $proc_date );

	//祝日処理
	$holidays = GetHolidayData( $trg );

	$rows[$mon] = MakeCalendarHtml( $today, $data, $trg, $holidays );
}

echo MakeViewYear( 'index.tpl', $proc_date, $rows );
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
