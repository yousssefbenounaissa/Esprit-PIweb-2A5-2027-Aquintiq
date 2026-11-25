/* Back Office – utilisateurs : envoi automatique du changement de rôle + confirmation avant suppression */
document.querySelectorAll('select[data-autosubmit]').forEach(function (s) {
  s.addEventListener('change', function () { s.form.submit(); });
});
document.querySelectorAll('form[data-confirm]').forEach(function (f) {
  f.addEventListener('submit', function (e) { if (!window.confirm(f.getAttribute('data-confirm'))) e.preventDefault(); });
});
