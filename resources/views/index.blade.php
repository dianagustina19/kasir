
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kasirin Aja</title>
        <!-- Favicon-->
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<script>
    function createButtons(amount) {
        var buttonRow = document.getElementById("buttonRow");
        buttonRow.innerHTML = "";
        
        if (amount > 100000) {
            var buttonCol = document.createElement("div");
            buttonCol.className = "col-md-4 mb-2";
            
            var button = document.createElement("button");
            button.className = "btn btn-primary";
            button.style.width = "100%";
            button.innerHTML = "Uang Pas";
            
            buttonCol.appendChild(button);
            buttonRow.appendChild(buttonCol);
        } else {
            var buttonCol;
            var button;
            var denominations = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100];
            var possiblePayments = [];
            var remainingAmount = amount;

            // Mengecek apakah jumlah pembelian sama dengan salah satu denominasi yang tersedia
            if (!denominations.includes(remainingAmount)) {
                // Membuat daftar kemungkinan pembayaran dari denominasi uang
                for (var i = 0; i < denominations.length; i++) {
                    var denomination = denominations[i];
                    var difference = denomination - remainingAmount;
                    if (difference >= 0) {
                        possiblePayments.push(denomination);
                    }
                }

                // Menambahkan kombinasi penjumlahan pecahan uang yang memungkinkan
                for (var i = 0; i < denominations.length; i++) {
                    for (var j = i; j < denominations.length; j++) {
                        var sum = denominations[i] + denominations[j];
                        if (sum === remainingAmount && !possiblePayments.includes(sum)) {
                            possiblePayments.push(sum);
                        }
                    }
                }
            }

            // Menghapus nominal denominasi yang sama dengan jumlah pembelian yang dimasukkan
            possiblePayments = possiblePayments.filter(payment => payment !== amount);

            // Membuat tombol-tombol untuk setiap kemungkinan pembayaran
            for (var i = 0; i < possiblePayments.length; i++) {
                var paymentAmount = possiblePayments[i];
                buttonCol = document.createElement("div");
                buttonCol.className = "col-md-4 mb-2";

                button = document.createElement("button");
                button.className = "btn btn-primary";
                button.style.width = "100%";
                button.innerHTML = "Rp " + paymentAmount.toLocaleString(); // Format jumlah uang dengan koma sebagai pemisah ribuan
                button.setAttribute("value", paymentAmount); // Set nilai tombol sesuai dengan jumlah pembayaran

                button.addEventListener("click", function() {
                    // Handler untuk menampilkan nilai tombol yang diklik
                    console.log("Uang yang dipilih: Rp " + parseInt(this.value).toLocaleString());
                });

                buttonCol.appendChild(button);
                buttonRow.appendChild(buttonCol);
            }

            // Membuat tombol "Uang Pas"
            buttonCol = document.createElement("div");
            buttonCol.className = "col-md-4 mb-2";

            button = document.createElement("button");
            button.className = "btn btn-primary";
            button.style.width = "100%";
            button.innerHTML = "Uang Pas";

            buttonCol.appendChild(button);
            buttonRow.appendChild(buttonCol);
        }
    }
    
    var inputAmount = document.getElementById("inputAmount");

    inputAmount.addEventListener("input", function() {
        var amount = parseInt(this.value); 
        createButtons(amount);
    });
</script>
