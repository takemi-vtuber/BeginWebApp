<?php
/**
 * テンプレートファイルに値を置換した文字列を生成する
 * @param string 	$tpl
 * @param int 		$trg_date
 * @param array 	$rows
 * @return string
 */
function MakeView( $tpl, $trg_date, $rows  ) {
	$tmp =  file_get_contents($tpl);

	$tmp = str_replace( '{$today}', date('Y-m-d'), $tmp );
	$tmp = str_replace( '{$next_month}', getNextMonth( $trg_date), $tmp );
	$tmp = str_replace( '{$prev_month}', getPrevMonth( $trg_date), $tmp );

	$tmp = str_replace( '{$year}', date('Y',$trg_date), $tmp );
	$tmp = str_replace( '{$month}', date('m',$trg_date), $tmp );
	$tmp = str_replace( '{$week_date}', implode('',$rows), $tmp );

	return $tmp;
}

function MakeViewYear( $tpl, $trg_date, $rows ) {
	$tmp =  file_get_contents($tpl);

	$tmp = str_replace( '{$today}', date('Y-m-d'), $tmp );
	$tmp = str_replace( '{$next_month}', getNextYear( $trg_date), $tmp );
	$tmp = str_replace( '{$prev_month}', getPrevYear( $trg_date), $tmp );

	$tmp = str_replace( '{$year}', date('Y',$trg_date), $tmp );
	$tmp = str_replace( '{$month}', date('m',$trg_date), $tmp );

	$tmp = str_replace( '{$jan_week}', implode('',$rows[1]), $tmp );
	$tmp = str_replace( '{$feb_week}', implode('',$rows[2]), $tmp );
	$tmp = str_replace( '{$mar_week}', implode('',$rows[3]), $tmp );
	$tmp = str_replace( '{$apr_week}', implode('',$rows[4]), $tmp );
	$tmp = str_replace( '{$may_week}', implode('',$rows[5]), $tmp );
	$tmp = str_replace( '{$jun_week}', implode('',$rows[6]), $tmp );
	$tmp = str_replace( '{$jul_week}', implode('',$rows[7]), $tmp );
	$tmp = str_replace( '{$aug_week}', implode('',$rows[8]), $tmp );
	$tmp = str_replace( '{$sep_week}', implode('',$rows[9]), $tmp );
	$tmp = str_replace( '{$oct_week}', implode('',$rows[10]), $tmp );
	$tmp = str_replace( '{$nov_week}', implode('',$rows[11]), $tmp );
	$tmp = str_replace( '{$dec_week}', implode('',$rows[12]), $tmp );

	return $tmp;
}