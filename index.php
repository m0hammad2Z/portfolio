<?php
session_start();

include('user.php');
include('site.php');

$site= Site::getSite();
$user = User::getUser();

if($site === null){
    $site = new Site("Hello,", "files/Mohammad_Al-Zaro_CV.pdf", "images/me.png", "I AM A WEB DEVELOPER AND SOFTWARE ENGINEER WITH A STRONG WORK ETHIC AND A PASSION FOR INNOVATION. I HAVE THE SKILLS AND EXPERIENCE TO CONTRIBUTE TO A VARIETY OF PROJECTS IN A PROFESSIONAL ENVIRONMENT.");
    $site->add();
}


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

            <div class="education-card">
                <div class="card-head">
                    <h3> High degree</h3>
                    <h4>Al Hussein Secondary College School (2019 - 2020)</h4>
                </div>
                <div class="card-body">
                    <p>I completed my high school education at Al Hussein Secondary College School. This period was crucial in shaping my academic interests and led me to pursue a career in Computer Science.</p>
                </div>
                <div></div>
            </div>

            <hr>

            <div class="education-card">
                <div class="card-head">
                    <h3>Bachelor in Computer Science</h3>
                    <h4>Hashemite University (2020 - 2023)</h4>
                </div>
                <div class="card-body">
                    <p>I pursued my Bachelor’s degree in Computer Science at the Hashemite University. During my time there, I gained a solid foundation in computer science basics and principles, and developed my problem-solving skills. I also had the opportunity to work on several programming projects, which allowed me to apply the theoretical knowledge I gained.</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="page-divider">

    <div class="skills-section section" id="skills-section">
        <div class="skills-title section-title">
            <h1>SKILLS</h1>
        </div>

        <div class="soft-skills">
            <h2>ٍSoft Skill</h2>
            <div class="skill">
                <div class="title-image">
                    <h3>Communication</h3>
                    <i class="fas fa-comments"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>Teamwork</h3>
                    <i class="fas fa-users"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>Problem Solving</h3>
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>Time Management</h3>
                    <i class="fas fa-clock"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>Adaptability</h3>
                    <i class="fas fa-adjust"></i>
                </div>
                <div class="bar">
                </div>
            </div>

        </div>

        <div class="development-skills">
            <h2>Development Skill</h2>
            <div class="skill">
                <div class="title-image">
                    <h3>unity</h3>
                    <i class="fab fa-unity"></i>
                    
                </div>
                <div class="bar">
                </div>
                
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>PHP</h3>
                    <i class="fab fa-php"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>java</h3>
                    <i class="fab fa-java"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>SQL</h3>
                    <i class="fas fa-database"></i>
                </div>
                <div class="bar">
                </div>
            </div>

            <div class="skill">
                <div class="title-image">
                    <h3>github</h3>
                    <i class="fab fa-github"></i>
                </div>
                <div class="bar">
                </div>
            </div>
            
            <div class="skill">
                <div class="title-image">
                    <h3>docker</h3>
                    <i class="fab fa-docker"></i>
                </div>
                <div class="bar">
                </div>
            </div>
        </div>

    </div>

    <hr class="page-divider">

    <div class="experience-section section" id="experience-section">
        <div class="experience-title section-title">
            <h1>experience</h1>
        </div>

        <div class="cards">
            <div class="experience-card">
                <div class="start-date">
                    <h4>06/2021</h4>
                </div>
                <div class="card-head">
                    <div class="left-side">
                        <h3>Android Development Course</h3>
                        <h4>Udacity</h4>
                    </div>

                    <img src="https://rainbowit.net/html/inbio/assets/images/portfolio/portfolio-01.jpg"
                        alt="img">

                </div>
                <div class="card-body">
                    <p> Developed web applications using HTML, CSS, JavaScript, and React.Developed web applications
                        using HTML, CSS, JavaScript, and React.
                    </p>
                </div>
                <div class="end-date">
                    <h4>09/2021</h4>
                </div>
            </div>

            <hr>

            <div class="experience-card">
                <div class="start-date">
                    <h4>04/2023</h4>
                </div>
                <div class="card-head">
                    <div class="left-side">
                        <h3>Full Stack Web Developer Nanodegree</h3>
                        <h4>Udacity</h4>
                    </div>

                    <img src="https://geospatialmedia.s3.amazonaws.com/wp-content/uploads/2020/06/1521538261_PbPTN7_udacity1.jpg"
                        alt="img">
                </div>
                <div class="card-body">
                    <p>Learn how to design and develop databases for software applications, create
                        and deploy database-backed web APIs, and secure and manage user
                        authentication and access control for an application backend. The program
                        also covers how to deploy a Flask-based web application to the cloud using
                        Docker and Kubernetes.
                    </p>
                </div>
                <div class="end-date">
                    <h4>08/2023</h4>
                </div>
            </div>

        </div>

    </div>

    <hr class="page-divider">

    <div class="projects-section section" id="projects-section">
        <div class="projects-title section-title">
            <h1>Projects</h1>
        </div>

        <div class="cards">
            <div class="project-card">
                <div class="left-side">
                    <img src="https://th.bing.com/th/id/OIP.tKd_Rf-exXJeByr0BW5J8gAAAA?pid=ImgDet&rs=1"
                        alt="project image">
                    <div class="card-head">
                        <h5>Web Devlopment</h5>
                        <h3><a  target="_blank" href="https://github.com/m0hammad2Z/Nova-Auction">Nova  </a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p>A website that allows users to buy and sell cars online.</p>
                    </div>
                </div>

                <div class="project-details">
                    <div class="inner-project-details">
                        <ul>
                            <li>Implemented the back-end using PHP and MySQL.</li>
                            <li>Implemented the front-end using HTML, CSS and JavaScript.</li>
                            <li>Implemented the back-end using PHP and MySQL.</li>
                            <li>Implemented the front-end using HTML, CSS and JavaScript.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="left-side">
                    <img src="https://www.itjobs.pt/empresa/promptly/logo/social"
                        alt="https://github.com/m0hammad2Z/Nova-Auction">
                    <div class="card-head">
                        <h5>Web Devlopment</h5>
                        <h3><a  target="_blank" href="https://github.com/m0hammad2Z/Promptly-API">Promptly-API </a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p>RESTful web service that provides users with ideas or suggestions for writing something creative, such
                            as a story, a poem, a script, or an essay.
                        </p>
                    </div>
                </div>

                <div class="project-details">
                    <div class="inner-project-details">
                        <ul>
                            <li>Used Python and Flask as the main technologies and implemented various features such as
                            authentication, pagination, and error handling.</li>
                           <li> Postgres as the database for storing and retrieving data and model parameters.</li>
                            
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="left-side">
                    <img src="https://img.itch.zone/aW1hZ2UvMjEwNjg5MC8xMjQwNDM2MS5wbmc=/347x500/bN8KOT.png"
                        alt="image">
                    <div class="card-head">
                        <h5>Game Devlopment</h5>
                        <h3><a  target="_blank" href="https://devkaiju.itch.io/fp-pacman">FP Pacman </a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p>FP Pacman is a first person remake of the classic arcade game made with Unity.</p>
                    </div>
                </div>

                <div class="project-details">
                    <div class="inner-project-details">
                        <ul>
                            <li>Designed and coded the game logic and mechanics using C#. </li>
                           <li>3D Models created using Blender. </li>   
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="left-side">
                    <img src="https://appimg2.dbankcdn.com/application/icon144/65/df9bf776c3d149ecbb4fe02458692394.png"
                        alt="image">
                    <div class="card-head">
                        <h5>Game Devlopment</h5>
                        <h3><a  target="_blank" href="https://appgallery.huawei.com/app/C107171901">Roller Ball </a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p>A game made with Unity where you have to control a ball to avoid collision with the obstacles.</p>
                    </div>
                </div>

                <div class="project-details">
                    <div class="inner-project-details">
                        <ul>
                            <li>Designed and coded the game logic and mechanics using C#.</li>
                           <li>Created various levels with increasing difficulty and variety. </li>   
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="left-side">
                    <img src="https://cdn.dribbble.com/users/3745465/screenshots/14066363/media/f6897a21464f69a586e73f2fb4cb6683.png"
                        alt="image">
                    <div class="card-head">
                        <h5>Mobile</h5>
                        <h3><a  target="_blank" href="https://github.com/m0hammad2Z/ChatVibe">ChatVibe </a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p>A simple chat app made using Flutter and Firebase.</p>
                    </div>
                </div>

                <div class="project-details">
                    <div class="inner-project-details">
                        <ul>
                            <li>Used Firebase as the backend service to store and retrieve messages. </li>
                           <li>Implemented authentication and authorization using Firebase Auth. </li>   
                        </ul>
                    </div>
                </div>
            </div>

            <div class="project-card">
                <div class="left-side">
                    <img src="https://i.pinimg.com/originals/06/c4/f7/06c4f70ec5931e2342e703e8a3f0a253.png"
                        alt="image">
                    <div class="card-head">
                        <h5>Mobile</h5>
                        <h3><a  target="_blank" href="https://github.com/m0hammad2Z/uni_weather">University Weather App </a><i class="fas fa-external-link-alt fa-xs"></i></h3>
                        <p>A weather software for universities was created using Flutter to make it easier for students to check
                            the weather in their universities. The app retrieves weather data using the OpenWeather API.</p>
                    </div>
                </div>

                <div class="project-details">
                    <div class="inner-project-details">
                        <ul>
                            <li>Used OpenWeather API to fetch weather data for different locations. </li>
                           <li>Implemented a user-friendly interface.</li>   
                        </ul>
                    </div>
                </div>
            </div>



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


    <
    </body>

</html>