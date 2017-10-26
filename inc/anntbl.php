<table class="table table-responsive table-striped table-hover">
  <thead>
    <tr>
      <th>Post ID</th>
      <th>Announcement Title</th>
      <?php if($_SESSION['my_role']==3) echo '<th>Author</th>'; ?>
      <th>Date</th>
      <th>Edit</th>
      <th>Delete</th>
      <?php if($_SESSION['my_role']==3) echo '<th>Visible</th>'; ?>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!isset($posts)) {
        require 'inc/connection.php';
        if($_SESSION['my_role']==3)
          $query = "SELECT post_id, post_title, post_date, posts.user_id, user_fname, post_publish FROM posts INNER JOIN users ON posts.user_id=users.user_id ORDER BY post_date DESC";
        else
          $query = "SELECT post_id, post_title, post_date FROM posts WHERE user_id='".$_SESSION['my_uid']."' ORDER BY post_date DESC";
        $posts = mysqli_query($connection,$query);
      }
      foreach($posts as $post) {
        echo '<tr>';
        if($_SESSION['my_role']==3)
          echo '<td>'.$post['post_id'].'</td><td>'.$post['post_title'].'</td><td><a href="profile.php?uid='.$post['user_id'].'">'.$post['user_fname'].'</a></td><td>'.date_format(new DateTime($post['post_date']),'F d, Y h:i A').'</td><td><a name="btnEditAnn" href="manageannouns.php?action=editann&aid='.$post['post_id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td><td><a name="btnDelAnn" href="manageannouns.php?action=delete&aid='.$post['post_id'].'" onclick="if (! confirm(\'Are you sure to delete this announcement?\')) { return false; }"><span class="glyphicon glyphicon-trash"></span></a></td>'. ($post['post_publish']==0?'<td><a name="btnAnnEn" href="manageannouns.php?action=enable&aid='.$post['post_id'].'"><span class="glyphicon glyphicon-eye-open"></span></a></td>':'<td><a name="btnAnnDis" href="manageannouns.php?action=disable&aid='.$post['post_id'].'"><span class="glyphicon glyphicon-eye-close"></span></a></td>');
        else
          echo '<td>'.$post['post_id'].'</td><td>'.$post['post_title'].'</td><td>'.date_format(new DateTime($post['post_date']),'F d, Y h:i A').'</td><td><a name="btnEditAnn" href="manageannouns.php?action=editann&aid='.$post['post_id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td><td><a name="btnDelAnn" href="manageannouns.php?action=delete&aid='.$post['post_id'].'" onclick="if (! confirm(\'Are you sure to delete this announcement?\')) { return false; }"><span class="glyphicon glyphicon-trash"></span></a></td>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>
