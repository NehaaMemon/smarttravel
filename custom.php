<?php
include 'header.php';
?>

<style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fb;
        }
        .vacancy-container {
            width: 90%;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .vacancy-content .button-primary {
    margin-top: 10px;
    margin-left: -138px;
}
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-lg-7, .col-lg-5 {
            padding: 20px;
        }
        .col-lg-7 {
            flex: 1 1 60%;
        }
        .col-lg-5 {
            flex: 1 1 40%;
            background-color: #f0f3f7;
            display: flex;
            align-items: center;
            justify-content: center;
            border-left: 1px solid #eee;
        }
        .vacancy-content-wrap {
            padding: 30px;
        }
        .vacancy-content {
            margin-bottom: 30px;
        }
        input[type="text"], select {
            width: 90%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, select:focus {
            border-color: #4CAF50;
        }
        input[type="submit"] {
            width: 50%;
            padding: 12px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #e64a19;
        }
        .vacancy-form img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        @media (max-width: 768px) {
            .col-lg-7, .col-lg-5 {
                flex: 1 1 100%;
            }
        }

        .people-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .people-options button, .people-options input {
            width: 50px;
            height: 50px;
            background-color: white;
            border: 2px solid #333;
            border-radius: 50%;
            font-size: 16px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-align: center;
        }
        .days-options {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .days-options button, .days-options input {
            width: 50px;
            height: 50px;
            background-color: white;
            font-size: 16px;
            border:0px ;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-align: center;
        }
        .days-options button:hover, .days-options button.active {
            background-color: #333;
            color: white;
        }
        .people-options button:hover, .people-options button.active {
            background-color: #333;
            color: white;
        }
        .people-options input {
            display: none;
            border-radius: 5px;
            padding: 5px;
            width: 60px;
            height: auto;
            font-size: 16px;
        }
        .custom-input {
            margin-top: 15px;
        }

        .activity-boxes {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .activity-box {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border: 2px solid #333;
            border-radius: 8px;
            text-align: center;
            background-color: white;
            color: #333;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            flex-basis: calc(33% - 20px); /* Adjust for box sizing and gap */
        }
        .activity-box:hover {
            background-color: #e0e0e0;
        }
        .activity-box.selected {
            background-color: #333;
            color: white;
        }
        .icon {
            margin-right: 10px;

        }
        .meal-options {
           display: flex;
           justify-content: space-around;

        }

.meal-option {
    border: 1px solid #000;
    padding: 9px;
    margin: 10px;
    text-align: center;
    width: 150px;
    font-family: Arial, sans-serif;
    background-color: white;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s;
    border-radius: 5px;
    outline: none;
}

.meal-option h4 {
    margin-bottom: 10px;
    font-size: 17px;

}

.meal-option p {
    font-size: 14px;
    color: #666;
}

/* Hover and active styles */
.meal-option:hover {
    background-color: #f0f0f0;
    border-color: #333;
}

.meal-option:active {
    background-color: #ddd;
}

.right-side-div {
    background-color:white !important;
}
.transport button{
    background-color: white;
}
.transport button:hover{
    background-color: #f0f0f0;
    border-color: #333;
}

    </style>




<?php
// Exchange rates (can be dynamically fetched from an API in a real-world app)
$exchangeRates = [
    'USD' => 72,  // 1 USD = 72 PKR
    'EUR' => 60,  // 1 EUR = 60 PKR
    'GBP' => 85,  // 1 GBP = 85 PKR
    'PKR' => 1    // Local currency is PKR
];

$result = '';

if (isset($_GET['btnConv'])) {
    $cur = $_GET['ddlcur'];
    $amount = $_GET['txtAmount'];

    if (!is_numeric($amount)) {
        $result = "Please enter a valid numeric amount.";
    } else {
        // Calculate converted amount
        $rate = isset($exchangeRates[$cur]) ? $exchangeRates[$cur] : null;

        if ($rate !== null) {
            $convertedAmount = $amount / $rate;
            $symbol = $cur == 'USD' ? '$' : ($cur == 'EUR' ? '€' : ($cur == 'GBP' ? '£' : '₨'));
            $result = "Converted Amount: $symbol " . number_format($convertedAmount, 2);
        } else {
            $result = "Invalid currency selected.";
        }
    }
}
?>

  <!-- Popup html start form here -->
 <div class="popup-wraper">
            <div class="popup-inner">
               <div class="popup-content">
               <h2>Currency Converter</h2>
        <form>
            <label>Enter Amount in PKR (₨):</label>
            <input type="text" name="txtAmount" required placeholder="Enter amount in PKR">
            
            <label>Select Currency:</label>
            <select name="ddlcur" required>
                <option value="USD">USD ($)</option>
                <option value="EUR">Euro (€)</option>
                <option value="GBP">GBP (£)</option>
                <option value="PKR">PKR (₨)</option>
            </select>

            <input type="submit" name="btnConv" value="Convert">
        </form>
        <?php if ($result): ?>
        <div class="result">
            <p><?php echo $result; ?></p>
        </div>
        <?php endif; ?>
               </div>

               <div class="popup-image">
                  <img src="assets/images/img52.png" alt="">
               </div>
               <div class="popup-close-btn">
                  <a href="#"></a>
               </div>
            </div>
         </div>
      </div> 
      
     

      <!-- JavaScript -->
    <script src="assets/js/jquery.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/vendors/jquery-ui/jquery-ui.min.js"></script>
      <script src="assets/vendors/countdown-date-loop-counter/loopcounter.js"></script>
      <script src="assets/js/jquery.counterup.js"></script>
      <script src="assets/vendors/modal-video/jquery-modal-video.min.js"></script>
      <script src="assets/vendors/masonry/masonry.pkgd.min.js"></script>
      <script src="assets/vendors/lightbox/dist/js/lightbox.min.js"></script>
      <script src="assets/vendors/slick/slick.min.js"></script>
      <script src="assets/js/jquery.slicknav.js"></script>
      <script src="assets/js/custom.min.js"></script> 

      <!-- js for popup  -->
  <script>
         $( document ).on( 'click', '.popup-close-btn a', function(e){
            e.preventDefault();
            $('.popup-wraper').hide();
         });
      </script> 

<main id="content" class="site-main">
            <!-- Inner Banner html start-->
            <section class="inner-banner-wrap">
               <div class="inner-baner-container" style="background-image: url(assets/images/inner-banner.jpg);">
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="inner-title">Prediction</h1>
                     </div>
                  </div>
               </div>
               <div class="inner-shape"></div>
            </section>
            <!-- Inner Banner html end-->
            <div class="carrer-page-section">
               <div class="container">
                  <div class="vacancy-section">
                     <div class="section-heading text-center">

                     
                        <div class="row">
                           <div class="col-lg-8 offset-lg-2">
                              <h5 class="dash-style">Predict Your Amount /Trip Calculator</h5>
                              <h2>CALCULATE YOUR TRIP WITH US!</h2>
                              <p>Plan your perfect adventure with ease! Use our trip calculator to estimate costs, explore options, and customize your journey. Let us help you create unforgettable travel experiences tailored to your budget and preferences.</p>
                           </div>
                        </div>
                     </div>
 

    <div class="vacancy-container">
        <div class="row">
            <div class="col-lg-7">
                <div class="vacancy-content-wrap">
                  <div class="vacancy-content">
                        <center><h5>Plan Your Custom Trip</h5></center>
                        <form method="POST">
    <h5>Step 1</h5>
    <h3>What Currency Do You Use?</h3>
    <select name="cncode" id="currencyCode" required>
        <option value="PKR">PKR (₨)</option>
        <option value="USD">USD ($)</option>
        <option value="EUR">Euro (€)</option>
        <option value="GBP">GBP (£)</option>          
    </select>
    <br><br>
    <h5>Step 2</h5>
    <h3>Where are you headed?</h3>
    <h6>*Destination must be accessible by Airplane, Train, or Bus</h6>
    
    <h4>Starting Point</h4>                     
    <input type="text" placeholder="Starting Point">
    <br>
    <h4>Destination</h4>              
    <input type="text" placeholder="Destination">
    <br>
    <h5>Step 3</h5>
<h3>How many people are coming?</h3>
<div class="people-options" id="people">
    <button type="button" onclick="selectPeople(1)">1</button>
    <button type="button" onclick="selectPeople(2)">2</button>
    <button type="button" onclick="selectPeople(3)">3</button>
    <button type="button" onclick="selectPeople(4)">4</button>
    <button type="button" onclick="selectPeople(5)">5</button>
    <button type="button" onclick="selectPeople(6)">6</button>
    <button type="button" onclick="selectPeople(7)">7</button>
    <button type="button" onclick="selectPeople(8)">8</button>
</div>

<div class="custom-input">
    <input type="number" id="customNumber" placeholder="Enter custom number" min="9">
</div>
<br>
    <h5>Step 4</h5>
    <h3>How long will you be gone for?</h3>
    <div class="days-options" id="days">
        <button type="button"  onclick="selectDays(1)">1</button>
        <button type="button"  onclick="selectDays(1)">2</button>
        <button  type="button"  onclick="selectDays(1)">3</button>
        <button  type="button"  onclick="selectDays(1)">4</button>
        <button type="button"  onclick="selectDays(1)">5</button>
        <button type="button"  onclick="selectDays(1)">6</button>
        <button type="button"  onclick="selectDays(1)">7</button>
        <button type="button"  onclick="selectDays(1)">8</button>
    </div>

    <div class="custom-input">
        <input type="number" id="days"  placeholder="Enter custom Days" min="9">
    </div>
    <br>
    <h5>Step 5</h5>
    <h3>What mode of transport do you prefer?</h3>
    <h6>*Destination must be accessible by Airplane, Train, or Bus</h6>
    <div class="row transport">
        <br>
        <div class="col-md-4" name="transport"type="button">
            <button type="button" onclick="selectTransport(1)"><img src="assets/images/plane.png" alt="" width="70%"></button>
        </div>
        <div class="col-md-4" name="transport">
            <button type="button" onclick="selectTransport(2)"><img src="assets/images/train.png" alt="" width="70%"></button>
        </div>
        <div class="col-md-4" name="transport">
            <button type="button" onclick="selectTransport(2)"><img src="assets/images/bus.png" alt="" width="70%"></button>
        </div>
    </div>       
    <br>
    <h5>Step 6</h5>
    <h3>Which type of tour do you prefer?</h3>
    <h6>*You're seeking excitement, nature, or history, there's a perfect tour for every traveler.</h6>

    <div class="activity-boxes">
    <button class="meal-option" name="ttype" type="button" onclick="selectTourType(1)">
            <span class="icon">🏟️</span> Adventure
        </button>
        <button class="meal-option" name="ttype" type="button"  onclick="selectTourType(2)">
            <span class="icon">🏞️</span> Luxury 
        </button>
        <button class="meal-option" name="ttype" type="button" onclick="selectTourType(3)">
            <span class="icon">🏕️</span> Hiking 
        </button>
        <button class="meal-option" name="ttype" type="button" onclick="selectTourType(4)">
            <span class="icon">🏛️</span> Historical 
        </button>
        <button class="meal-option" name="ttype" type="button" onclick="selectTourType(5)">
            <span class="icon">🏡</span> Cultural
        </button>
      
        <button class="meal-option" name="ttype" type="button" onclick="selectTourType(6)"> 
             <span class="icon">🏖️</span> Beach</button>
      
    </div>
    <br>
    <h5>Step 7</h5>
    <h3>How are you handling meals?</h3>

    <div class="meal-options">
        <button class="meal-option" name="meal" type="button"  onclick="selectMeal(1)">
            <h4>EATING IN</h4>
            <p>Making most meals</p>
        </button>
        <button class="meal-option" name="meal" type="button"  onclick="selectMeal(2)">
            <h4>EATING IN & OUT</h4>
            <p>Cooking but also eating out</p>
        </button>
        <button class="meal-option" name="meal" type="button"  onclick="selectMeal(3)">
            <h4>EATING OUT</h4>
            <p>Mainly eating at restaurants</p>
        </button>
    </div>

    <p class="full-width">
        <center> 
        <button type="button"  class="button-primary"onclick="runCalculation()">Calculate</button>
        </center>
    </p>
</form>

<br><br>
<h3>Predict Amount:</h3>
<div class="activity-box" id="activity-box">
    <div id="total-amount">0</div>
</div>

                   

                      </form>
                      </div>
         
                 </div>
                </div>       

                
</form>

<script>
    function runCalculation() {
        // Get the selected currency value
        const selectedCurrency = document.getElementById("currencyCode").value;
        
        // Run different functions based on the selected currency
        if (selectedCurrency === "PKR") {
            calculateInPKR();
        } else if (selectedCurrency === "USD") {
            calculateInUSD();
        } else if (selectedCurrency === "EUR") {
            calculateInEUR();
        } else if (selectedCurrency === "GBP") {
            calculateInGBP();
        }
    }

    let selectedPeople = 1; // Default value if no button is clicked
let selectedDays = 5;   // Set this value according to your requirement
let selectedTourType = 1; // Default to Standard Tour
let selectedMeal = 1; // Default to No Meal
let selectedTransport = 1; // Default to Economy Transport

// Function to set the number of people based on the button click
function selectPeople(people) {
    selectedPeople = people;
}

// Function to set the tour type based on the button click
function selectTourType(type) {
    selectedTourType = type;
}

// Function to set the meal option based on the button click
function selectMeal(meal) {
    selectedMeal = meal;
}

// Function to set the transport option based on the button click
function selectTransport(transport) {
    selectedTransport = transport;
}

// Function to calculate the total amount in PKR
function calculateInPKR() {
    let customPeople = document.getElementById('customNumber').value;

    if (customPeople >= 9) {
        selectedPeople = parseInt(customPeople);
    }

    const perperson = 7000; // cost per person
    const perDayRate = 8000; // cost per day

    const tourRates = {
        1: 10000, // Standard
        2: 15000  // Deluxe
    };

    const mealRates = {
        1: 0,     // No Meal
        2: 6500,  // Standard Meal
        3: 9500   // Deluxe Meal
    };

    const transportRates = {
        1: 9000,  // Economy
        2: 15000  // Business
    };

    let totalAmount = selectedPeople * perperson +
                      selectedDays * perDayRate +
                      tourRates[selectedTourType] +
                      mealRates[selectedMeal] +
                      transportRates[selectedTransport];

    document.getElementById('total-amount').innerText = "PKR: ₨ " + totalAmount;
}

// Function to calculate the total amount in USD
function calculateInUSD() {
    let customPeople = document.getElementById('customNumber').value;

    if (customPeople >= 9) {
        selectedPeople = parseInt(customPeople);
    }

    const perperson = 50; // cost per person
    const perDayRate = 60; // cost per day

    const tourRates = {
        1: 70,  // Standard
        2: 100  // Deluxe
    };

    const mealRates = {
        1: 0,   // No Meal
        2: 45,  // Standard Meal
        3: 65   // Deluxe Meal
    };

    const transportRates = {
        1: 55,  // Economy
        2: 95   // Business
    };

    let totalAmount = selectedPeople * perperson +
                      selectedDays * perDayRate +
                      tourRates[selectedTourType] +
                      mealRates[selectedMeal] +
                      transportRates[selectedTransport];

    document.getElementById('total-amount').innerText = "USD: $ " + totalAmount;
}

// Function to calculate the total amount in EUR
function calculateInEUR() {
    let customPeople = document.getElementById('customNumber').value;

    if (customPeople >= 9) {
        selectedPeople = parseInt(customPeople);
    }

    const perperson = 45; // cost per person
    const perDayRate = 55; // cost per day

    const tourRates = {
        1: 65,  // Standard
        2: 95   // Deluxe
    };

    const mealRates = {
        1: 0,   // No Meal
        2: 40,  // Standard Meal
        3: 60   // Deluxe Meal
    };

    const transportRates = {
        1: 50,  // Economy
        2: 90   // Business
    };

    let totalAmount = selectedPeople * perperson +
                      selectedDays * perDayRate +
                      tourRates[selectedTourType] +
                      mealRates[selectedMeal] +
                      transportRates[selectedTransport];

    document.getElementById('total-amount').innerText = "EUR: € " + totalAmount;
}

// Function to calculate the total amount in GBP
function calculateInGBP() {
    let customPeople = document.getElementById('customNumber').value;

    if (customPeople >= 9) {
        selectedPeople = parseInt(customPeople);
    }

    const perperson = 40; // cost per person
    const perDayRate = 50; // cost per day

    const tourRates = {
        1: 60,  // Standard
        2: 90   // Deluxe
    };

    const mealRates = {
        1: 0,   // No Meal
        2: 35,  // Standard Meal
        3: 55   // Deluxe Meal
    };

    const transportRates = {
        1: 45,  // Economy
        2: 85   // Business
    };

    let totalAmount = selectedPeople * perperson +
                      selectedDays * perDayRate +
                      tourRates[selectedTourType] +
                      mealRates[selectedMeal] +
                      transportRates[selectedTransport];

    document.getElementById('total-amount').innerText = "GBP: £ " + totalAmount;
}

</script>



            <div class="col-lg-5 .right-side-div">

            <img src="assets/images/cover-img.png" alt="">
            </div>
        </div>
    </div>
                  </div>
                  <div class="about-service-wrap">
                     <div class="section-heading">
                        <div class="row no-gutters align-items-end">
                           <div class="col-lg-6">
                              <h5 class="dash-style">OUR BENEFITS</h5>
                              <h2>OUR TRAVEL AGENCY HAS BEEN BEST AMONG OTHERS SINCE 1998</h2>
                           </div>
                           <div class="col-lg-6">
                              <div class="section-disc">
                                 <p>Since 1998, our travel agency has been a trusted name in the industry, known for its personalized service and deep expertise.</p>
                                 <p> We pride ourselves on crafting unique and memorable travel experiences tailored to your needs, leveraging our extensive knowledge and longstanding relationships with top providers. Choose us for a reliable, customer-focused approach that turns your travel dreams into reality.</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="about-service-container">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="about-service">
                                 <div class="about-service-icon">
                                    <img src="assets/images/icon19.png" alt="">
                                 </div>
                                 <div class="about-service-content">
                                    <h4>Award winning</h4>
                                    <p>our travel agency excels in crafting exceptional.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="about-service">
                                 <div class="about-service-icon">
                                    <img src="assets/images/icon20.png" alt="">
                                 </div>
                                 <div class="about-service-content">
                                    <h4>Well allowance</h4>
                                    <p> promoting a balanced and healthy lifestyle.</p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="about-service">
                                 <div class="about-service-icon">
                                    <img src="assets/images/icon21.png" alt="">
                                 </div>
                                 <div class="about-service-content">
                                    <h4>Full Insurance</h4>
                                    <p>Our full insurance protected with medical</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>


         <script>
        const buttons = document.querySelectorAll('.people-options button');
        const eightPlusButton = document.getElementById('eightPlus');
        const customInput = document.getElementById('customNumber');
        
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                if (button === eightPlusButton) {
                    customInput.style.display = 'block';
                    customInput.focus();
                } else {
                    customInput.style.display = 'none';
                    customInput.value = '';  // Clear the input if other buttons are clicked
                }
            });
        });

        customInput.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            eightPlusButton.classList.add('active');  // Keep the "8+" button active if custom input is clicked
        });

        function toggleSelect(element) {
        element.classList.toggle('selected');
    }
    
    </script>
               <?php
include 'footer.php';
?>

