<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include('user.php');
include('site.php');
include('cards.php');

$site = Site::getSite();

if($site === null){
    $site = new Site("Hello,", "files/Mohammad_Al-Zaro_CV.pdf", "images/me.png", "I AM A WEB DEVELOPER AND SOFTWARE ENGINEER WITH A STRONG WORK ETHIC AND A PASSION FOR INNOVATION. I HAVE THE SKILLS AND EXPERIENCE TO CONTRIBUTE TO A VARIETY OF PROJECTS IN A PROFESSIONAL ENVIRONMENT.", "https://www.facebook.com/mohammad.alzaro.1", "https://twitter.com/MohammadAlZaro", "https://www.linkedin.com/in/mohammad-al-zaro-0b0b3a1b3/", "github.com/MohammadAlZaro");
    $site->add();
}


$user = User::getUser();
$card = new Card();



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['_method'] == 'sitePost'){
        $site->welcomeText = $_POST['welcomeText'];
        $site->cvLink = $_POST['cvLink'];
        $site->imageLink = $_POST['imageLink'];
        $site->aboutText = $_POST['aboutText'];
        $site->facebookLink = $_POST['facebook-link'];
        $site->twitterLink = $_POST['twitter-link'];
        $site->linkedinLink = $_POST['linkedin-link'];
        $site->githubLink = $_POST['github-link'];
        $site->update();
    
    
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->mobile = $_POST['mobileNumber'];
        $user->pos = $_POST['position'];
        $user->update();
    
        $_SESSION['user'] = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'pos' => $_POST['position'],
            'mobile' =>  $_POST['mobileNumber']
        ];
    }
}

if(isset($_GET['logout'])){
    if($_GET['logout'] == 1){
        session_destroy();
        header("Location: login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dashboard.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>



<div class="container-fluid">
    <div class="row">
      <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center p-5 pb-2 mb-3">     
          <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="add-card" data-bs-target="#exampleModal">Add Card</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='dashboard.php?logout=1'">Logout</button>
          </div>  
      </div>
         
      <main class="ms-sm-auto col-lg-12 px-md-4 content-container">      
          <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
          <h1 class="h2 ml-3" style="color:white; text-align:center; margin-bottom:10px;">Dashboard</h1>
          <hr>
              <div class="position-sticky">
                  <ul class="nav flex-column">
                      <li class="nav-item">
                          <a class="nav-link active" href="dashboard.php">
                          <i class="fas fa-home"></i>&nbsp;&nbsp; Home
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="cardsManage.php">
                          <i class="fas fa-address-card"></i>&nbsp;&nbsp; Manage cards 
                          </a>
                      </li>

                      
                      <li class="nav-item">
                          <a class="nav-link" href="index.php" target="_blank">
                          <i class="fas fa-eye"></i>&nbsp;&nbsp; View portfolio 
                          </a>
                      </li>

                  </ul>
              </div>
          </nav>

          <div class="col-md-8">
          <h2 style="margin-top:1em;">Profile</h2>
            <form action="dashboard.php" method="POST">
            <div class="mb-3">
                <input style="display: none;" class="_method" name="_method" value="sitePost">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo $user->name; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php echo $user->email; ?>">
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" placeholder="Your Position"  value="<?php echo $user->pos; ?>">
                </div>
                <div class="mb-3">
                    <label for="welcomeText" class="form-label">Welcome Text</label>
                    <input type="text" class="form-control" id="welcomeText" name="welcomeText" placeholder="Welcome message" value="<?php echo $site->welcomeText; ?>">
                </div>
                <div class="mb-3">
                    <label for="cvLink" class="form-label">CV Link</label>
                    <input type="text" class="form-control" id="cvLink" name="cvLink" placeholder="Link to your CV" value="<?php echo $site->cvLink; ?>">
                </div>
                <div class="mb-3">
                    <label for="imageLink" class="form-label">Image Link</label>
                    <input type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Link to your Image" value="<?php echo $site->imageLink; ?>">
                </div>
                <div class="mb-3">
                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Your Mobile Number" value="<?php echo $user->mobile; ?>">
                </div>
                <div class="mb-3">
                    <label for="facebook-link" class="form-label">Facebook Link</label>
                    <input type="text" class="form-control" id="facebook-link" name="facebook-link" placeholder="Link to your Facebook" value="<?php echo $site->facebookLink; ?>">
                </div>
                <div class="mb-3">
                    <label for="twitter-link" class="form-label">Twitter Link</label>
                    <input type="text" class="form-control" id="twitter-link" name="twitter-link" placeholder="Link to your Twitter" value="<?php echo $site->twitterLink; ?>">
                </div>

                <div class="mb-3">
                    <label for="linkedin-link" class="form-label">LinkedIn Link</label>
                    <input type="text" class="form-control" id="linkedin-link" name="linkedin-link" placeholder="Link to your LinkedIn" value="<?php echo $site->linkedinLink; ?>">
                </div>

                <div class="mb-3">
                    <label for="github-link" class="form-label">Github Link</label>
                    <input type="text" class="form-control" id="github-link" name="github-link" placeholder="Link to your Github" value="<?php echo $site->githubLink; ?>">
                </div>


                <div class="mb-3">
                    <label for="aboutText" class="form-label">About Text</label>
                    <textarea class="form-control" id="aboutText" name="aboutText" rows="3" placeholder="About yourself"><?php echo $site->aboutText; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>

            </form>
          </div>
        </div>

      </main>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <label for="categoryDropdown" class="form-label">Select Category:</label>
          <select class="form-select" id="categoryDropdown">
            <option value="education">Education</option>
            <option value="soft_skill">Soft Skill</option>
            <option value="dev_skill">Dev Skill</option>
            <option value="experience">Experience</option>
            <option value="project">Project</option>
            <option value="service">Service</option>
          </select>
        </div>

        <div id="formContent"></div>


      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
  document.getElementById("categoryDropdown").addEventListener("change", function () {
    var selectedCategory = this.value;
    loadFormContent(selectedCategory);
  });

  function loadFormContent(category) {
    var formContentElement = document.getElementById("formContent");

    formContentElement.innerHTML = "";
    switch (category) {
      case "education":
        formContentElement.innerHTML = `
          <form action="cardsManage.php" method="POST">
          <input style="display: none;" class="_method" name="_method" value="cardPost">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" value="education" name="type" readonly>
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            <label for="organization" class="form-label">Organization:</label>
            <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            <label for="startYear" class="form-label">Start Year:</label>
            <input type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year">
            <label for="endYear" class="form-label">End Year:</label>
            <input type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year">
            <label style="display: none; for="icon" class="form-label">Icon:</label>
            <input style="display: none; type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            <label style="display: none; for="imageLink" class="form-label">Image Link:</label>
            <input style="display: none; type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Image Link">
            <label style="display: none; for="demoLink" class="form-label">Demo Link:</label>
            <input style="display: none; type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Demo Link">
            <label style="display: none; for="githubLink" class="form-label">Github Link:</label>
            <input style="display: none; type="text" class="form-control" id="githubLink" name="githubLink" placeholder="Github Link">
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>`;
        break;
      case "soft_skill":
        formContentElement.innerHTML = `
          <form action="cardsManage.php" method="POST">
            <input style="display: none;" class="_method" name="_method" value="cardPost">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" value="soft_skill" name="type" readonly>
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            <label style="display: none;" for="organization" class="form-label">Organization:</label>
            <input style="display: none;" type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            <label style="display: none;" for="description" class="form-label">Description:</label>
            <textarea style="display: none;" class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            <label style="display: none;" for="startYear" class="form-label">Start Year:</label>
            <input style="display: none;" type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year">
            <label style="display: none;" for="endYear" class="form-label">End Year:</label>
            <input style="display: none;" type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year">
            <label for="icon" class="form-label">Icon:</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            <label style="display: none; for="imageLink" class="form-label">Image Link:</label>
            <input style="display: none; type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Image Link">
            <label style="display: none; for="demoLink" class="form-label">Demo Link:</label>
            <input style="display: none; type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Demo Link">
            <label style="display: none; for="githubLink" class="form-label">Github Link:</label>
            <input style="display: none; type="text" class="form-control" id="githubLink" name="githubLink" placeholder="Github Link">
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>`;
        break;
      case "dev_skill":
        formContentElement.innerHTML = `
          <form action="cardsManage.php" method="POST">
            <input style="display: none;" class="_method" name="_method" value="cardPost">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" value="dev_skill" name="type" readonly>
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            <label style="display: none;" for="organization" class="form-label">Organization:</label>
            <input style="display: none;" type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            <label style="display: none;" for="description" class="form-label">Description:</label>
            <textarea style="display: none;" class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            <label style="display: none;" for="startYear" class="form-label">Start Year:</label>
            <input style="display: none;" type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year">
            <label style="display: none;" for="endYear" class="form-label">End Year:</label>
            <input style="display: none;" type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year">
            <label for="icon" class="form-label">Icon:</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            <label style="display: none; for="imageLink" class="form-label">Image Link:</label>
            <input style="display: none; type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Image Link">
            <label style="display: none; for="demoLink" class="form-label">Demo Link:</label>
            <input style="display: none; type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Demo Link">
            <label style="display: none; for="githubLink" class="form-label">Github Link:</label>
            <input style="display: none; type="text" class="form-control" id="githubLink" name="githubLink" placeholder="Github Link">
            <input type="submit" class="btn btn-primary" value="Submit">

          </form>`;
        break;
      case "experience":
        formContentElement.innerHTML = `
          <form action="cardsManage.php" method="POST">
            <input style="display: none;" class="_method" name="_method" value="cardPost">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" value="experience" name="type" readonly>
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            <label for="organization" class="form-label">Organization:</label>
            <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            <label for="startYear" class="form-label">Start Year:</label>
            <input type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year">
            <label for="endYear" class="form-label">End Year:</label>
            <input type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year">
            <label style="display: none; for="icon" class="form-label">Icon:</label>
            <input style="display: none; type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            <label for="imageLink" class="form-label">Image Link:</label>
            <input type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Image Link">
            <label style="display: none; for="demoLink" class="form-label">Demo Link:</label>
            <input style="display: none; type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Demo Link">
            <label style="display: none; for="githubLink" class="form-label">Github Link:</label>
            <input style="display: none; type="text" class="form-control" id="githubLink" name="githubLink" placeholder="Github Link">
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>`;
        break;
      case "project":
        formContentElement.innerHTML = `
          <form action="cardsManage.php" method="POST">
            <input style="display: none;" class="_method" name="_method" value="cardPost">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" value="project" name="type" readonly>
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            <label for="organization" class="form-label">Organization:</label>
            <input type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            <label for="startYear" class="form-label">Start Year:</label>
            <input type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year">
            <label for="endYear" class="form-label">End Year:</label>
            <input type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year">
            <label style="display: none; for="icon" class="form-label">Icon:</label>
            <input style="display: none; type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            <label for="imageLink" class="form-label">Image Link:</label>
            <input type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Image Link">
            <label style="display: none; for="demoLink" class="form-label">Demo Link:</label>
            <input style="display: none; type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Demo Link">
            <label for="githubLink" class="form-label">Github Link:</label>
            <input type="text" class="form-control" id="githubLink" name="githubLink" placeholder="Github Link">
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>`;
        break;
      case "service":
        formContentElement.innerHTML = `
          <form action="cardsManage.php" method="POST">
            <input style="display: none;" class="_method" name="_method" value="cardPost">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" value="service" name="type" readonly>
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            <label style="display: none; for="organization" class="form-label">Organization:</label>
            <input style="display: none; type="text" class="form-control" id="organization" name="organization" placeholder="Organization">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
            <label style="display: none; for="startYear" class="form-label">Start Year:</label>
            <input style="display: none; type="text" class="form-control" id="startYear" name="startYear" placeholder="Start Year">
            <label style="display: none; for="endYear" class="form-label">End Year:</label>
            <input style="display: none; type="text" class="form-control" id="endYear" name="endYear" placeholder="End Year">
            <label for="icon" class="form-label">Icon:</label>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
            <label style="display: none; for="imageLink" class="form-label">Image Link:</label>
            <input style="display: none; type="text" class="form-control" id="imageLink" name="imageLink" placeholder="Image Link">
            <label style="display: none; for="demoLink" class="form-label">Demo Link:</label>
            <input style="display: none; type="text" class="form-control" id="demoLink" name="demoLink" placeholder="Demo Link">
            <label style="display: none; for="githubLink" class="form-label">Github Link:</label>
            <input style="display: none; type="text" class="form-control" id="githubLink" name="githubLink" placeholder="Github Link">
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>`;
        break;
      default:
        // Handle default case or add more cases as needed
        break;
    }
  }

  loadFormContent(document.getElementById("categoryDropdown").value);
</script>

</body>
</html>


