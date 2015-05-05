<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\WebApiExtension\Context\WebApiContext;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ApiContext extends WebApiContext implements SnippetAcceptingContext {


    function __construct() {

    }

    /**
     * Begin a database transaction.
     *
     * @BeforeScenario
     */
    public static function beginTransaction()
    {
        DB::beginTransaction();
    }

    /**
     *
     * Roll it back after the scenario.
     *
     * @AfterScenario
     */
    public static function rollback()
    {
        DB::rollback();
    }

    /**
     * Migrate the database before each scenario.
     *
     * @beforeScenario
     */
    public function migrate()
    {
        Artisan::call('migrate');
    }
}