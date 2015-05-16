<?php
use \ApiTester;

class CategoriesCest
{
    public function allCategories(ApiTester $I) {
        $I->am('member');
        $I->wantTo('view all the product categories');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('categories');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}