<?php
use CodeIgniter\I18n\Time; 

/**
 * Random Date
 *
 * This function will return a random date between two dates.
 *
 * Note: The format of the dates you provide usually do not matter, function will try and evalutate it.
 * Note: It does not matter if the first date specified is greater than or less than the second date, either works.
 *
 * @see https://www.php.net/manual/en/function.date.php for specifying the returning date format.
 *
 * @param string $firstDate A string representing the first date.
 * @param string $secondDate A string representing the second date.
 * @param string $format By default returns in Y-m-d, but you can use any format php date supports.
 * @return string Returns a random date between the two dates.
 */
  
function randomDate($firstDate, $secondDate, $format = 'd/m/Y'): string
{
    $firstDateTime = Time::createFromFormat($format, $firstDate, 'Europe/Athens');
    $secondDateTime = Time::createFromFormat($format, $secondDate, 'Europe/Athens');

    $firstDateTimeStamp = $firstDateTime->getTimestamp();
    $secondDateTimeStamp = $secondDateTime->getTimestamp();

    if ($firstDateTimeStamp < $secondDateTimeStamp) {
        return date($format, mt_rand($firstDateTimeStamp, $secondDateTimeStamp));
    }

    return date($format, mt_rand($secondDateTimeStamp, $firstDateTimeStamp));
}


?>