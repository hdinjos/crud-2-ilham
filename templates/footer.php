    <script src="assets/js/jquery-3.4.1.min .js"></script>
    <script src="assets/js/bootstrap .js"></script>
    <script>
        $('.hapus').on('click', function(e){
            let id_data = $(this).attr('href');
            $('.hapus-data-modal').attr('href', id_data);
        })
    </script>
</body>
</html>