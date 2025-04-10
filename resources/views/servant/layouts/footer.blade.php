    <!-- footer -->
    <br><br><br><br><br>

</div>
<footer>
    <div class="footer">
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <p>© 2019 Dsports Design by<a href="https://html.design/"> Free Html Template</a></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <ul class="social_icon">
                            <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                            <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
</div>
</div>
<div class="overlay"></div>
<!-- Javascript files-->
<script src="{{ asset('assets/servant/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/servant/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/servant/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/servant/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/servant/js/custom.js') }}"></script>
<script src="{{ asset('assets/servant/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script src="{{ asset('assets/servant/js/jquery-3.0.0.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function() {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
});
</script>

<script>
// This example adds a marker to indicate the position of Bondi Beach in Sydney,
// Australia.
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: {
            lat: 40.645037,
            lng: -73.880224
        },
    });

    var image = 'images/maps-and-flags.png';
    var beachMarker = new google.maps.Marker({
        position: {
            lat: 40.645037,
            lng: -73.880224
        },
        map: map,
        icon: image
    });
}
</script>
<!-- google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
<!-- end google map js -->

</body>

</html>