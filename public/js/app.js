// KampungRelish client-side scripts
document.addEventListener('DOMContentLoaded', function () {

    // 1) hide flash messages after 5 seconds
    document.querySelectorAll('.alert').forEach(function (box) {
        setTimeout(function () { box.style.display = 'none'; }, 5000);
    });

    // 2) confirm before deleting
    document.querySelectorAll('.delete-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm('Are you sure you want to delete this record?')) {
                e.preventDefault();
            }
        });
    });

    // 3) form validation before submit (forms with class "js-validate")
    document.querySelectorAll('form.js-validate').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var ok = true;
            form.querySelectorAll('[data-rule]').forEach(function (field) {
                var msg = checkField(field, form);
                showError(field, msg);
                if (msg) { ok = false; }
            });
            if (!ok) { e.preventDefault(); }
        });
        // clear error when user types again
        form.querySelectorAll('[data-rule]').forEach(function (field) {
            field.addEventListener('input', function () { showError(field, ''); });
        });
    });

    function checkField(field, form) {
        var rules = field.dataset.rule.split('|');
        var value = field.value.trim();
        var label = field.dataset.label || 'This field';
        for (var i = 0; i < rules.length; i++) {
            var r = rules[i];
            if (r === 'required' && value === '') return label + ' is required.';
            if (r === 'email' && value !== '' && !/^\S+@\S+\.\S+$/.test(value)) return 'Please enter a valid email.';
            if (r === 'digits' && value !== '' && !/^[0-9]{9,11}$/.test(value)) return 'Phone number must be 9 to 11 digits.';
            if (r === 'min6' && value !== '' && value.length < 6) return 'Password must be at least 6 characters.';
            if (r === 'price' && value !== '' && (isNaN(value) || Number(value) < 0)) return 'Price must be a number that is not negative.';
            if (r === 'match') {
                var other = form.querySelector('[name="' + field.dataset.match + '"]');
                if (other && other.value !== field.value) return 'Passwords do not match.';
            }
        }
        return '';
    }

    function showError(field, msg) {
        var span = field.parentElement.querySelector('.js-error');
        if (!span) {
            span = document.createElement('span');
            span.className = 'js-error';
            field.insertAdjacentElement('afterend', span);
        }
        span.textContent = msg;
        field.classList.toggle('invalid', msg !== '');
    }

    // 4) show / hide password
    document.querySelectorAll('.toggle-password').forEach(function (box) {
        box.addEventListener('change', function () {
            document.querySelectorAll('input.pw').forEach(function (p) {
                p.type = box.checked ? 'text' : 'password';
            });
        });
    });

    // 5) live total price in the booking form
    var expSelect = document.getElementById('experience_id');
    var paxInput = document.getElementById('pax');
    var totalBox = document.getElementById('totalPrice');
    function updateTotal() {
        if (!expSelect || !paxInput || !totalBox) return;
        var opt = expSelect.options[expSelect.selectedIndex];
        var price = opt ? parseFloat(opt.dataset.price || 0) : 0;
        var pax = parseInt(paxInput.value) || 0;
        totalBox.textContent = 'RM ' + (price * pax).toFixed(2);
    }
    if (expSelect && paxInput) {
        expSelect.addEventListener('change', updateTotal);
        paxInput.addEventListener('input', updateTotal);
        updateTotal();
    }

    // 6) live search inside a table (type to hide rows)
    var tableSearch = document.getElementById('tableSearch');
    if (tableSearch) {
        tableSearch.addEventListener('keyup', function () {
            var word = tableSearch.value.toLowerCase();
            document.querySelectorAll('table.searchable tbody tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(word) ? '' : 'none';
            });
        });
    }

    // 7) show / hide review list on experience page
    var toggleBtn = document.getElementById('toggleReviews');
    var reviewBox = document.getElementById('reviewBox');
    if (toggleBtn && reviewBox) {
        toggleBtn.addEventListener('click', function () {
            var hidden = reviewBox.style.display === 'none';
            reviewBox.style.display = hidden ? 'block' : 'none';
            toggleBtn.textContent = hidden ? 'Hide Reviews' : 'Show Reviews';
        });
    }
});
