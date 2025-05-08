
$(document).ready(function() {
     // Sembunyikan semua grup toggle
     $('.toggle-group').hide();
     
     // Handle semua toggle sekaligus
     $('[data-toggle-target]').on('change', function() {
         const target = $(this).data('toggle-target');
         const showCondition = $(this).val() === 'yes' || $(this).val() === 'Yes'; // Sesuaikan dengan value Anda
         
         $(target).toggle(showCondition);
     });
 });
          
$(document).ready(function() {

     $('#leasehold_group').hide();
     $('#freehold_group').hide();

     // Property Category
     $('#legal_category').on('change', function() {
          if ($(this).val() === 'Leasehold') {
               $('#leasehold_group').attr('style', 'display: block !important');
               $('#freehold_group').attr('style', 'display: none !important');

          } else {
               $('#leasehold_group').attr('style', 'display: none !important');
               $('#freehold_group').attr('style', 'display: block !important');
          }
     });

     
});