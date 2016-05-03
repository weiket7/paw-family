<?php

class SiteCest
{
    // test
    public function home(AcceptanceTester $I)
    {
        $I->wantTo('see home');
        $I->amOnPage('/');
        $I->see('Home');
    }

    public function register(AcceptanceTester $I)
    {
        $I->wantTo('see register');
        $I->amOnPage('register');
        $I->see('Register');
    }

    public function cart(AcceptanceTester $I)
    {
        $I->wantTo('see cart');
        $I->amOnPage('cart');
        $I->see('Cart');
    }

    public function checkout(AcceptanceTester $I)
    {
        $I->wantTo('see checkout');
        $I->amOnPage('checkout');
        $I->see('Checkout');
    }

    public function brand(AcceptanceTester $I)
    {
        $I->wantTo('see brands');
        $I->amOnPage('brands');
        $I->see('Brands');
    }


    public function contact(AcceptanceTester $I)
    {
        $I->wantTo('see contact');
        $I->amOnPage('contact');
        $I->see('Contact');
    }

    public function forgotPassword(AcceptanceTester $I)
    {
        $I->wantTo('see forgot password');
        $I->amOnPage('forgot-password');
        $I->see('Forgot Password');
    }

    public function productsInCategory(AcceptanceTester $I)
    {
        $I->wantTo('see products in category');
        $I->amOnPage('product/category/dog-dry-food');
        $I->seeResponseCodeIs(200);
    }

    public function productsInCategoryFilterByBrand(AcceptanceTester $I)
    {
        $I->wantTo('see products in category filter by brand');
        $I->amOnPage('product/category/dog-dry-food?brand=addiction');
        $I->seeResponseCodeIs(200);
    }

    public function productsInBrand(AcceptanceTester $I)
    {
        $I->wantTo('see products in brand');
        $I->amOnPage('product/category/dog-dry-food');
        $I->seeResponseCodeIs(200);
    }
}