<?php

namespace ctcrm;

use ctcrm\controllers\calls\CallDataService;
use ctcrm\controllers\contactGroups\ContactGroupDataService;
use ctcrm\controllers\contacts\ContactDataService;
use ctcrm\controllers\numberTypes\NumberTypeDataService;
use ctcrm\controllers\contactTitles\ContactTitleDataService;
use ctcrm\controllers\articleGroups\ArticleGroupDataService;
use ctcrm\controllers\articles\ArticleDataService;
use ctcrm\database\Factory;

class ApplicationFactory {

  public function getLoginRequestHandler() {
    $authFactory = new \ctcrm\controllers\auth\Factory();
    return $authFactory->getLoginRequestHandler();
  }
    public function getCallDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new CallDataService($handler);
    }

    public function getContactDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new ContactDataService($handler);
    }

    public function getContactGroupDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new ContactGroupDataService($handler);
    }

    public function getContactTitleDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new ContactTitleDataService($handler);
    }

    public function getNumberTypeDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new NumberTypeDataService($handler);
    }

    public function getArticleGroupDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new ArticleGroupDataService($handler);
    }

    public function getArticleDataService() {
        $dbFactory = new Factory();
        $handler = $dbFactory->getDbConnection('ctcrm');
        return new ArticleDataService($handler);
    }

}
