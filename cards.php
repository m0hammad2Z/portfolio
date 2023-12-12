<?php 

class CardTypes {
    public const EDUCATION = "education";
    public const SOFT = "soft_skill";
    public const DEV = "dev_skill";
    public const EXPERIENCE = "experience";
    public const PROJECT = "project";
    public const SERVICE = "service";
}


class Card{
    public $id;
    public $type;
    public $title;
    public $organization;
    public $description;
    public $startYear;
    public $endYear;
    public $icon;
    public $imageLink;
    public $demoLink;
    public $githubLink;

    private $conn;
    function __construct()
    {       
        try {
            $this->conn = Connect::connectTo();
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

        function addCard($type, $title, $organization, $description, $startYear, $endYear, $icon, $imageLink, $demoLink, $githubLink){
            $sql = "INSERT INTO cards (type, title, organization, description, startYear, endYear, icon, imageLink, demoLink, githubLink) VALUES (:type, :title, :organization, :description, :startYear, :endYear, :icon, :imageLink, :demoLink, :githubLink)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':organization', $organization);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':startYear', $startYear);
            $stmt->bindParam(':endYear', $endYear);
            $stmt->bindParam(':icon', $icon);
            $stmt->bindParam(':imageLink', $imageLink);
            $stmt->bindParam(':demoLink', $demoLink);
            $stmt->bindParam(':githubLink', $githubLink);
            $stmt->execute();
        }

         function getCards(){
            $sql = "SELECT * FROM cards";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if(!$result){
                return array();
            }

            $objectResult = array();
            foreach($result as $row){
                $card = new Card();
                $card->id = $row['id'];
                $card->type = $row['type'];
                $card->title = $row['title'];
                $card->organization = $row['organization'];
                $card->description = $row['description'];
                $card->startYear = $row['startYear'];
                $card->endYear = $row['endYear'];
                $card->icon = $row['icon'];
                $card->imageLink = $row['imageLink'];
                $card->demoLink = $row['demoLink'];
                $card->githubLink = $row['githubLink'];
                array_push($objectResult, $card);
            }


            return $objectResult;
        }

        function getCard($id){
            $sql = "SELECT * FROM cards WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result){
                return array();
            }

            $card = new Card();
            $card->id = $result[0]['id'];
            $card->type = $result[0]['type'];
            $card->title = $result[0]['title'];
            $card->organization = $result[0]['organization'];
            $card->description = $result[0]['description'];
            $card->startYear = $result[0]['startYear'];
            $card->endYear = $result[0]['endYear'];
            $card->icon = $result[0]['icon'];
            $card->imageLink = $result[0]['imageLink'];
            $card->demoLink = $result[0]['demoLink'];
            $card->githubLink = $result[0]['githubLink'];

            return $card;

        }

         function updateCard($id, $type, $title, $organization, $description, $startYear, $endYear, $icon, $imageLink, $demoLink, $githubLink){
            $sql = "UPDATE cards SET type = :type, title = :title, organization = :organization, description = :description, startYear = :startYear, endYear = :endYear, icon = :icon, imageLink = :imageLink, demoLink = :demoLink, githubLink = :githubLink WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':organization', $organization);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':startYear', $startYear);
            $stmt->bindParam(':endYear', $endYear);
            $stmt->bindParam(':icon', $icon);
            $stmt->bindParam(':imageLink', $imageLink);
            $stmt->bindParam(':demoLink', $demoLink);
            $stmt->bindParam(':githubLink', $githubLink);
            $stmt->execute();
        }

        function deleteCard($id){
            $sql = "DELETE FROM cards WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        function getCardByType($type){
            $sql = "SELECT * FROM cards WHERE type = :type";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result){
                return array();
            }

            $objectResult = array();
            foreach($result as $row){
                $card = new Card();
                $card->id = $row['id'];
                $card->type = $row['type'];
                $card->title = $row['title'];
                $card->organization = $row['organization'];
                $card->description = $row['description'];
                $card->startYear = $row['startYear'];
                $card->endYear = $row['endYear'];
                $card->icon = $row['icon'];
                $card->imageLink = $row['imageLink'];
                $card->demoLink = $row['demoLink'];
                $card->githubLink = $row['githubLink'];
                array_push($objectResult, $card);
            }

            return $objectResult;
        }
    }


?>

