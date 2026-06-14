<?php
include 'db_connection.php';
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY registration_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records | School Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .nav {
            background: white;
            border-radius: 50px;
            padding: 15px 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .nav a {
            text-decoration: none;
            color: #667eea;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .nav a:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
        }

        .table-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow-x: auto;
        }

        .table-card h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats {
            text-align: right;
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
            color: #555;
        }

        tr:hover {
            background: #f8f9ff;
            transition: 0.3s;
        }

        .empty-state {
            text-align: center;
            padding: 60px;
            color: #999;
        }

        .badge {
            background: #e8f0fe;
            color: #667eea;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            th, td {
                padding: 8px;
                font-size: 12px;
            }
            .nav a {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="register_student.php">Register Student</a>
            <a href="display_students.php">View Records</a>
            <a href="search_student.php">Search Student</a>
        </div>

        <div class="table-card">
            <h2>All Student Records</h2>
            
            <?php $count = mysqli_num_rows($result); ?>
            <div class="stats">
                <span class="badge">Total Students: <?php echo $count; ?></span>
            </div>

            <?php if($count > 0): ?>
                </table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reg Number</th>
                            <th>Full Name</th>
                            <th>Class</th>
                            <th>Parent Phone</th>
                            <th>Address</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><strong><?php echo $row['reg_number']; ?></strong></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['class']; ?></td>
                                <td><?php echo $row['parent_phone']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['registration_date'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    No students registered yet. Go to Registration page to add students.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <footer style="text-align: center; padding: 20px; margin-top: 30px; color: #888;">
    <p>© 2026 Student Management System - Tanzania Primary & Secondary Schools</p>
</footer>
</body>
</html>