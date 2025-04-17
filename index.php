<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK YOUR APPOINTMENT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="left-section">
                <div class="doctor-image">
                    <img src="doctor_image.jpg" alt="Doctor">
                    <div class="ask-doctor">
                        <p>Ask the<br>doctor?</p>
                    </div>
                </div>
                <div class="choose-doctor-button">
                    <p>Choose a doctor...</p>
                </div>
            </div>
            
            <div class="form-section">
                <h1>BOOK YOUR APPOINTMENT.......</h1>
                
                <form action="process_form.php" method="POST">
                    <div class="form-group">
                        <label for="doctor">Choose Doctor</label>
                        <input type="text" id="doctor" name="doctor" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="disease">Disease</label>
                        <input type="text" id="disease" name="disease" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" id="amount" name="amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <input type="text" id="sex" name="sex" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="question">Your Question</label>
                        <textarea id="question" name="question" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-group submit-container">
                        <button type="submit" class="submit-btn">SUBMIT</button>
                    </div>
                </form>
            </div>
            
            <div class="right-section">
                <div class="pills-image">
                    <img src="https://t4.ftcdn.net/jpg/02/60/04/09/360_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg" alt="Pills and herbs">
                </div>
                <div class="ayurveda-text">
                    <p>Because we cannot undo our inner body we need to learn a few skills to help cleanse our natural organs and mind. This is the art of Ayurveda.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>