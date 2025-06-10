document.addEventListener("DOMContentLoaded", function () {
    //  Logika Sidebar
    let toggle = document.querySelector(".toggle");
    let navigation = document.querySelector(".sidebar");
    let main = document.querySelector(".main");

    function isDesktop() {
        return window.innerWidth > 768;
    }

    if (isDesktop() && localStorage.getItem("sidebar-collapsed") === "true") {
        navigation.classList.add("active");
        if (main) main.classList.add("active");
    }

    toggle.onclick = function () {
        navigation.classList.toggle("active");
        if (main) main.classList.toggle("active");
        if (isDesktop()) {
            localStorage.setItem(
                "sidebar-collapsed",
                navigation.classList.contains("active")
            );
        }
    };

    window.addEventListener("resize", function () {
        if (!isDesktop()) {
            navigation.classList.remove("active");
            if (main) main.classList.remove("active");
        }
    });

    // Logika nya icon yang ada di select
    const select = document.getElementById("showSelect");
    const icon = document.getElementById("selectIcon");
    if (select && icon) {
        select.addEventListener("focus", function () {
            icon.setAttribute("name", "chevron-up-circle-outline");
        });
        select.addEventListener("blur", function () {
            icon.setAttribute("name", "chevron-down-circle-outline");
        });
    }

    // logika show entries
    var rows = document.querySelectorAll("#productsTable tbody tr");
    var defaultEntries = 10;
    rows.forEach((row, index) => {
        if (index < defaultEntries) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });

    if (select) {
        select.addEventListener("change", function () {
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
    }

    // logika tema
    const body = document.getElementById("bodyTheme");
    const savedTemplate = localStorage.getItem("selectedTemplate") || "1";
    ubahTemplate(savedTemplate);

    document.querySelectorAll(".theme-option").forEach((btn) => {
        btn.classList.remove("selected");
        if (btn.dataset.theme === `template-${savedTemplate}`) {
            btn.classList.add("selected");
        }
        btn.onclick = function () {
            document.querySelectorAll(".theme-option").forEach((b) => b.classList.remove("selected"));
            btn.classList.add("selected");
            const angkaTemplate = btn.dataset.theme.split("-")[1];
            ubahTemplate(angkaTemplate);
            toggleThemePanel();
        };
    });
});

function ubahTemplate(angkaTemplate) {
    const body = document.getElementById("bodyTheme");
    body.classList.remove("template-1", "template-2");
    body.classList.add(`template-${angkaTemplate}`);
    localStorage.setItem("selectedTemplate", angkaTemplate);
}

function toggleThemePanel() {
    const panel = document.getElementById("theme-panel");
    panel.classList.toggle("active");
}
