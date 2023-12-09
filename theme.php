<?php 
include('connect.php');

class Theme {
    public $fontType;
    public $fontColor;
    public $backgroundColor;
    public $primaryColor;
    public $secondaryColor;
    

    private $conn;

    function __construct($fontType, $fontColor, $backgroundColor, $primaryColor, $secondaryColor)
    {       
        $this->fontType = $fontType;
        $this->fontColor = $fontColor;
        $this->backgroundColor = $backgroundColor;
        $this->primaryColor = $primaryColor;
        $this->secondaryColor = $secondaryColor;

        try {
            $this->conn = Connect::connectTo();
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    function add(){
        $stmt = $this->conn->prepare("INSERT INTO theme (fontType, fontColor, backgroundColor, primaryColor, secondaryColor) VALUES (:font_type, :font_color, :background_color, :primary_color, :secondary_color)");
        $stmt->bindParam(':font_type', $this->fontType);
        $stmt->bindParam(':font_color', $this->fontColor);
        $stmt->bindParam(':background_color', $this->backgroundColor);
        $stmt->bindParam(':primary_color', $this->primaryColor);
        $stmt->bindParam(':secondary_color', $this->secondaryColor);
    
        $stmt->execute();
        $stmt->closeCursor();
    }

    function update(){
        $stmt = $this->conn->prepare("UPDATE theme SET fontType = :font_type, fontColor = :font_color, backgroundColor = :background_color, primaryColor = :primary_color, secondaryColor = :secondary_color WHERE id = 1");
        $stmt->bindParam(':font_type', $this->fontType);
        $stmt->bindParam(':font_color', $this->fontColor);
        $stmt->bindParam(':background_color', $this->backgroundColor);
        $stmt->bindParam(':primary_color', $this->primaryColor);
        $stmt->bindParam(':secondary_color', $this->secondaryColor);

        $stmt->execute();
        $stmt->closeCursor();
    }
    
    

    public static function getTheme(){
        $c = new connect();
        $conn = $c->connectTo();

        $stmt = $conn->prepare("SELECT * FROM theme limit 1");
        $stmt->execute();
        

        $result = $stmt->fetch(PDO::FETCH_BOTH);
        if($result == null){
            return null;
        }
        $theme = new Theme($result['fontType'], $result['fontColor'], $result['backgroundColor'], $result['primaryColor'], $result['secondaryColor']);
        
        if($theme->fontType == null){
            return null;
        }

        return $theme;
    }
}



?>
