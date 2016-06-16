<?php
/**
 * 
 */
class cmfcCalendarV1Thai extends cmfcCalendarV1 {
  var $_monthsName = array(
    '1' => 'à¸¡à¸à¸£à¸²à¸„à¸¡',
    '2' => 'à¸à¸¸à¸¡à¸ à¸²à¸žà¸±à¸™à¸˜à¹Œ',
    '3' => 'à¸¡à¸µà¸™à¸²à¸„à¸¡',
    '4' => 'à¹€à¸¡à¸©à¸²à¸¢à¸™',
    '5' => 'à¸žà¸¤à¸©à¸ à¸²à¸„à¸¡',
    '6' => 'à¸¡à¸´à¸–à¸¸à¸™à¸²à¸¢à¸™',
    '7' => 'à¸à¸£à¸à¸Žà¸²à¸„à¸¡',
    '8' => 'à¸ªà¸´à¸‡à¸«à¸²à¸„à¸¡',
    '9' => 'à¸à¸±à¸™à¸¢à¸²à¸¢à¸™',
    '10' => 'à¸•à¸¸à¸¥à¸²à¸„à¸¡',
    '11' => 'à¸žà¸¤à¸¨à¸ˆà¸´à¸à¸²à¸¢à¸™',
    '12' => 'à¸˜à¸±à¸™à¸§à¸²à¸„à¸¡',
  );
  
  var $_monthsShortName = array(
    '1' => 'à¸¡.à¸„.',
    '2' => 'à¸.à¸ž.',
    '3' => 'à¸¡à¸µ.à¸„.',
    '4' => 'à¹€à¸¡.à¸¢.',
    '5' => 'à¸ž.à¸„.',
    '6' => 'à¸¡à¸´.à¸¢.',
    '7' => 'à¸.à¸„.',
    '8' => 'à¸ª.à¸„.',
    '9' => 'à¸.à¸¢.',
    '10' => 'à¸•.à¸„.',
    '11' => 'à¸ž.à¸¢.',
    '12' => 'à¸˜.à¸„.',
  );
  
  var $_weeksName = array(
    '0' => 'à¸­à¸²à¸—à¸´à¸•à¸¢à¹Œ',
    '1' => 'à¸ˆà¸±à¸™à¸—à¸£à¹Œ',
    '2' => 'à¸­à¸±à¸‡à¸„à¸²à¸£',
    '3' => 'à¸žà¸¸à¸˜',
    '4' => 'à¸žà¸¤à¸«à¸±à¸ªà¸šà¸”à¸µ',
    '5' => 'à¸¨à¸¸à¸à¸£à¹Œ',
    '6' => 'à¹€à¸ªà¸²à¸£à¹Œ',
  );
  
  var $_weeksShortName = array(
    '0' => 'à¸­à¸²',
    '1' => 'à¸ˆ',
    '2' => 'à¸­',
    '3' => 'à¸ž',
    '4' => 'à¸žà¸¤',
    '5' => 'à¸¨',
    '6' => 'à¸ª',
  );
  
  var $_weekDaysHoliday = array(6, 0);

  function timestampToStr($format, $timestamp = NULL) {
    if (is_null($timestamp)) {
      $timestamp = time(); //$this->phpTime();
    }
    return $this->date($format, $timestamp);
  }
  
  function strToTimestamp($string) {
    $date = explode(' ', $string);
    $date_parts = explode('-', $date[0]);
    $date_parts[0] = $date_parts[0] - 543;
    $date[0] = implode('-', $date_parts);
    $date = implode(' ', $date);
    return strtotime($date);
  }
  
  function timestampToInfoArray($timestamp = NULL) {
    if (is_null($timestamp)) $timestamp = $this->phpTime();
    $info = $this->phpGetDate($timestamp);
    
    $info['month'] = $info['mon'];
    $info['day'] = $info['mday'];
    
    $info['monthName'] = $this->getMonthName($info['month']);
    $info['monthShortName'] = $this->getMonthShortName($info['month']);
    
    $info_timestamp = $this->infoArrayToTimestamp(array(
      'year' => $info['year'],
      'month' => $info['month'],
      'day' => 1,
    ));
    $info['monthFirstDayWeekday'] = $this->phpDate('w', $info_timestamp) + 1;
    $info['monthDaysNumber'] = $this->phpDate('t', $timestamp);
    
    $info['weekday'] = $info['wday'];
    $info['weekdayName'] = $this->getWeekName($info['weekday']);
    $info['weekdayShortName'] = $this->getWeekShortName($info['weekday']);
    
    return $info;
  }
  
  function infoArrayToTimestamp($info) {
    return mktime(0, 0, 0, $info['month'], $info['day'], $info['year']);
  }
  
  function dateDiff($first, $second) {
    $first_date = explode('-', $first);
    $first_date = mktime(0, 0, 0, $first_date[1], $first_date[2], $first_date[0]);
    
    $second_date = explode('-', $second);
    $second_date = mktime(0, 0, 0, $second_date[1], $second_date[2], $second_date[0]);
    
    $totalasec = $second_date - $first_date;
    return $totalday = round($totalsec/86400);
  }
  
  function date($format, $timestamp) {
    if (is_null($timestamp) || $timestamp == '') $timestamp = $this->phpTime();
    $value = gmdate($format, $timestamp);
    switch ($format) {
      case 'D': $output = $this->getWeekShortName(gmdate('w', $timestamp)); break;
      case 'l': $output = $this->getWeekName(gmdate('w', $timestamp)); break;
      case 'S': $output = ''; /* In Thai has no suffix.*/ break;
      case 'F': $output = $this->getMonthName(gmdate('n', $timestamp)); break;
      case 'M': $output = $this->getMonthShortName(gmdate('n', $timestamp)); break;
      case 'Y': $output = $value + 543; break;
      case 'y': 
        $output = (string) $value + 543;
        $output = substr($output, strlen($output) - 2);
      break;
      case 'U': $output = $this->phpTime(); break;
      default: $output = gmdate($format, $timestamp); break;
    }
    return $output;
  }
  
  function isDateValid($month, $day, $year) {
    $month = (int) $month;
    $day = (int) $day;
    $year = ((int) $year) - 543;
    $timestamp = mktime(10, 10, 10, $month, $day, $year);
    if ($month < 1 || $month > 12) {
      return FALSE;
    }
    if ($year < 1970 || $year > date('Y', $timestamp)) {
      return FALSE;
    }
    if ($day < 1 || $day > date('t', $timestamp)) {
      return FALSE;
    }
    return TRUE;
  }
    
  /**
   * translate number of month to name of month
   */
  function getWeekName($weekNumber) {
    return $this->_weeksName[$weekNumber];
  }
      
  function getWeekShortName($weekNumber){   
    return $this->_weeksShortName[$weekNumber];
  }
      
  /**     
   * translate number of month to name of month
   */
  function getMonthName($month) {   
    return $this->_monthsName[$month];
  }
      
  function getMonthShortName($month){   
    return $this->_monthsShortName[$month];
  }   
}