<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Log\Formatter;

use DateTime;
use Zend\Log\Formatter\JsonFormatter;

/**
 * @group      Zend_Log
 */
class XmlTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultFormat()
    {
        $date = new DateTime();
        $f = new JsonFormatter();
        $line = $f->format(['timestamp' => $date, 'message' => 'foo', 'priority' => 42]);
        $json = json_decode($line);


        $this->assertEqual($date->format('c'), $json->timestamp);
        $this->assertEqual('foo', $json->message);
        $this->assertEqual((string)42, $json->priority);
    }



    /**
     * @dataProvider provideDateTimeFormats
     */
    public function testSetDateTimeFormat($dateTimeFormat)
    {
        $date = new DateTime();
        $f = new JsonFormatter();
        $f->setDateTimeFormat($dateTimeFormat);

        $line = $f->format(['timestamp' => $date]);
        $json = json_decode($line);

        $this->assertContains($date->format($dateTimeFormat), $json->timestamp);
    }


    public function provideDateTimeFormats()
    {
        return [
            ['r'],
            ['U'],
        ];
    }

}
