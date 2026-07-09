<?php
    include  '../db.php';

    $quary = "SELECT * FROM alumni WHERE status = 'pending'";
    $result = mysqli_query($conn, $quary);

    if(!$result){
        die("Data Base quary failed: ".mysqli_error($conn));
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Success Directory</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css"  href="style.css">
    <script src="script.js" defer></script>
</head>

<body>

    <div class="topbar">
      <div class="topbar-title" id="topTitle">Admin Dashboard<em> - Pending Submissions</em></div>
    </div>

    <div class="tab-panel" id="tab-pending">
        <div class="sec-box">
          <div class="tbl-toolbar">
            <span class="tbl-info" id="pendInfo"></span>
          </div>
          <br><br>
          <table>
            <thead>
              <tr><th>Name</th><th>Role &middot; Company</th><th>Student ID</th><th>Year</th><th>Proof Document</th><th>Actions</th></tr>
            </thead>
            <tbody id="pendBody">
              <?php if(mysqli_num_rows($result) > 0): ?>
                  <?php while($row = mysqli_fetch_assoc($result)): ?>
                      <tr>
                          <td><span class="alum-name"><?php echo htmlspecialchars($row['full_name']); ?></span></td>
                          <td><span class="alum-role"><?php echo htmlspecialchars($row['job_title']); ?></span> &middot; <span class="alum-company"><?php echo htmlspecialchars($row['company']); ?></span></td>
                          <td><?php echo htmlspecialchars(!empty($row['student_id']) ? $row['student_id'] : 'N/A'); ?></td>
                          <td><span class="year-badge"><?php echo htmlspecialchars($row['graduation_year']); ?></span></td>
                          <td>
                              <?php if (!empty($row['document_path'])): ?>
                                  <a href="../<?php echo htmlspecialchars($row['document_path']); ?>" target="_blank" style="color:#C9A84C;">View PDF</a>
                              <?php else: ?>
                                  N/A
                              <?php endif; ?>
                          </td>
                          <td>
                              <button class="btn-approve" onclick="setStatus(<?php echo isset($row['id']) ? $row['id'] : 0; ?>, 'approved')">Approve</button>
                              <button class="btn-reject" onclick="setStatus(<?php echo isset($row['id']) ? $row['id'] : 0; ?>, 'rejected')">Reject</button>
                          </td>
                      </tr>
                  <?php endwhile; ?>
              <?php else: ?>
                  <tr><td colspan="6" style="text-align: center;">No Pending Submissions Found</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
    </div>
<br> <br> <br> <br>
<!-- --------------------------------------------------------------------------------------------------------------------- -->   

<!-- -- Footer ------------------------------- -->
    <?php 
        include "../Header_Footer\Footer.php";
     ?>

</body>
</html>