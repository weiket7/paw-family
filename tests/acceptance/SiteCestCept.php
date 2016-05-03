<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('see home page');
$I->amOnPage('/');
$I->see('Home');

$I->wantTo('see register');
$I->amOnPage('register');
$I->see('Register');
