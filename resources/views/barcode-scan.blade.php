<!DOCTYPE html>
<html>
<head>
    <title>Lector de Códigos de Barras</title>
</head>
<body>
    <form method="POST" action="{{ route('barcode.scan') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="barcode" accept="image/*">
        <button type="submit">Escanear</button>
    </form>

    <div id="result"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#result').text(response.text);
                },
                error: function(response) {
                   
$('#result').text('Error: ' + response.responseJSON.error);
}
});
});
</script>

</body>
</html>