<?php
include 'conf.php';
session_start();

if (!isset($_SESSION['unique_id']) && !isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Home</title>
    <link rel="icon" type="image/x-icon" href="images/Capstone/logo.png">
    <link rel="icon" type="image/x-icon" href="images/Capstone/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/user.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
        .ui-autocomplete {
            z-index: 9999 !important;
        }
    </style>

</head>

<body>
    <section class="nav-section" id="nav-home">
        <nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="dropdown">
                            <a class="nav-link custom-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-bars ps-3 py-4" style="color: #ff702d;"></i>
                            </a>
                            <ul class="dropdown-menu" style="width: 13.5rem">
                                <li><a class="dropdown-item py-3" href="user_profile.php">Profile</a></li>
                                <li><a class="dropdown-item py-3" href="user_order.php">Orders</a></li>
                                <li><a class="dropdown-item py-3" href="users_client.php">Chat</a></li>
                                <hr>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center text-decoration-none">
                        <a href="user_home.php"
                            class="d-flex justify-content-center align-items-center text-decoration-none">
                            <img src="images/Capstone/logo.png" alt="" class="img-fluid img-logo-nav">
                            <div class="ms-1 C2WAD-text"><strong>C2WAD</strong></div>
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <div id="bellNotif">

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <div class="section-body w-100">
        <div class="px-3 d-flex align-items-center h-100">
            <span class="catch-phrase ">Experience hassle-free delivery management.</span>
        </div>
    </div>
    <div class="section-two mb-3 d-flex justify-content-center align-items-center">
        <img src="images/bg-book.png" alt="" class="img-fluid logo-book">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h3 class="fw-bold mb-3 text-white">Book Now!</h3>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="btn btn-sm btn-book-now w-100">Click Me</button>
            <?php
            $username = $_SESSION['username'];
            $query = "SELECT * FROM user WHERE username = '$username' ";
            $query_run = mysqli_query($con, $query);

            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <form action="signUpUser.php" method="POST">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- Step 1: Order Details -->
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Step 1 Content -->
                                    <div class="step" id="step-1">
                                        <div class="row" id="input-container">
                                            <input type="hidden" name="uid" value="<?php echo $row['user_id'] ?>">
                                            <input type="hidden" name="client_name"
                                                value="<?php echo $row['firstName'] . " " . $row['lastName'] ?>">
                                            <input type="hidden" name="CP" value="<?php echo $row['phoneNumber'] ?>">
                                            <div class="col-12 text-center">
                                                <div class="text-danger" id="errMessage"></div>
                                            </div>
                                            <!-- Existing input elements (item0 and quantity0) -->
                                            <div class="col-12 text-center">
                                                <label for="" class="py-3 order-detail-text">Store Name / Pick Up
                                                    Location</label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" id="storeName" name="locName" placeholder="E.g Jollibee, Franks, Pintag" class="form-control">
                                            </div>
                                            <div class="col-12 text-center">
                                                <label for="" class="py-3 order-detail-text">What would you like to be
                                                    delivered?</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" name="orderDetails"
                                                    id="orderDetails" rows="3" placeholder="E.g Small Fries, 1pc Burger, Tapsilog"
                                                    name="order-details"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 2 Content -->
                                    <div class="step" id="step-2" style="display: none;">
                                            <div class="col-12 text-center">
                                                <div class="text-danger" id="errMessage2"></div>
                                            </div>
                                        <div class="col-12 text-center">
                                            <label for="" class="py-3 order-detail-text">Payment Method</label>
                                        </div>
                                        <div class="col text-center">
                                            <input type="radio" class="btn-COD" name="payment_method" value="COD"
                                                id="cod-radio">
                                            <label for="cod-radio" class="btn-COD">COD</label>

                                            <input type="radio" class="btn-COD" name="payment_method" value="GCash"
                                                id="gcash-radio">
                                            <label for="gcash-radio" class="btn-COD">GCash</label>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="" class="fair-price">*Note: Minimum Fair is 55₱</label>
                                        </div>
                                    </div>
                                    <!-- Step 3 Content -->
                                    <div class="step" id="step-3" style="display: none;">
                                        <!-- Add your Step 3 content here -->
                                        <div class="col-12 text-center">
                                            <label for="" class="py-3 order-detail-text">Drop Off</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="text" id="municipality" name="municipality" value="<?= $row['municipality'] ?>"
                                                    class="form-control" placeholder="Select Municipality">
                                                <label for="municipality" class="text-secondary" >Municipality</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="text" id="barangay" name="barangay" class="form-control" value="<?= $row['barangay'] ?>"
                                                    placeholder="Select Barangay">
                                                <label for="barangay" class="text-secondary">Barangay</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="text" name="Street" value="<?php echo $row['street'] ?>"
                                                    class="form-control shadow-none input-focus-profile" id="floatingStreet"
                                                    placeholder="Street" />
                                                <label for="floatingStreet" class="text-secondary">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" name="landmark" placeholder="E.g Near Cabagan Square Park"
                                                    id="floatingTextarea2" style="height: 100px"></textarea>
                                                <label for="floatingTextarea2" class="text-sm   ">Landmark
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- Previous and Next buttons -->
                                    <button type="button" class="btn btn-secondary"
                                        onclick="previousStep()">Previous</button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
                                    <!-- Place Order button (Step 3) -->
                                    <button type="submit" name="placeOrder" class="btn btn-place-order text-white"
                                        onclick="placeOrder()">Place
                                        Order!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="section-3 p-2 mb-1">
        <div class="container-fluid">
            <h4 class="text-center mb-4" style="color: #e28a1e;">We Do Any Kind of Deliveries</h4>
            <div class="row">
                <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center mb-3">
                    <div class="box-any-del d-flex flex-column justify-content-center align-items-center" style="
    padding: 1rem">
                        <img src="images/img-food-delivery.png" class="img-fluid h-100" alt="">
                        <h5 class="">Food</h5>
                    </div>
                </div>
                <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center mb-3">
                    <div class="box-any-del d-flex flex-column justify-content-center align-items-center" style="
    padding: 1rem">
                        <img src="images/img-parcel.png" class="img-fluid h-100" alt="">
                        <h5 class="">Parcels</h5>
                    </div>
                </div>
                <div class="col-12 col-lg-4 d-flex justify-content-center align-items-center mb-3">
                    <div class="box-any-del d-flex flex-column justify-content-center align-items-center" style="
    padding: 1rem">
                        <img src="images/img-medicine.png" class="img-fluid h-100" alt="">
                        <h5 class="">Medicine</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-3 p-2 mb-1">
            <h4 class="text-center">C2WAD: Your Trusted 2Wheels Angkas Delivery Service for Food, Parcels, and More!
            </h4>
            <p class="text-center">Cabagan 2Wheels Angkas Delivery (C2WAD), is a reliable and efficient delivery service
                that offers a wide range of services to meet your needs. C2WAD provides food take-out and delivery from
                any
                food chain, as well as pick-up and delivery of parcels, groceries, medical needs, and more. </p>
        </div>
    </div>
    <section class="p-2 mb-1">
        <h3 class="ms-3">FAQ's</h3>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        How is the fare matrix gradually added?
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        The fare matrix is gradually adjusted by adding 10 pesos per kilometer and also depending on the
                        prevailing road conditions.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Question 2
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Question 3
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="section-footer mb-2" style="position: static">
        <div class="d-flex align-items-center px-3 py-2">
            <div class="me-auto">
                <img src="images/logo-bw.png" alt="" class="img-fluid img-logo-nav">
                <label class="C2WAD-text-grey"><strong>C2WAD</strong></label>
            </div>
            <div>
                <a href="https://www.facebook.com/profile.php?id=100064153805135" target="_blank">
                    <i class="fa-brands fa-facebook-f px-2 C2WAD-text-grey"></i>
                </a>
                <a href="https://www.facebook.com/groups/227421291921529" target="_blank">
                    <i class="fa-solid fa-people-group px-2 C2WAD-text-grey"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="js/user_script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationDot = document.getElementById('notificationDot');

            notificationDropdown.addEventListener('click', function () {
                notificationDot.style.display = 'none';

            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            loadNewNotifhome();
            function loadNewNotifhome() {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "get_order_update.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.querySelector("#bellNotif").innerHTML = xhr.responseText;
                        } else {
                        }
                    }
                };
                xhr.send();
            }
            function fetchOrdersPeriodically() {
                loadNewNotifhome();
                setTimeout(fetchOrdersPeriodically, 10000);
            }
            fetchOrdersPeriodically();
        });
    </script>

    <script>
        $(function () {
            // Autocomplete for municipality input
            $("#municipality").autocomplete({
                source: [
                    "Cabagan", "San Pablo", "Tumauini", "Santa Maria", "Sto. Thomas", "Tuguegarao"
                ]
            });

            // Autocomplete for barangay input
            $("#barangay").autocomplete({
                source: [
                    "Aggub", "Anao", "Angancasilian", "Balasig", "Cansan", "Casibarag Norte", "Casibarag Sur",
                    "Catabayungan", "Centro", "Cubag", "Garita", "Luquilu", "Mabangug", "Magassi", "Masipi East",
                    "Masipi West", "Ngarag", "Pilig Abajo", "Pilig Alto", "San Antonio", "San Bernardo", "Saui",
                    "Tallag", "Ugad", "Union",
                    "Annanuman", "Auitan", "Ballacayu", "Binguang", "Bungad", "Dalena", "Caddangan", "Calamagui",
                    "Caralucud", "Guminga", "Limbauan", "Minanga Norte", "Minanga Sur", "San Jose", "Poblacion",
                    "Simanu Norte", "Simanu Sur", "Tupa",
                    "Annafunan East", "Annafunan West", "Atulayan Norte", "Atulayan Sur", "Bagay", "Buntun",
                    "Caggay", "Capatan", "Carig Norte", "Carig Sur", "Caritan Centro", "Caritan Sur", "Cataggaman Nuevo",
                    "Cataggaman Pardo", "Cataggaman Viejo", "Centro 1 (Bagumbayan)", "Centro 2 (Poblacion)", "Centro 3 (Poblacion)",
                    "Centro 4 (Poblacion)", "Centro 5 (Bagumbayan)", "Centro 6 (Poblacion)", "Centro 7 (Poblacion)", "Centro 8 (Poblacion)",
                    "Centro 9 (Bagumbayan)", "Centro 10 (Riverside)", "Centro 11 (Balzain West)", "Centro 12 (Balzain East)",
                    "Dadda", "Gosi Norte", "Gosi Sur", "Larion Alto", "Larion Bajo", "Leonarda", "Libag Norte", "Libag Sur",
                    "Linao Sur", "Linao Norte", "Linao West", "Namabbalan Norte", "Namabbalan Sur", "Pallua Norte",
                    "Pengue-Ruyu", "San Gabriel", "Tagga", "Tanza", "Ugac Norte", "Ugac Sur",
                    "Annafunan", "Antagan I", "Antagan II", "Arcon", "Balug", "Banig", "Bantug", "Barangay District 1 (Poblacion)",
                    "Barangay District 2 (Poblacion)", "Barangay District 3 (Poblacion)", "Barangay District 4 (Poblacion)", "Bayabo East",
                    "Caligayan", "Camasi", "Carapentero", "Compania", "Cumabao", "Fermeldy", "Fugu Abajo", "Fugu Norte",
                    "Fugu Sur", "Lalauan", "Lanna", "Lapogan", "Lingaling", "Liwanag", "Malamag East", "Malamag West",
                    "Maligaya", "Minanga", "Moldero", "Namnama", "Paragu", "Pilitan", "San Mateo", "San Pedro", "San Vicente",
                    "Santa", "Santa Catalina", "Santa Visitacion", "Santa Niño", "Sinippil", "Sisim Abajo", "Sisim Alto",
                    "Tunggui", "Ugad"
                ]
            });
        });
    </script>
</body>

</html>