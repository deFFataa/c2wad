<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Home</title>
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
    <style>
        .ui-autocomplete {
            z-index: 9999 !important;
        }
    </style>
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="municipality" name="municipality" class="form-control"
                        placeholder="Select Municipality">
                    <input type="text" id="barangay" name="barangay" class="form-control mt-5"
                        placeholder="Select Barangay">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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