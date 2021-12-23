
$(document).ready(function () {

    fetch_data();

    function fetch_data() {
        var dataTable = $('#book_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "/assets/pages/datatablestest/fetch.php",
                type: "POST"
            }
        });
    }

    // function update_data(id, column_name, value) {
    //     $.ajax({
    //         url: "/assets/pages/datatablestest/update.php",
    //         method: "POST",
    //         data: {
    //             id: id,
    //             column_name: column_name,
    //             value: value
    //         },
    //         success: function (data) {
    //             $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
    //             $('#book_data').DataTable().destroy();
    //             fetch_data();
    //         }
    //     });
    //     setInterval(function () {
    //         $('#alert_message').html('');
    //     }, 5000);
    // }

    // $(document).on('blur', '.update', function () {
    //     var id = $(this).data("id");
    //     var column_name = $(this).data("column");
    //     var value = $(this).text();
    //     update_data(id, column_name, value);
    // });

    // $('#add').click(function () {
    //     var html = '<tr>';
    //     html += '<td contenteditable id="data1"></td>';
    //     html += '<td contenteditable id="data2"></td>';
    //     html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
    //     html += '</tr>';
    //     $('#book_data tbody').prepend(html);
    // });

    // $(document).on('click', '#insert', function () {
    //     var first_name = $('#data1').text();
    //     var last_name = $('#data2').text();
    //     if (first_name != '' && last_name != '') {
    //         $.ajax({
    //             url: "/assets/pages/datatablestest/insert.php",
    //             method: "POST",
    //             data: {
    //                 first_name: first_name,
    //                 last_name: last_name
    //             },
    //             success: function (data) {
    //                 $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
    //                 $('#book_data').DataTable().destroy();
    //                 fetch_data();
    //             }
    //         });
    //         setInterval(function () {
    //             $('#alert_message').html('');
    //         }, 5000);
    //     } else {
    //         alert("Both Fields is required");
    //     }
    // });

    // $(document).on('click', '.delete', function () {
    //     var id = $(this).attr("id");
    //     if (confirm("Are you sure you want to remove this?")) {
    //         $.ajax({
    //             url: "/assets/pages/datatablestest/delete.php",
    //             method: "POST",
    //             data: {
    //                 id: id
    //             },
    //             success: function (data) {
    //                 $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
    //                 $('#book_data').DataTable().destroy();
    //                 fetch_data();
    //             }
    //         });
    //         setInterval(function () {
    //             $('#alert_message').html('');
    //         }, 5000);
    //     }
    // });
});