$(document).ready(function() {
  $("#askNowBtn").click(function(e) {
    e.preventDefault();
    $("#formModal").modal("show");
  });

  // Contoh: Tambahkan event handler untuk form submit
//   $("form").submit(function(e) {
//       e.preventDefault(); // Hentikan submission form default
//       // Lakukan validasi atau kirim data
//       alert("Pertanyaan Anda telah dikirim. Kami akan segera menjawabnya!");
//       $('#formModal').modal('hide'); // Tutup modal setelah submit
//   });
// });

// $(document).ready(function() {
//   $("form").submit(function(e) {
//     e.preventDefault(); // Mencegah pengiriman form standar

//     // Simulasi pengiriman data
//     var name = $("#nama").val();
//     var email = $("#email").val();
//     var message = $("#pesan").val();

//     // Tambahkan validasi atau pengiriman data ke server di sini

//     // Tampilkan pesan sukses atau lakukan reset form
//     alert("Pesan telah dikirim! Terima kasih, " + name + ".");
//     $('#formModal').modal('hide'); // Tutup modal setelah pengiriman
//   });
});

  
  $(document).ready(function() {
    $(".card-img-top").click(function() {
        var produkJudul = $(this).closest(".card").find(".menu-title").text();
        var produkDeskripsi = $(this).closest(".card").find(".card-text:not(:has(strong))").text();
        var produkHarga = $(this).closest(".card").find(".harga").last().text();
        var produkGambar = $(this).attr("src");

        var modalContent = '<div class="modal-dialog modal-dialog-centered">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title">' + produkJudul + '</h5>' +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            '</div>' +
            '<div class="modal-body">' +
            '<img src="' + produkGambar + '" class="img-fluid mb-2 modal-product-image" alt="' + produkJudul + '">' +
            '<p><strong>Deskripsi:</strong> ' + produkDeskripsi + '</p>' +
            '<p><strong>Harga:</strong> ' + produkHarga + '</p>' +
            '</div>' +
            '</div>' +
            '</div>';

        $(".modal").remove();
        $("body").append('<div class="modal fade" id="detailProdukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">' + modalContent + '</div>');
        $("#detailProdukModal").modal("show");
    });
});


document.addEventListener("DOMContentLoaded", function() {
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 }); // 10% elemen harus berada di dalam viewport

  document.querySelectorAll('.animate-up').forEach((elem) => {
    observer.observe(elem);
  });
});
