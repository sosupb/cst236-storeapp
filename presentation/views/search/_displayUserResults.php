<?php 
/**
 * This is a partial file to display a list of user
 */

?>
<section class="searchFormWrapper">
    <table class="searchResultList">
    	<thead>
    		<tr>
        		<th>ID</th>
        		<th>User Name</th>
        		<th>First Name</th>
        		<th>Last Name</th>
        		<th>Role</th>
    		</tr>
    	</thead>
    	
        <?php
            foreach($users as $user) {
                echo "<tr onclick=\"window.location.href='../handlers/editUserHandler.php?UserID=" . $user['USER_ID'] . "';\">";
                echo "<td>" . $user['USER_ID'] . "</td>" . "<td>" . $user['USER_NAME'] . "</td>" . "<td>" . $user['FIRST_NAME'] . "</td>". "<td>" . $user['LAST_NAME'] . "</td>". "<td>" . $user['ROLE'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</section>