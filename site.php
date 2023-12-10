<?php 


class Site {
    private $id;
    public $welcomeText;
    public $cvLink;
    public $imageLink;
    public $aboutText;
    public $facebookLink;
    public $twitterLink;
    public $linkedinLink;
    public $githubLink;
    

    private $conn;

    function __construct($welcomeText, $cvLink, $imageLink, $aboutText, $facebookLink, $twitterLink, $linkedinLink, $githubLink)
    {       
        $this->welcomeText = $welcomeText;
        $this->cvLink = $cvLink;
        $this->imageLink = $imageLink;
        $this->aboutText = $aboutText;
        $this->facebookLink = $facebookLink;
        $this->twitterLink = $twitterLink;
        $this->linkedinLink = $linkedinLink;
        $this->githubLink = $githubLink;

        try {
            $this->conn = Connect::connectTo();
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function add(){
        $stmt = $this->conn->prepare("INSERT INTO site (welcomeText, cvLink, imageLink, aboutText, fLink, tLink, lLink, gLink) VALUES (:welcome_text, :cv_link, :image_link, :about_text, :f_link, :t_link, :l_link, :g_link)");
        $stmt->bindParam(':welcome_text', $this->welcomeText);
        $stmt->bindParam(':cv_link', $this->cvLink);
        $stmt->bindParam(':image_link', $this->imageLink);
        $stmt->bindParam(':about_text', $this->aboutText);
        $stmt->bindParam(':f_link', $this->facebookLink);
        $stmt->bindParam(':t_link', $this->twitterLink);
        $stmt->bindParam(':l_link', $this->linkedinLink);
        $stmt->bindParam(':g_link', $this->githubLink);
    
        $stmt->execute();
        $stmt->closeCursor();
    }

    function update(){
        $stmt = $this->conn->prepare("UPDATE site SET welcomeText = :welcome_text, cvLink = :cv_link, imageLink = :image_link, aboutText = :about_text, fLink =:f_link, tLink = :t_link, lLink = :l_link, gLink = :g_link");
        $stmt->bindParam(':welcome_text', $this->welcomeText);
        $stmt->bindParam(':cv_link', $this->cvLink);
        $stmt->bindParam(':image_link', $this->imageLink);
        $stmt->bindParam(':about_text', $this->aboutText);
        $stmt->bindParam(':f_link', $this->facebookLink);
        $stmt->bindParam(':t_link', $this->twitterLink);
        $stmt->bindParam(':l_link', $this->linkedinLink);
        $stmt->bindParam(':g_link', $this->githubLink);

        $stmt->execute();
        $stmt->closeCursor();
    }

    public static function getSite(){
        $c = new connect();
        $conn = $c->connectTo();

        $stmt = $conn->prepare("SELECT * FROM site limit 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        
        $site = new Site($result['welcomeText'], $result['cvLink'], $result['imageLink'], $result['aboutText'], $result['fLink'], $result['tLink'], $result['lLink'], $result['gLink']);

        if($result == null){
            return null;
        }

        return $site;

        
    }

}
