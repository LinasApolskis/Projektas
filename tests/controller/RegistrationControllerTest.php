<?php
/**
 * Created by PhpStorm.
 * User: zaviz
 * Date: 2018-05-16
 * Time: 20:04
 */

// tests/controller/RegistrationControllerTest.php
namespace App\Tests\controller;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class RegistrationControllerTest extends WebTestCase
{
    public function test_PageWorks()
    {   $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }



}