window.addEventListener('load', function () { var s = document.getElementById('spinner'); if (s) s.classList.remove('show'); });
(function () {
  var t = document.querySelector('.nav-toggle'), n = document.getElementById('navLinks');
  if (t && n) t.addEventListener('click', function () { var o = n.classList.toggle('open'); t.setAttribute('aria-expanded', o); });
  var b = document.querySelector('.to-top');
  if (b) {
    window.addEventListener('scroll', function () { b.classList.toggle('show', window.scrollY > 400); });
    b.addEventListener('click', function (e) { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); });
  }
})();
