<input type="hidden" value="<?= base_url(); ?>" id="baseUrl">
<?php if (!empty($css)) :
    foreach ($js as $data) : ?>
        <script type="text/javascript" src="<?= $data; ?>"></script>
<?php endforeach;
endif; ?>
</body>

</html>