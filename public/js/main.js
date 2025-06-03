let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".sidebar");
let main = document.querySelector(".main");

// Fungsi cek apakah layar lebar (bukan HP)
function isDesktop() {
    return window.innerWidth > 768;
}

// Saat load, hanya apply localStorage jika desktop
if (isDesktop() && localStorage.getItem("sidebar-collapsed") === "true") {
    navigation.classList.add("active");
    if (main) main.classList.add("active");
}

// Toggle klik
toggle.onclick = function () {
    navigation.classList.toggle("active");
    if (main) main.classList.toggle("active");
    // Hanya simpan status jika desktop
    if (isDesktop()) {
        localStorage.setItem(
            "sidebar-collapsed",
            navigation.classList.contains("active")
        );
    }
};

// Reset sidebar jika resize ke mobile
window.addEventListener("resize", function () {
    if (!isDesktop()) {
        navigation.classList.remove("active");
        if (main) main.classList.remove("active");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("showSelect");
    const icon = document.getElementById("selectIcon");

    select.addEventListener("focus", function () {
        icon.setAttribute("name", "chevron-up-circle-outline");
    });
    select.addEventListener("blur", function () {
        icon.setAttribute("name", "chevron-down-circle-outline");
    });
});

function closePopup() {
    document.getElementById("popup").style.display = "none";
}

function openPopup() {
    document.getElementById("popup").style.display = "flex";
}

document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll("#productsTable tbody tr");
    var defaultEntries = 10; // Set jumlah default yang ditampilkan
    
    rows.forEach((row, index) => {
        if (index < defaultEntries) {
            row.style.display = ""; // Tampilkan
        } else {
            row.style.display = "none"; // Sembunyikan
        }
    });
});

document.getElementById("showSelect").addEventListener("change", function () {
    var selectedValue = parseInt(this.value);
    var rows = document.querySelectorAll("#productsTable tbody tr");

    rows.forEach((row, index) => {
        if (index < selectedValue) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
