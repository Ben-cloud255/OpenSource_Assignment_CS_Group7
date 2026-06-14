<?php
include 'db_connection.php';
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY registration_date DESC");

// Get additional stats
$total_students = mysqli_num_rows($result);

// Get class distribution (optional - shows how many students per class)
$class_query = "SELECT class, COUNT(*) as count FROM students GROUP BY class";
$class_result = mysqli_query($conn, $class_query);
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

        /* Stats Dashboard */
        .stats-dashboard {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 20px 30px;
            text-align: center;
            min-width: 150px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: white;
        }

        .stat-label {
            font-size: 14px;
            color: rgba(255,255,255,0.9);
            margin-top: 5px;
        }

        .class-stats {
            background: #f8f9ff;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .class-badge {
            background: white;
            border: 1px solid #667eea;
            border-radius: 20px;
            padding: 8px 15px;
            color: #667eea;
            font-size: 13px;
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

        @media (max-width: 768px) {
            th, td {
                padding: 8px;
                font-size: 12px;
            }
            .stat-card {
                padding: 15px 20px;
                min-width: 120px;
            }
            .stat-number {
                font-size: 28px;
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
            <h2>Student Records Dashboard</h2>
            
            <!-- Stats Dashboard -->
            <div class="stats-dashboard">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $total_students; ?></div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo mysqli_num_rows($class_result); ?></div>
                    <div class="stat-label">Different Classes</div>
                </div>
            </div>

            <!-- Class Distribution -->
            <?php if($total_students > 0): ?>
            <div class="class-stats">
                <?php 
                mysqli_data_seek($class_result, 0);
                while($class = mysqli_fetch_assoc($class_result)): 
                ?>
                    <span class="class-badge">📚 <?php echo $class['class']; ?>: <?php echo $class['count']; ?> students</span>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <h3 style="margin: 20px 0 15px 0; color: #555;">Student Records Table</h3>

            <?php if($total_students > 0): ?>
                <table>
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
                        <?php 
                        mysqli_data_seek($result, 0);
                        while($row = mysqli_fetch_assoc($result)): 
                        ?>
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
</body>
</html>