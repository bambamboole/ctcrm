<?php

namespace ctcrm\controllers\articleGroups;

use ctcrm\database\Handler;

class ArticleGroupDataService {

    private $handler;

    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    public function getArticleGroups() {
        $fetchedArticleGroups = $this->handler->getAll("SELECT * FROM article_groups");

        $articleGroups = array();
        foreach ($fetchedArticleGroups as $fetchedArticleGroup) {
            $articleGroup = new ArticleGroupDto();
            $articleGroup->setId($fetchedArticleGroup['id']);
            $articleGroup->setName($fetchedArticleGroup['name']);
            $articleGroups[] = $articleGroup;
        }

        return json_encode($articleGroups);
    }

    public function saveArticleGroup(ArticleGroupDto $dto) {
        $sql = sprintf("UPDATE article_groups SET name = '%s' WHERE id = %d", $dto->getName(), $dto->getId());
        $this->handler->query($sql);
    }
}