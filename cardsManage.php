<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

include('user.php');

include('cards.php');

$user = User::getUser();


$card = new Card();

$projects = $card->getCardByType(CardTypes::PROJECT);
$skills = $card->getCardByType(CardTypes::DEV);
$softSkills = $card->getCardByType(CardTypes::SOFT);
$educations = $card->getCardByType(CardTypes::EDUCATION);
$experiences = $card->getCardByType(CardTypes::EXPERIENCE);
$services = $card->getCardByType(CardTypes::SERVICE);


// Delete card
if(isset($_GET['delete-id'])){
    $card->deleteCard($_GET['delete-id']);
    header("Location: cardsManage.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if($_POST['_method'] == "cardUpdate"){
    $card->updateCard($_POST['id'], $_POST['type'], $_POST['title'], $_POST['organization'], $_POST['description'], $_POST['startYear'], $_POST['endYear'], $_POST['icon'], $_POST['imageLink'], $_POST['demoLink'], $_POST['githubLink']);
    header("Location: cardsManage.php");
  }

  if ($_POST['_method'] == 'cardPost'){
    $card->addCard($_POST['type'], $_POST['title'], $_POST['organization'], $_POST['description'], $_POST['startYear'], $_POST['endYear'], $_POST['icon'], $_POST['imageLink'], $_POST['demoLink'], $_POST['githubLink']);
    header("Location: cardsManage.php");
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

<style>
    body{
      width: 90%;
      margin: auto;
    }
  </style>

<body>



  <div class="container-fluid ">
    <div class="row">

    <div class="row ">

        <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center p-5 pb-2 mb-3">
          <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="add-card" data-bs-target="#exampleModal">Add Card</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='dashboard.php?logout=1'">Logout</button>
          </div>  
        </div>

          <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
          <h1 class="h2 ml-3" style="color:white; text-align:center; margin-bottom:10px;">Dashboard</h1>
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

          
       <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      
          <?php
          echo '<div class="h2 mt-3 pt-3">Projects</div>';
          if($projects == null)
            echo '<p align="center">No project cards</hp>';
          else
            foreach($projects as $project){
              echo 
              '<div class="col-md-10">
              <div class="row mb-3 bg-light d-flex align-items-center p-3 justify-content-between">
                <div class="col-md-8">
                  <h2 class="text-primary">'.$project->title.'</h2>
                  <p class="text-secondary">'.$project->type.'</p>
                </div>
                <div class="col-md-4 d-flex justify-content-end gap-3">
                  <a class="btn btn-danger" href="cardsManage.php?delete-id='.$project->id.'">Delete</a>
                  <button type="button" class="btn btn-primary update-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-values="'.htmlspecialchars(json_encode($project), ENT_QUOTES, 'UTF-8').'">Edit</button>
                
                  </div>
              </div>
          </div>';
          }

          
            echo '<div class="h2 mt-3 pt-3">Dev Skills</div>';
            if($skills == null) 
              echo '<p align="center">No dev skill cards</hp>';
            else
          foreach($skills as $skill){
              echo 
              '<div class="col-md-10">
              <div class="row mb-3 bg-light d-flex align-items-center p-3 justify-content-between">
                <div class="col-md-8">
                  <h2 class="text-primary">'.$skill->title.'</h2>
                  <p class="text-secondary">'.$skill->type.'</p>
                </div>
                <div class="col-md-4 d-flex justify-content-end gap-3">
                  <a class="btn btn-danger" href="cardsManage.php?delete-id='.$skill->id.'">Delete</a>
                  <button type="button" class="btn btn-primary update-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-values="'.htmlspecialchars(json_encode($skill), ENT_QUOTES, 'UTF-8').'">Edit</button>
                </div>
              </div>
          </div>';
          }

          echo '<div class="h2 mt-3 pt-3">Soft Skills</div>';
          if($softSkills == null) 
            echo '<p align="center">No soft skill cards</hp>';
          else
          foreach($softSkills as $softSkill){
              echo 
              '<div class="col-md-10">
              <div class="row mb-3 bg-light d-flex align-items-center p-3 justify-content-between">
                <div class="col-md-8">
                  <h2 class="text-primary">'.$softSkill->title.'</h2>
                  <p class="text-secondary">'.$softSkill->type.'</p>
                </div>
                <div class="col-md-4 d-flex justify-content-end gap-3">
                  <a class="btn btn-danger" href="cardsManage.php?delete-id='.$softSkill->id.'">Delete</a>
                  <button type="button" class="btn btn-primary update-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-values="'.htmlspecialchars(json_encode($softSkill), ENT_QUOTES, 'UTF-8').'">Edit</button>
                </div>
              </div>
          </div>';
        }

        echo '<div class="h2 mt-3 pt-3">Education</div>';
        if($educations == null) 
            echo '<p align="center">No education cards</hp>';
        else
            foreach($educations as $education){
              echo 
              '<div class="col-md-10">
              <div class="row mb-3 bg-light d-flex align-items-center p-3 justify-content-between">
                <div class="col-md-8">
                  <h2 class="text-primary">'.$education->title.'</h2>
                  <p class="text-secondary">'.$education->type.'</p>
                </div>
                <div class="col-md-4 d-flex justify-content-end gap-3">
                  <a class="btn btn-danger" href="cardsManage.php?delete-id='.$education->id.'">Delete</a>
                  <button type="button" class="btn btn-primary update-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-values="'.htmlspecialchars(json_encode($education), ENT_QUOTES, 'UTF-8').'">Edit</button>
                </div>
              </div>
          </div>';
        }


    echo '<div class="h2 mt-3 pt-3">Experience</div>';
    if($experiences == null) 
        echo '<p align="center">No experience cards</hp>';
    else
      foreach($experiences as $experience){
        echo
        '<div class="col-md-10">
        <div class="row mb-3 bg-light d-flex align-items-center p-3 justify-content-between">
          <div class="col-md-8">
            <h2 class="text-primary">'.$experience->title.'</h2>
            <p class="text-secondary">'.$experience->type.'</p>
            </div>
            <div class="col-md-4 d-flex justify-content-end gap-3">
              <a class="btn btn-danger" href="cardsManage.php?delete-id='.$experience->id.'">Delete</a>
              <button type="button" class="btn btn-primary update-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-values="'.htmlspecialchars(json_encode($experience), ENT_QUOTES, 'UTF-8').'">Edit</button>
            </div>
          </div>
        </div>';
    }


  echo '<div class="h2 mt-3 pt-3">Services</div>';
  if($services == null) 
      echo '<p align="center">No education cards</hp>';
  else
  foreach($services as $service){
    echo
    '<div class="col-md-10">
    <div class="row mb-3 bg-light d-flex align-items-center p-3 justify-content-between">
      <div class="col-md-8">
        <h2 class="text-primary">'.$service->title.'</h2>
        <p class="text-secondary">'.$service->type.'</p>
        </div>
        <div class="col-md-4 d-flex justify-content-end gap-3">
          <a class="btn btn-danger" href="cardsManage.php?delete-id='.$service->id.'">Delete</a>
          <button type="button" class="btn btn-primary update-button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-values="'.htmlspecialchars(json_encode($service), ENT_QUOTES, 'UTF-8').'">Edit</button>
        </div>
      </div>
    </div>';
  }
          

              ?>

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
            <input style="display: none;" id="request-type" class="_method" name="_method" value="cardPost">
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
            <input style="display: none;" id="request-type"  class="_method" name="_method" value="cardPost">
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
            <input style="display: none;" id="request-type" class="_method" name="_method" value="cardPost">
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
            <input style="display: none;" id="request-type"  class="_method" name="_method" value="cardPost">
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
            <input style="display: none;" id="request-type"  class="_method" name="_method" value="cardPost">
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
            <input style="display: none;" id="request-type"  class="_method" name="_method" value="cardPost">
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

    }
  }

  loadFormContent(document.getElementById("categoryDropdown").value);

  document.getElementById("add-card").addEventListener("click", function () {
    document.getElementById("categoryDropdown").disabled = false;
    document.getElementById("request-type").value = "cardPost";
    document.getElementById("categoryDropdown").value = "project";
    loadFormContent(document.getElementById("categoryDropdown").value);

  });

</script>

<script>
    function setupUpdateButtons() {
      let updateButtons = document.querySelectorAll(".update-button");
      updateButtons.forEach(function (updateButton) {
        updateButton.addEventListener("click", function () {
          document.getElementById("categoryDropdown").disabled = true;

          let data = JSON.parse(this.getAttribute("data-values"));


          loadFormContent(data['type']);
          document.getElementById("request-type").value = "cardUpdate";
          document.getElementById("categoryDropdown").value = data['type'];
          document.getElementById("type").value = data['type'];
          document.getElementById("title").value = data['title'];
          document.getElementById("organization").value = data['organization'];
          document.getElementById("description").value = data['description'];
          document.getElementById("startYear").value = data['startYear'];
          document.getElementById("endYear").value = data['endYear'];
          document.getElementById("icon").value = data['icon'];
          document.getElementById("imageLink").value = data['imageLink'];
          document.getElementById("demoLink").value = data['demoLink'];
          document.getElementById("githubLink").value = data['githubLink'];

          const id = data['id'];
          let idInput = document.createElement("input");
          idInput.setAttribute("style", "display: none;");
          idInput.setAttribute("name", 'id');
          idInput.setAttribute("value", id);
          document.getElementById("formContent").getElementsByTagName("form")[0].appendChild(idInput);
        });
      });
    }

    // On page load setup update buttons
    

    setupUpdateButtons();

</script>



</body>
</html>