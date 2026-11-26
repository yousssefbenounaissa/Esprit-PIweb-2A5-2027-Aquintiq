<script>/* sécurité : le spinner ne reste jamais bloqué */setTimeout(function(){var s=document.getElementById("spinner");if(s)s.classList.remove("show");},2000);</script>
<script src="<?= asset('js/main.js') ?>"></script>
<?= $extraScripts ?? '' ?>
</body>
</html>
