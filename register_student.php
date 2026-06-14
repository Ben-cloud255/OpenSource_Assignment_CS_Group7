<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reg_number = $_POST['reg_number'];
    $full_name = $_POST['full_name'];
    $class = $_POST['class'];
    $parent_phone = $_POST['parent_phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO students (reg_number, full_name, class, parent_phone, address) 
            VALUES ('$reg_number', '$full_name', '$class', '$parent_phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        $success = "✅ Student registered successfully!";
    } else {
        $error = "❌ Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student | School Management System</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navigation Bar - White */
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

        /* Form Card - White */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .form-card h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .alert {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 25px;
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

        <div class="form-card">
            <h2>Student Registration Form</h2>
            
            <?php if(isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label>Registration Number</label>
                    <input type="text" name="reg_number" placeholder="e.g., TZ/2024/001" required>
                </div>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter student's full name" required>
                </div>

                <div class="form-group">
                    <label>Class</label>
                    <input type="text" name="class" placeholder="e.g., Form 2A, Standard 5" required>
                </div>

                <div class="form-group">
                    <label>Parent/Guardian Phone</label>
                    <input type="tel" name="parent_phone" placeholder="e.g., 0712345678" required>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" placeholder="Enter student's home address"></textarea>
                </div>

                <button type="submit">Register Student</button>
            </form>
        </div>
    </div>
    <footer style="text-align: center; padding: 20px; margin-top: 30px; color: #888;">
    <p>© 2026 Student Management System - Tanzania Primary & Secondary Schools</p>
</footer>
</body>
</html>