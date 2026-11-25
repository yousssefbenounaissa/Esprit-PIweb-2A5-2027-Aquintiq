window.addEventListener('load', function () { var p = document.getElementById('preloader'); if (p) p.classList.add('hide'); });
(function () {
  var sb = document.getElementById('sidebar'), ov = document.getElementById('overlay'), bt = document.getElementById('menu-toggle');
  if (!sb || !bt) return;
  function toggle() { sb.classList.toggle('open'); ov.classList.toggle('show'); }
  bt.addEventListener('click', toggle); ov.addEventListener('click', toggle);
})();

/* groupe repliable du menu */
document.querySelectorAll('.sb-group').forEach(function (b) {
  b.addEventListener('click', function () {
    var sub = document.getElementById(b.dataset.toggle), open = !sub.classList.contains('open');
    sub.classList.toggle('open', open); b.classList.toggle('collapsed', !open);
    b.setAttribute('aria-expanded', open ? 'true' : 'false');
  });
});
