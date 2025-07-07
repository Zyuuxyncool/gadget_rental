function toggleThemePanel() {
        const panel = document.getElementById("theme-panel");
        panel?.classList.toggle("active");
    }

document.addEventListener("DOMContentLoaded", function () {
    // ====================== TEMA =========================
    const body = document.getElementById("bodyTheme");
    const savedTemplate = localStorage.getItem("selectedTemplate") || "1";
    if (body) {
        body.classList.remove("template-1", "template-2");
        body.classList.add(`template-${savedTemplate}`);
    }

    document.querySelectorAll(".theme-option").forEach((btn) => {
        btn.classList.remove("selected");
        if (btn.dataset.theme === `template-${savedTemplate}`) {
            btn.classList.add("selected");
        }

        btn.onclick = function () {
            document
                .querySelectorAll(".theme-option")
                .forEach((b) => b.classList.remove("selected"));
            btn.classList.add("selected");
            const angkaTemplate = btn.dataset.theme.split("-")[1];
            ubahTemplate(angkaTemplate);
            toggleThemePanel();
        };
    });

    function ubahTemplate(angkaTemplate) {
        if (!body) return;
        body.classList.remove("template-1", "template-2");
        body.classList.add(`template-${angkaTemplate}`);
        localStorage.setItem("selectedTemplate", angkaTemplate);
    }

    // ===================== SIDEBAR =========================
    const navigation = document.querySelector(".sidebar");
    const main = document.querySelector(".main");
    const toggle = document.querySelector(".toggle");

    function isDesktop() {
        return window.innerWidth > 768;
    }

    if (isDesktop() && localStorage.getItem("sidebar-collapsed") === "true") {
        navigation?.classList.add("active");
        main?.classList.add("active");
    }

    toggle?.addEventListener("click", () => {
        navigation?.classList.toggle("active");
        main?.classList.toggle("active");

        if (isDesktop()) {
            localStorage.setItem(
                "sidebar-collapsed",
                navigation?.classList.contains("active")
            );
        }
    });

    window.addEventListener("resize", function () {
        if (!isDesktop()) {
            navigation?.classList.remove("active");
            main?.classList.remove("active");
        }
    });

    // ===================== DROPDOWN ICON =====================
    const select = document.getElementById("showSelect");
    const icon = document.getElementById("selectIcon");
    if (select && icon) {
        select.addEventListener("focus", () =>
            icon.setAttribute("name", "chevron-up-circle-outline")
        );
        select.addEventListener("blur", () =>
            icon.setAttribute("name", "chevron-down-circle-outline")
        );
    }

    // ===================== SHOW ENTRIES ======================
    const rows = document.querySelectorAll("#productsTable tbody tr");
    const defaultEntries = 10;

    if (rows.length > 0) {
        rows.forEach((row, index) => {
            row.style.display = index < defaultEntries ? "" : "none";
        });

        select?.addEventListener("change", function () {
            const selectedValue = parseInt(this.value);
            rows.forEach((row, index) => {
                row.style.display = index < selectedValue ? "" : "none";
            });
        });
    }

    // ===================== DROPDOWN CUSTOM =====================
    document.addEventListener("click", function (e) {
        const toggleBtn = e.target.closest(".dropdown-toggle");
        if (toggleBtn) {
            e.stopPropagation();
            toggleBtn.classList.toggle("active");

            const dropdown = toggleBtn.parentElement.querySelector(".action");
            const isVisible = dropdown?.style.display === "block";

            document
                .querySelectorAll(".action")
                .forEach((menu) => (menu.style.display = "none"));
            document
                .querySelectorAll(".dropdown-toggle")
                .forEach((btn) => btn.classList.remove("active"));

            if (!isVisible) {
                dropdown.style.display = "block";
                toggleBtn.classList.add("active");
            }
        } else {
            document
                .querySelectorAll(".action")
                .forEach((menu) => (menu.style.display = "none"));
            document
                .querySelectorAll(".dropdown-toggle")
                .forEach((btn) => btn.classList.remove("active"));
        }
    });

    // ===================== DRAG-DROP FILE PREVIEW =====================

    // ===================== FORMAT RUPIAH ======================
    window.formatRupiah = function (input) {
        let value = input.value.replace(/\D/g, "");
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        input.value = value;
    };
});
