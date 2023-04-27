<?php

namespace app\models;

use app\core\DbModel;					

class donationModel extends DbModel
{
    public string $donationID = "";
    public string $createdBy ="";
    public string $item ="";
    public string $amount = "";
    public string $date = "";
    public string $donateTo = "";
    public string $deliveryID = "";
    public string $deliveryStatus= "";
    public function table(): string
    {
        return "donation";
    }

    public function attributes(): array
    {
        return ["donationID","createdBy","item","amount","donateTo","deliveryID"];
    }

    public function primaryKey(): string
    {
        return "donationID";
    }

    public function rules(): array
    {
        return [
            "item" => [self::$REQUIRED,],
            "amount" => [self::$REQUIRED,],
        ];
    }

    public function getCategories(): bool|array
    {
        $stmnt = self::prepare('SELECT * FROM category');
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function getSubcategories($category): bool|array
    {
        $stmnt = self::prepare('SELECT subcategoryID,subcategoryName FROM subcategory WHERE categoryID = :category');
        $stmnt->bindValue(':category',$category);
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function save(): bool
    {
        $this->donationID = substr(uniqid('donation',true),0,23);
        return parent::save();
    }

    public function getDonationWithPostedBy() {
        $cols = 'd.donationID,u.username,CONCAT(d.amount," ",s.scale) AS amount,d.date,s.subcategoryName,d.donateTo,d.deliveryStatus,c.city';
        $sql = "SELECT " . $cols . " FROM donation d LEFT JOIN users u ON d.createdBy = u.userID LEFT JOIN subcategory s ON d.item = s.subcategoryID LEFT JOIN communitycenter c ON d.donateTo = c.ccID";
        $stmnt = self::prepare($sql);
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAllSubcategories() {
        $stmnt = self::prepare('SELECT subcategoryID,subcategoryName FROM subcategory');
        $stmnt->execute();
        return $stmnt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function  getDonationDetails(string $donationID)
    {
        $statement = self::prepare("SELECT createdBy,item,amount,date,amount,deliveryStatus FROM donation where donationID=:donationID");
        $statement->bindValue(':donationID',$donationID);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}