<?php

/**
 * 前月の1日の日付文字列を取得
 *
 * @param int $prc_date
 * @return string
 */
function getPrevMonth( $proc_date ) {
	$year = date( 'Y', $proc_date );
	$month= date( 'm', $proc_date );
	$month --;
	if( $month < 1 ) {
		$year --;
		$month = 12;
	}
	return "{$year}-{$month}-1";
}

/**
 * 翌月の1日の日付文字列を取得
 *
 * @param int $proc_date
 * @return string
 */
function getNextMonth( $proc_date ) {
	$year = date( 'Y', $proc_date );
	$month= date( 'm', $proc_date );
	$month ++;
	if( $month > 12 ) {
		$year ++;
		$month = 1;
	}
	return "{$year}-{$month}-1";
}
/**
 * 前月の1日の日付文字列を取得
 *
 * @param int $prc_date
 * @return string
 */
function getPrevYear( $proc_date ) {
	$year = date( 'Y', $proc_date );
	$year --;
	return "{$year}-1-1";
}

/**
 * 翌月の1日の日付文字列を取得
 *
 * @param int $proc_date
 * @return string
 */
function getNextYear( $proc_date ) {
	$year = date( 'Y', $proc_date );
	$year ++;

	return "{$year}-1-1";
}

/**
 * カレンダーのデータを生成する
 * @return array
 */
function MakeCalendarData( $trg_date ){
	//月の日データ
	$data = [ 0 =>  ['', '','','','','',''] ];

	$begin = strtotime( date('Y-m-1', $trg_date) );
	$end = strtotime( date('Y-m-t', $trg_date) );
	$line = 0;
	for( $d = $begin; $d <= $end; $d += 24 * 3600 ) {
		$w = date( 'w', $d );
		$i = $w - 1;
		if( $i < 0 ) $i = 6;
		//echo date('Y-m-d', $d); echo " {$i} \n";
		$data[$line][$i] = date( 'd', $d );
		if( $i == 6 ) { 
			$line ++;
			$data[$line] = [ '', '', '', '', '', '', '' ];
		}
	}
	return $data;
}

/**
 * CSVより処理年月の祝日データを取得する
 * @param array $trg
 * @return array
 */
function GetHolidayData( $trg ){
	$holidays = [];
	$fp = fopen( 'syukujitsu.csv', 'r' );
	if( $fp ) {
		fgetcsv($fp);	//ヘッダー読み飛ばし
		while( ($hdata = fgetcsv($fp) )!== false ) {
			if( !$hdata ) continue;
			$c_time = strtotime( $hdata[0] );
			$c_year = date('Y', $c_time );
			$c_month = date( 'm', $c_time );
			$c_day = date( 'd', $c_time );
			//処理月と異なる年付きの祝日データは読み飛ばし
			if( !($trg['y'] == $c_year && $trg['m'] == $c_month) ) continue;

			$holidays[$c_day] = $hdata[1];
		}
	}
	return $holidays;
}

/**
 * カレンダーのHTMLデータを生成する
 *
 * @param int $today
 * @param array $data
 * @param array $trg
 * @param array $holidays
 * @return array
 */
function MakeCalendarHtml( $today, $data, $trg, $holidays ){
	$rows = [];
	foreach( $data as $l ) {
		$tmp = "<tr>";
		foreach( $l as $i => $d ) {
			$class = "cl_day";
			if( !$d ) {
				$class = "cl_none";
			} else {
				if( $i == 5 ) {
					$class = "cl_sat";
				} elseif( $i == 6 ) {
					$class = "cl_sun";
				}
			}

			if( $trg['y'] == $today['y'] && 
				$trg['m'] == $today['m'] &&
					$d == $today['d']
			) { 
				$class .= " cl_today";
			}

			if( !empty($holidays[$d]) ) {
				$class .= " cl_holiday";
			}

			$tmp.= "<td class='{$class}'>";
			$tmp.= $d;
			if( !empty($holidays[$d]) ) {
				$tmp.= '<br/><span>'.$holidays[$d].'</span>';
			}
			$tmp.= "</td>";
		}
		$tmp.= "</tr>";
		$rows[] = $tmp;
	}
	return $rows;
}