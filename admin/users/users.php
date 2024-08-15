<?php
include '../includes/header/header.php';
include '../includes/header/sidebar.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-9">
            <h2>Users</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Call the get function
                    $tbl_name = 'tbl_users';
                    $users = get_records($tbl_name);

                    $total_pages = isset($_SESSION['total_pages']) ? $_SESSION['total_pages'] : 1;
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    if (!empty($users)) {
                        foreach ($users as $user) { 
                            echo "<tr>";
                            echo "<td>" . $user['id'] . "</td>";
                            echo "<td>" . $user['username'] . "</td>";
                            echo "<td>" . $user['password'] . "</td>";
                            echo "<td>
                          <a href='/Jewellery-website/admin/users/edit_user.php?id=" . $user['id'] . "' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i></a>
                          <form action='delete_user.php' method='POST' style='display:inline;'>
                              <input type='hidden' name='id' value='" . $user['id'] . "'>
                              <button type='submit' class='btn btn-warning mx-1'><i class='fa-solid fa-trash'></i></button>
                          </form>
                      </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<li class='page-item " . ($i == $page ? "active" : "") . "'><a class='page-link' href='users.php?page=" . $i . "'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>



<?php include '../includes/footer/footer.php'; ?>