<?php 
    include("DB/team.php"); 
    if(isset($_SESSION['user_id'])){}
    else{ header("location:login.php"); }
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Goal Management Dashboard</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="JS/script.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Goal Management System</a>
      <div class="collapse navbar-collapse" id="navbarNav"></div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-3 bg-light">
        <table class="table table-borderless">
          <tr>
     
            <td><a href="#">Home</a></td>
          </tr>
          <tr>
  
            <td><a href="#" data-bs-toggle="modal" data-bs-target="#aboutModal">About</a></td>
          </tr>
          <?php if(($_SESSION['role_id'] != 4)&&($_SESSION['role_id'] != 5)){ ?>
          <tr>
            <td><a href="#" data-bs-toggle="modal" data-bs-target="#goalParametersModal">Create Goal Parameter</a></td>
          </tr>
          <?php }?>
          <!-- Add Logout link -->
          <tr>
        
            <td><a href="logout.php">Logout</a></td>
          </tr>
        </table>
      </nav>
      <style>
        /* Style the links in the sidebar to have black text */
        #sidebar a {
          color: black;
          text-decoration: none;
          display: block;

          margin-bottom: 10px;
        }
    
        /* Style the links on hover */
        #sidebar a:hover {
          color: #007bff; /* Change to the desired color on hover */
        }
        #sidebar {
      width: 200px; /* Adjust the width as needed */
    }
      </style>
      <!-- aboust section -->
      <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="aboutModalLabel">About</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>This is goal management system, helps you to track your progress and work done for a day.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
      <!-- Goal Parameters Modal -->
      <div class="modal fade" id="goalParametersModal" tabindex="-1" aria-labelledby="goalParametersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="goalParametersModalLabel">Team Goal Parameters</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="indexb.php" method="post">
              <div id="inputContainer">
                <!-- Initial Input Field -->
                <div className="form-group">
                  <label>Team Name:</label>
                  <select class="form-select" name="team_name" id="category" onchange="createNewInput()" aria-label="Default select example">
                    <option value="">Select team name</option>
                    <?php $i=1; while($table = mysqli_fetch_object($team_name)){ if( $_SESSION['role_id'] != 3){?>
                      <option value="<?php echo $i++; ?>"><?php echo $table->team_name; ?></option>
                    <?php }elseif( $_SESSION['team_id'] == $i){ ?>
                      <option value="<?php echo $i++; ?>"><?php echo $table->team_name; ?></option>
                    <?php }} ?>
                    <?php if( $_SESSION['role_id'] != 3){ ?>
                      <option value="other">New Team</option>
                    <?php } ?>
                  </select> 
                  <div id="dynamicInput"></div>
                </div>
                <div>
                  <label for="inputField1">Add Parameter:</label>
                  <input type="text" id="inputField1" name="100" placeholder="Parameter Name">
                  <select class="form-select" name="500" aria-label="Default select example">
                    <option value="">Parameter data type</option>
                    <option value="VARCHAR">Text</option>
                    <option value="INT">Number</option>
                  </select> 
                  <button type="button" style="width: 80px; float:right;" onclick="removeInputField(1)">Remove</button>
                </div>
              </div>
              <!-- Button to Add New Input Field -->
              <button type="button" style="width: 50px; float:right; margin-right:10px;" onclick="addInputField()">+</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- team activation status -->
      <?php while($table = mysqli_fetch_object($teamactive)){ ?> 
      <div class="modal fade" id="teamactivation<?=$table->id?>" tabindex="-1" aria-labelledby="goalParametersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="goalParametersModalLabel">Team Status</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="indexb.php" method="post">
              <div id="inputContainer">
                <!-- Initial Input Field -->
                <input type="text" name="team_id" value="<?=$table->id?>" required hidden>
                <div className="form-group">
                  <label for="500"><?=$table->team_name?></label>
                  <select class="form-select" name="team_activation" aria-label="Default select example">
                    <option value="Active" <?php if($table->Status=="Active"){ echo "selected"; } ?>>Active</option>
                    <option value="Inactive" <?php if($table->Status=="Inactive"){ echo "selected"; } ?>>Inactive</option>
                  </select>
 
                </div>
              </div>
             </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>

        <!-- edit team info -->
        <?php while($table = mysqli_fetch_object($editteam)){ ?> 
      <div class="modal fade" id="editteam<?=$table->id?>" tabindex="-1" aria-labelledby="goalParametersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="goalParametersModalLabel"><?=$table->team_name?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="indexb.php" method="post">
              <div id="inputContainer">
                <!-- Initial Input Field -->
                <input type="text" name="team_id" value="<?=$table->id?>" required hidden>
                <div className="form-group">
                  <label for="team_name">Team_name:</label>
                  <input type="text" name = "team_name" value="<?=$table->team_name?>" required>
                  <label for="team_domain">Team_domain:</label>
                  <input type="text" name = "team_domain" value="<?=$table->team_domain?>" required>
 
                </div>
              </div>
             </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>


      <!-- Main Content Area -->
      <div id="content" class="col-md-9">
        <h1>Team</h1>
        <table class="table"style="width: 115%;" >
          <thead>
            <tr>
              <th>Team Id</th>
              <th>Team Name</th>
              <th>Team Domain</th>
              <?php if($_SESSION['role_id']==1){ ?>
                <th>team status</th>
                <th></th>
              <?php } ?>
            </tr>
            <?php while($table = mysqli_fetch_object($results)){ ?>
            <tr>
              <td><a href="DB/access.php?team_id=<?=$table->id ?>">#<?php echo $table->id; ?></a></td>
              <td><?php echo $table->team_name; ?></td>
              <td><?php echo $table->team_domain; ?></td>
              <?php if($_SESSION['role_id']==1){ ?>
                <td><a href="#" data-bs-toggle="modal" data-bs-target="#teamactivation<?=$table->id?>"><?php echo $table->Status; ?></a></td>
                <td><a href="#" data-bs-toggle="modal" data-bs-target="#editteam<?=$table->id?>">edit</a></td>
              <?php } ?>
            </tr>
            <?php } ?>
          </thead>
          <tbody>
            <!-- Add historical data rows here -->
            <?php if(isset($_SESSION["invalid"])){ ?>
              <script>window.alert("<?=$_SESSION["invalid"]?>")</script>
            <?php unset($_SESSION["invalid"]); } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript Function -->
<script>
        var inputCount = 1; // Initialize input count
        var parameter = 100;
        var data_type = 500;
        document.cookie = "inputCount=" + inputCount;
        function addInputField() {
            inputCount++; // Increment input count
            parameter++;
            data_type++;
            document.cookie = "inputCount=" + inputCount;
            // Create a new input field, label, and remove button
            var newDiv = document.createElement("div");
            newDiv.innerHTML = `
                <label for="inputField${inputCount}" >Enter something:</label>
                <input type="text" id="inputField${inputCount}" name="${parameter}" placeholder="Type something here">
                <select class="form-select" id="inputField${inputCount}" name="${data_type}" aria-label="Default select example">
                    <option value="">Parameter data type</option>
                    <option value="VARCHAR">Text</option>
                    <option value="INT">Number</option>
                    <option value="DATE">Date</option>
                  </select>
                <button type="button" style="width: 80px; float:right;" onclick="removeInputField(${inputCount})">Remove</button>
            `;
            
            // Append the new input field to the container
            document.getElementById("inputContainer").appendChild(newDiv);
        }
        
        function removeInputField(inputNumber) {
            // Remove the div containing the input field and remove button
            var divToRemove = document.getElementById(`inputField${inputNumber}`).parentNode;
            divToRemove.parentNode.removeChild(divToRemove);
        }

      function createNewInput() {
        var selectedValue = document.getElementById("category").value;
        var dynamicInputContainer = document.getElementById("dynamicInput");

        // Clear previous dynamic input
        dynamicInputContainer.innerHTML = "";

        if (selectedValue === "other") {
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.placeholder = "Create new team name";
            newInput.name = "newteam";
            dynamicInputContainer.appendChild(newInput);

            var originalInput = document.createElement("input");
            originalInput.type = "text";
            originalInput.placeholder = "team domain";
            originalInput.name = "teamdomain";
            dynamicInputContainer.appendChild(originalInput);
        }
      }
    </script>

  
</body>
</html>
