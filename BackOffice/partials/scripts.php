<!-- ========= All Javascript files linkup ======== -->
<script>setTimeout(function(){var p=document.getElementById("preloader");if(p)p.classList.add("hide");},2000);</script>
<script src="<?= asset('js/back-main.js') ?>"></script>

<?php if (!empty($extraScripts)): ?>
  <?= $extraScripts ?>
<?php endif; ?>
</body>
</html>
