<?php 
/**
 * This is a partial file to display a list of user
 */

?>
<section class="searchFormWrapper">
    <table class="searchResultList">
    	<thead>
    		<tr>
        		<td>ID</td>
        		<td>User Name</td>
        		<td>First Name</td>
        		<td>Last Name</td>
        		<td>Role</td>
    		</tr>
    	</thead>
    	
        <?php
            foreach($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['USER_ID'] . "</td>" . "<td>" . $user['USER_NAME'] . "</td>" . "<td>" . $user['FIRST_NAME'] . "</td>". "<td>" . $user['LAST_NAME'] . "</td>". "<td>" . $user['ROLE'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</section>