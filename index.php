<?php
session_start();

include('user.php');
include('site.php');
include('cards.php');

$site= Site::getSite();
$user = User::getUser();

if($site === null){
    $site = new Site("Hello,", "files/Mohammad_Al-Zaro_CV.pdf", "images/me.png", "I AM A WEB DEVELOPER AND SOFTWARE ENGINEER WITH A STRONG WORK ETHIC AND A PASSION FOR INNOVATION. I HAVE THE SKILLS AND EXPERIENCE TO CONTRIBUTE TO A VARIETY OF PROJECTS IN A PROFESSIONAL ENVIRONMENT.");
    $site->add();
}

$card = new Card();

$projects = $card->getCardByType(CardTypes::PROJECT);
$skills = $card->getCardByType(CardTypes::DEV);
$softSkills = $card->getCardByType(CardTypes::SOFT);
$educations = $card->getCardByType(CardTypes::EDUCATION);
$experiences = $card->getCardByType(CardTypes::EXPERIENCE);
$services = $card->getCardByType(CardTypes::SERVICE);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-..." />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
</head>

<body>

    <div class="head" id="head">
        <div class="left-side">
            <div class="hello">
                <h1><?php echo $site->welcomeText;?></h1>
            </div>
            <div class="name-section">
                <h1>I'M <?php echo $user->name;?></h1>
                <h2><?php echo $user->pos?></h2>
            </div>

            <div class="social-media">
                <a  target="_blank" href="<?php echo $site->facebookLink;?>"><i class="fab fa-facebook"></i></a>
                <a  target="_blank" href="<?php echo $site->linkedinLink;?>"><i class="fab fa-linkedin"></i></a>
                <a  target="_blank" href="<?php echo $site->githubLink;?>"><i class="fab fa-github"></i></a>
                <a  target="_blank" href="<?php echo $site->twitterLink;?>"><i class="fab fa-twitter"></i></a>
            </div>


            <div class="download-button">
                <a target="_blank" href="<?php echo $site->cvLink?>" download="newfilename">view CV</a>
            </div>


        </div>

        <div class="right-side">
            <img src="<?php echo $site->imageLink;?>">
        </div>

        <div class="bottom-arrow">
            <a class="jumping-button" href="#about-section">
                <i class="fas fa-chevron-down"></i>
                <i class="fas fa-chevron-down"></i>
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </div>

    <div class="nav">
        <a  href="#head">Home</a>
        <hr>
        <a  href="#about-section">ِAbout</a>
        <hr>
        <a   href="#education-section">Education</a>
        <hr>
        <a   href="#skills-section">Skils</a>
        <hr>
        <a  href="#experience-section">Experience</a>
        <hr>
        <a  href="#projects-section">Projects</a>
    </div>

    <hr class="page-divider">
    
    <clsas class="about-section section" id="about-section">
        <div class="about-title section-title">
            <h1>About</h1>
        </div>
        <div class="about">
            <h3>
                <?php echo $site->aboutText;?>
            </h3>
        </div>
    </clsas>
    
    <hr class="page-divider">

    <div class="education-section section" id="education-section">

        <div class="education-title section-title">
            <h1>Education</h1>
        </div>

        <div class="cards">

            <?php 

            for($i = 0; $i < count($educations); $i++){
                echo '
                <div class="education-card">
                <div class="card-head">
                    <h3> '.$educations[$i]->title.'</h3>
                    <h4>'.$educations[$i]->organization.' ('.$educations[$i]->startYear.' - '.$educations[$i]->endYear.')</h4>
                </div>
                <div class="card-body">
                    <p>'.$educations[$i]->description.'</p>
                </div>
                <div></div>
            </div>
                ';

                if($i != count($educations) - 1){
                    echo '<hr>';
                }

           
             } ?>
            
  
        </div>
    </div>

    <hr class="page-divider">

    <div class="skills-section section" id="skills-section">
        <div class="skills-title section-title">
            <h1>SKILLS</h1>
        </div>

        <div class="soft-skills">
            <h2>Soft Skills</h2>
            <?php 
              foreach($softSkills as $softSkill){
                echo '
                <div class="skill">
                    <div class="title-image">
                        <h3>'.$softSkill->title.'</h3>
                        <i class="'.$softSkill->icon.'"></i>
                    </div>
                    <div class="bar">
                    </div>
                </div>';
              }
            ?>
        </div>

        <div class="development-skills">
            <h2>Development Skill</h2>
            
            <?php
            foreach($skills as $skill){
                echo '
                <div class="skill">
                    <div class="title-image">
                        <h3>'.$skill->title.'</h3>
                        <i class="'.$skill->icon.'"></i>
                    </div>
                    <div class="bar">
                    </div>
                </div>';
              }

            ?>


        </div>

    </div>

    <hr class="page-divider">

    <div class="experience-section section" id="experience-section">
        <div class="experience-title section-title">
            <h1>experience</h1>
        </div>

        <div class="cards">

        <?php 

        for($i = 0; $i < count($experiences); $i++){

            echo '
            <div class="experience-card">
                <div class="start-date">
                    <h4>'.$experiences[$i]->startYear.'</h4>
                </div>
                <div class="card-head">
                    <div class="left-side">
                        <h3>'.$experiences[$i]->title.'</h3>
                        <h4>'.$experiences[$i]->organization.'</h4>
                    </div>

                    <img src="'.$experiences[$i]->imageLink.'"
                        alt="img">

                </div>
                <div class="card-body">
                    <p> '.$experiences[$i]->description.'
                    </p>
                </div>
                <div class="end-date">
                    <h4>'.$experiences[$i]->endYear.'</h4>
                </div>
            </div>';

            if($i != count($experiences) - 1){
                echo '<hr>';
            }

       
         } ?>


        </div>

    </div>

    <hr class="page-divider">

    <div class="projects-section section" id="projects-section">
        <div class="projects-title section-title">
            <h1>Projects</h1>
        </div>

        <div class="cards">
            <?php 

            for($i = 0; $i < count($projects); $i++){
                echo 
                '<div class="project-card">
                <div class="left-side">
                    <img src="'.$projects[$i]->imageLink.'"
                        alt="https://github.com/m0hammad2Z/Nova-Auction">
                    <div class="card-head">
                        <h5>'.$projects[$i]->organization.'</h5>
                        <h3><a  target="_blank" href="'.$projects[$i]->githubLink.'">'.$projects[$i]->title.'</a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p >'.$projects[$i]->description.'
                        </p>
                    </div>
                </div>

                <div class="project-details">
                <div class="inner-project-details">
                    '.$projects[$i]->description.'
                </div>
            </div>
            </div>';       
            } ?>


        </div>

    </div>

    <hr class="page-divider">

    <div class="footer-section section" id="footer-section">
        <div class="name-section">
            <h1><?php echo $user->name?></1>
            <h4><?php echo $user->pos?></h4>

        </div>
        <div class="phone-email-section">
            <h3><?php echo $user->mobile?></h3>
            <h3><?php echo $user->email?></h3>
            
        </div>

        <div class="social-media">
        <a  target="_blank" href="<?php echo $site->facebookLink;?>"><i class="fab fa-facebook"></i></a>
                <a  target="_blank" href="<?php echo $site->linkedinLink;?>"><i class="fab fa-linkedin"></i></a>
                <a  target="_blank" href="<?php echo $site->githubLink;?>"><i class="fab fa-github"></i></a>
                <a  target="_blank" href="<?php echo $site->twitterLink;?>"><i class="fab fa-twitter"></i></a>
        </div>

        <div>
            <p>© 2023 Mohammad Alzaro. All rights reserved.</p>
        </div>

    </div>

    <?php
        

        if(isset($_SESSION['user'])){    
        ?>

    
    <div class="theme-options">
            <div class="theme-option">
                <div class="theme-option-title">
                    <h5>Font Type</h5>
                </div>
                <div class="theme-option-content">
                    <select name="font-type" id="font-type">
                        <option value="Fredoka">Fredoka</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                </div>
            </div>

            <div class="theme-option">
                <div class="theme-option-title">
                    <h5>Font Color</h5>
                </div>
                <div class="theme-option-content">
                    <input type="color" name="font-color" id="font-color">
                </div>
            </div>

            <div class="theme-option">
                <div class="theme-option-title">
                    <h5>Background</h5>
                </div>
                <div class="theme-option-content">
                    <input type="color" name="background-color" id="background-color">
                </div>
            </div>

            <div class="theme-option">
                <div class="theme-option-title">
                    <h5>Primary</h5>
                </div>
                <div class="theme-option-content">
                    <input type="color" name="primary-color" id="primary-color">
                </div>
            </div>

            <div class="theme-option">
                <div class="theme-option-title">
                    <h5>Secondary</h5>
                </div>
                <div class="theme-option-content">
                    <input type="color" name="secondary-color" id="secondary-color">
                </div>
            </div>
        </div>
     </div>
    
    
     <script src="ajax.js"></script>
    <?php } else{
        ?>

        <script>
            window.onload = function() {
                $.ajax({
                    type: 'GET',
                    url: 'themeHandling.php', 
                    contentType: 'application/json',
                    success: function(response) {
                        response = JSON.parse(response);
                        document.body.style.fontFamily = response['fontType'];
                        document.body.style.color = response['fontColor'];
                        document.body.style.backgroundColor = response['backgroundColor'];
                        document.documentElement.style.setProperty('--blue', response['primaryColor']);
                        document.documentElement.style.setProperty('--divider-color', response['secondaryColor']);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        </script>


<?php } ?>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </body>

</html>