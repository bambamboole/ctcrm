<?php

require_once 'vendor/autoload.php';

$f3 = Base::instance();

$f3->route('POST /login', function(Base $f3) {
  $credentials = json_decode($f3->get('BODY'));
  $factory = new \ctcrm\ApplicationFactory();
  $authService = $factory->getLoginRequestHandler();
  echo json_encode(
    $authService->handleRequest($credentials->username, $credentials->password)
  );

});

$f3->route('GET /calls', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getCallDataService();
    echo $dataService->getCalls();
});

$f3->route('GET /contacts', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getContactDataService();
    echo $dataService->getContacts();
});

$f3->route('GET /contactGroups', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getContactGroupDataService();
    echo $dataService->getContactGroups();
});

$f3->route('PUT /contactGroups', function(Base $f3) {
  $contactGroupJson = json_decode($f3->get('BODY'));
  $contactGroup = new \ctcrm\controllers\contactGroups\ContactGroupDto();
  $contactGroup->setId($contactGroupJson->id);
  $contactGroup->setName($contactGroupJson->name);

  $factory = new \ctcrm\ApplicationFactory();
  $dataService = $factory->getContactGroupDataService();
  $dataService->saveContactGroup($contactGroup);
});

$f3->route('GET /contactTitles', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getContactTitleDataService();
    echo $dataService->getContactTitles();
});

$f3->route('GET /numberTypes', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getNumberTypeDataService();
    echo $dataService->getNumberTypes();
});

$f3->route('GET /articleGroups', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getArticleGroupDataService();
    echo $dataService->getArticleGroups();
});

$f3->route('PUT /articleGroups', function(Base $f3) {
    $articleGroupJson = json_decode($f3->get('BODY'));
    $articleGroup = new ctcrm\controllers\articleGroups\ArticleGroupDto();
    $articleGroup->setId($articleGroupJson->id);
    $articleGroup->setName($articleGroupJson->name);

    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getArticleGroupDataService();
    $dataService->saveArticleGroup($articleGroup);
});

$f3->route('GET /articles', function() {
    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getArticleDataService();
    echo $dataService->getArticles();
});

$f3->route('PUT /articles', function(Base $f3) {
    $articleJson = json_decode($f3->get('BODY'));
    $article = new \ctcrm\controllers\articles\ArticleDto();
    $article->setId($articleJson->id);
    $article->setGroupId($articleJson->groupId);
    $article->setName($articleJson->name);
    $article->setPurchaseInfo($articleJson->purchaseInfo);
    $article->setVisible($articleJson->visible);
    $article->setPrice($articleJson->price);

    $factory = new \ctcrm\ApplicationFactory();
    $dataService = $factory->getArticleDataService();
    echo $dataService->saveArticle($article);
});

$f3->run();
