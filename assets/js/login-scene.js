(function(){
  var cv = document.getElementById('scene');
  if (!cv || !window.THREE) return;
  var T = THREE, reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  var r = new T.WebGLRenderer({canvas: cv, antialias: true, alpha: true});
  r.setPixelRatio(Math.min(devicePixelRatio || 1, 2));
  var sc = new T.Scene(), cam = new T.PerspectiveCamera(35, 1.6, .1,50);
  cam.position.set(0, 2.8, 8.6); cam.lookAt(0, .9, 0);
  sc.add(new T.HemisphereLight(0xffffff, 0x0f6a9c, .95));
  var dl = new T.DirectionalLight(0xffffff, .9); dl.position.set(3, 6, 5); sc.add(dl);
  var g = new T.Group(); g.position.x = .5; sc.add(g);
  function M(c, ro){ return new T.MeshStandardMaterial({color: c, roughness: ro == null ? .5 : ro}); }
  function add(geo, mat, x, y, z, p){ var m = new T.Mesh(geo, mat); m.position.set(x, y, z); (p || g).add(m); return m; }

  // Sol
  add(new T.CylinderGeometry(3.2, 3.4, .25, 48), M(0x269447, .9), 0, -.125, 0);
  add(new T.CylinderGeometry(.55, .7, .18, 24), M(0x5b3a24, .95), 1.2, .08, 0);

  // Pompe
  var px = -1.7;
  add(new T.BoxGeometry(1.3, .18, 1), M(0x263238), px, .09, 0);
  var body = add(new T.CylinderGeometry(.42, .42, .9, 32), M(0x123B65, .35), px, .63, 0);
  add(new T.TorusGeometry(.43, .06, 12, 32), M(0x00A6D6, .3), px, .45, 0).rotation.x = Math.PI / 2;
  add(new T.CylinderGeometry(.3, .3, .3, 32), M(0x263238, .4), px, 1.23, 0);
  var led = add(new T.SphereGeometry(.07, 12, 12), new T.MeshBasicMaterial({color: 0x5fd07c}), px + .3, .85, .38);
  var pm = M(0xcfd8dc, .3);
  add(new T.CylinderGeometry(.09, .09, .8, 16), pm, px + .8, .55, 0).rotation.z = Math.PI / 2;
  add(new T.CylinderGeometry(.06, .12, .25, 16), pm, px + 1.28, .55, 0).rotation.z = -Math.PI / 2;

  // Panneau solaire
  add(new T.CylinderGeometry(.04, .04, 1.6, 10), M(0x90a4ae), -2.5, .8, -.9);
  var panel = add(new T.BoxGeometry(1.5, .05, .9), M(0x1c4e9a, .2), -2.5, 1.7, -.9);
  panel.rotation.x = .45;

  // Fleur
  var fl = new T.Group(); fl.position.set(1.2, .15, 0); g.add(fl);
  add(new T.CylinderGeometry(.05, .07, 1.7, 12), M(0x269447), 0, .85, 0, fl);
  var lm = M(0x3fae5d);
  var l1 = add(new T.SphereGeometry(.28, 16, 12), lm, .28, .6, 0, fl); l1.scale.set(1, .18, .5); l1.rotation.z = .5;
  var l2 = add(new T.SphereGeometry(.28, 16, 12), lm, -.28, 1, 0, fl); l2.scale.set(1, .18, .5); l2.rotation.z = -.5;
  var head = new T.Group(); head.position.y = 1.75; fl.add(head);
  for (var k = 0; k < 8; k++){
    var a = k / 8 * Math.PI * 2;
    var p = add(new T.SphereGeometry(.2, 14, 10), M(0xffffff, .6), Math.cos(a) * .3, Math.sin(a) * .3, 0, head);
    p.scale.set(1.3, .7, .4); p.rotation.z = a;
  }
  add(new T.SphereGeometry(.17, 16, 12), M(0xf7b731, .5), 0, 0, .05, head);

  // Gouttes
  var N = 28, D = [];
  var dg = new T.SphereGeometry(.045, 8, 8);
  var wm = new T.MeshStandardMaterial({color: 0x7fd8f5, emissive: 0x00A6D6, emissiveIntensity: .4, transparent: true, opacity: .9});
  for (var i = 0; i < N; i++){ var d = new T.Mesh(dg, wm); g.add(d); D.push(d); }

  function tick(t){
    for (var i = 0; i < N; i++){
      var u = (t * .9 + i / N) % 1;
      D[i].position.set(-.3 + 1.45 * u, .55 + 1.2 * u + Math.sin(Math.PI * u), Math.sin(i * 12.9) * .04);
    }
    led.visible = Math.sin(t * 6) > 0;
    body.position.y = .63 + Math.sin(t * 40) * .003;
    head.scale.setScalar(.88 + .12 * (Math.sin(t * .8) * .5 + .5));
    fl.rotation.z = Math.sin(t * 1.3) * .03;
    g.rotation.y = Math.sin(t * .45) * .38 - .1;
    panel.rotation.z = Math.sin(t * .45) * .02;
  }

  var lw = 0, lh = 0;
  function fit(){
    var w = cv.clientWidth, h = cv.clientHeight;
    if (!w || !h) return false;
    if (w !== lw || h !== lh){ lw = w; lh = h; r.setSize(w, h, false); cam.aspect = w / h; cam.updateProjectionMatrix(); }
    return true;
  }
  function loop(ms){
    requestAnimationFrame(loop);
    if (document.hidden || !fit()) return;
    tick(ms / 1000); r.render(sc, cam);
  }
  if (reduce){
    var still = function(){ if (fit()){ tick(1.2); r.render(sc, cam); } };
    still(); addEventListener('resize', still);
  } else requestAnimationFrame(loop);
})();
