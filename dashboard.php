<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include('user.php');
include('site.php');


$site = Site::getSite();

if($site === null){
    $site = new Site("Hello,", "files/Mohammad_Al-Zaro_CV.pdf", "images/me.png", "I AM A WEB DEVELOPER AND SOFTWARE ENGINEER WITH A STRONG WORK ETHIC AND A PASSION FOR INNOVATION. I HAVE THE SKILLS AND EXPERIENCE TO CONTRIBUTE TO A VARIETY OF PROJECTS IN A PROFESSIONAL ENVIRONMENT.", "https://www.facebook.com/mohammad.alzaro.1", "https://twitter.com/MohammadAlZaro", "https://www.linkedin.com/in/mohammad-al-zaro-0b0b3a1b3/", "github.com/MohammadAlZaro");
    $site->add();
}


$user = User::getUser();



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

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Analytics
              </a>
            </li>
            <!-- Add more sidebar items as needed -->
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>

        <!-- Edit Form -->
        <div class="row">
          <div class="col-md-8">
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

        <div class="row">

      </main>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
