(function(){
  // Menu du profil : se ferme au clic ailleurs ou avec Échap
  var menu = document.getElementById('userMenu');
  if (menu) {
    document.addEventListener('click', function(e){ if (menu.open && !menu.contains(e.target)) menu.open = false; });
    document.addEventListener('keydown', function(e){
      if (e.key === 'Escape' && menu.open) { menu.open = false; menu.querySelector('summary').focus(); }
    });
  }
  // Page « compte » : aperçu de la photo choisie avant l’envoi
  var input = document.getElementById('photoInput'), prev = document.getElementById('avatarPreview'), msg = document.getElementById('photoMsg');
  if (input && prev) {
    input.addEventListener('change', function(){
      var f = input.files && input.files[0];
      if (!f) return;
      if (f.size > 2 * 1024 * 1024) { input.value = ''; if (msg) msg.textContent = 'Image trop lourde : 2 Mo maximum.'; return; }
      var av = prev.querySelector('.avatar'), img = document.createElement('img');
      img.alt = ''; img.src = URL.createObjectURL(f);
      av.textContent = ''; av.appendChild(img);
      var rm = document.querySelector('input[name=remove_photo]'); if (rm) rm.checked = false;
    });
  }
})();
