<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="account.css">
    <script src="https://kit.fontawesome.com/bb02d24289.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <aside>    
            <nav class="menu">
                <ul>
                    <div>
                        <a href="dashboard.php" class="logo">
                            <img src="no-bg-KFC-Dental-Clinic.png" alt="KFC Dental Clinic">
                        </a>
                    </div>

                    <li>
                        <a href="dashboard.php">
                            <i class="fa-solid fa-house fa-sm"></i>
                            <span class="nav-item">Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="appointment.php">
                            <i class="fa-regular fa-calendar-check fa-sm"></i>
                            <span class="nav-item">Appointments</span>
                            <i class="fa-solid fa-bell" aria-hidden="true" id="notifi_number">0</i>
                        </a>
                    </li>

                    <li>
                        <a href="patient.php">
                            <i class="fa-solid fa-bed fa-sm"></i>
                            <span class="nav-item">Patient</span>
                        </a>
                    </li>

                    <li>
                        <a href="account.php">
                            <i class="fa-solid fa-user"></i>
                            <span class="nav-item">Account</span>
                        </a>
                    </li>

                    <li>
                        <a href="message.php">
                            <i class="fa-solid fa-message fa-sm"></i>
                            <span class="nav-item">Message</span>
                            <i class="fa-solid fa-bell" aria-hidden="true" id="message_notifi_number">0</i>
                        </a>
                    </li>

                    <li>
                        <a href="logout.php" class="log-out">
                            <i class="fa-solid fa-right-from-bracket fa-sm"></i>
                            <span class="nav-item">Log out</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main>
            <header>
                <div class="hamburger-icon" onclick="toggleNav()">
                    <i class="fas fa-bars"></i>
                </div>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <span><p>Accounts</p></span>


            </header>

            <section>
                <div class="table-container">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th class="Id">ID</th>
                                <th class="Role">Role</th>
                                <th class="Name">Name</th>
                                <th class="email">Email</th>
                                <th class="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            include "account_db.php";

                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
                                $delete_accountId = $_POST["delete"];
                                    
                                $deleteSql = "DELETE FROM create_account WHERE id = $delete_accountId";
                                mysqli_query($conn, $deleteSql);
                            }

                            $sql = "SELECT * FROM create_account";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td data-label="ID"><?php echo $row['Id'] ?></td>
                                    <td data-label="Role"><?php echo $row['Role'] ?></td>
                                    <td data-label="Name"><?php echo $row['Name'] ?></td>
                                    <td data-label="Email"><?php echo $row['email'] ?></td>
                                    <td class="action" data-label="Action">
                                        <form method="post" action="edit_account.php" onsubmit="return confirm('Are you sure you want to Edit?');">
                                            <input type="hidden" name="edit" value="<?php echo $row['Id']; ?>">
                                            <button type="submit" class="edit"><i class="fa-regular fa-pen-to-square"></i></button>
                                        </form>
                                        <form method="post" action="" onsubmit="return confirm('Are you sure you want to Delete?');">
                                            <button type="submit" class="delete" name="delete" value="<?php echo $row['Id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>




<script>
    function toggleNav() {
        var nav = document.querySelector('aside nav');
        var hamburger = document.querySelector('.hamburger-icon');
        var section = document.querySelector('.section');
        
        nav.classList.toggle('active');
        hamburger.classList.toggle('active')
        section.classList.toggle('active');
    }

    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("notifi_number").innerHTML = this.responseText;
                document.getElementById("appointment_number").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "notification_db.php", true);
        xhttp.send();
    }
    loadDoc();

    function loadDoc_message() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("message_notifi_number").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "contact_notif_db.php", true);
        xhttp.send();
    }
    loadDoc_message();


</script>
    
</body>
</html>