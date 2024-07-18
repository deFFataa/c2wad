<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | Client</title>
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
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
</head>

<body>
  <div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="d-flex flex-column align-items-center justify-content-center overflow-hidden"
      id="container-fluid-index">
      <div class="icon--header">
        <img src="images/Capstone/logo.png" alt="logo" class="img-fluid img-logo" />
        <h4 class="fw-bold">CLIENT SIGNUP</h4>
      </div>
      <div class="username-box">
        <form action="signUpUser.php" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-floating mb-1">
                <input type="text" name="Username" class="form-control shadow-none" id="floatingInput"
                  placeholder="Enter Username" required />
                <label for="floatingInput" class="text-secondary">Username</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="text" class="form-control shadow-none" name="password" id="floatingPassword"
                  placeholder="Enter Password" required />
                <label for="floatingPassword" class="text-secondary">Password</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-1">
                <input type="text" name="firstname" class="form-control shadow-none" id="floatingInput"
                  placeholder="Firstname" required />
                <label for="floatingInput" class="text-secondary">Firstname</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="text" name="lastName" class="form-control shadow-none" id="floatingInput"
                  placeholder="Last name" required />
                <label for="floatingInput" class="text-secondary">Last Name</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <select name="sex" class="form-floating form-select text-secondary mb-2" style="height: 3.68rem;"
                  aria-label="Default select example" required>
                  <option selected disabled value="">-- Choose --</option>
                  <option value="Male">M</option>
                  <option value="Female">F</option>
                </select>
                <label for="floatingInput" class="text-secondary">Sex</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="text" name="municipality" id="municipality" class="form-control shadow-none mb-2"
                  id="floatingInput" placeholder="Enter Username" required />
                <label for="floatingInput" class="text-secondary">Municipality</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="text" name="barangay" id="barangay" class="form-control shadow-none mb-2"
                  id="floatingInput" placeholder="Enter Username" required />
                <label for="floatingInput" class="text-secondary">Barangay</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="text" name="street" class="form-control shadow-none" id="floatingInput"
                  placeholder="Last name" required />
                <label for="floatingInput" class="text-secondary">Street</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="text" name="facebook" class="form-control shadow-none" id="floatingInput"
                  placeholder="Last name" required />
                <label for="floatingInput" class="text-secondary">Facebook Link</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="number" name="phoneNumber" class="form-control shadow-none" id="floatingInput"
                  placeholder="Phone Number" required />
                <label for="floatingInput" class="text-secondary">Phone Number</label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating mb-2">
                <input type="file" name="idCard" class="form-control shadow-none" id="floatingInput" required />
                <label for="floatingInput" class="text-secondary">ID</label>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="ps-1 text-danger">
                <small><i>Reminder:
                  Your ID will be used for confirmation only and will be deleted after approval</i>.</small>
              </div>
            </div>
          </div>
      </div>
      <div class="d-flex mb-3 mt-2">
        <input type="checkbox" class="form-check-input w-25" style="width: 16px !important; margin-right: 8px;"
          required>
        <div class="text-secondary desc-account text-center" id="myCheck" style="margin-top: 3px;">
          I accept C2WAD's
          <a type="button" class="text-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <b>Terms of Agreement</b>
          </a>
        </div>
      </div>
      <button type="submit" name="submitUser" class="btn btn-login fw-bold text-white">
        SUBMIT
      </button>
      <p class="text-secondary desc-account text-center">
        Already have an account?
        <a href="index.php" class="signUpUser">Login here</a>
      </p>
      </form>
    </div>

  </div>
  </div>
  <!-- Modal Terms of Agreement -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h1 class="modal-title fs-5 " id="exampleModalLabel">Terms of Agreement</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Please read the following terms of agreement carefully before submitting a request for a client account. By
            proceeding with the request, you agree to comply with these terms:</p>
          <ol>
            <li>
              <strong>Account Request Process:</strong>
              <ul>
                <li>
                  You understand that submitting a request for a client account does not guarantee approval. We reserve
                  the right to approve or deny account requests at our sole discretion.
                </li>
                <li>
                  You agree to provide accurate and complete information during the account request process. Falsifying
                  information may result in the denial of your request.
                </li>
              </ul>
            </li>
            <li>
              <strong>Account Usage:</strong>
              <ul>
                <li>
                  You are responsible for maintaining the confidentiality of your account credentials, including
                  passwords and any other security information. You are solely responsible for all activities that occur
                  under your account.
                </li>
                <li>
                  You agree not to share your account credentials with any third party or allow anyone else to access
                  your account.
                </li>
                <li>
                  You will promptly notify us of any unauthorized use of your account or any other breach of security.
                </li>
              </ul>
            </li>
            <li>
              <strong>Acceptable Use:</strong>
              <ul>
                <li>
                  You will not use your account to engage in any activities that violate local, state, national, or
                  international laws or regulations.
                </li>
                <li>
                  You will not use your account to transmit any harmful, offensive, or inappropriate content.
                </li>
              </ul>
            </li>
            <li>
              <strong>Privacy and Data Security:</strong>
              <ul>
                <li>
                  You understand and agree that we may collect, store, and process your personal information in
                  accordance with our privacy policy.
                </li>
                <li>
                  You will not attempt to access, modify, or tamper with any data or information that does not belong to
                  you.
                </li>
              </ul>
            </li>
            <li>
              <strong>Intellectual Property:</strong>
              <ul>
                <li>
                  You retain ownership of any intellectual property rights that you hold in the content you submit
                  through your client account.
                </li>
                <li>
                  You grant us a non-exclusive, worldwide, royalty-free license to use, reproduce, modify, and display
                  the content solely for the purpose of providing the requested services.
                </li>
              </ul>
            </li>
            <li>
              <strong>Termination:</strong>
              <ul>
                <li>
                  We reserve the right to suspend or terminate your account at any time if you violate these terms of
                  agreement.
                </li>
                <li>
                  You may terminate your account at any time by contacting us and following the specified account
                  closure procedures.
                </li>
              </ul>
            </li>
            <li>
              <strong>Changes to Terms:</strong>
              <ul>
                <li>
                  We may update or modify these terms of agreement from time to time. Continued use of your account
                  after any changes will constitute acceptance of the updated terms.
                </li>
              </ul>
            </li>
            <li>
              <strong>Limitation of Liability:</strong>
              <ul>
                <li>
                  We shall not be liable for any indirect, incidental, special, consequential, or punitive damages
                  arising out of or related to your use of the account.
                </li>
              </ul>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

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