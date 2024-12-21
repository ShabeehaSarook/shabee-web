<?php
include 'connection.php'; // Database connection

// Handle Reservation Addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['edit-id'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $party_size = $_POST['party_size'];
    $table_id = $_POST['table_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO reservations (date, time, party_size, table_id, status)
            VALUES ('$date', '$time', '$party_size', '$table_id', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "New reservation added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: admin_reservation_management.php"); // Redirect to avoid form resubmission
    exit();
}

// Handle Reservation Editing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-id'])) {
    $id = $_POST['edit-id'];
    $date = $_POST['edit-date'];
    $time = $_POST['edit-time'];
    $party_size = $_POST['edit-party-size'];
    $table_id = $_POST['edit-table-id'];
    $status = $_POST['edit-status'];

    $sql = "UPDATE reservations SET 
            date='$date', 
            time='$time', 
            party_size='$party_size', 
            table_id='$table_id', 
            status='$status' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: manage-order&reserve.php"); // Redirect to avoid form resubmission
    exit();
}

// Handle Reservation Search
$search_query = "";
if (isset($_POST['search-input'])) {
    $search_term = $_POST['search-input'];
    $search_query = "WHERE date LIKE '%$search_term%' OR table_id LIKE '%$search_term%'";
}

$query = "SELECT * FROM reservations $search_query";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Reservation Management</title>
  <style>
     body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: url('admin1.jpg') no-repeat center center fixed;
      background-size: cover;
      padding: 0;
      color: #333;
      background-color: rgba(0, 0, 0, 0.1);
    }
    .navbar {
      overflow: hidden;
      background-color: #333;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      animation: slideDown 0.5s ease-in-out;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }
    .navbar a {
      color: #d4a373;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
      font-size: 17px;
      transition: background-color 0.3s, color 0.3s;
    }
    .navbar a:hover {
      background-color: #ddd;
      color: #333;
    }
    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
      color: #d4a373;
    }
    @keyframes slideDown {
      from { top: -50px; }
      to { top: 0; }
    }
    .content {
      padding: 20px;
      margin: 80px auto 0;
      max-width: 1200px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      background-color: white;
    }
    h1 {
      color: #d4a373;
      text-align: center;
      margin-bottom: 20px;
    }
    #reservation-list {
      margin-top: 40px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    table th {
      background-color: #f2f2f2;
    }
    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin: 5px;
      font-size: 14px;
      transition: background-color 0.3s, transform 0.2s;
    }
    .btn:hover {
      transform: scale(1.05);
    }
    .edit-btn {
      background-color: #4CAF50;
      color: white;
    }
    .cancel-btn {
      background-color: #f44336;
      color: white;
    }
    .confirm-btn {
      background-color: #008CBA;
      color: white;
    }
    .add-btn {
      background-color: #4CAF50;
      color: white;
    }
    .search-bar {
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .search-bar input {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 250px;
    }
    .search-bar button {
      padding: 10px;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #4CAF50;
      color: white;
      transition: background-color 0.3s;
    }
    .search-bar button:hover {
      background-color: #45a049;
    }
    .pagination {
      display: flex;
      justify-content: center;
      list-style: none;
      padding: 0;
    }
    .pagination li {
      margin: 0 5px;
    }
    .pagination button {
      padding: 8px 12px;
      border: 1px solid #ddd;
      background-color: white;
      cursor: pointer;
      border-radius: 5px;
      font-size: 14px;
    }
    .pagination button:hover {
      background-color: #ddd;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1001;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
      padding-top: 60px;
    }
    .modal-content {
      background-color: white;
      margin: 5% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    .modal-content form {
      display: flex;
      flex-direction: column;
    }
    .modal-content form input {
      margin-bottom: 10px;
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .modal-content form button {
      padding: 10px;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #4CAF50;
      color: white;
      transition: background-color 0.3s;
    }
    .modal-content form button:hover {
      background-color: #45a049;
    }
    footer {
      text-align: center;
      padding: 10px;
      background-color: #333;
      color: #d4a373;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    footer a {
      color: #d4a373;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div class="logo">Admin reservation management system </div>
    <a href="admin-dashboard.php">Admin</a>
  </div>

  <div class="content">
    <h1>Admin Reservation Management</h1>
    <div class="search-bar">
      <form method="POST" action="">
        <input type="text" name="search-input" id="search-input" placeholder="Search by date or table ID">
        <button type="submit" class="btn add-btn">Search</button>
      </form>
      <button class="btn add-btn" onclick="openAddModal()">Add Reservation</button>
    </div>
    <div id="reservation-list">
      <h2>Reservations:</h2>
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
           
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="reservation-tbody">
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row['date'] . "</td>";
                  echo "<td>" . $row['time'] . "</td>";
                  
                  echo "<td>
                          <button class='btn edit-btn' onclick='openEditModal(" . $row['id'] . ")'>Edit</button>
                          <button class='btn cancel-btn' onclick='cancelReservation(" . $row['id'] . ")'>Cancel</button>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No reservations found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
    <ul class="pagination">
      <!-- pagination buttons will be generated here -->
    </ul>
  </div>

  <!-- Modal for editing reservations -->
  <div id="edit-modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id="edit-form" method="POST" action="">
        <input type="hidden" name="edit-id" id="edit-id">
        <label for="edit-date">Date:</label>
        <input type="date" name="edit-date" id="edit-date" required>
        <label for="edit-time">Time:</label>
        <input type="time" name="edit-time" id="edit-time" required>
        <label for="edit-party-size">Party Size:</label>
        <input type="number" name="edit-party-size" id="edit-party-size" required>
        <label for="edit-table-id">Table ID:</label>
        <input type="text" name="edit-table-id" id="edit-table-id" required>
        <label for="edit-status">Status:</label>
        <select name="edit-status" id="edit-status" required>
          <option value="Confirmed">Confirmed</option>
          <option value="Pending">Pending</option>
          <option value="Cancelled">Cancelled</option>
        </select>
        <button type="submit" class="btn edit-btn">Save Changes</button>
      </form>
    </div>
  </div>

  <!-- Modal for adding reservations -->
  <div id="add-modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id="add-form" method="POST" action="">
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <label for="time">Time:</label>
        <input type="time" name="time" id="time" required>
        <label for="party-size">Party Size:</label>
        <input type="number" name="party_size" id="party-size" required>
        <label for="table-id">Table ID:</label>
        <input type="text" name="table_id" id="table-id" required>
        <label for="status">Status:</label>
        <select name="status" id="status" required>
          <option value="Confirmed">Confirmed</option>
          <option value="Pending">Pending</option>
          <option value="Cancelled">Cancelled</option>
        </select>
        <button type="submit" class="btn add-btn">Add Reservation</button>
      </form>
    </div>
  </div>

  <footer>
    &copy; 2023 Admin reservation management system. All rights reserved. 
    <br>
    <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
  </footer>

  <script>
    function openEditModal(id) {
      // Fetch data using AJAX or directly populate the modal with existing data
      document.getElementById('edit-id').value = id;
      // Populate other fields
      document.getElementById('edit-modal').style.display = "block";
    }

    function openAddModal() {
      document.getElementById('add-modal').style.display = "block";
    }

    function cancelReservation(id) {
      if (confirm("Are you sure you want to cancel this reservation?")) {
        window.location.href = "cancel_reservation.php?id=" + id;
      }
    }

    // Close modal on clicking the close button or outside the modal
    document.querySelectorAll('.close').forEach(function(element) {
      element.onclick = function() {
        document.getElementById('edit-modal').style.display = "none";
        document.getElementById('add-modal').style.display = "none";
      };
    });
    window.onclick = function(event) {
      if (event.target == document.getElementById('edit-modal')) {
        document.getElementById('edit-modal').style.display = "none";
      }
      if (event.target == document.getElementById('add-modal')) {
        document.getElementById('add-modal').style.display = "none";
      }
    };
  </script>
</body>
</html>
