
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

     // Property Category
     $('#property_category').on('change', function() {
          if ($(this).val() === 'Leasehold') {
               $('#lease_duration_group').attr('style', 'display: block !important');
          } else {
               $('#lease_duration_group').attr('style', 'display: none !important');
          }
     });


//      $('#group_secure_neighborhood_type').hide();
//      $('#group_on_site_service_type').hide();
//      $('#group_last_year_income').hide();
//      $('#group_private_garden_size').hide();

//      // Swimming Pool Toggle
//      $('#swimming_pool').on('change', function() {
//           let value = $(this).val();
//           if (value === 'Yes') {
//                $('#group_4').show();
//           } else {
//                $('#group_4').hide();
//           }
//      });

//      // Property Type Toggle
//      $('#property_type').on('change', function() {
//           let value = $(this).val();

//           if (value === 'appartement') {
//                $('#group_year_built').hide();
//                $('#group_property_status').show();

//           }
//           else if(value === 'villa') {
//                $('#group_property_status').hide();
//                $('#group_year_built').show();
//           }
//           else {
//                $('#group_year_built').show();
//                $('#group_property_status').show();
//           }
//      });

//      // Secure Neighborhood
//      $('#secure_neighborhood').on('change', function() {
//           let value = $(this).val();

//           if (value === 'yes') {
//                $('#group_secure_neighborhood_type').show();

//           }
//           else {
//                $('#group_secure_neighborhood_type').hide();
//           }
//      });

//      // Om Site Service
//      $('#on_site_service').on('change', function() {
//           let value = $(this).val();

//           if (value === 'yes') {
//                $('#group_on_site_service_type').show();

//           }
//           else {
//                $('#group_on_site_service_type').hide();
//           }
//      });

//      // Rental History
//      $('#rental_history').on('change', function() {
//           let value = $(this).val();

//           if (value === 'yes') {
//                $('#group_last_year_income').show();

//           }
//           else {
//                $('#group_last_year_income').hide();
//           }
//      });
//      // Private Garden
//      $('#private_garden').on('change', function() {
//           let value = $(this).val();
//           console.log(value);

//           if (value === 'yes') {
//                $('#group_private_garden_size').show();

//           }
//           else {
//                $('#group_private_garden_size').hide();
//           }
//      });

     
});