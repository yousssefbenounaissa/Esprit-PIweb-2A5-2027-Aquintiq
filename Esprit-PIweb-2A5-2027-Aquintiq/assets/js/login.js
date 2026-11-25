(function(){
  var card = document.getElementById('card');
  var panes = {login: document.getElementById('paneLogin'), signup: document.getElementById('paneSignup')};

  function setMode(m){
    card.classList.toggle('signup', m === 'signup');
    panes.login.inert = (m === 'signup');
    panes.signup.inert = (m !== 'signup');
    var first = panes[m].querySelector('input');
    setTimeout(function(){ if (first) first.focus({preventScroll:true}); }, 700);
  }
  document.querySelectorAll('[data-go]').forEach(function(b){
    b.addEventListener('click', function(){ setMode(b.dataset.go); });
  });
  setMode(card.dataset.mode === 'signup' ? 'signup' : 'login');

  // Afficher / masquer le mot de passe
  document.querySelectorAll('.eye').forEach(function(btn){
    btn.addEventListener('click', function(){
      var input = btn.parentNode.querySelector('input');
      var show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      btn.setAttribute('aria-label', show ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
    });
  });

  // Validation
  function setErr(input, text){
    var box = input.closest('.box');
    box.classList.toggle('bad', !!text);
    input.closest('.field').querySelector('.msg').textContent = text || '';
    return !text;
  }
  var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  function check(form){
    var ok = true, f = form.elements;
    if (f.name) ok = setErr(f.name, f.name.value.trim().length < 2 ? 'Entrez votre nom complet.' : '') && ok;
    ok = setErr(f.email, emailRe.test(f.email.value.trim()) ? '' : 'Entrez une adresse e-mail valide, par exemple nom@exemple.com.') && ok;
    var min = f.name ? 8 : 1;
    ok = setErr(f.password, f.password.value.length < min ? (f.name ? 'Le mot de passe doit contenir au moins 8 caractères.' : 'Entrez votre mot de passe.') : '') && ok;
    return ok;
  }

  function wire(form){
    form.querySelectorAll('input').forEach(function(i){
      i.addEventListener('input', function(){ setErr(i, ''); });
    });
    form.addEventListener('submit', function(e){
      var status = form.querySelector('.status'), btn = form.querySelector('.cta');
      status.textContent = '';
      if (!check(form)) { e.preventDefault(); return; }
      btn.dataset.label = btn.textContent;
      btn.disabled = true; btn.textContent = 'Un instant…';   // le formulaire part vers le serveur (PHP)
    });
  }
  wire(document.getElementById('formLogin'));
  wire(document.getElementById('formSignup'));
  // retour arrière du navigateur : on réactive les boutons
  addEventListener('pageshow', function(){
    document.querySelectorAll('.cta').forEach(function(b){ b.disabled = false; if (b.dataset.label) b.textContent = b.dataset.label; });
  });
})();
