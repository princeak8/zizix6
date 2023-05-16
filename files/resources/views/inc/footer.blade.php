<!-- ***** Footer Area Start ***** -->
<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
    <footer class="footer-social-icon text-center section_padding_70 clearfix">
        <!-- footer logo -->
        <!-- <div class="footer-text">
            <h2><img class="logo_img" src="{{env('APP_STORAGE')}}images/logo.png" width="60" alt="zizix6 logo"> Zizix6 Technologies</h2>
        </div> -->
        <!-- social icon-->
        <div class="footer-social-icon">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="active fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        </div>
        <div class="footer-menu">
            <nav>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
        <!-- Foooter Text-->
        <div class="copyright-text">
            <!-- ***** Removing this text is now allowed! This template is licensed under CC BY 3.0 ***** -->
            <p>Copyright © <?php echo date("Y", time()); ?> Zizix6 Tech.</p>
        </div>
    </footer>
    <!-- ***** Footer Area Start ***** -->

    <!-- Jquery-2.2.4 JS -->
    <script src="{{asset('assets/js/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script type="application/javascript">
    $(document).ready(function() {
        $('#captcha-refresh').click(function(){ 
          $.ajax({
             type:'GET',
             url:'refreshcaptcha',
             success:function(data){
                $(".captcha span").html(data.captcha);
             }
          })
        })
    })

</script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <!-- Bootstrap-4 Beta JS -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- All Plugins JS -->
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <!-- Slick Slider Js-->
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <!-- Footer Reveal JS -->
    <script src="{{asset('assets/js/footer-reveal.min.js')}}"></script>
    <!-- Active JS -->
    <script src="{{asset('assets/js/active.js')}}"></script>

</body>

</html>