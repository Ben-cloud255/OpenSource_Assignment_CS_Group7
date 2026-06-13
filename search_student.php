<?php
include 'db_connection.php';
$student = null;
$searched = false;

if (isset($_GET['reg_number']) && !empty($_GET['reg_number'])) {
    $searched = true;
    $reg_number = $_GET['reg_number'];
    $sql = "SELECT * FROM students WHERE reg_number = '$reg_number'";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student | School Management System</title>
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
            max-width: 800px;
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

        .search-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .search-card h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .search-box input {
            flex: 1;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-box button {
            padding: 14px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-box button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .result-card {
            background: #f8f9ff;
            border-radius: 15px;
            padding: 25px;
            margin-top: 20px;
            border: 1px solid #e0e0e0;
        }

        .result-card h3 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 22px;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-label {
            width: 140px;
            font-weight: 600;
            color: #555;
        }

        .info-value {
            flex: 1;
            color: #333;
        }

        .not-found {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        @media (max-width: 768px) {
            .search-card {
                padding: 25px;
            }
            .info-label {
                width: 110px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="register_student.php"> Register Student</a>
            <a href="display_students.php">View Records</a>
            <a href="search_student.php"> Search Student</a>
        </div>

        <div class="search-card">
            <h2>Search Student</h2>
            
            <form method="GET" class="search-box">
                <input type="text" name="reg_number" placeholder="Enter registration number (e.g., TZ/2024/001)" value="<?php echo isset($_GET['reg_number']) ? htmlspecialchars($_GET['reg_number']) : ''; ?>" required>
                <button type="submit">Search →</button>
            </form>

            <?php if($searched): ?>
                <?php if($student): ?>
                    <div class="result-card">
                        <h3>✅ Student Found</h3>
                        <div class="info-row">
                            <div class="info-label"> Registration Number</div>
                            <div class="info-value"><strong><?php echo $student['reg_number']; ?></strong></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Full Name</div>
                            <div class="info-value"><?php echo $student['full_name']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Class</div>
                            <div class="info-value"><?php echo $student['class']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Parent Phone</div>
                            <div class="info-value"><?php echo $student['parent_phone']; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Address</div>
                            <div class="info-value"><?php echo $student['address'] ?: 'Not provided'; ?></div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Registration Date</div>
                            <div class="info-value"><?php echo date('d/m/Y H:i', strtotime($student['registration_date'])); ?></div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="not-found">
                         No student found with registration number: <strong><?php echo htmlspecialchars($_GET['reg_number']); ?></strong>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>