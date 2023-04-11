<?php

namespace App;

use Exception;

const LIMIT = 70; // don't know the term for not make it limit muna XD

class GradeHelpers {
    /**
     *  get TransmutedValue
     *
     *
     * @param int $initial_value
     * @param int $number_of_items
     * @return int
     */
    static function getTransmutedValue($initial_value, $number_of_items) {
        try {
            if ($number_of_items < $initial_value) {
                throw new Exception("Initial Grade is not valid.");
            }

            // check if passed of not
            $isPassed = $initial_value / $number_of_items * 50 + 50 > 70;

            $result = null;

            if ($isPassed) {
                $result = $initial_value/$number_of_items*50+50;
            } else {
                $result = ((($initial_value/$number_of_items*50+50) - 50)/4) + 65;
            }

            return intval(floor($result)); // FLOOR use to round down the result eg. 65.9 -> 65
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
