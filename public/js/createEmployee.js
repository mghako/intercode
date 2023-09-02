(function updateContainerCount() {
    var span = document.getElementById("employee-container-count");

    // Set the new text
    span.innerText = employeeContainerCount();
})()

document.getElementById('add-employee').addEventListener('click', function () {
    const container = document.getElementById('employee-container');
    const employeeFields = document.createElement('div');
    employeeFields.classList.add('employee-box');
    employeeFields.innerHTML = `
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name[]" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email[]" class="form-control" required>
        </div>
        <button type="button" class="remove-employee btn btn-danger">Remove</button>
    `;
    if(! checkEmployeeContainerCount(51)) {
        alert("50 is limit!");
    } 
    container.appendChild(employeeFields);
    updateContainerCount();
    
});

function updateContainerCount() {
    console.log('update called');
    var spanTag = document.getElementById("employee-container-count");
    spanTag.innerText = employeeContainerCount();
}



document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('remove-employee')) {
        const employee = e.target.closest('.employee-box');
        if (employee) {
            employee.remove();
            updateContainerCount();
        }
    }
});

function isEmployeeContainerEmpty() {
    const container = document.getElementById('employee-container');
    return container.children.length === 0;
}

function checkEmployeeContainerCount(value) {
    const container = document.getElementById('employee-container');
    return container.children.length < value;
}

function employeeContainerCount() {
    const container = document.getElementById('employee-container');
    return container.children.length;
}


