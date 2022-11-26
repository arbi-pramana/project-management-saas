<script src="{{url('acara/vendor/global/global.min.js')}}"></script>
<script src="{{url('acara/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{url('acara/vendor/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{url('acara/js/custom.min.js')}}"></script>
<script src="{{url('acara/js/deznav-init.js')}}"></script>
<script src="{{url('acara/vendor/owl-carousel/owl.carousel.js')}}"></script>

<!-- Chart piety plugin files -->
<script src="{{url('acara/vendor/peity/jquery.peity.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{url('acara/vendor/apexchart/apexchart.js')}}"></script>

<!-- Dashboard 1 -->
<script src="{{url('acara/js/dashboard/dashboard-1.js')}}"></script>

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
<script src="{{url('acara/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('acara/js/plugins-init/datatables.init.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script>
    $(".table").DataTable({
        search: {
            regex: false,
            smart: false,
        },
        dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"f><ip>',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    })
</script>