<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    public function testOrderPageIsAccessible()
    {
        $client = static::createClient();
        $client->request('GET', '/order');

        $this->assertResponseIsSuccessful();
    }

    public function testOrderPageDisplaysForm1()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/order');

        $this->assertCount(1, $crawler->filter('#userForm'));
        $this->assertCount(1, $crawler->filter('form[name="login_form"]'));
        $this->assertCount(1, $crawler->filter('form[name="user_other_address_delivery_form"]'));
        $this->assertCount(1, $crawler->filter('form[name="discount_code_form"]'));
    }

    public function testOrderPageDisplaysShippingMethodsForm()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/order');

        $this->assertCount(1, $crawler->filter('#shippingMethodForm'));
    }

    public function testOrderPageDisplaysProducts()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order');

        $this->assertCount(1, $crawler->filter('.products-list'));
    }

    public function testOrderPageDisplaysPaymentMethodsContainer()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/order');

        $this->assertCount(1, $crawler->filter('#paymentMethodsContainer'));
    }
}