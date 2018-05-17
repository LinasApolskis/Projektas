<?php
/**
 * Created by PhpStorm.
 * User: zaviz
 * Date: 2018-05-17
 * Time: 19:51
 */

namespace App\Tests\controller;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class LoginControllerTest extends WebTestCase
{
    public function test_PageWorks()
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test_Login()
    {


        $client = static::createClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('login')->form();
        $crawler = $client->submit($form, array(
            '_username' => 'foo',
            '_password'=>'apolskis'
            ));

        $this->changepassword($client);
        $this->logout($client);
        $this->visit($client);
        $this->profile($client);
        $this->Cars($client);
    }


    //Ar veikia logout
    public function logout($client)
    {

        $client->request('GET', '/logout');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    //Ar veikia visit
    public function visit($client)
    {

        $client->request('GET', '/visit');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    //Ar veikia profile
    public function profile($client)
    {

        $client->request('GET', '/profile/2/edit');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    ///Ar veikia cars
    public function Cars($client)
    {
        $client->request('GET', '/cars/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    //Ar veikia change password
    public function changepassword($client)
    {

        $client->request('GET', '/changepassword');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}