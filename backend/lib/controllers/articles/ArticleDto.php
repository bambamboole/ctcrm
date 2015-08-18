<?php

namespace ctcrm\controllers\articles;

class ArticleDto implements \JsonSerializable {

    private $id;
    private $groupId;
    private $name;
    private $purchaseInfo;
    private $visible;
    private $price;


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getGroupId(){
        return $this->groupId;
    }

    public function setGroupId($groupId){
        $this->groupId = $groupId;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPurchaseInfo(){
        return $this->purchaseInfo;
    }

    public function setPurchaseInfo($purchaseInfo){
        $this->purchaseInfo = $purchaseInfo;
    }

    public function getVisible(){
        return $this->visible;
    }

    public function setVisible($visible){
        $this->visible = $visible;
    }

    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }


    function jsonSerialize() {
        return array(
            'id' => $this->id,
            'groupId' => $this->groupId,
            'name' => $this->name,
            'purchaseInfo' => $this->purchaseInfo,
            'visible' => $this->visible,
            'price' => $this->price
        );
    }

}
