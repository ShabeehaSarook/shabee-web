<?php
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $date = $_POST['date'];
    $time = $_POST['time'];
    $partySize = $_POST['party-size'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO reservations (date, time, party_size) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $date, $time, $partySize);

    // Execute the query
    if ($stmt->execute()) {
        $message = "Reservation added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement and connections
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table Reservation System</title>
  <style>
  body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      color: #d4a373; /* Changed text color */
    }
    .navbar {
      overflow: hidden;
      background-color: rgba(0, 0, 0, 0.9); /* Updated background color */
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      animation: slideDown 0.5s ease-in-out;
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 80px; /* Increased height for larger navbar */
      padding: 0 20px; /* Added padding for left and right spacing */
    }

    .navbar a {
      float: left;
      display: block;
      color: #d4a373; /* Changed text color */
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
      font-size: 20px; /* Increased font size */
      transition: background-color 0.3s;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    .order-btn {
      background-color: #d4a373; /* New button color */
      color: #fff;
      border: none;
      padding: 14px 20px;
      cursor: pointer;
      font-size: 17px;
      position: fixed;
      bottom: 20px;
      right: 20px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .order-btn:hover {
      background-color: #b59063;
    }

    @keyframes slideDown {
      from {
        top: -80px; /* Adjusted for larger navbar */
      }
      to {
        top: 0;
      }
    }

    .background-image {
      background-image: url("Coffee time instagram post.png"); /* Replace with your background image URL */
      background-size: cover;
      background-position: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    .content {
      padding: 20px;
      margin: 100px auto 0; /* Adjusted for larger navbar */
      max-width: 800px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      position: relative;
      z-index: 1;
    }

    h1 {
      color: #d4a373; /* Changed text color */
      text-align: center;
      margin-bottom: 20px;
    }

    #reservation-form {
      max-width: 400px;
      margin: 40px auto;
      padding: 20px;
      background-color: rgba(84, 45, 4, 0.227);
      border: 1px solid #ddd;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #reservation-form label {
      display: block;
      margin-bottom: 10px;
      color: #d4a373; /* Changed text color */
    }

    #reservation-form input[type="date"],
    #reservation-form input[type="time"],
    #reservation-form input[type="number"] {
      width: calc(100% - 22px);
      height: 40px;
      margin-bottom: 20px;
      padding: 10px;
      background-color: rgba(250, 133, 9, 0.227);
      border-radius: 5px;
      font-size: 1rem;
      color: #d4a373; /* Changed text color */
    }

    #reservation-form button[type="submit"] {
      width: 100%;
      height: 40px;
      background-color: #4CAF50;
      color: #f2ede8; /* Changed text color */
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
    }

    #reservation-form button[type="submit"]:hover {
      background-color: #3e8e41;
    }

    #table-list,
    #reservation-list {
      margin-top: 40px;
    }

    #table-ul,
    #reservation-ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    #table-ul li,
    #reservation-ul li {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      background-color: rgba(84, 45, 4, 0.227);
      color: #d4a373; /* Changed text color */
    }

    #table-ul li:hover,
    #reservation-ul li:hover {
      background-color: #3a2504;
    }

    #table-ul li table,
    #reservation-ul li table {
      width: 100%;
      border-collapse: collapse;
    }

    #table-ul li table th,
    #reservation-ul li table th {
      background-color: rgba(247, 130, 5, 0.227);
      padding: 10px;
      text-align: left;
      color: #d4a373; /* Changed text color */
    }

    #table-ul li table td,
    #reservation-ul li table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      color: #d4a373; /* Changed text color */
    }

    /* Additional styles for the footer */
    footer {
      background-color: #333;
      color: #d4a373; /* Changed text color */
      text-align: center;
      padding: 20px;
      position: relative;
      bottom: 0;
      width: 100%;
    }

    footer a {
      color: #d4a373; /* Changed text color */
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    /* Style for form feedback messages */
    .feedback-message {
      color: #4CAF50;
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
    }

    /* Style for error messages */
    .error-message {
      color: #ff0000;
      font-weight: bold;
      text-align: center;
      margin-top: 20px;

    }
    .order-button:hover {
    background-color: #bfa06a;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
}
.order-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #d4a373;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    text-align: center;

}
.order-button a {
text-decoration:none ;
color: white;
}
  </style>
</head>
<body>
  <div class="navbar">
  <li><a href="index.php">home</a></li>
    <!-- Your navbar content here -->
  </div>

  <div class="background-image"></div>
  <div class="content">
    <h1>Table Reservation System</h1>
    <?php if (isset($message)) : ?>
      <div class="feedback-message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form id="reservation-form" action="" method="POST">
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" required>
      <label for="time">Time:</label>
      <input type="time" id="time" name="time" required>
      <label for="party-size">Party Size:</label>
      <input type="number" id="party-size" name="party-size" required>
      <button type="submit">Make Reservation</button>
    </form>
    <div id="table-list">
      <h2>Available Tables:</h2>
      <ul id="table-ul">
        <!-- Table list will be generated here -->
      </ul>
    </div>
    <div id="reservation-list">
      <h2>Reservations:</h2>
      <ul id="reservation-ul">
        <!-- Reservation list will be generated here -->
      </ul>
    </div>
  </div>

  <script>
     
    const tableList = document.getElementById('table-ul');
    const reservationList = document.getElementById('reservation-ul');
    const reservationForm = document.getElementById('reservation-form');
    const orderBtn = document.getElementById('orderBtn');

    // Hardcoded tables and reservations for demo purposes
    let tables = [
      { id: 1, chairs: 8, location: 'Window', capacity: 'Large' },
      { id: 2, chairs: 6, location: 'Center', capacity: 'Medium' },
      { id: 3, chairs: 4, location: 'Corner', capacity: 'Small' },
      { id: 4, chairs: 2, location: 'Private', capacity: 'Couple' }
    ];

    let reservations = [];

    function renderTables() {
      tableList.innerHTML = '';
      tables.forEach(table => {
        const li = document.createElement('li');
        li.innerHTML = `
          <table>
            <tr>
              <th>Table ID</th>
              <th>Chairs</th>
              <th>Location</th>
              <th>Capacity</th>
            </tr>
            <tr>
              <td>${table.id}</td>
              <td>${table.chairs}</td>
              <td>${table.location}</td>
              <td>${table.capacity}</td>
            </tr>
          </table>
        `;
        tableList.appendChild(li);
      });
    }

    function renderReservations() {
      reservationList.innerHTML = '';
      reservations.forEach((reservation, index) => {
        const li = document.createElement('li');
        li.innerHTML = `
          <table>
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Party Size</th>
              <th>Actions</th>
            </tr>
            <tr>
              <td>${reservation.date}</td>
              <td>${reservation.time}</td>
              <td>${reservation.partySize}</td>
              <td>
                <button onclick="editReservation(${index})">Edit</button>
                <button onclick="deleteReservation(${index})">Delete</button>
              </td>
            </tr>
          </table>
        `;
        reservationList.appendChild(li);
      });
    }

    function addReservation(event) {
      event.preventDefault();
      const date = document.getElementById('date').value;
      const time = document.getElementById('time').value;
      const partySize = document.getElementById('party-size').value;
      reservations.push({ date, time, partySize });
      renderReservations();
      reservationForm.reset();
      document.getElementById('feedback').textContent = 'Reservation added successfully!';
    }

    function editReservation(index) {
      const reservation = reservations[index];
      document.getElementById('date').value = reservation.date;
      document.getElementById('time').value = reservation.time;
      document.getElementById('party-size').value = reservation.partySize;
      reservations.splice(index, 1);
      renderReservations();
    }

    function deleteReservation(index) {
      reservations.splice(index, 1);
      renderReservations();
    }

    reservationForm.addEventListener('submit', addReservation);
    renderTables();
    renderReservations();

    // Add event listener to the Order Parking button
    orderBtn.addEventListener('click', () => {
      window.location.href = 'parking.php';
    });
  </script>
  </script>
<footer>
<div class="order-button">
            <a href="parking.php">Parking</a>
        </div>
</footer>
  
</body>
</html>
