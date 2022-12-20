<?php


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function Main(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->scrollTo('.catagory_area');
        $I->fillField('input[name=key]', 'wordpress');
        $I->executeJS("$('#loc > .nice-select').click()");
        $I->executeJS("$('#loc > li:nth-child(2)').click()");
        $I->executeJS("$('#cat > .nice-select').click()");
        $I->executeJS("$('#cat > li:nth-child(3)').click()");
        $I->click('Find Job');

        $I->wait(2);
        $I->see('Wordpress Developer');
    }
    public function Jobs(AcceptanceTester $I) {
        $I->amOnPage('/jobs');
        $I->fillField('input[name=key]', 'wordpress');

        $I->executeJS("$('#loc > .nice-select').click()");
        $I->executeJS("$('#loc > li:nth-child(2)').click()");

        $I->executeJS("$('#cat > .nice-select').click()");
        $I->executeJS("$('#cat > li:nth-child(3)').click()");

        $I->executeJS("$('#type > .nice-select').click()");
        $I->executeJS("$('#type > li:nth-child(3)').click()");

        $I->executeJS("$('#qua > .nice-select').click()");
        $I->executeJS("$('#qua > li:nth-child(3)').click()");



        $I->click('Apply');
        $I->wait(2);

        $I->see('Wordpress Developer');
        $I->see('Full time');

        $I->click('Reset');

        $I->see('Software Engineer');
    }
    public function Details(AcceptanceTester $I) {
        $I->amOnPage('/jobs/1');
        $I->scrollTo('.apply_job_form');

        $I->fillField('Your name', 'abbab');
        $I->fillField('Email', 'abbab@mail.ru');
        $I->fillField('Website/Portfolio link', 'abbab.com');
        $I->fillField('Coverletter', 'Hellow I`m abbab');

        $I->click('Apply Now');
        $I->wait(2);
        $I->see('Find your');
    }
}
