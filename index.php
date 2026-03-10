<?php
session_start();

// 1. Database Connection
$server = "127.0.0.1";
$username = "root";
$password = "";
$database = "trip_db";

$con = mysqli_connect($server, $username, $password, $database);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}

//  Catches the data only if the form was submitted
if(isset($_POST['name'])){
    
    // Grabs the data from the Tailwind form
    $name = $_POST['name'];
    $age = $_POST['age']; 
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc']; // Your textarea is named 'desc'

    //  Drafts the SQL Query (mapping $desc to the `other` column)
    $sql = "INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) 
            VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";

    //  Executes and Checks the Query
   if($con->query($sql) == true){
        // Store the success flag securely in the Session memory
        $_SESSION['success'] = true; 
        
        $con->close(); 
        
        // Redirect to a completely clean URL with no extra text
        header("Location: first.php");
        exit(); 
        
    } else {
        echo "ERROR: $sql <br> $con->error";
        $con->close();
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Kashmir Trip Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-fixed relative"
      style="background-image: url('https://gadyalkashmir.com/wp-content/uploads/2025/12/university-of-kashmir-srinagar-253239.jpg');">

    <div class="absolute inset-0 bg-black/40 z-0"></div>

    <div class="relative z-10 backdrop-blur-xl bg-white/10 p-8 sm:p-10 w-full max-w-lg rounded-3xl shadow-[0_8px_32px_0_rgba(0,0,0,0.37)] border border-white/20">

        <h1 class="text-3xl font-extrabold text-white text-center mb-2 tracking-wide drop-shadow-lg">
            University of Kashmir Trip Form
        </h1>

        <?php
        // Check if the success flag exists in Session memory
        if(isset($_SESSION['success']) && $_SESSION['success'] == true){
            echo "<p class='text-center text-green-400 font-bold mb-4 drop-shadow-md bg-green-900/30 py-2 rounded-lg'>Successfully registered for the trip!</p>";
            
            // Delete the flag! The next time you refresh, it will be gone.
            unset($_SESSION['success']); 
        }
        ?>

        <p class="text-center text-gray-200 mb-8 text-sm font-medium drop-shadow-md">
            Please fill in your details below to confirm your participation.
        </p>

        <form action="first.php" method="post" class="space-y-5">
            
            <input type="text" name="name" placeholder="Enter your full name" required
                class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/20 rounded-xl px-4 py-3 transition-all duration-300 shadow-inner">

            <input type="number" name="age" placeholder="Enter your age" required
                class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/20 rounded-xl px-4 py-3 transition-all duration-300 shadow-inner">

            <input type="text" name="gender" placeholder="Enter your gender" required
                class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/20 rounded-xl px-4 py-3 transition-all duration-300 shadow-inner">

            <input type="email" name="email" placeholder="Enter your email address" required
                class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/20 rounded-xl px-4 py-3 transition-all duration-300 shadow-inner">

            <input type="tel" name="phone" placeholder="Enter your phone number" required
                class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/20 rounded-xl px-4 py-3 transition-all duration-300 shadow-inner">

            <textarea name="desc" rows="3" placeholder="Any other information?"
                class="w-full bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/20 rounded-xl px-4 py-3 transition-all duration-300 shadow-inner resize-none"></textarea>

            <div class="flex gap-4 pt-2">
                <button type="submit"
                    class="w-1/2 bg-blue-600/80 hover:bg-blue-600 text-white font-bold py-3 rounded-xl backdrop-blur-sm border border-blue-500/50 transition-all duration-300 shadow-lg hover:shadow-blue-500/30">
                    Submit
                </button>

                <button type="reset"
                    class="w-1/2 bg-white/10 hover:bg-white/20 text-white font-bold py-3 rounded-xl backdrop-blur-sm border border-white/20 transition-all duration-300 shadow-lg">
                    Reset
                </button>
            </div>

        </form>
    </div>

</body>
</html>