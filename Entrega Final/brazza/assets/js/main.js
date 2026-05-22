// Toggle mobile menu (public nav)
function toggleMenu() {
    document.querySelector("nav ul").classList.toggle("open");
}

// Toggle mobile menu (admin nav)
function toggleAdminMenu() {
    document.querySelector(".admin-nav ul").classList.toggle("open");
}

// Delete confirmation modal
function confirmDelete(url) {
    // Build modal once and inject it into the page
    if (!document.getElementById('delete-modal')) {
        var overlay = document.createElement('div');
        overlay.id = 'delete-modal';
        overlay.innerHTML =
            '<div class="modal-box">' +
                '<p class="modal-title">¿Eliminar este elemento?</p>' +
                '<p class="modal-sub">Esta acción no se puede deshacer.</p>' +
                '<div class="modal-actions">' +
                    '<button class="modal-cancel" onclick="closeDeleteModal()">Cancelar</button>' +
                    '<button class="modal-confirm" id="modal-confirm-btn">Eliminar</button>' +
                '</div>' +
            '</div>';
        // Click outside the box to cancel
        overlay.onclick = function(e) {
            if (e.target === overlay) closeDeleteModal();
        };
        document.body.appendChild(overlay);
    }
    // Wire confirm button to the actual delete URL
    document.getElementById('modal-confirm-btn').onclick = function() {
        window.location.href = url;
    };
    document.getElementById('delete-modal').classList.add('active');
}

function closeDeleteModal() {
    var modal = document.getElementById('delete-modal');
    if (modal) modal.classList.remove('active');
}

// Show menu tab (cortes / bebidas / postres)
function showTab(tabId, btn) {
    // hide all tab contents
    var tabs = document.querySelectorAll(".tab-content");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }
    // remove active from all buttons
    var buttons = document.querySelectorAll(".tab-btn");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("active");
    }
    // show selected tab
    document.getElementById(tabId).classList.add("active");
    btn.classList.add("active");
}
