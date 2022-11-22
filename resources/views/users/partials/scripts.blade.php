<script src="{{asset('acara/vendor/global/global.min.js')}}"></script>
<script src="{{asset('acara/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('acara/vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{asset('acara/js/custom.min.js')}}"></script>
<script src="{{asset('acara/js/deznav-init.js')}}"></script>
<script src="{{asset('acara/vendor/owl-carousel/owl.carousel.js')}}"></script>

<!-- Chart piety plugin files -->
<script src="{{asset('acara/vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('acara/vendor/apexchart/apexchart.js')}}"></script>

<!-- Dashboard 1 -->
<script src="{{asset('acara/js/dashboard/dashboard-1.js')}}"></script>

<script>
    function carouselReview(){
        /*  event-bx one function by = owl.carousel.js */
        jQuery('.event-bx').owlCarousel({
            loop:true,
            margin:30,
            nav:true,
            center:true,
            autoplaySpeed: 3000,
            navSpeed: 3000,
            paginationSpeed: 3000,
            slideSpeed: 3000,
            smartSpeed: 3000,
            autoplay: false,
            navText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>', '<i class="fa fa-caret-right" aria-hidden="true"></i>'],
            dots:true,
            responsive:{
                0:{
                    items:1
                },
                720:{
                    items:2
                },
                
                1150:{
                    items:3
                },			
                
                1200:{
                    items:2
                },
                1749:{
                    items:3
                }
            }
        })			
    }
    jQuery(window).on('load',function(){
        setTimeout(function(){
            carouselReview();
        }, 1000); 
    });
</script>

<!-- Datatable -->
<script src="{{asset('acara/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('acara/js/plugins-init/datatables.init.js')}}"></script>
<script>
    $(".table").DataTable()
</script>