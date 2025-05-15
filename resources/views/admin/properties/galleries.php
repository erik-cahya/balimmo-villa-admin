<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

     <title>Document</title>
</head>
<body>

     @foreach ($image_gallery as $gallery)     

     <a href="{{ asset($gallery->image_path) }}" class="glightbox" data-gallery="property-gallery">
        <img src="{{ asset($gallery->image_path) }}" width="150" style="margin:10px; border-radius:8px;">
    </a>
     @endforeach


     

     <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
     <script>
    const lightbox = GLightbox({
        selector: '.glightbox'
    });
</script>

</body>
</html>