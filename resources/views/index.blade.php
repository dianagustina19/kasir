
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Freelancer - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">

        </header>

        <section class="page-section portfolio" id="portfolio">
          <div class="container">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Kasir</h2><br>
            <form action="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <input type="number" class="form-control" id="inputAmount" placeholder="Masukkan jumlah">
        </div>
    </div>

    <div class="text-center" style="margin-top:50px">
        <h4>Kemungkinan Pembayaran</h4>
        <div class="row justify-content-center" id="buttonRow"></div>
    </div>
</form>
          </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="about">
         
        </section>

        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2023</small></div>
        </div>

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

    if (amount) {
  
// Menambahkan kemungkinan pembayaran dari denominasi tunggal uang yang lebih besar atau setidaknya sama dengan jumlah pembelian
for (var i = 0; i < denominations.length; i++) {
    var denomination = denominations[i];
    if (denomination >= remainingAmount && !possiblePayments.includes(denomination)) {
        possiblePayments.push(denomination);
    }
}

// Menambahkan kemungkinan pembayaran dari kombinasi dua atau lebih pecahan uang yang jumlahnya sama dengan atau lebih besar dari jumlah pembelian
for (var i = 0; i < denominations.length; i++) {
    for (var j = i; j < denominations.length; j++) {
        for (var k = j; k < denominations.length; k++) {
            var combination = denominations[i] + denominations[j] + denominations[k];
            if (combination === remainingAmount && !possiblePayments.includes(combination)) {
                possiblePayments.push(combination);
            }
        }
    }
}


console.log(possiblePayments)
        // Menambahkan opsi "Uang Pas" jika jumlah pembelian tidak cocok dengan denominasi yang tersedia
        // possiblePayments.push(amount);
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

    button.addEventListener("click", function() {
        // Handler untuk menampilkan uang pas
        console.log("Uang yang dipilih: Uang Pas");
    });

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
