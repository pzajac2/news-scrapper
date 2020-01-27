<?php
namespace App\Utility;

/*
 * TextParser Utility Class
 *
 * @author Piotr Zając
 * @since 2017-12-11
 */
class TextParser {

    /**
     * Tries to convert polish date string to YYYY-MM-DD format
     * 
     * @author Piotr Zając
     * @since 2017-12-11
     *
     * @todo input validation
     * @todo move code to different class (helper?)
     *
     * @param string $string Date in format "8 grudnia 2017"
     * @return string $string Date in format "2017-12-08"
     * @throws \Exception
     */
    static public function parsePolishDate($string) {

        // 1) replace month name to number
        $months = ['stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'wrzesnia', 'października', 'listopada', 'grudnia'];
        $monthsOrd = [1,2,3,4,5,6,7,8,9,10,11,12];
        $string = str_replace($months, $monthsOrd, $string);

        // 2) split date to parts
        $dateParts = explode(' ', $string);

        // 3) we don't have 3 parts of date - sth wrong...
        if (count($dateParts) != 3) {
            throw new \InvalidArgumentException(__('Invalid date format'));
        }
        
        // 4) building final date format
        return date('Y-m-d H:i:s', mktime(12, 0, 0, $dateParts[1], $dateParts[0], $dateParts[2]));

    } // parsePolishDate

} // class