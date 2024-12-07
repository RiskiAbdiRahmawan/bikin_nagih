<?php
include 'koneksi.php';

// Query to fetch data from menu table with average rating from rating table
$query = "SELECT m.*, AVG(r.rating) AS average_rating 
          FROM menu m 
          LEFT JOIN rating r ON m.nama = r.nama_Menu 
          GROUP BY m.ID";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project_Kel3</title>
  <link rel="icon" href="img/logo.jpg">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<style>
  .flip-container {
    perspective: 1000px;
    margin-bottom: 20px;
  }

  .flipper {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform 0.6s;
  }

  .flip-container:hover .flipper {
    transform: rotateY(180deg);
  }

  .flipper img {
    backface-visibility: hidden;
  }

  .home {
    background: url('img/F20.jpg') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    opacity: 0;
    animation: fadeIn 2s forwards;
  }

  @keyframes fadeIn {
    to {
      opacity: 1;
    }
  }

  .typewriter {
    border-right: 2px solid #000;
    white-space: nowrap;
    overflow: hidden;
  }

  .typewriter h1,
  .typewriter h4 {
    display: inline-block;
    animation: typing 4s steps(40, end), blink-caret .75s step-end infinite;
  }

  @keyframes typing {
    from {
      width: 0
    }

    to {
      width: 100%
    }
  }

  @keyframes blink-caret {

    from,
    to {
      border-color: transparent
    }

    50% {
      border-color: black
    }
  }

  .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
  }

  .rating input {
    display: none;
  }

  .rating label {
    font-size: 2rem;
    color: lightgray;
    cursor: pointer;
  }

  .rating input:checked~label,
  .rating label:hover,
  .rating label:hover~label {
    color: gold;
  }
</style>

<body>

  <nav class="navbar navbar-expand-lg sticky-top bg-white">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="img/logo.jpg" class="me-3" alt="brand">
        <span class="text-dark"></span>Bikin Nagih!
      </a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="navbar-toggler-icon"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#About">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#menu">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="askNowBtn">Kritik dan Saran</a>
          </li>
          <a href="#" class="btn btn-success position-relative shadow-none" data-bs-toggle="modal" data-bs-target="#cartModal">
            <i class="bi bi-cart "></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">
              0
            </span>
          </a>
        </ul>
        <!-- <a href="#" id="askNowBtn" class="btn btn-warning shadow-none">Kritik dan Saran</a> -->
        <a href="login.php" id="admin" class="btn btn-warning shadow-none">Login</a>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kritik</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="create_Testimoni.php" method="POST">
            <div class="form-group mb-3">
              <label for="nama" class="form-label">Name:</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group mb-3">
              <label for="rasa" class="form-label">Pilih yang di kritik:</label>
              <select class="form-control" id="kritik" name="kritik" required>
                <option value="" disabled selected>Pilih yang di kritik</option>
                <option value="menu">Menu</option>
                <option value="tempat">Tempat</option>
                <option value="pelayanan">Pelayanan</option>
                <option value="parkiran">Parkiran</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="pelayanan" class="form-label">Pesan:</label>
              <input type="text" class="form-control" id="pesan" name="pesan" required>
            </div>
            <button type="submit" class="btn btn-warning">Kirim Pesan</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <section class="home" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12">
          <div class="home-content">
            <p class="badge rounded-pill bg-success text-white">Bikin Nagih</p>
            <h1 class="text-home-bold fw-bold mt-3 text-warning" id="welcome-text">

            </h1>
            <h4 class="text-home-reguler fw-normal mt-4 animate-up">
              Temukan kehangatan dan kelezatan dimsum, disiapkan khusus untuk Anda.
            </h4>
            <div class="home-btn mt-5">
              <a href="#menu" class="btn btn-warning shadow-none" target="_blank">Order Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="bg-light">
    <div class="container py-5 " id="About">
      <div class=" p-5 mb-5 rounded-3">
        <div class="container-fluid">
          <div class="row g-4">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
              <img src="img/logo.jpg" class="img-fluid" alt="Company Logo">
            </div>
            <div class="col-md-6">
              <h2 class="fw-bold text-right mb-4 h2 text-warning">About Us</h2>
              <p class="text-sm text-right">Bikin Nagih Malang adalah restoran yang menyajikan hidangan dimsum dan nasi mentai yang lezat dan kekinian. Restoran ini terkenal dengan dimsumnya yang segar dan otentik, serta nasi mentainya yang gurih dan creamy dengan berbagai pilihan topping. Bikin Nagih Malang adalah pilihan tepat bagi pelanggan yang ingin menikmati hidangan Tionghoa yang lezat dan kekinian dengan suasana yang nyaman dan instagramable. Bikin nagih berlokasi di Jl. Pinus No.35, Tunggulwulung, Lowokwaru, Malang.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="py-5">
    <div class="container ">
      <h2 class="text-center mb-4 h2 text-dark fw-bold">Kenapa Memilih Kuliner Kami?</h2>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4 ">
          <div class="card h-100 text-center custom-card">
            <i class="bi bi-check-all text-primary" style="font-size: 64px; margin-top: 20px;"></i>
            <div class="card-body">
              <h5 class="card-title text-lg text-dark">Kualitas Terbaik</h5>
              <p class="card-text">Kami menggunakan bahan-bahan berkualitas tinggi untuk setiap hidangan yang kami sajikan.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 text-center custom-card">
            <img src="img/delivery.png" class="img-fluid img-thumbnail" style="margin: 20px auto;">
            <div class="card-body">
              <h5 class="card-title text-lg text-dark">Sistem Antar Kerumah</h5>
              <p class="card-text">Dengan layanan pengantaran tepat waktu dan Kami selalu membawa cita rasa yang terbaik langsung kerumah anda.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 text-center custom-card">
            <i class="bi bi-tag text-success" style="font-size: 64px; margin-top: 20px;"></i>
            <div class="card-body">
              <h5 class="card-title text-lg text-dark">Terjangkau</h5>
              <p class="card-text">Tersedia Bagi kalangan, kami selalu memahami bahwa pentingnya keterjangkauan dalam menikmati kuliner yang lezat.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="menu py-5" id="menu">
    <div class="container p-5">
      <h2 class="fw-bold text-warning mb-4 h2 text-right">Menu Makanan</h2>
      <div class="d-flex flex-row flex-wrap overflow-auto">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <div class="col-lg-4 col-md-6">
            <div class="card card-menu bg-white mx-2 position-relative">
              <img src="<?php echo $row['gambar']; ?>" class="card-img-top" alt="<?php echo $row['nama']; ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                <p class="card-text">Harga: Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                <p class="card-text"><i class="fas fa-star text-warning"></i> <?php echo $row['average_rating'] !== null ? number_format($row['average_rating'], 1) : '-'; ?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal" data-id="<?php echo $row['ID']; ?>" data-menu="<?php echo $row['nama']; ?>" data-harga="<?php echo $row['harga']; ?>"><i class='bi bi-cart-check fs-5'></i> Add to Cart</button>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>




  <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="purchaseModalLabel">Form Pembelian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="purchaseForm">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" readonly>
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="text" class="form-control" id="harga" name="harga" readonly>
        </div>
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah</label>
          <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <button type="button" class="btn btn-primary" id="addToCartBtn">Tambahkan ke Keranjang</button>
        </form>
      </div>
    </div>
  </div>
  </div>

  <section>
    <div id="gallery" class="content p-5"></div>
    <div class="container py-5">
      <h2 class="fw-bold text-black mb-4 h2 text-center">Gallery Bikin Nagih!</h2>
      <!-- Gallery -->
      <div class="row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
          <div class="flip-container">
            <div class="flipper">
              <img src="img/F18.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
            </div>
          </div>
          <div class="flip-container">
            <div class="flipper">
              <img src="img/F17.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Wintry Mountain Landscape" />
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="flip-container">
            <div class="flipper">
              <img src="img/F14.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Mountains in the Clouds" />
            </div>
          </div>
          <div class="flip-container">
            <div class="flipper">
              <img src="img/F15.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="flip-container">
            <div class="flipper">
              <img src="img/F9.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Waves at Sea" />
            </div>
          </div>
          <div class="flip-container">
            <div class="flipper">
              <img src="img/F2.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Yosemite National Park" />
            </div>
          </div>
        </div>
      </div>
      <!-- Gallery -->
    </div>
  </section>


  <!-- Rating Modal -->
  <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ratingModalLabel">Berikan Rating untuk Menu Makanan Kami</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="create_Rating.php">
            <div class="form-group">
              <label for="menuItem" class="sr-only">Pilih Menu</label>
              <select class="form-control shadow-none" id="menuItem" name="menuItem" required>
                <option value="" disabled selected>Pilih Menu</option>
                <?php
                include 'koneksi.php';
                $query_menu = "SELECT nama FROM menu";
                $result_menu = mysqli_query($conn, $query_menu);
                while ($row_menu = mysqli_fetch_assoc($result_menu)) {
                  echo "<option value='" . $row_menu['nama'] . "'>" . $row_menu['nama'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group mt-3">
              <label for="rating" class="sr-only">Rating</label>
              <div class="rating">
                <input type="radio" name="rating" id="rating-5" value="5">
                <label for="rating-5" title="Sangat Baik">&#9733;</label>
                <input type="radio" name="rating" id="rating-4" value="4">
                <label for="rating-4" title="Baik">&#9733;</label>
                <input type="radio" name="rating" id="rating-3" value="3">
                <label for="rating-3" title="Cukup">&#9733;</label>
                <input type="radio" name="rating" id="rating-2" value="2">
                <label for="rating-2" title="Buruk">&#9733;</label>
                <input type="radio" name="rating" id="rating-1" value="1">
                <label for="rating-1" title="Sangat Buruk">&#9733;</label>
              </div>
            </div>
            <div class="form-group mt-3">
              <label for="review" class="sr-only">Ulasan</label>
              <textarea class="form-control shadow-none" id="ulasan" name="ulasan" rows="3" placeholder="Tulis ulasan Anda di sini" required></textarea>
            </div>
            <button type="submit" class="btn btn-warning shadow-none mt-3">Kirim Rating</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section class="py-5t">
    <div class="container">
      <h2 class="fw-bold text-center mb-5 text-black" style="color: #6c757d;">Apa Kata Mereka?</h2>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card h-100 shadow-sm bg-light">
            <div class="card-body d-flex flex-column">
              <p class="card-text mb-4">"Tiap kali lidah ini rindu masakan rumahan, saya langsung ke sini. Mie pangsitnya itu lho, juara! Rasanya benar-benar seperti buatan ibu di rumah."</p>
              <footer class="mt-auto">
                <small class="text-muted">Pak Rudi Dosen Hukum</small>
              </footer>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card h-100 shadow-sm bg-light">
            <div class="card-body d-flex flex-column">
              <p class="card-text mb-4">"Dompet mahasiswa memang tipis, tapi di sini saya bisa makan enak tanpa bikin kantong jebol. Plus, wifi gratisannya kenceng untuk nugas!"</p>
              <footer class="mt-auto">
                <small class="text-muted">Lisa Mahasiswi Desain Komunikasi Visual</small>
              </footer>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="py-4 bg-dark text-white">
    <div class="container text-center">
      <p>&copy; 2024 Bikin Nagih</p>
      <p>Ikuti Media Sosial Kami</p>
      <a href="https://www.instagram.com/bikinagih.mlg?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-white"><i class="bi bi-instagram"></i></a>
    </div>
  </footer>

  <!-- Shopping Cart Modal -->
  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="checkoutForm" method="POST" action="checkout.php">
          <div class="modal-body">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
              <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required>
            </div>
            <div class="mb-3">
              <label for="payment_method" class="form-label">Metode Pembayaran</label>
              <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="Cash">Cash</option>
                <option value="Qris">Qris</option>
              </select>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nama Menu</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody id="cartItems">
                <!-- Cart items will be dynamically added here -->
              </tbody>
            </table>
            <div class="text-right">
              <h5>Total: <span id="totalAmount">0</span></h5>
              <input type="hidden" id="total" name="total">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Checkout</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let cart = [];

    // Event listener for the add to cart button in the modal
    document.getElementById('addToCartBtn').addEventListener('click', () => {
      const namaMenu = document.getElementById('nama_menu').value;
      const harga = parseFloat(document.getElementById('harga').value);
      const jumlah = parseInt(document.getElementById('jumlah').value);

      // Add the item to the cart array
      const item = {
        namaMenu,
        harga,
        jumlah,
        subtotal: harga * jumlah
      };
      cart.push(item);

      // Close the modal
      $('#purchaseModal').modal('hide');

      // Update the cart display
      updateCartDisplay();
    });

    // Event listener to open the purchase modal and populate data
    $('#purchaseModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      const menu = button.data('menu');
      const harga = button.data('harga');

      const modal = $(this);
      modal.find('.modal-body #nama_menu').val(menu);
      modal.find('.modal-body #harga').val(harga);
    });

    // Function to update the cart display
    function updateCartDisplay() {
      const cartItemsElement = document.getElementById('cartItems');
      cartItemsElement.innerHTML = '';

      let totalAmount = 0;
      cart.forEach((item, index) => {
        totalAmount += item.subtotal;

        const row = document.createElement('tr');
        row.innerHTML = `
      <td>${item.namaMenu}</td>
      <td>${item.harga}</td>
      <td>${item.jumlah}</td>
      <td>${item.subtotal}</td>
      <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">Remove</button></td>
    `;
        cartItemsElement.appendChild(row);
      });
      // Set total amount input value
      document.getElementById('total').value = totalAmount;

      document.getElementById('totalAmount').innerText = totalAmount;
    }

    // Function to remove an item from the cart
    function removeFromCart(index) {
      cart.splice(index, 1);
      updateCartDisplay();
    }

    // Event listener for the cart button to show the cart modal
    document.getElementById('cartModal').addEventListener('show.bs.modal', updateCartDisplay);

    // Function to send cart data to server
    function processCheckout() {
      const formData = new FormData();
      formData.append('cart', JSON.stringify(cart));

      fetch('checkout.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          console.log(data);
          // Handle response from server if needed
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var cartModal = document.getElementById('cartModal');
      cartModal.addEventListener('show.bs.modal', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var formattedDate = year + '-' + month + '-' + day;
        document.getElementById('tanggal_transaksi').value = formattedDate;
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var purchaseModal = document.getElementById('purchaseModal');
      var cartItems = [];

      purchaseModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var menuId = button.getAttribute('data-id');
        var menuName = button.getAttribute('data-menu');
        var menuPrice = button.getAttribute('data-harga');

        var modalTitle = purchaseModal.querySelector('.modal-title');
        var modalBodyInputNamaMenu = purchaseModal.querySelector('#nama_menu');
        var modalBodyInputHarga = purchaseModal.querySelector('#harga');

        modalTitle.textContent = 'Form Pembelian ' + menuName;
        modalBodyInputNamaMenu.value = menuName;
        modalBodyInputHarga.value = menuPrice;
      });

      function updateCartCount() {
        var cartCount = cartItems.length;
        document.getElementById('cartCount').innerText = cartCount;
      }

      document.getElementById('addToCartBtn').addEventListener('click', function() {
        var nama_menu = document.getElementById('nama_menu').value;
        var harga = parseFloat(document.getElementById('harga').value);
        var jumlah = parseInt(document.getElementById('jumlah').value);
        var subtotal = harga * jumlah;

        cartItems.push({
          namaMenu: nama_menu,
          harga: harga,
          jumlah: jumlah,
          subtotal: subtotal
        });

        updateCartItems();
        updateTotalAmount();
        updateCartCount();
      });

      function updateCartItems() {
        var cartItemsTableBody = document.getElementById('cartItems');
        cartItemsTableBody.innerHTML = '';

        cartItems.forEach(function(item, index) {
          var row = document.createElement('tr');
          row.innerHTML = `
        <td>${item.namaMenu}</td>
        <td>${item.harga}</td>
        <td>${item.jumlah}</td>
        <td>${item.subtotal}</td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeCartItem(${index})">Hapus</button></td>
      `;
          cartItemsTableBody.appendChild(row);
        });
      }

      function updateTotalAmount() {
        var totalAmount = cartItems.reduce(function(acc, item) {
          return acc + item.subtotal;
        }, 0);
        document.getElementById('totalAmount').textContent = totalAmount;
        document.getElementById('total').value = totalAmount;
      }

      function removeCartItem(index) {
        cartItems.splice(index, 1);
        updateCartItems();
        updateTotalAmount();
        updateCartCount();
      }

      document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(event.target);
        formData.append('cart', JSON.stringify(cartItems));

        fetch('checkout.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(data => {
            console.log(data);
            var cartModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));
            cartModal.hide();
            event.target.reset();
            cartItems = [];
            updateCartItems();
            updateTotalAmount();
            updateCartCount(); // Ensure the cart count is updated to reflect empty cart

            // Show the rating modal after successful payment
            var ratingModal = new bootstrap.Modal(document.getElementById('ratingModal'));
            ratingModal.show();
          })
          .catch(error => {
            console.error('Error:', error);
          });
      });
    });
  </script>

</body>

</html>