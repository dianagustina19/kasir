
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kasirin Aja</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Kasirin Aja</a>
            </div>
        </nav>

        <section class="page-section portfolio masthead " id="portfolio">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Kasir</h2><br>
                    <form action="">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="inputAmount" placeholder="Masukkan Jumlah Belanja">
                            </div>
                        </div>

                        <div class="text-center" style="margin-top:50px">
                            <h4>Kemungkinan Pembayaran</h4>
                            <div class="row justify-content-center" id="buttonRow"></div>
                        </div>
                    </form>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<script>
    var inputAmount = document.getElementById("inputAmount");

    inputAmount.addEventListener("input", function() {
        var amount = parseInt(this.value);
        if (!isNaN(amount)) {
            $.ajax({
                url: '{{ route('getPaymentOptions', ':amount') }}'.replace(':amount', amount),
                type: "GET",
                contentType: "application/json",
                success: function(response) {
                    createButtons(response, amount);
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });

    function createButtons(possiblePayments, amount) {
        
        var buttonRow = document.getElementById("buttonRow");
        buttonRow.innerHTML = "";

        for (var i = 0; i < possiblePayments.length; i++) {
            var paymentAmount = possiblePayments[i];
            var buttonCol = document.createElement("div");
            buttonCol.className = "col-md-4 mb-2";

            var button = document.createElement("button");
            button.className = "btn btn-primary";
            button.style.width = "100%";
            button.innerHTML = "Rp " + paymentAmount.toLocaleString(); 
            button.setAttribute("value", paymentAmount);
            button.setAttribute("data-amount", paymentAmount); 
            button.addEventListener("click", function(event) {
                event.preventDefault();
                var selectedAmount = parseInt(this.getAttribute("data-amount"));
                if (!isNaN(selectedAmount)) {
                    var change = selectedAmount - amount;
                    if (change >= 0) {
                        Swal.fire("Pembayaran", "Nominal yang dibayarkan: Rp " + selectedAmount.toLocaleString() + "<br>Kembalian: Rp " + change.toLocaleString(), "success");
                    } else {
                        Swal.fire("Error", "Pilih nominal yang cukup untuk membayar", "error");
                    }
                } else {
                    Swal.fire("Error", "Masukkan angka yang valid", "error");
                }
            });

            buttonCol.appendChild(button);
            buttonRow.appendChild(buttonCol);
        }

        var buttonCol = document.createElement("div");
        buttonCol.className = "col-md-4 mb-2";

        var button = document.createElement("button");
        button.className = "btn btn-warning";
        button.style.width = "100%";
        button.innerHTML = "Uang Pas";

        button.setAttribute("data-amount", amount); 

        button.addEventListener("click", function(event) {
            event.preventDefault();
            var selectedAmount = parseInt(this.getAttribute("data-amount"));
            if (!isNaN(selectedAmount)) {
                Swal.fire("Pembayaran", "Uang Pas : Rp " + selectedAmount.toLocaleString());
            }
        });

        buttonCol.appendChild(button);
        buttonRow.appendChild(buttonCol);
    }
</script>

