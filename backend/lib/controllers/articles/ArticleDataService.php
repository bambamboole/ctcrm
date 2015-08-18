<?php

namespace ctcrm\controllers\articles;

use ctcrm\database\Handler;

class ArticleDataService {

    private $handler;

    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    public function getArticles() {
        $fetchedArticles = $this->handler->getAll("SELECT * FROM articles");

        $articles = array();
        foreach ($fetchedArticles as $fetchedArticle) {
            $article = new ArticleDto();
            $article->setId($fetchedArticle['id']);
            $article->setGroupId($fetchedArticle['group_id']);
            $article->setName($fetchedArticle['name']);
            $article->setPurchaseInfo($fetchedArticle['purchase_info']);
            $article->setVisible($fetchedArticle['visible']);
            $article->setPrice($fetchedArticle['price']);
            $articles[] = $article;
        }

        return json_encode($articles);
    }

    public function saveArticle(ArticleDto $dto) {
        $sql = sprintf("UPDATE articles
                        SET name = '%s',
                        purchase_info = '%s',
                        visible = '%d',
                        price ='%d'
                        WHERE id = %d",
                        $dto->getName(), $dto->getPurchaseInfo(), $dto->getVisible(), $dto->getPrice(), $dto->getId());
        $this->handler->query($sql);
    }
}