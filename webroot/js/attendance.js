document.addEventListener('DOMContentLoaded', function(){
    console.log('Loaded');

    var attendancesTable = document.getElementById('attendancesTable').getElementsByTagName('tbody')[0];
    function generateTable(attendances){

        attendancesTable.innerHTML = '';
        attendances.forEach(function(attendance, index){

            var row = document.createElement('tr');
            var checkInTime = new Date(attendance.check_in).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            var checkOut = new Date(attendance.check_out).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            var checkOutTime = attendance.check_out ? checkOut : 'N/A';
            if (attendance.check_out) {
                checkOutTime = new Date(attendance.check_out).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            } else {
                checkOutTime = '';
            }
            var checkInDate = new Date(attendance.created).toLocaleDateString('en-US', { year: 'numeric', day: '2-digit', month: '2-digit' });

            row.innerHTML = `
            <td>${index + 1}</td>
            <td>${attendance.employee.first_name} ${attendance.employee.middle_name} ${attendance.employee.last_name}</td>
            <td>${attendance.employee.department.department}</td>
            <td>${checkInTime}</td>
            <td>${checkOutTime}</td>
            <td>${checkInDate}</td>
            `;
            attendancesTable.appendChild(row);
        })
    }
    var departmenyFilter = document.getElementById('departmentFilter');
    var departments = [...new Set(attendances.map(attendance => attendance.employee.department?.department || 'N/A'))];  
    departments.forEach(function(department){
        var option = document.createElement('option');
        option.value = department;
        option.textContent = department;
        departmenyFilter.appendChild(option);
    });

    departmenyFilter.addEventListener('change', function(){
        var selectedDepartment = this.value;
        var filteredAttendances = attendances.filter(function(attendance){
            return selectedDepartment === '' || (attendance.employee.department?.department === selectedDepartment);
        });
        generateTable(filteredAttendances);
    });

    var dateFilter = document.getElementById('dateFilter');     
    dateFilter.addEventListener('change', function () {
        var selectedDate = this.value; 
        var filteredAttendances = attendances.filter(function (attendance) {
            var attendanceDate = new Date(attendance.created).toISOString().split('T')[0];
            return selectedDate === '' || attendanceDate === selectedDate;
        });
        generateTable(filteredAttendances);
    });

    document.getElementById("pfdBtn").addEventListener("click", function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const headers = [];
        document.querySelectorAll("#attendancesTable thead th").forEach(th => {
            headers.push(th.textContent.trim());
        });

        const rows = [];
        document.querySelectorAll("#attendancesTable tbody tr").forEach(tr => {
            const row = [];
            tr.querySelectorAll("td").forEach(td => {
                row.push(td.textContent.trim());
            });
            rows.push(row);
        });

        doc.autoTable({
            head: [headers],
            body: rows,
            startY: 10,
            theme: 'grid',
        });

        doc.save("attendance.pdf");
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
    if (typeof attendances !== 'undefined' && Array.isArray(attendances)) {
        var today = new Date();
        var date = today.toISOString().split('T')[0]; 

        var count = attendances.filter(attendance => {
            var attendanceDate = new Date(attendance.created).toISOString().split('T')[0];
            return attendanceDate === date;
        }).length;

        document.getElementById('attendanceCount').innerText = count ;
    } else {
        console.error('Attendances data is not defined or invalid.');
        document.getElementById('attendanceCount').innerText = '0';
    }
    
    generateTable(attendances);
});

