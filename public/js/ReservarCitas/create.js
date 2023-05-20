// $(document).ready(function() {
//     $('#tiposervicio').change(function() {
//         var tiposervicio_id = $(this).val();

//         // Realizar una solicitud AJAX al servidor
//         $.ajax({
//             url: '/obtener-usuarios',
//             type: 'GET',
//             data: { tiposervicio_id: tiposervicio_id },
//             success: function(response) {
//                 // Limpiar el segundo select
//                 console.log(response)
//                 $('#funcionario').empty();

//                 // Agregar las opciones de usuario al segundo select
//                 response.forEach(function(users) {
//                     $('#funcionario').append('<option value="' + users.id + '">' + users.name + '</option>');
//                 });
//             }
//         });
//     });
// });