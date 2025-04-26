$(document).ready(function () {
    console.log('Loaded');
    var table = $('#employeesTable').DataTable({
        scrollX: true,
        pageLength: 50,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        paging: true,
        searching: true,
        ordering: true,
        autoWidth: false,
    });
    table.clear();

    employees.forEach(function (employee, index) {
        table.row.add([
            index + 1,
            `<div style="display: flex; justify-content: center; margin-top: 10px;">
                <input type="checkbox" class="department-checkbox" value="${employee.id}">
            </div>`,
            employee.first_name || 'N/A',
            employee.middle_name || 'N/A',
            employee.last_name || 'N/A',
            (employee.department && employee.department.department) || 'N/A',
            employee.date_of_birth || 'N/A',
            (employee.status === 'Singel' ? 'Single' : employee.status) || 'N/A',
            employee.place_of_birth || 'N/A',
            employee.qr_code || 'N/A',
            new Date(employee.created).toLocaleString('en-US'),
            new Date(employee.modified).toLocaleString('en-US'),
            `<div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="/adventist-attendance-system/employees/view/${employee.id}" class="btn btn-primary btn-sm me-1">View</a>
                <a href="/adventist-attendance-system/employees/edit/${employee.id}" class="btn btn-success btn-sm me-1">Edit</a>
                <a href="#" onclick="confirmDelete(${employee.id})" class="btn btn-danger btn-sm me-1">Delete</a>
            </div>`
        ]).draw(false);
    });
});

function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/adventist-attendance-system/employees/delete/${id}`,
                type: 'POST', 
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text: "There was an error deleting the file.",
                        icon: "error"
                    });
                }
            });
        }
    });
}

