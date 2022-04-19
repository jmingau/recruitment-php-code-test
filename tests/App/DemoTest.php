<?php
/*
 * @Date         : 2022-03-02 14:49:25
 * @LastEditors  : Jack Zhou <jack@ks-it.co>
 * @LastEditTime : 2022-03-02 17:22:16
 * @Description  : 
 * @FilePath     : /recruitment-php-code-test/tests/App/DemoTest.php
 */

namespace Test\App;

use PHPUnit\Framework\TestCase;
use App\App\Demo;
use App\Util\HttpRequest;
use App\Service\AppLogger;

class DemoTest extends TestCase {

    public function test_foo() {
        $request = new HttpRequest();
        $demo = new Demo(new AppLogger(), $request);

        $this->assertEquals('bar', $demo->foo());
    }

    public function test_get_user_info() {
        $request = new HttpRequest();
        $demo = new Demo(new AppLogger(), $request);
        $data = $demo->get_user_info();

        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data, '');
        $this->assertArrayHasKey('username', $data, '');
    }
}