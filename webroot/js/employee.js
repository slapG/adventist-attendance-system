document.addEventListener('DOMContentLoaded', function () {
    console.log('Loaded');

    var employeesTable = document.getElementById('employeesTable').getElementsByTagName('tbody')[0];
    var searchInput = document.getElementById('searchBar'); 

    function generateTable(employees) {

        employeesTable.innerHTML = ''; 
        employees.forEach(function (employee, index) {
            var row = document.createElement('tr');

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${employee.first_name || 'N/A'}</td>
                <td>${employee.middle_name || 'N/A'}</td>
                <td>${employee.last_name || 'N/A'}</td>
                <td>${(employee.department && employee.department.department) || 'N/A'}</td>
                <td>${employee.date_of_birth || 'N/A'}</td>
                <td>${employee.status || 'N/A'}</td>
                <td>${employee.place_of_birth || 'N/A'}</td>
                <td>${new Date(employee.created).toLocaleString('en-US')}</td>
                <td>${new Date(employee.modified).toLocaleString('en-US')}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <a href="/adventist-attendance-system/employees/view/${employee.id}" class="btn btn-primary btn-sm">View</a>
                        <a href="/adventist-attendance-system/employees/edit/${employee.id}" class="btn btn-success btn-sm ">Edit</a>
                        <a href="#" onclick="confirmDelete(${employee.id})" class="btn btn-danger btn-sm ">Delete</a>
                    </div> 
                </td>
            `;
            employeesTable.appendChild(row);
        });
    }

    var departmentFilter = document.getElementById('departmentFilter');
    var departments = [...new Set(employees.map(emp => emp.department?.department || 'N/A'))];

    departments.forEach(function (department) {
        var option = document.createElement('option');
        option.value = department;
        option.textContent = department;
        departmentFilter.appendChild(option);
    });

    departmentFilter.addEventListener('change', function () {
        var selectedDepartment = this.value;
        var filteredEmployees = employees.filter(function (employee) {
            return selectedDepartment === '' || (employee.department?.department === selectedDepartment);
        });
        generateTable(filteredEmployees);
    });

    var statusFilter = document.getElementById('statusFilter');
    statusFilter.addEventListener('change', function () {
        var selectedStatus = this.value.toLowerCase();
        var filteredEmployees = employees.filter(function (employee) {
            return selectedStatus === '' || employee.status.toLowerCase() === selectedStatus;
        });
        generateTable(filteredEmployees);
    });

    searchInput.addEventListener('input', function () {
        var searchTerm = this.value.toLowerCase(); 
        var filteredEmployees = employees.filter(function (employee) {
            return (
                employee.first_name.toLowerCase().includes(searchTerm) ||
                employee.middle_name.toLowerCase().includes(searchTerm) ||
                employee.last_name.toLowerCase().includes(searchTerm) ||
                (employee.department && employee.department.department.toLowerCase().includes(searchTerm)) ||
                employee.status.toLowerCase().includes(searchTerm) ||
                employee.place_of_birth.toLowerCase().includes(searchTerm) ||
                employee.qr_code.toLowerCase().includes(searchTerm)
            );
        });
        generateTable(filteredEmployees);
    });

    var tableContainer = document.getElementById('tableContainer');
    if (tableContainer) {
        const ps = new PerfectScrollbar(tableContainer, {
            wheelSpeed: 1, 
            wheelPropagation: true, 
            minScrollbarLength: 20, 
            maxScrollbarLength: 30
        });

        console.log('Perfect Scrollbar initialized for #tableContainer');
    }
    generateTable(employees);
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