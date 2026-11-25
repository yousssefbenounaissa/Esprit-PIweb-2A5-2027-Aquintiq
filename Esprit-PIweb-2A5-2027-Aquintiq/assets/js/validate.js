/* Validation côté client (JS) – réutilisée par les formulaires marqués data-validate.
   Attributs sur chaque champ : required, data-label, data-min, data-max, data-type="email|phone", data-optional-min.
   Le serveur (PHP) refait TOUJOURS les mêmes contrôles : le JS n'est qu'un confort. */
(function () {
  var EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/, PHONE = /^[0-9+\s().-]{8,20}$/;

  function check(f) {
    var v = f.value.trim(), label = f.getAttribute('data-label') || f.name, t = f.getAttribute('data-type');
    var min = parseInt(f.getAttribute('data-min') || '0', 10), max = parseInt(f.getAttribute('data-max') || '0', 10);
    if (f.hasAttribute('required') && v === '') return label + ' est obligatoire.';
    if (v === '') return '';
    if (min && v.length < min) return label + ' : au moins ' + min + ' caractères.';
    if (max && v.length > max) return label + ' : ' + max + ' caractères maximum.';
    if (t === 'email' && !EMAIL.test(v)) return 'Adresse e-mail invalide.';
    if (t === 'phone' && !PHONE.test(v)) return 'Numéro de téléphone invalide.';
    return '';
  }
  function show(f, msg) {
    var n = f.parentNode.querySelector('.field-error');
    if (!msg) { if (n) n.remove(); f.classList.remove('invalid'); return; }
    if (!n) { n = document.createElement('span'); n.className = 'field-error'; n.setAttribute('role', 'alert'); f.parentNode.appendChild(n); }
    n.textContent = msg; f.classList.add('invalid');
  }
  document.querySelectorAll('form[data-validate]').forEach(function (form) {
    form.setAttribute('novalidate', '');
    var fields = form.querySelectorAll('input[data-label],textarea[data-label],select[data-label]');
    fields.forEach(function (f) { f.addEventListener('blur', function () { show(f, check(f)); }); });
    form.addEventListener('submit', function (e) {
      var first = null;
      fields.forEach(function (f) { var m = check(f); show(f, m); if (m && !first) first = f; });
      if (first) { e.preventDefault(); first.focus(); }
    });
  });
})();
