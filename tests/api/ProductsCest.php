<?php
use \ApiTester;

class ProductsCest
{
    public function allProducts(ApiTester $I) {
        $I->am("member");
        $I->wantTo('list products');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('products');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array('message' => 'Products'));
    }

    public function paginatedProducts(ApiTester $I) {
        $I->am("member");
        $I->wantTo('see paginated products list');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('products?page=2&limit=10');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(array('current_page' => 2));
        $I->seeResponseContainsJson(array('limit' => '10'));
    }
}