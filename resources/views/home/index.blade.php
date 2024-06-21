<!DOCTYPE html>
<html>

<head>
  @include('home.css')
</head>

<body style="background-color: #22252A">
  <div class="hero_area">
    <!-- hecho -->
    @include('home.header')

    <!-- hecho -->
    @include('home.slider')
  </div>

  <!-- hecho -->

  @include('home.product')


  <!-- hecho -->

  @include('home.contact')

  <!-- hecho -->

  @include('home.footer')

  @include('home.js')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>